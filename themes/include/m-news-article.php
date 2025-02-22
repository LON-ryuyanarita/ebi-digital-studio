<?php
$themeUri = get_template_directory_uri();
$post_id = get_query_var('post_id');
$post = get_post($post_id);
setup_postdata($post);
$title = get_field('title');
// $thumb = get_field('thumbnail') ?? null;
// $thumb_src = wp_get_attachment_image_url($thumb, 'full');
// $terms = wp_get_post_terms($post_id, 'cpost-tag');
?>
<div class="newsList__item">
  <a href="<?php echo get_permalink($post_id); ?>">
    <div class="-title"><?php echo $title; ?></div>
    <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', $post_id); ?>"><?php echo get_the_date('Y/m/d', $post_id); ?></time>
    <div class="-i"><i><img src="<?php echo $themeUri; ?>/assets/img/icon-arrow-4.svg" alt=""></i></div>
  </a>
</div>
<?php wp_reset_postdata(); ?>