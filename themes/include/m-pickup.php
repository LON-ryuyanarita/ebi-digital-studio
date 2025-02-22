<?php
$themeUri = get_template_directory_uri();
?>

<section class="pickup section">
  <div class="section__inner">
    <h2 class="pickup__title fontPanchang">
      PICK UP
    </h2>
    <div class="pickup__items">
      <?php
      $pickups = get_field('top_pickup');
      if ($pickups) :
        foreach ($pickups as $pickup):
          $post_id = $pickup;
          $post = get_post($post_id);
          $title = get_field('title', $post_id);
          $thumb = get_field('thumbnail', $post_id) ?? null;
          $thumb_src = wp_get_attachment_image_url($thumb, 'full');
      ?>
          <article class="pickup__item">
            <a href="<?php echo get_permalink($post_id); ?>">
              <div class="pickup__item__img">
                <?php if ($thumb_src) : ?>
                  <img src="<?php echo $thumb_src; ?>" alt="">
                <?php endif; ?>
              </div>
              <div class="pickup__item__body">
                <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo get_the_date('Y/m/d', $post_id); ?></time>
                <h3 class="-title"><?php echo nl2br($title); ?></h3>
              </div>
            </a>
            <div class="-tags">
              <?php
              $terms = wp_get_post_terms($post_id, 'cpost-tag');
              if (!empty($terms) && !is_wp_error($terms)) :
                foreach ($terms as $term) :
              ?>
                  <a href="<?php echo get_term_link($term); ?>">#<?php echo esc_html($term->name); ?></a>
              <?php
                endforeach;
              endif;
              ?>
            </div>
          </article>
      <?php
        endforeach;
      endif; ?>
    </div>
  </div>
</section>