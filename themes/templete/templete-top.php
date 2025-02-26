<?php
/*
Template Name: TOP
*/
?>

<?php
$themeUri = get_template_directory_uri();
$top_page = get_page_by_path('home');
?>

<?php get_header(); ?>

<main class="main" role="main">
  <?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>
      <section class="top">
        <header class="top__header">
          <h2 class="top__title fontPanchang">EBI DIGITAL STUDIO</h2>
          <div class="top__description">
            日本最大のポルシェ正規ディーラー EBI GROUP が提供する<br>
            ポルシェに惹かれるすべての人たちへ向けたWEBスタジオ
          </div>
        </header>

        <div class="top__mv">
          <?php
          $top_mv_top = get_field('top_mv_top');
          if (!empty($top_mv_top)) :
            // 1個目の記事
            $post_id = $top_mv_top;
            $post = get_post($post_id);
            setup_postdata($post);
            $title = nl2br(get_field('title', $post->ID));
            $top_mv = get_field('top_mv');
            $top_mv_type = $top_mv['top_mv_type'];
            $top_mv_file = $top_mv_type == 'img' ? $top_mv['top_mv_img'] : $top_mv['top_mv_mov'];
            $top_mv_src = wp_get_attachment_url($top_mv_file, 'full') ?? null;
          ?>
            <div class="top__mv__upper">
              <?php
              ?>
              <article class="top__mv__item">
                <a href="<?php echo get_permalink($post_id); ?>">
                  <div class="top__mv__item__img">
                    <?php if ($top_mv_type == 'img') : ?>
                      <img src="<?php echo esc_url($top_mv_src); ?>" alt="">
                    <?php else : ?>
                      <video
                        class="js__loading__restartVideo"
                        src="<?php echo esc_url($top_mv_src); ?>"
                        muted
                        autoplay
                        playsinline
                        loop>
                      </video>
                    <?php endif; ?>
                  </div>
                  <div class="top__mv__item__body">
                    <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo get_the_date('Y/m/d', $post_id); ?></time>
                    <h3 class="-title"><?php echo $title; ?></h3>
                  </div>
                </a>
                <div class="-tags">
                  <?php
                  $terms = wp_get_post_terms($post_id, 'cpost-tag');
                  if (!empty($terms) && !is_wp_error($terms)) :
                    $terms = array_slice($terms, 0, 3);
                    foreach ($terms as $term) :
                  ?>
                      <a href="<?php echo get_term_link($term); ?>">#<?php echo esc_html($term->name); ?></a>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </div>
              </article>
              <?php wp_reset_postdata(); ?>
            </div>
          <?php endif; ?>
          <?php
          $top_mv_lowers = get_field('top_mv_lowers');
          if (!empty($top_mv_lowers) && is_array($top_mv_lowers)) :
            $top_mv_articles = array_slice($top_mv_lowers, 0, 2);
          ?>
            <div class="top__mv__lower">
              <?php
              // 2, 3個目の記事
              for ($i = 0; $i < 2; $i++) :
                if (!empty($top_mv_articles[$i])) :
                  $post_id = $top_mv_articles[$i];
                  $post = get_post($post_id);
                  setup_postdata($post);
                  $title = nl2br(get_field('title', $post->ID));
                  $top_mv = get_field('top_mv');
                  $top_mv_type = $top_mv['top_mv_type'];
                  $top_mv_file = $top_mv_type == 'img' ? $top_mv['top_mv_img'] : $top_mv['top_mv_mov'];
                  $top_mv_src = wp_get_attachment_url($top_mv_file, 'full') ?? null;
              ?>
                  <article class="top__mv__item">
                    <a href="<?php echo get_permalink($post_id); ?>">
                      <div class="top__mv__item__img">
                        <?php if ($top_mv_type == 'img') : ?>
                          <img src="<?php echo esc_url($top_mv_src); ?>" alt="">
                        <?php else : ?>
                          <video
                            src="<?php echo esc_url($top_mv_src); ?>"
                            muted
                            autoplay
                            playsinline
                            loop>
                          </video>
                        <?php endif; ?>
                        <?php if ($mv_src) : ?>
                          <img src="<?php echo $mv_src; ?>" alt="">
                        <?php endif; ?>
                      </div>
                      <div class="top__mv__item__body">
                        <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo get_the_date('Y/m/d', $post_id); ?></time>
                        <h3 class="-title"><?php echo $title; ?></h3>
                      </div>
                    </a>
                    <div class="-tags">
                      <?php
                      $terms = wp_get_post_terms($post_id, 'cpost-tag');
                      if (!empty($terms) && !is_wp_error($terms)) :
                        $terms = array_slice($terms, 0, 3);
                        foreach ($terms as $term) :
                      ?>
                          <a href="<?php echo get_term_link($term); ?>">#<?php echo esc_html($term->name); ?></a>
                      <?php
                        endforeach;
                      endif;
                      ?>
                    </div>
                  </article>
              <?php wp_reset_postdata();
                endif;
              endfor; ?>
            </div>
          <?php endif; ?>
        </div>

        <?php get_template_part('include/m-pickup'); ?>
        <?php get_template_part('include/m-latest'); ?>
        <?php get_template_part('include/m-love'); ?>

        <div class="top__links">
          <div class="top__links__inner">
            <div class="top__links__item -fest">
              <a href="https://ebi.marketing/thefest2023/" target="_blank">
                <div class="-bg"><img src="<?php echo $themeUri; ?>/assets/img/top-fest-img.jpg" alt="EBI GROUP が主催するオーナー向けイベント「THE FEST.」の写真｜EBI DIGITAL STUDIO（イー・ビー・アイ・デジタル・スタジオ）｜ポルシェ正規ディーラー EBI GROUP"></div>
                <div class="-name fontPorsche">
                  <em>THE FEST.</em>
                </div>
                <div class="-logo">
                  <img src="<?php echo $themeUri; ?>/assets/img/top-fest-logo.png" alt="EBI GROUP が主催するオーナー向けイベント「THE FEST.」のロゴ｜EBI DIGITAL STUDIO（イー・ビー・アイ・デジタル・スタジオ）｜ポルシェ正規ディーラー EBI GROUP">
                </div>
              </a>
            </div>
            <div class="top__links__item -rally">
              <a href="https://therally.jp/" target="_blank">
                <div class="-bg"><img src="<?php echo $themeUri; ?>/assets/img/top-rally-img.jpg" alt="EBI GROUP が主催するオーナー向けイベント「The Rally -Amazing Moment-.」の写真｜EBI DIGITAL STUDIO（イー・ビー・アイ・デジタル・スタジオ）｜ポルシェ正規ディーラー EBI GROUP"></div>
                <div class="-name fontPorsche">
                  <em>The Rally</em> <span>- Amazing Moment -</span>
                </div>
                <div class="-logo">
                  <img src="<?php echo $themeUri; ?>/assets/img/top-rally-logo.png" alt="EBI GROUP が主催するオーナー向けイベント「The Rally -Amazing Moment-.」のロゴ｜EBI DIGITAL STUDIO（イー・ビー・アイ・デジタル・スタジオ）｜ポルシェ正規ディーラー EBI GROUP">
                </div>
              </a>
            </div>

          </div>
        </div>

        <section class="top__news section">
          <div class="section__inner">
            <h2 class="top__news__title fontPanchang">
              NEWS
            </h2>
            <div class="top__news__content">
              <div class="newsList">
                <div class="newsList__list">
                  <?php
                  $args = array(
                    'post_type' => 'cpost',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'cpost-cat',
                        'field' => 'slug',
                        'terms' => 'news',
                      ),
                    ),
                  );
                  $query = new WP_Query($args);
                  if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                      set_query_var('post_id', get_the_ID());
                      get_template_part('include/m-news-article');
                    endwhile;
                    wp_reset_postdata();
                  endif;
                  ?>
                </div>
              </div>
              <div class="top__news__btn ebiButton -small">
                <a href="/news/">
                  <span class="fontPanchang">VIEW ALL</span>
                </a>
              </div>
            </div>
          </div>
        </section>

        <section class="top__ds">
          <div class="top__ds__inner">
            <h2 class="top__ds__title fontPanchang">
              <em>EBI DIGITAL STUDIO</em>
              <small>ディーラーだから提供できる価値がある。</small>
            </h2>
            <div class="top__ds__text">
              <p>
                EBI DIGITAL STUDIO<br>ポルシェに惹かれるすべての人へ。
              </p>
              <p>
                東京のポルシェ正規ディーラー EBI GROUP が提供する、<br>
                “ポルシェ・エンターテイメント空間”です。
              </p>
              <p>
                最新情報の単純な追従ではなく、より本質的なポルシェブランドの真髄を、<br>
                わかりやすく、心躍る形で発信いたします。<br>
                様々なカテゴリーの記事を定期的に更新していきながら、<br>
                グループのイベント情報なども随時お知らせしていきます。
              </p>
              <p>
                私たちはWEBメディアの枠を超え、<br>
                ポルシェの魅力を心から楽しめる空間を創り上げます。
              </p>
            </div>
          </div>
        </section>

        <section class="top__se">
          <div class="top__se__inner">
            <header class="top__se__header">
              <div class="-t1">EBI GROUP が提供する特別なポルシェのブランド体験</div>
              <h2 class="top__se__title fontPanchang">
                SPECIAL <br>EXPERIENCE
              </h2>
              <div class="-t2">
                E-Performanceセンター<br>
                ポルシェスタジオ銀座
              </div>
              <div class="top__se__btn ebiButton -small -transparent">
                <a href="/special-ex/">
                  <span class="fontPanchang">VIEW ALL</span>
                </a>
              </div>
              <div class="-t3">
                <p>
                  ポルシェスタジオ銀座は、<br>
                  まったく新しいポルシェのエンターテイメントディーラーです。
                </p>
                <p>
                  E-Performanceセンターとしての機能が中核となり、<br>
                  都心のポルシェ正規ディーラー EBI GROUP 8拠点のハブストアとして、<br>
                  ブランドアンバサダー 「PORSCHE PRO」 がお客様をアテンドいたします。
                </p>
                <p>
                  EBI GROUP だけのオリジナルコンテンツを、<br>
                  ぜひご来場のうえご体感ください。
                </p>
              </div>
            </header>

            <section class="top__se__contents">
              <?php get_template_part('include/m-seMap'); ?>
            </section>
          </div>
        </section>

        <section class="top__group">
          <div class="top__group__inner">
            <div class="top__group__contents">
              <h2 class="top__group__title fontPanchang">
                <small>日本最大 ポルシェディーラーグループ</small>
                <em>EBI GROUP</em>
              </h2>
              <div class="top__group__text">
                <p>
                  日本最大のポルシェセンターとして、<br class="pc">お客様にポルシェの魅力をお伝えできるようおもてなしを追求しています。
                </p>
                <p>
                  EBI GROUP はポルシェジャパンの発足と共に、国内最大市場である東京で20年以上にわたりポルシェビジネスを展開しています。「お客様の歓びの創造者」をモットーに、経験豊富なスタッフによる丁寧な接客と、迅速で質の高いアフターサービスを提供し続けています。全社員がブランドアンバサダーとして積極的に取り組み、将来にわたりかけがえのない信頼関係を築いていきます。
                </p>
                <p>
                  <span>日本最大級のポルシェセンターの役割として、オーナー様の「ポルシェのある生活」がより豊かになるよう、様々な提案を図っていきます。プロダクトや季節にちなんだイベントをはじめ、店舗スタッフが自ら企画したイベントなどを開催し、オーナー様同士やスタッフとの繋がりを大切にしています。EBI GROUP だけのエクスクルーシブな体験をこれからもお楽しみください。</span>
                  <img class="sp" src="<?php echo $themeUri; ?>/assets/img/top-group-img.jpg" alt="">
                </p>
              </div>
              <div class="top__group__btn ebiButton -small">
                <a href="/ebi-group/">
                  <span class="fontPanchang">VIEW ALL</span>
                </a>
              </div>
            </div>
            <div class="top__group__img pc">
              <img src="<?php echo $themeUri; ?>/assets/img/top-group-img.jpg" alt="EBI GROUP （株式会社エポカルインターナショナル）が運営するポルシェスタジオ銀座の外観｜EBI DIGITAL STUDIO（イー・ビー・アイ・デジタル・スタジオ）｜ポルシェ正規ディーラー EBI GROUP">
            </div>
          </div>

          <div class="top__map">
            <div class="top__map__title">
              東京を中心に多数ショールームを展開ぜひお近くのショールームまでお越しください
            </div>
            <div class="top__map__contents">
              <iframe src="https://www.google.com/maps/d/u/7/embed?mid=1Z-whQUwxi7Hfo11cHT262xkwNlil-gY&ehbc=2E312F" width="640" height="480"></iframe>
            </div>
          </div>
        </section>

        <section class="top__contact">EBI GROUP （株式会社エポカルインターナショナル）が運営するポルシェスタジオ銀座の外観｜EBI DIGITAL STUDIO（イー・ビー・アイ・デジタル・スタジオ）｜ポルシェ正規ディーラー EBI GROUP
          <div class="top__contact__inner">
            <h2 class="top__contact__title fontPanchang">
              CONTACT
            </h2>
            <div class="top__contact__text">
              <p>
                ご試乗やご購入に関するご相談など、<br class="sp">まずはお気軽にお問い合わせください。<br>
                グループのハブストア「ポルシェスタジオ銀座」の<br class="sp">ポルシェプロが対応させていただきます。
              </p>
              <p>
                その後、お客様のご状況やご希望に合わせて、<br>
                都心の各拠点へシームレスにお繋ぎすることも可能です。
              </p>
            </div>
            <div class="top__contact__btn ebiButton -full -black">
              <a href="https://ginza.ebi-group.tokyo/digital-s" target="_blank">
                <span>お問い合わせ</span>
              </a>
            </div>
          </div>
        </section>
      </section>
  <?php
    endwhile;
  endif;
  ?>
</main>

<?php get_template_part('include/m-seMapModals'); ?>

<?php get_footer(); ?>