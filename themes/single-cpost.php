<?php
$themeUri = get_template_directory_uri();
$top_page = get_page_by_path('home');
?>

<?php get_header(); ?>

<main class="main" role="main">
  <article class="article">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        $permalink = get_permalink();
        $title = get_field('title');
        $share_title = str_replace(["\r", "\n"], '', strip_tags($title)) . '｜EBI DIGITAL STUDIO';
        $kv = get_field('kv');
        $kv_src = wp_get_attachment_image_url($kv, 'full') ?? null;
        $taxonomy_cat = 'cpost-cat';
        $terms_cats = get_the_terms(get_the_ID(), $taxonomy_cat);
        $taxonomy_tag = 'cpost-tag';
        $terms_tags = get_the_terms(get_the_ID(), $taxonomy_tag);
        $updated = get_field('updated') ?? get_the_modified_date('Y/m/d');
        $updated_date = DateTime::createFromFormat('Y/m/d', $updated);
    ?>
        <header class="article__header">
          <div class="article__header__img">
            <div class="-bg" style="background-image: url(<?php echo $kv_src; ?>);"></div>
            <div class="-img">
              <img src="<?php echo $kv_src; ?>" alt="">
            </div>
          </div>
          <div class="article__header__inner">
            <div class="article__header__category">
              <?php if (!empty($terms_cats) && !is_wp_error($terms_cats)) : ?>
                <?php foreach ($terms_cats as $term) : ?>
                  <a href="<?php echo get_term_link($term); ?>">
                    <?php echo esc_html($term->name); ?>
                  </a>
                <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
            <h1 class="article__header__title">
              <?php echo nl2br($title); ?>
            </h1>
            <div class="article__header__info">
              <div class="-upper">
                <dl class="article__info -created">
                  <dt>Created</dt>
                  <dd>
                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
                  </dd>
                </dl>
                <dl class="article__info -updated">
                  <dt>Updated</dt>
                  <dd>
                    <time datetime="<?php echo $updated_date->format('c'); ?>"><?php echo $updated_date->format('Y.m.d'); ?></time>
                  </dd>
                </dl>
              </div>
              <div class="-lower">
                <dl class="article__info -tags">
                  <dt>Tags</dt>
                  <dd>
                    <?php if (!empty($terms_tags) && !is_wp_error($terms_tags)) : ?>
                      <?php foreach ($terms_tags as $term) : ?>
                        <a href="<?php echo get_term_link($term); ?>">
                          #<?php echo esc_html($term->name); ?>
                        </a>
                      <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </dd>
                </dl>
              </div>
              <dl class="article__info -share">
                <dt>この記事をシェアする</dt>
                <dd>
                  <a class="-facebook" target="_blank" data-ebi-share="facebook" data-ebi-share-url="<?php echo esc_url($permalink); ?>" data-ebi-share-text="<?php echo $share_title; ?>">
                    <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-facebook.svg'); ?>
                  </a>
                  <a class="-x" target="_blank" data-ebi-share="x" data-ebi-share-url="<?php echo esc_url($permalink); ?>" data-ebi-share-text="<?php echo $share_title; ?>">
                    <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-x.svg'); ?>
                  </a>
                  <a class="-line" target="_blank" data-ebi-share="line" data-ebi-share-url="<?php echo esc_url($permalink); ?>" data-ebi-share-text="<?php echo $share_title; ?>">
                    <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-line.svg'); ?>
                  </a>
                </dd>
              </dl>
            </div>
          </div>
        </header>
        <div class="article__contents">
          <div class="body">
            <?php
            $section_counter = 0;
            $section_titles = [];
            ?>
            <?php if (have_rows('body')): ?>
              <?php while (have_rows('body')): the_row(); ?>
                <?php
                $type = get_sub_field('type');
                if ($type === 'h2') {
                  $section_counter++;
                  $h2_text = get_sub_field('h2');
                  $section_titles[] = [
                    'id' => "section-$section_counter",
                    'title' => strip_tags($h2_text),
                  ];
                }
                ?>
              <?php endwhile; ?>
              <?php
              $section_counter = 0;
              while (have_rows('body')): the_row();
                $type = get_sub_field('type'); ?>
                <?php if ($type === 'h2'):
                  $section_counter++;
                  $h2 = wrap_with_span(get_sub_field('h2'));
                ?>
                  <h2 id="section-<?php echo $section_counter; ?>"><?php echo $h2; ?></h2>
                <?php elseif ($type === 'h3'):
                  $h3 = get_sub_field('h3');
                ?>
                  <h3><?php echo nl2br($h3); ?></h3>
                <?php elseif ($type === 'h4'):
                  $h4 = get_sub_field('h4');
                ?>
                  <h4><?php echo nl2br($h4); ?></h4>
                <?php elseif ($type === 'p'):
                  $p = get_sub_field('p');
                ?>
                  <?php echo $p; ?>
                <?php elseif ($type === 'note'):
                  $note = nl2br(strip_tags(get_sub_field('note')));
                ?>
                  <p class="body__note">
                    <small>
                      <?php echo $note; ?>
                    </small>
                  </p>
                <?php elseif ($type === 'img'):
                  $img_group = get_sub_field('imgs');
                  $img_full = $img_group['size'];
                  $img_file = $img_group['img'];
                  $img_src = wp_get_attachment_image_url($img_file, 'full') ?? null;
                  $img_caption = $img_group['caption'];
                  $img_classnames = $img_full == 1 ? 'body__fullimg -full' : 'body__img'
                ?>
                  <div class="<?php echo $img_classnames; ?>">
                    <figure>
                      <img src="<?php echo $img_src; ?>" alt="">
                      <?php if ($img_caption) : ?>
                        <figcaption>
                          <?php echo nl2br(strip_tags($img_caption)); ?>
                        </figcaption>
                      <?php endif; ?>
                    </figure>
                  </div>
                <?php elseif ($type === 'movie'):
                  $mov_group = get_sub_field('movies');
                  $mov_url = $mov_group['url'];
                  $mov_id = get_youtube_id($mov_url);
                  $mov_caption = $mov_group['caption'];
                ?>
                  <div class="body__movie">
                    <div class="-mov">
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $mov_id; ?>?si=qcMLzxJrfcwt2j7m" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="-caption">
                      <?php echo nl2br(strip_tags($mov_caption)); ?>
                    </div>
                  </div>
                <?php elseif ($type === 'list'):
                  $list_group = get_sub_field('lists');
                  $list_is_ol = $list_group['ol'];
                  $list_content = strip_tags($list_group['list'], '<a><em><br>');
                ?>
                  <?php if ($list_is_ol == 1) : ?>
                    <ol>
                      <?php echo wrap_with_li($list_content); ?>
                    </ol>
                  <?php else : ?>
                    <ul>
                      <?php echo wrap_with_li($list_content); ?>
                    </ul>
                  <?php endif; ?>
                <?php elseif ($type === 'button'):
                  $button_group = get_sub_field('buttons');
                  $button_url = $button_group['url'];
                  $button_label = $button_group['label'];
                ?>
                  <div class="body__button">
                    <a href="<? echo esc_url($button_url); ?>">
                      <span><?php echo $button_label; ?></span>
                    </a>
                  </div>
                <?php elseif ($type === 'hr'):
                  $hr_is_dashed = get_sub_field('hr');
                ?>
                  <hr class="<?php echo $hr_is_dashed == 1 ? "-dashed" : ""; ?>">
                <?php elseif ($type === 'box'):
                  $box = get_sub_field('box');
                ?>
                  <div class="body__box">
                    <?php echo strip_tags($box, '<a><em><br>'); ?>
                  </div>
                <?php elseif ($type === 'blockquote'):
                  $blockquote = get_sub_field('blockquote');
                ?>
                  <blockquote>
                    <?php echo strip_tags($blockquote, '<a><em><br>'); ?>
                  </blockquote>
                <?php elseif ($type === 'columns'): ?>
                  <div class="body__columns -full">
                    <div class="-inner">
                      <?php
                      if (have_rows('columns')):
                        while (have_rows('columns')): the_row();
                          $columns_type = get_sub_field('type');
                          $columns_title = get_sub_field('title');
                          $columns_text = strip_tags(get_sub_field('text'), '<p><a><em><br>');
                          $columns_classname = '';
                          if ($columns_type == 'left') {
                            $columns_classname = '-c2 -imgright';
                          }
                          if ($columns_type == 'right') {
                            $columns_classname = '-c2 -imgleft';
                          }
                          if ($columns_type == 'imgs') {
                            $columns_classname = '-c3';
                          }
                      ?>
                          <div class="-column <?php echo $columns_classname; ?>">
                            <?php if ($columns_type == 'left'): ?>
                              <div class="-txt">
                                <h3><?php echo $columns_title; ?></h3>
                                <?php echo $columns_text; ?>
                              </div>
                              <div class="-img">
                                <?php if (have_rows('imgs')):
                                  while (have_rows('imgs')): the_row();
                                    $img_file = get_sub_field('img');
                                    $img_src = wp_get_attachment_image_url($img_file, 'full') ?? null;
                                    $img_caption = get_sub_field('caption');
                                ?>
                                    <figure>
                                      <img src="<?php echo $img_src; ?>" alt="">
                                      <figcaption>
                                        <?php echo nl2br(strip_tags($img_caption)); ?>
                                      </figcaption>
                                    </figure>
                                <?php
                                  endwhile;
                                endif;
                                ?>
                              </div>
                            <?php elseif ($columns_type == 'right'): ?>
                              <div class="-img">
                                <?php if (have_rows('imgs')):
                                  while (have_rows('imgs')): the_row();
                                    $img_file = get_sub_field('img');
                                    $img_src = wp_get_attachment_image_url($img_file, 'full') ?? null;
                                    $img_caption = get_sub_field('caption'); ?>
                                    <figure>
                                      <img src="<?php echo $img_src; ?>" alt="">
                                      <figcaption>
                                        <?php echo nl2br(strip_tags($img_caption)); ?>
                                      </figcaption>
                                    </figure>
                                <?php
                                  endwhile;
                                endif;
                                ?>
                              </div>
                              <div class="-txt">
                                <h3><?php echo $columns_title; ?></h3>
                                <?php echo $columns_text; ?>
                              </div>
                            <?php elseif ($columns_type == 'imgs'): ?>
                              <div class="-imgs">
                                <?php if (have_rows('imgs')):
                                  while (have_rows('imgs')): the_row();
                                    $img_file = get_sub_field('img');
                                    $img_src = wp_get_attachment_image_url($img_file, 'full') ?? null;
                                    $img_caption = get_sub_field('caption'); ?>
                                    <figure>
                                      <img src="<?php echo $img_src; ?>" alt="">
                                      <figcaption>
                                        <?php echo nl2br(strip_tags($img_caption)); ?>
                                      </figcaption>
                                    </figure>
                                <?php
                                  endwhile;
                                endif;
                                ?>
                              </div>
                            <?php endif; ?>
                          </div>
                      <?php
                        endwhile;
                      endif;
                      ?>
                    </div>
                  </div>
                <?php elseif ($type === 'ogp'):
                  $ogp = get_sub_field('ogp');
                  $ogp_link = $ogp['url'];
                  $ogp_data = get_ogp_data($ogp_link);
                  $ogp_img_file = $ogp['img'];
                  $ogp_img_src = wp_get_attachment_image_url($ogp_img_file, 'full') ?? null;
                ?>
                  <div class="body__link">
                    <article class="-ogp">
                      <a href="<?php echo esc_url($ogp_link); ?>" target="_blank">
                        <div class="-img">
                          <img src="<?php echo $ogp_img_src; ?>" alt="">
                        </div>
                        <div class="-txt">
                          <h2><?php echo $ogp_data['title']; ?></h2>
                          <p><?php echo $ogp_data['description']; ?></p>
                        </div>
                      </a>
                    </article>
                  </div>
                <?php elseif ($type === 'dialogue'): ?>
                  <div class="body__dialogue">
                    <?php
                    if (have_rows('dialogues')):
                      while (have_rows('dialogues')): the_row();
                        $group = get_sub_field('dialogues_block');
                        $position = $group['dialogues_position'];
                        $img = $group['dialogues_img'];
                        $img_src = wp_get_attachment_image_url($img, 'full') ?? null;
                        $name = $group['name'];
                        $text = strip_tags($group['dialogues_txt'], '<p><a><em><br>');
                    ?>
                        <div class="-block -<?php echo $position; ?>">
                          <div class="-person">
                            <img src="<?php echo $img_src; ?>" alt="">
                            <span><?php echo $name; ?></span>
                          </div>
                          <?php echo $text; ?>
                        </div>
                    <?php
                      endwhile;
                    endif;
                    ?>
                  </div>
                <?php elseif ($type === 'comment'): ?>
                  <div class="body__comment">
                    <?php
                    if (have_rows('comments')):
                      while (have_rows('comments')): the_row();
                        $group = get_sub_field('comments_block');
                        $position = $group['comments_position'];
                        $name = $group['name'];
                        $text = strip_tags($group['comments_txt'], '<p><a><em><br>');
                    ?>
                        <div class="-block -<?php echo $position; ?>">
                          <div class="-name"><em><?php echo $name; ?></em></div>
                          <?php echo $text; ?>
                        </div>
                    <?php
                      endwhile;
                    endif;
                    ?>
                  </div>
                <?php elseif ($type === 'profile'):
                  $profile_group = get_sub_field('profiles');
                  $profile_title = $profile_group['title'];
                  $profile_text = $profile_group['text'];
                  $profile_img = $profile_group['img'];
                  $profile_img_src = wp_get_attachment_image_url($profile_img, 'full') ?? null;
                ?>
                  <div class="body__profile">
                    <div class="-txt">
                      <div class="-title">
                        <?php echo strip_tags($profile_title, '<a><em><br>'); ?>
                      </div>
                      <p>
                        <?php echo strip_tags($profile_text, '<a><em><br>'); ?>
                      </p>
                    </div>
                    <div class="-img">
                      <img src="<?php echo $profile_img_src; ?>" alt="">
                    </div>
                  </div>
                <?php elseif ($type === 'index'): ?>
                  <!-- <div class="body__index">
                    <div class="-title fontPanchang">
                      INDEX
                    </div>
                    <ul class="-list">
                      <li>
                        <a href="#section1" data-ebi-scroller>自分好みを見つけることのできる理由</a>
                      </li>
                      <li>
                        <a href="#section2" data-ebi-scroller>鮮やかだけれども濃い</a>
                      </li>
                      <li>
                        <a href="#section3" data-ebi-scroller>久しぶりに991.2を駆る</a>
                      </li>
                      <li>
                        <a href="#section4" data-ebi-scroller>スペック</a>
                      </li>
                      <li>
                        <a href="#section5" data-ebi-scroller>写真を一覧で見る</a>
                      </li>
                    </ul>
                  </div> -->
                  <div class="body__index">
                    <div class="-title fontPanchang">
                      INDEX
                    </div>
                    <ul class="-list">
                      <?php foreach ($section_titles as $section): ?>
                        <li>
                          <a href="#<?php echo $section['id']; ?>" data-ebi-scroller>
                            <?php echo $section['title']; ?>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php elseif ($type === 'credit'):
                  $credits = get_sub_field('credits');
                ?>
                  <div class="body__credit">
                    <div class="-title fontPanchang">Credit</div>
                    <div class="-body">
                      <?php echo $credits; ?>
                    </div>
                  </div>
                <?php endif; ?>

              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
        <aside class="lineFriends">
          <div class="lineFriends__inner">
            <div class="lineFriends__contents">
              <h2 class="lineFriends__title">
                EBI DIGITAL STUDIO<br>
                LINE 公式アカウント友だち募集中！
              </h2>
              <ol>
                <li>
                  <span class="-num fontPanchang">01.</span>
                  <p>
                    最新記事やEBI GROUP実施のイベント情報など<br class="sp">最速でご案内<br>
                    <small>※グループ拠点すべてのイベント情報が通知されるわけではありません</small>
                  </p>
                </li>
                <li>
                  <span class="-num fontPanchang">02.</span>
                  <p>
                    来店予約や試乗体験の予約申し込みが可能<br>
                    <small>※来店予約はハブストアであるポルシェスタジオ銀座のみとなります</small>
                  </p>
                </li>
                <li>
                  <span class="-num fontPanchang">03.</span>
                  <p>
                    ポルシェに関するご質問やお困りごとをお気軽にお問い合わせください<br>
                    <small>来店前のご質問や、ちょっとした気になることまで、LINEで簡単にお問い合わせいただけます。</small>
                  </p>
                </li>
              </ol>
              <div class="ebiButton -full -line">
                <a href="https://lin.ee/P29MAc9" target="_blank">
                  <span>公式LINEを登録する</span>
                </a>
              </div>
            </div>
            <div class="lineFriends__img">
              <img src="<?php echo $themeUri; ?>/assets/img/article-line-img.png" alt="">
            </div>
          </div>
        </aside>
        <div class="article__share">
          <dl class="article__info -share">
            <dt>この記事をシェアする</dt>
            <dd>
              <a class="-facebook" target="_blank" data-ebi-share="facebook" data-ebi-share-url="<?php echo esc_url($permalink); ?>" data-ebi-share-text="<?php echo $share_title; ?>">
                <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-facebook.svg'); ?>
              </a>
              <a class="-x" target="_blank" data-ebi-share="x" data-ebi-share-url="<?php echo esc_url($permalink); ?>" data-ebi-share-text="<?php echo $share_title; ?>">
                <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-x.svg'); ?>
              </a>
              <a class="-line" target="_blank" data-ebi-share="line" data-ebi-share-url="<?php echo esc_url($permalink); ?>" data-ebi-share-text="<?php echo $share_title; ?>">
                <?php echo file_get_contents(get_template_directory() . '/include/svg/icon-line.svg'); ?>
              </a>
            </dd>
          </dl>
        </div>
    <?php
      endwhile;
    endif;
    ?>

    <?php get_template_part('include/m-related'); ?>
    <?php get_template_part('include/m-categories'); ?>
    <?php get_template_part('include/m-love'); ?>
  </article>
</main>

<?php get_footer(); ?>