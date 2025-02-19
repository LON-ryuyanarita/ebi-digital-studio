<?php
$themeUri = get_template_directory_uri();
?>

<aside class="love">
  <div class="love__imgs">
    <div class="-left">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-1.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-2.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-3.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-4.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-5.jpg" alt="">
    </div>
    <div class="-right">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-6.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-7.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-8.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-9.jpg" alt="">
      <img src="<?php echo $themeUri; ?>/assets/img/love-img-10.jpg" alt="">
    </div>
  </div>

  <div class="love__inner">
    <div class="love__summary">
      <h2 class="love__title">
        <em class="fontPanchang">LOVE<br>PORSCHE</em>
        <span>オーナーレビュー</span>
      </h2>
      <div class="love__description">
        <p>
          ポルシェを愛する皆様に、<br>
          ポルシェとともに過ごすカーライフについてインタビュー。<br>
          一人ひとりのポルシェへの想いについて、<br class="pc">
          ご紹介いたします。
        </p>
      </div>
      <div class="love__btn ebiButton -small -transparent">
        <a href="#TBD" target="_blank">
          <span class="fontPanchang">VIEW ALL</span>
        </a>
      </div>
    </div>

    <div class="love__latest">
      <article class="love__article">
        <?php
        $args = array(
          'post_type' => 'cpost',
          'posts_per_page' => 1,
          'tax_query' => array(
            array(
              'taxonomy' => 'cpost-cat',
              'field' => 'slug',
              'terms' => 'love',
            ),
          ),
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
            $title = get_field('title');
            $thumb = get_field('thumbnail') ?? null;
            $thumb_src = wp_get_attachment_image_url($thumb, 'full'); ?>
            <a href="<?php echo get_permalink(); ?>">
              <div class="love__article__img">
                <?php if ($thumb_src) : ?>
                  <img src="<?php echo $thumb_src; ?>" alt="">
                <?php endif; ?>
              </div>
              <div class="love__article__body">
                <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo get_the_date('Y/m/d', $post_id); ?></time>
                <h3 class="-title"><?php echo $title; ?></h3>
              </div>
            </a>
            <div class="-tags">
              <?php if (!empty($terms) && !is_wp_error($terms)) :
                foreach ($terms as $term) : ?>
                  <a href="<?php echo get_term_link($term); ?>">#<?php echo esc_html($term->name); ?></a>
              <?php endforeach;
              endif; ?>
            </div>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </article>
    </div>
  </div>
</aside>