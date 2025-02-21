<?php
$themeUri = get_template_directory_uri();
$top_page = get_page_by_path('home');
?>

<?php get_header(); ?>

<main class="main" role="main">
  <?php
  $term = get_queried_object();
  $term_name = $term->name;
  $term_slug = $term->slug;

  $paged = (get_query_var('paged') && get_query_var('paged') > 1) ? absint(get_query_var('paged')) : 1;
  $post_per_page = 15;
  $offset = ($paged - 1) * $post_per_page;
  $list_posts_args = array(
    'post_type' => 'cpost',
    'posts_per_page' => $post_per_page,
    'paged' => $paged,
    'offset' => $offset,
    'tax_query' => array(
      array(
        'taxonomy' => 'cpost-tag',
        'field' => 'slug',
        'terms' => $term_slug,
      ),
    ),
  );
  $list_posts_query = new WP_Query($list_posts_args);
  ?>
  <div class="archive">
    <div class="archive__top -news">
      <header class="archive__news__header">
        <div class="-title">
          <span class="fontPanchang">NEWS</span>
        </div>
      </header>
    </div>
    <div class="archive__contents section__inner">
      <div class="newsList">
        <div class="newsList__list">
          <?php if ($list_posts_query->have_posts()) :
            while ($list_posts_query->have_posts()) : $list_posts_query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-news-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>

      <?php
      $total_pages = $list_posts_query->max_num_pages;
      if ($total_pages > 1) :
        $current_page = max(1, get_query_var('paged'));
        $pagination_links = paginate_links(array(
          'base' => user_trailingslashit(get_term_link($term) . 'page/%#%/'),
          'format' => 'page/%#%/',
          'current' => $paged,
          'total' => $list_posts_query->max_num_pages,
          'type' => 'array',
          'prev_next' => false,
        ));

      ?>
        <div class="archive__pager pager">
          <div class="pager__nav -btn -prev <?php if ($current_page <= 1) : ?>-disabled<?php endif; ?>">
            <a class="fontPanchang" href="<?php echo get_pagenum_link($current_page - 1); ?>">Prev</a>
          </div>

          <div class="pager__nav -link">
            <?php foreach ($pagination_links as $link) : ?>
              <?php echo str_replace('page-numbers', 'fontPanchang', $link); ?>
            <?php endforeach; ?>
          </div>

          <div class="pager__nav -btn -next <?php if ($current_page >= $total_pages) : ?>-disabled<?php endif; ?>">
            <a class="fontPanchang" href="<?php echo get_pagenum_link($current_page + 1); ?>">Next</a>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <?php get_template_part('include/m-categories'); ?>
    <?php get_template_part('include/m-love'); ?>
  </div>
</main>

<?php get_footer(); ?>