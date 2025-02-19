<?php
$themeUri = get_template_directory_uri();
$terms = get_terms(array(
  'taxonomy' => 'cpost-tag',
  'hide_empty' => false,
));

if (!empty($terms) && !is_wp_error($terms)) : ?>
  <div class="tags">
    <h3 class="fontPanchang">TAG</h3>
    <div class="tags__items">
      <ul>
        <?php foreach ($terms as $term) : ?>
          <li>
            <a href="<?php echo get_term_link($term); ?>">#<?php echo esc_html($term->name); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>