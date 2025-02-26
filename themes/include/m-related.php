<?php
$themeUri = get_template_directory_uri();
?>

<?php
$related_posts = get_related_cposts_by_tags(get_the_ID());

if ($related_posts->have_posts() && $related_posts->found_posts >= 2) :
?>
  <aside class="related section">
    <div class="section__inner">
      <h2 class="related__title fontPanchang">
        RELATED CONTENTS
      </h2>
    </div>
    <div class="related__inner">
      <div class="related__items" data-ebi-carousel="related">
        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
          <?php
          $post_id = get_the_ID();
          $post = get_post($post_id);
          $title = get_field('title', $post_id);
          $thumb = get_field('thumbnail', $post_id) ?? null;
          $thumb_src = wp_get_attachment_image_url($thumb, 'full'); ?>
          <article class="related__item">
            <a href="<?php echo get_permalink($post_id); ?>">
              <div class="related__item__img">
                <?php if ($thumb_src) : ?>
                  <img src="<?php echo $thumb_src; ?>" alt="">
                <?php endif; ?>
              </div>
              <div class="related__item__body">
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
        <?php endwhile; ?>
      </div>
    </div>
  </aside>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>