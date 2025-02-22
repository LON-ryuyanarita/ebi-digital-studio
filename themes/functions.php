<?php

/* アイキャッチ有効化 */
function twpp_setup_theme()
{
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'twpp_setup_theme');


/* 絵文字のスクリプトとCSSを無効化 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/* 固定ページのエディタを非表示 */
function remove_page_editor()
{
  remove_post_type_support('page', 'editor');
}
add_action('init', 'remove_page_editor');


/* メニューの投稿を削除 */
function remove_default_post_type_menu()
{
  remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_default_post_type_menu');


/* カスタム投稿タイプ追加 */
add_action('init', 'create_post_type');
function create_post_type()
{
  /* 投稿タイプを登録 */
  register_post_type(
    'cpost',
    array(
      'labels' => array(
        'name' => '投稿',
        'all_items' => '投稿 一覧',
        'add_new' => '新規投稿を追加',
        'add_new_item' => '新規投稿を追加'
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array(
        'title',
      ),
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-write-blog',
      'show_in_rest' => true, /* API で利用可能にする */
    )
  );
  register_taxonomy(
    'cpost-cat',
    'cpost',
    array(
      'label' => 'カテゴリー',
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
    )
  );
  register_taxonomy(
    'cpost-tag',
    'cpost',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}

function add_custom_query_vars($vars)
{
  $vars[] = 'paged';
  return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');

function custom_cpost_rewrite_rules()
{
  // 記事個別ページ（例: /articles/123/）
  add_rewrite_rule(
    '^articles/([0-9]+)/?$',
    'index.php?post_type=cpost&p=$matches[1]',
    'top'
  );

  // 記事一覧のページネーション対応（例: /articles/page/2/）
  add_rewrite_rule(
    '^articles/page/([0-9]+)/?$',
    'index.php?post_type=cpost&paged=$matches[1]',
    'top'
  );

  // タグアーカイブ（例: /tags/testdrive/）
  add_rewrite_rule(
    '^tags/([^/]+)/?$',
    'index.php?cpost-tag=$matches[1]',
    'top'
  );

  // タグアーカイブのページネーション対応（例: /tags/testdrive/page/3/）
  add_rewrite_rule(
    '^tags/([^/]+)/page/([0-9]+)/?$',
    'index.php?cpost-tag=$matches[1]&paged=$matches[2]',
    'top'
  );

  // カテゴリーアーカイブのページネーション対応（例: /reviews/page/2/）
  add_rewrite_rule(
    '^([^/]+)/page/([0-9]+)/?$',
    'index.php?cpost-cat=$matches[1]&paged=$matches[2]',
    'top'
  );

  // カテゴリーアーカイブ（例: /reviews/）
  add_rewrite_rule(
    '^([^/]+)/?$',
    'index.php?cpost-cat=$matches[1]',
    'top'
  );
}
add_action('init', 'custom_cpost_rewrite_rules');


function custom_cpost_permalinks($post_link, $post)
{
  if ($post->post_type === 'cpost') {
    return home_url('/articles/' . $post->ID . '/');
  }
  return $post_link;
}
add_filter('post_type_link', 'custom_cpost_permalinks', 10, 2);

function custom_taxonomy_permalinks($url, $term, $taxonomy)
{
  if ($taxonomy === 'cpost-cat') {
    return home_url('/' . $term->slug . '/');
  } elseif ($taxonomy === 'cpost-tag') {
    return home_url('/tags/' . $term->slug . '/');
  }
  return $url;
}
add_filter('term_link', 'custom_taxonomy_permalinks', 10, 3);


/* タクソノミーをラジオボタンに変更 */
function select_to_radio_event_cat()
{
?>
  <script type="text/javascript">
    jQuery(function($) {
      function convertCheckboxesToRadios() {
        $('#taxonomy-cpost-cat').find('input[type=checkbox]').each(function() {
          $(this).replaceWith($(this).clone().attr('type', 'radio'));
        });
        $('#cpost-catchecklist').find('input[type=radio]').on('click', function() {
          $(this).closest('.cat-checklist')
            .find('input[type=radio]').not(this).prop('checked', false);
        });
      }

      convertCheckboxesToRadios();

      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
          if (mutation.addedNodes.length > 0) {
            convertCheckboxesToRadios();
          }
        });
      });

      const targetNode = document.body;
      const config = {
        childList: true,
        subtree: true
      };
      observer.observe(targetNode, config);
    });
  </script>
<?php
}
add_action('admin_print_footer_scripts', 'select_to_radio_event_cat');


/* 管理画面いじいじ */
add_action('admin_head', 'custom_admin_inline_styles');
function custom_admin_inline_styles()
{
  echo '<style>
      .acf-field-wysiwyg .mce-toolbar .mce-widget:not([aria-label="リンクの挿入/編集 (⌘K)"]):not(.mce-widget.mce-btn.mce-menubtn.mce-first.mce-btn-has-text) {
        display: none;
      }
      .client.column-client {
        a {
          margin-right: 1em;
        }
      }
      .mce-menu .mce-menu-item.mce-active.mce-menu-item-normal,
      .mce-menu .mce-menu-item.mce-active.mce-menu-item-preview,
      .mce-menu .mce-menu-item.mce-selected {
        color: inherit !important;
        background: #d7e9f9 !important;
      }
      .mce-menu .mce-menu-item:focus,
      .mce-menu .mce-menu-item:hover {
        color: white !important;
        background: #359cfa !important;
      }
  </style>';
}
//スタイルセレクトボタンを追加
function tinymce_add_buttons($array)
{
  array_unshift(
    $array,
    'styleselect'
  );
  return $array;
}
add_filter('mce_buttons', 'tinymce_add_buttons');

function customize_tinymce_settings($mceInit)
{
  $style_formats = array(
    array(
      'title' => '太字 強調',
      'inline' => 'em',
      'classes' => '-em1',
      'styles' => array(
        'font-style' => 'normal',
        'font-weight' => 'bold'
      ),
      'exact' => true,
    ),
    array(
      'title' => '太字アンダーライン 強調',
      'inline' => 'em',
      'classes' => '-em2',
      'styles' => array(
        'font-style' => 'normal',
        'font-weight' => 'bold',
        'text-decoration' => 'underline',
        'text-decoration-thickness' => '4px',
        'text-decoration-style' => 'solid',
        'text-decoration-color' => '#ddd  ',
        'text-underline-offset' => '-2px',
      ),
      'exact' => true,
    ),
    array(
      'title' => '書式設定をリセット',
      'selector' => '*',
      'remove' => 'all',
    ),
  );
  $mceInit['style_formats'] = json_encode($style_formats);
  return $mceInit;
}
add_filter('tiny_mce_before_init', 'customize_tinymce_settings');


/* Contact Form 7の自動pタグ無効 */
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
  return false;
}


/* youtube ID 抽出 */
function get_youtube_id($url)
{
  // `youtu.be/` や `youtube.com/watch?v=` の解析
  if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
    return $matches[1];
  }

  // `parse_url()` を使って `?v=` を取得（保険）
  $parsed_url = parse_url($url);
  if (isset($parsed_url['query'])) {
    parse_str($parsed_url['query'], $query_params);
    return $query_params['v'] ?? null;
  }

  return null;
}


/* 改行で区切って span でラップ */
function wrap_with_span($text)
{
  // 改行（\n）を <br> に変換
  $text = nl2br($text);

  // `<br>` の前後を `<span>` で囲む
  $text = preg_replace('/([^<]+)(<br\s*\/?>)/i', '<span>$1</span>$2', $text);
  $text = preg_replace('/(<br\s*\/?>)([^<]+)/i', '$1<span>$2</span>', $text);

  // もし <span> タグが存在しなければ（＝1行のみの場合）全体を囲む
  if (strpos($text, '<span>') === false) {
    $text = '<span>' . $text . '</span>';
  }
  return $text;
}


/* 改行で区切って span でラップ */
function wrap_with_li($text)
{
  // <br> に続く改行を削除
  $text = preg_replace('/<br\s*\/?>\s*[\r\n]+/', '<br />', $text);

  // 文頭・文末の改行を削除
  $text = trim($text, "\r\n");

  // 改行コードで分割
  $lines = preg_split('/\r\n|\r|\n/', $text);

  // 各行を <li> で囲む
  $listItems = array_map(function ($line) {
    return "<li>{$line}</li>";
  }, $lines);

  // 連結して出力
  return implode("\n", $listItems);
}


/* OGP 取得 */
function get_ogp_data($url)
{
  require_once get_template_directory() . '/include/OpenGraph.php';

  $ogp_data = [
    'title'       => '',
    'description' => '',
  ];

  $graph = OpenGraph::fetch($url);
  if ($graph) {
    $detects = ['ASCII', 'EUC-JP', 'SJIS', 'JIS', 'CP51932', 'UTF-16', 'ISO-8859-1'];
    $post_title = esc_attr($graph->title);
    $site_name = esc_attr($graph->site_name);

    $title_check = mb_convert_encoding($post_title, 'ISO-8859-1', 'UTF-8');
    if (mb_detect_encoding($title_check) == 'UTF-8') {
      $post_title = $title_check;
    }
    if (mb_detect_encoding($post_title) != 'UTF-8') {
      $post_title = mb_convert_encoding($post_title, 'UTF-8', mb_detect_encoding($post_title, $detects, true));
    }

    $site_name_check = mb_convert_encoding($site_name, 'ISO-8859-1', 'UTF-8');
    if (mb_detect_encoding($site_name_check) == 'UTF-8') {
      $site_name = $site_name_check;
    }
    if (mb_detect_encoding($site_name) != 'UTF-8') {
      $site_name = mb_convert_encoding($site_name, 'UTF-8', mb_detect_encoding($site_name, $detects, true));
    }
  }

  $ogp_data['title'] = $graph->title;
  $ogp_data['description'] = $graph->description;

  return $ogp_data;
}
?>