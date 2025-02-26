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
  $term_description = $term->description;
  $term_ja_names = array(
    'REVIEWS'   => 'レビュー',
    'CUSTOMIZE' => 'カスタマイズ',
    'HERITAGE'  => 'ヘリテージ',
    'RACE'      => 'レース',
    'LIFESTYLE' => 'ライフスタイル',
    'EVENT'     => 'イベント',
  );
  $term_ja = isset($term_ja_names[$term_name]) ? $term_ja_names[$term_name] : $term_name;

  $first_post_args = array(
    'post_type' => 'cpost',
    'posts_per_page' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'cpost-cat',
        'field' => 'slug',
        'terms' => $term->slug,
      ),
    ),
  );
  $first_post_query = new WP_Query($first_post_args);

  $paged = (get_query_var('paged') && get_query_var('paged') > 1) ? absint(get_query_var('paged')) : 1;
  $post_per_page = 15;
  $offset = ($paged - 1) * $post_per_page + 1; // 2件目以降を取得
  $list_posts_args = array(
    'post_type' => 'cpost',
    'posts_per_page' => $post_per_page,
    'paged' => $paged,
    'offset' => $offset,
    'tax_query' => array(
      array(
        'taxonomy' => 'cpost-cat',
        'field' => 'slug',
        'terms' => $term_slug,
      ),
    ),
  );
  $list_posts_query = new WP_Query($list_posts_args);
  ?>
  <div class="archive">
    <div class="archive__top">
      <header class="archive__header">
        <div class="-title">
          <span class="-en fontPanchang"><?php echo esc_html($term_name); ?> </span>
          <span class="-ja"><?php echo esc_html($term_ja); ?></span>
        </div>
        <div class="-description">
          <p><?php echo esc_html($term_description); ?></p>
        </div>
      </header>
      <div class="archive__top__article">
        <?php if ($first_post_query->have_posts()) : $first_post_query->the_post(); ?>
          <?php
          $title = get_field('title');
          $thumb = get_field('thumbnail') ?? null;
          $thumb_src = wp_get_attachment_image_url($thumb, 'full');
          $terms = wp_get_post_terms(get_the_ID(), 'cpost-tag');
          ?>
          <article class="archive__top__article__item">
            <a href="<?php the_permalink(); ?>">
              <div class="archive__top__article__img">
                <?php if ($thumb_src) : ?>
                  <img src="<?php echo $thumb_src; ?>" alt="">
                <?php endif; ?>
              </div>
              <div class="archive__top__article__body">
                <time class="-date fontPanchang" datetime="<?php echo get_the_date('c', get_the_ID()); ?>"><?php echo get_the_date('Y/m/d', get_the_ID()); ?></time>
                <h3 class="-title"><?php echo nl2br($title); ?></h3>
              </div>
            </a>
            <div class="-tags">
              <?php if (!empty($terms) && !is_wp_error($terms)) :
                $terms = array_slice($terms, 0, 3);
                foreach ($terms as $term) : ?>
                  <a href="<?php echo get_term_link($term); ?>">#<?php echo esc_html($term->name); ?></a>
              <?php endforeach;
              endif; ?>
            </div>
          </article>
        <?php wp_reset_postdata();
        endif; ?>
      </div>
    </div>
    <div class="archive__contents section__inner">
      <div class="archive__list">
        <div class="articles">
          <?php if ($list_posts_query->have_posts()) :
            while ($list_posts_query->have_posts()) : $list_posts_query->the_post();
              set_query_var('post_id', get_the_ID());
              get_template_part('include/m-article');
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>

      <!-- <div class="archive__pager pager">
        <div class="pager__nav -btn -prev">
          <a class="fontPanchang" href="#TBD">
            Prev
          </a>
        </div>
        <div class="pager__nav -link">
          <a class="fontPanchang" href="#TBD">1</a>
          <a class="-current fontPanchang" href="#TBD">2</a>
          <a class="fontPanchang" href="#TBD">3</a>
          <a class="fontPanchang" href="#TBD">4</a>
          <span>...</span>
          <a class="fontPanchang" href="#TBD">5</a>
        </div>
        <div class="pager__nav -btn -next">
          <a class="fontPanchang" href="#TBD">
            Next
          </a>
        </div>
      </div> -->

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