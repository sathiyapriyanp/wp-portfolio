<?php
/**
 * Template Name: Nurse List
 */
get_header();
// Force WordPress NOT to treat ?s= as global search
set_query_var('is_search', false);

?>

<form method="GET" action="<?php echo get_permalink(); ?>" class="nurse-filters">
  <div class="nurse-filters-inner">
    <input type="text" name="nurse_name" placeholder="Search nurses..."
      value="<?php echo isset($_GET['nurse_name']) ? esc_attr($_GET['nurse_name']) : ''; ?>">
    <select name="department">
        <option value="">All Departments</option>
        <option value="cardiology" <?php selected($_GET['department'] ?? '', 'cardiology'); ?>>Cardiology</option>
        <option value="emergency" <?php selected($_GET['department'] ?? '', 'emergency'); ?>>Emergency</option>
        <option value="pediatrics" <?php selected($_GET['department'] ?? '', 'pediatrics'); ?>>Pediatrics</option>
        <option value="icu" <?php selected($_GET['department'] ?? '', 'icu'); ?>>ICU</option>
    </select>

    <select name="experience">
        <option value="">Experience</option>
        <option value="1" <?php selected($_GET['experience'] ?? '', '1'); ?>>1+ years</option>
        <option value="3" <?php selected($_GET['experience'] ?? '', '3'); ?>>3+ years</option>
        <option value="5" <?php selected($_GET['experience'] ?? '', '5'); ?>>5+ years</option>
        <option value="10" <?php selected($_GET['experience'] ?? '', '10'); ?>>10+ years</option>
    </select>

    <button type="submit" class="filter-btn">Apply</button>

  </div>
</form>

<?php

// ================= FILTER QUERY ==================

$meta_query = array('relation' => 'AND');
// Department filter
if (!empty($_GET['department'])) {
    $meta_query[] = [
        'key'     => 'department',
        'value'   => sanitize_text_field($_GET['department']),
        'compare' => 'LIKE'
    ];
}
// Experience filter
if (!empty($_GET['experience'])) {
    $meta_query[] = [
        'key'     => 'experience',
        'value'   => intval($_GET['experience']),
        'compare' => '>=',
        'type'    => 'NUMERIC'
    ];
}
// Qualification filter
if (!empty($_GET['qualification'])) {
    $meta_query[] = [
        'key'     => 'qualification',
        'value'   => sanitize_text_field($_GET['qualification']),
        'compare' => 'LIKE'
    ];
}
// Pagination
$paged = max(1, get_query_var('paged'));

// User search input (correct way)
$keyword = $_GET['nurse_name'] ?? '';
if (!empty($keyword)) {
    $args['s'] = sanitize_text_field($keyword);
}'';

// Final WP_Query args
$args = [
    'post_type'      => 'nurse',
    'posts_per_page' => 4,
    'paged'          => $paged,
    'meta_query'     => $meta_query
];

// Add search keyword safely
if (!empty($keyword)) {
    $args['s'] = $keyword;
}

// Run query
$nurse_query = new WP_Query($args);

?>

<!-- POPUP -->
<div id="filterPopup" class="filter-popup">
  <div class="filter-content">
    <h3>More Filters</h3>

    <form method="GET">

      <label>Qualification</label>
      <input type="text" name="qualification"
             value="<?php echo esc_attr($_GET['qualification'] ?? ''); ?>">

      <input type="hidden" name="s" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
      <input type="hidden" name="department" value="<?php echo esc_attr($_GET['department'] ?? ''); ?>">
      <input type="hidden" name="experience" value="<?php echo esc_attr($_GET['experience'] ?? ''); ?>">

      <button type="submit" class="apply-btn">Apply</button>
      <button type="button" id="closeFilter" class="close-btn">Close</button>

    </form>
  </div>
</div>

<!-- GRID -->
<div class="nurse-grid">
<?php 
if ($nurse_query->have_posts()) : 
  while ($nurse_query->have_posts()) : $nurse_query->the_post(); ?>

    <article class="nurse-card">

      <?php 
      if ( has_post_thumbnail() ) {
        the_post_thumbnail('medium_large');
      } else {
        echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/book.png" class="default-img">';
      }
      ?>

      <h3><?php the_title(); ?></h3>

      <div class="nurse-card-footer">
        <a href="<?php the_permalink(); ?>">View Profile →</a>
      </div>
    </article>

<?php endwhile; wp_reset_postdata();
else:
  echo "<p>No nurses found.</p>";
endif;
?>
</div>

<!-- PAGINATION -->
<div class="nurse-pagination">
<?php 
echo paginate_links([
    'total'   => $nurse_query->max_num_pages,
    'current' => $paged,
    'prev_text' => '&laquo;',
    'next_text' => '&raquo;',
    'type' => 'list'
]);
?>
</div>
<?php 
    $selected_department = ''; // empty = show 6 random nurses
    include locate_template('template-parts/related_nurse.php'); 
    ?>

<?php get_footer(); ?>
