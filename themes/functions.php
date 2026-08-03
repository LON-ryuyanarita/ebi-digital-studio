<?php

/* アイキャッチ有効化 */
function twpp_setup_theme()
{
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'twpp_setup_theme');


/* 添付画像をレスポンシブ画像として出力 */
function ebi_get_attachment_image($attachment_id, $size = 'large', $attributes = array())
{
  if (!$attachment_id) {
    return '';
  }

  $default_attributes = array(
    'alt' => '',
    'loading' => 'lazy',
    'decoding' => 'async',
  );

  return wp_get_attachment_image(
    (int) $attachment_id,
    $size,
    false,
    array_merge($default_attributes, $attributes)
  );
}


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
      'publicly_queryable' => true,
      'has_archive' => true,
      'supports' => array(
        'title',
        'slug',
      ),
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-write-blog',
      'show_in_rest' => true, /* API で利用可能にする */
      'rewrite' => array(
        'slug' => 'articles',
        'with_front' => false,
      ),
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
  // 記事個別ページ（例: /articles/sample-post/）
  add_rewrite_rule(
    '^articles/([^/]+)/?$',
    'index.php?post_type=cpost&name=$matches[1]',
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

  global $wp;
  $all_pages = get_pages();
  $page_slugs = array_map(function ($page) {
    return $page->post_name;
  }, $all_pages);

  // 固定ページのスラッグと一致するカテゴリーは `cpost-cat` として扱わない
  add_rewrite_rule(
    '^([^/]+)/page/([0-9]+)/?$',
    'index.php?cpost-cat=$matches[1]&paged=$matches[2]',
    'top'
  );

  foreach ($page_slugs as $slug) {
    add_rewrite_rule(
      '^' . $slug . '/?$',
      'index.php?pagename=' . $slug,
      'top'
    );
  }

  // カテゴリーアーカイブ（例: /reviews/）のルールを変更
  add_rewrite_rule(
    '^([^/]+)/?$',
    'index.php?cpost-cat=$matches[1]',
    'top'
  );

  flush_rewrite_rules();
}
add_action('init', 'custom_cpost_rewrite_rules');

function flush_cpost_rewrite_rules()
{
  flush_rewrite_rules();
}
add_action('save_post_cpost', 'flush_cpost_rewrite_rules');


function custom_cpost_permalinks($post_link, $post)
{
  if ($post->post_type === 'cpost') {
    $slug = get_post_field('post_name', $post);
    return home_url('/articles/' . $slug . '/');
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

/* ACFのリッチテキストに必要なボタンだけを表示 */
function ebi_acf_wysiwyg_toolbars($toolbars)
{
  if (!isset($toolbars['Full'])) {
    return $toolbars;
  }

  $toolbars['Full'] = array(
    1 => array('styleselect', 'bullist', 'numlist', 'link', 'unlink'),
  );

  return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'ebi_acf_wysiwyg_toolbars');

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


/* OGPグループに取得結果の保存欄を追加 */
function ebi_add_ogp_metadata_fields($field)
{
  if (($field['key'] ?? '') !== 'field_67aea371bbfac' || ($field['type'] ?? '') !== 'group') {
    return $field;
  }

  $sub_fields = $field['sub_fields'] ?? array();
  $field_names = wp_list_pluck($sub_fields, 'name');

  if (!in_array('title', $field_names, true)) {
    $sub_fields[] = array(
      'key' => 'field_ebi_ogp_title',
      'label' => 'タイトル',
      'name' => 'title',
      '_name' => 'title',
      'type' => 'text',
      'instructions' => '「情報取得」を押すとリンク先から取得します。必要に応じて編集できます。',
      'required' => 0,
      'wrapper' => array('width' => '', 'class' => '', 'id' => ''),
      'default_value' => '',
      'parent' => $field['key'],
    );
  }

  if (!in_array('description', $field_names, true)) {
    $sub_fields[] = array(
      'key' => 'field_ebi_ogp_description',
      'label' => 'ディスクリプション',
      'name' => 'description',
      '_name' => 'description',
      'type' => 'textarea',
      'instructions' => '「情報取得」を押すとリンク先から取得します。必要に応じて編集できます。',
      'required' => 0,
      'wrapper' => array('width' => '', 'class' => '', 'id' => ''),
      'default_value' => '',
      'rows' => 4,
      'new_lines' => '',
      'parent' => $field['key'],
    );
  }

  $field['sub_fields'] = $sub_fields;
  return $field;
}
add_filter('acf/load_field/name=ogp', 'ebi_add_ogp_metadata_fields', 20);


/* OGP取得ボタン用の管理画面スクリプト */
function ebi_enqueue_ogp_admin_script()
{
  $screen = function_exists('get_current_screen') ? get_current_screen() : null;

  if (!$screen || $screen->post_type !== 'cpost') {
    return;
  }

  $script_path = get_template_directory() . '/assets/js/admin-ogp.js';
  if (!file_exists($script_path)) {
    return;
  }

  wp_enqueue_script(
    'ebi-admin-ogp',
    get_template_directory_uri() . '/assets/js/admin-ogp.js',
    array('jquery', 'acf-input', 'wp-api-fetch'),
    filemtime($script_path),
    true
  );
}
add_action('acf/input/admin_enqueue_scripts', 'ebi_enqueue_ogp_admin_script');


/* 管理画面からリンク先のOGP情報を取得 */
function ebi_register_ogp_rest_route()
{
  register_rest_route('ebi/v1', '/ogp', array(
    'methods' => WP_REST_Server::CREATABLE,
    'permission_callback' => function (WP_REST_Request $request) {
      $post_id = (int) $request->get_param('post_id');

      if (!current_user_can('edit_posts')) {
        return false;
      }

      if ($post_id && !current_user_can('edit_post', $post_id)) {
        return false;
      }

      if ($request->get_param('fetch_image') && !current_user_can('upload_files')) {
        return false;
      }

      return true;
    },
    'args' => array(
      'url' => array(
        'required' => true,
        'type' => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'validate_callback' => function ($url) {
          return (bool) wp_http_validate_url($url);
        },
      ),
      'fetch_image' => array(
        'type' => 'boolean',
        'default' => false,
      ),
      'post_id' => array(
        'type' => 'integer',
        'minimum' => 0,
        'default' => 0,
      ),
    ),
    'callback' => 'ebi_fetch_ogp_data',
  ));
}
add_action('rest_api_init', 'ebi_register_ogp_rest_route');

function ebi_fetch_ogp_data(WP_REST_Request $request)
{
  $url = esc_url_raw($request->get_param('url'));
  $response = wp_safe_remote_get($url, array(
    'timeout' => 8,
    'redirection' => 3,
    'user-agent' => 'EBI DIGITAL STUDIO OGP Fetcher; ' . home_url('/'),
    'limit_response_size' => 1048576,
  ));

  if (is_wp_error($response)) {
    return new WP_Error('ebi_ogp_fetch_failed', 'OGP情報を取得できませんでした。', array('status' => 502));
  }

  $status_code = wp_remote_retrieve_response_code($response);
  $body = wp_remote_retrieve_body($response);

  if ($status_code < 200 || $status_code >= 300 || !$body) {
    return new WP_Error('ebi_ogp_invalid_response', 'リンク先から有効な応答を取得できませんでした。', array('status' => 502));
  }

  $data = ebi_extract_ogp_data($body, $url);
  $image_url = $data['image_url'];
  unset($data['image_url']);

  $data['image'] = null;
  $data['image_error'] = '';

  if ($request->get_param('fetch_image')) {
    if (!$image_url) {
      $data['image_error'] = 'リンク先にog:imageが設定されていません。';
    } else {
      $attachment_id = ebi_sideload_ogp_image(
        $image_url,
        (int) $request->get_param('post_id'),
        $data['title']
      );

      if (is_wp_error($attachment_id)) {
        $data['image_error'] = $attachment_id->get_error_message();
      } else {
        $data['image'] = wp_prepare_attachment_for_js($attachment_id);

        if (!$data['image']) {
          $data['image'] = array(
            'id' => $attachment_id,
            'url' => wp_get_attachment_url($attachment_id),
          );
        }
      }
    }
  }

  return rest_ensure_response($data);
}

function ebi_extract_ogp_data($html, $source_url = '')
{
  $data = array('title' => '', 'description' => '', 'image_url' => '');

  if (!class_exists('DOMDocument')) {
    return $data;
  }

  $previous_errors = libxml_use_internal_errors(true);
  $dom = new DOMDocument();
  $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
  libxml_clear_errors();
  libxml_use_internal_errors($previous_errors);

  $xpath = new DOMXPath($dom);
  $data['title'] = ebi_find_meta_content($xpath, 'property', 'og:title');
  $data['description'] = ebi_find_meta_content($xpath, 'property', 'og:description');
  $data['image_url'] = ebi_find_meta_content($xpath, 'property', 'og:image:secure_url');

  if (!$data['image_url']) {
    $data['image_url'] = ebi_find_meta_content($xpath, 'property', 'og:image');
  }

  if (!$data['image_url']) {
    $data['image_url'] = ebi_find_meta_content($xpath, 'name', 'twitter:image');
  }

  if (!$data['title']) {
    $title_nodes = $xpath->query('//title');
    if ($title_nodes->length > 0) {
      $data['title'] = trim($title_nodes->item(0)->textContent);
    }
  }

  if (!$data['description']) {
    $data['description'] = ebi_find_meta_content($xpath, 'name', 'description');
  }

  $data['title'] = sanitize_text_field($data['title']);
  $data['description'] = sanitize_text_field($data['description']);

  if ($data['image_url'] && $source_url) {
    $data['image_url'] = WP_Http::make_absolute_url($data['image_url'], $source_url);
  }
  $data['image_url'] = esc_url_raw($data['image_url']);

  return $data;
}

function ebi_find_meta_content(DOMXPath $xpath, $attribute, $value)
{
  $query = sprintf(
    '//meta[translate(@%1$s, "ABCDEFGHIJKLMNOPQRSTUVWXYZ", "abcdefghijklmnopqrstuvwxyz")="%2$s"]',
    $attribute,
    strtolower($value)
  );
  $nodes = $xpath->query($query);

  if ($nodes->length < 1) {
    return '';
  }

  return trim($nodes->item(0)->getAttribute('content'));
}

function ebi_sideload_ogp_image($image_url, $post_id = 0, $title = '')
{
  $image_url = esc_url_raw($image_url);

  if (!wp_http_validate_url($image_url)) {
    return new WP_Error('ebi_ogp_invalid_image_url', 'OGP画像のURLが無効です。');
  }

  $local_attachment_id = attachment_url_to_postid($image_url);
  if ($local_attachment_id) {
    return $local_attachment_id;
  }

  $existing_attachments = get_posts(array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'posts_per_page' => 1,
    'fields' => 'ids',
    'meta_key' => '_source_url',
    'meta_value' => $image_url,
  ));

  if ($existing_attachments) {
    return (int) $existing_attachments[0];
  }

  require_once ABSPATH . 'wp-admin/includes/file.php';
  require_once ABSPATH . 'wp-admin/includes/media.php';
  require_once ABSPATH . 'wp-admin/includes/image.php';

  $attachment_id = media_sideload_image(
    $image_url,
    $post_id,
    $title ?: null,
    'id'
  );

  if (is_wp_error($attachment_id)) {
    return new WP_Error('ebi_ogp_image_fetch_failed', 'OGP画像を取得できませんでした。');
  }

  return (int) $attachment_id;
}


/* 記事モジュールで許可するリッチテキスト */
function ebi_kses_rich_text($html)
{
  $allowed_html = array(
    'p' => array(),
    'a' => array(
      'href' => true,
      'target' => true,
      'rel' => true,
      'class' => true,
    ),
    'em' => array('class' => true, 'style' => true),
    'strong' => array('class' => true),
    'br' => array(),
    'ul' => array('class' => true),
    'ol' => array('class' => true),
    'li' => array('class' => true),
  );

  return wp_kses($html, $allowed_html);
}


/* 輝度計算 */
function get_text_color($hex)
{
  // 16進数形式のバリデーション（#付き or 3桁/6桁の16進数）
  if (!preg_match('/^#?([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $hex)) {
    return "";
  }
  // 16進数をRGBに変換
  $hex = ltrim($hex, '#');
  if (strlen($hex) === 3) {
    $r = hexdec(str_repeat($hex[0], 2));
    $g = hexdec(str_repeat($hex[1], 2));
    $b = hexdec(str_repeat($hex[2], 2));
  } else {
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
  }

  $luminance = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);
  // 128未満なら白、128以上なら黒
  return ($luminance < 128) ? '#fff' : '';
}


/* 関連記事 */
function get_related_cposts_by_tags($post_id)
{
  if (!$post_id) return new WP_Query();

  $tags = wp_get_post_terms($post_id, 'cpost-tag', ['fields' => 'ids']);

  if (empty($tags)) return new WP_Query();

  $args = [
    'post_type' => 'cpost',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => [$post_id],
    'tax_query' => [
      [
        'taxonomy' => 'cpost-tag',
        'field' => 'id',
        'terms' => $tags,
        'operator' => 'IN',
      ],
    ],
  ];

  return new WP_Query($args);
}
?>
