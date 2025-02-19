<?php
$themeUri = get_template_directory_uri();
?>

<section class="latast">
  <div class="latast__inner">
    <h2 class="latast__title fontPanchang">
      LATEST CONTENTS
    </h2>
    <div class="latast__rows">
      <div class="latest__row">
        <div class="latest__row__title">
          <div class="-inner">
            <span class="-en fontPanchang">REVIEWS</span>
            <span class="-ja">レビュー</span>
          </div>
        </div>
        <div class="latast__items">
          <?php
          $args = array(
            'post_type' => 'cpost',
            'posts_per_page' => 5,
            'tax_query' => array(
              array(
                'taxonomy' => 'cpost-cat',
                'field' => 'slug',
                'terms' => 'reviews',
              ),
            ),
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-latest-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
      <div class="latest__row">
        <div class="latest__row__title">
          <div class="-inner">
            <span class="-en fontPanchang">CUSTOMIZE</span>
            <span class="-ja">カスタマイズ</span>
          </div>
        </div>
        <div class="latast__items">
          <?php
          $args = array(
            'post_type' => 'cpost',
            'posts_per_page' => 5,
            'tax_query' => array(
              array(
                'taxonomy' => 'cpost-cat',
                'field' => 'slug',
                'terms' => 'customize',
              ),
            ),
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-latest-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
      <div class="latest__row">
        <div class="latest__row__title">
          <div class="-inner">
            <span class="-en fontPanchang">HERITAGE</span>
            <span class="-ja">ヘリテージ</span>
          </div>
        </div>
        <div class="latast__items">
          <?php
          $args = array(
            'post_type' => 'cpost',
            'posts_per_page' => 5,
            'tax_query' => array(
              array(
                'taxonomy' => 'cpost-cat',
                'field' => 'slug',
                'terms' => 'heritage',
              ),
            ),
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-latest-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
      <div class="latest__row">
        <div class="latest__row__title">
          <div class="-inner">
            <span class="-en fontPanchang">RACE</span>
            <span class="-ja">レース</span>
          </div>
        </div>
        <div class="latast__items">
          <?php
          $args = array(
            'post_type' => 'cpost',
            'posts_per_page' => 5,
            'tax_query' => array(
              array(
                'taxonomy' => 'cpost-cat',
                'field' => 'slug',
                'terms' => 'race',
              ),
            ),
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-latest-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
      <div class="latest__row">
        <div class="latest__row__title">
          <div class="-inner">
            <span class="-en fontPanchang">LIFESTYLE</span>
            <span class="-ja">ライフスタイル</span>
          </div>
        </div>
        <div class="latast__items">
          <?php
          $args = array(
            'post_type' => 'cpost',
            'posts_per_page' => 5,
            'tax_query' => array(
              array(
                'taxonomy' => 'cpost-cat',
                'field' => 'slug',
                'terms' => 'lifestyle',
              ),
            ),
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-latest-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
      <div class="latest__row">
        <div class="latest__row__title">
          <div class="-inner">
            <span class="-en fontPanchang">EVENT</span>
            <span class="-ja">イベント</span>
          </div>
        </div>
        <div class="latast__items">
          <?php
          $args = array(
            'post_type' => 'cpost',
            'posts_per_page' => 5,
            'tax_query' => array(
              array(
                'taxonomy' => 'cpost-cat',
                'field' => 'slug',
                'terms' => 'event',
              ),
            ),
          );
          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-latest-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
      <div class="latest__row -tag">
        <?php get_template_part('include/m-tags'); ?>
      </div>
    </div>
  </div>
</section>