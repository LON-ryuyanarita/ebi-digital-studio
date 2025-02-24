<?php
$themeUri = get_template_directory_uri();

$categories = [
  'reviews' => 'レビュー',
  'customize' => 'カスタマイズ',
  'heritage' => 'ヘリテージ',
  'race' => 'レース',
  'lifestyle' => 'ライフスタイル',
  'event' => 'イベント'
];
?>

<section class="latest">
  <div class="latest__inner">
    <h2 class="latest__title fontPanchang">
      LATEST CONTENTS
    </h2>
    <div class="latest__rows">
      <?php foreach ($categories as $slug => $ja_name) : ?>
        <div class="latest__row" data-ebi-carousel-wrapper>
          <div class="latest__row__title">
            <div class="-inner">
              <span class="-en fontPanchang"><?php echo strtoupper($slug); ?></span>
              <span class="-ja"><?php echo $ja_name; ?></span>
            </div>
            <div class="latest__nav">
              <div class="-btns" data-ebi-carousel-btns></div>
              <div class="-indicator">
                <span data-ebi-carousel-indicator></span>
                <span data-ebi-carousel-total></span>
              </div>
            </div>
          </div>
          <div class="latest__items" data-ebi-carousel="latest">
            <?php
            $args = [
              'post_type' => 'cpost',
              'posts_per_page' => 5,
              'tax_query' => [
                [
                  'taxonomy' => 'cpost-cat',
                  'field' => 'slug',
                  'terms' => $slug,
                ],
              ],
            ];
            $query = new WP_Query($args);
            if ($query->have_posts()) :
              while ($query->have_posts()) :
                $query->the_post();
                set_query_var('post_id', get_the_ID());
                get_template_part('include/m-latest-article');
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
            <div class="latest__item -viewall">
              <a href="/<?php echo esc_attr($slug); ?>/">
                <span class="fontPanchang">VIEW ALL</span>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="latest__row -tag">
      <?php get_template_part('include/m-tags'); ?>
    </div>
  </div>
</section>