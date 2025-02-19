<?php
$post_id = get_query_var('post_id');
$post = get_post($post_id);
setup_postdata($post);
$title = get_field('title');
$thumb = get_field('thumbnail') ?? null;
$thumb_src = wp_get_attachment_image_url($thumb, 'full');
$terms = wp_get_post_terms($post_id, 'cpost-tag');
?>
<article class="articles__item">
  <a href="<?php echo get_permalink($post_id); ?>">
    <div class="articles__item__img">
      <?php if ($thumb_src) : ?>
        <img src="<?php echo $thumb_src; ?>" alt="">
      <?php endif; ?>
    </div>
    <div class="articles__item__body">
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
</article>
<?php wp_reset_postdata(); ?>