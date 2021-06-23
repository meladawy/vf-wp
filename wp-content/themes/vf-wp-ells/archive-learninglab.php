<?php
get_header();

?>

<div class="vf-grid vf-grid__col-3 | vf-content">
  <div class="vf-grid__col--span-2">
    <h1 class="vf-text vf-text-heading--1">LearningLABs
    </h1>
    <p>Our professional development opportunities for teachers aim to empower educators to share the latest developments in life sciences with their students. Our courses are open to science educators teaching at secondary schools in Europe and beyond.

    </p>
    <p>The ELLS teacher training courses (LearningLABs) take place either face-to-face over 2–3 days or virtually across several weeks. All courses provide an update on current research and offer teaching and learning materials that bring real-life science into the classroom. Face-to-face courses include training in laboratory or bioinformatics practices. All of our training is free of charge for participants.

</p>
  </div>
  <div>
  <h3>Upcoming LearningLAB</h3>
  <?php
 $current_date = date('Ymd');
 $args = array(
  'post_type' => 'learninglab',
  'posts_per_page' => 1,
  'orderby' => 'labs_start_date',
  'order' => 'DSC',
  'meta_query' => array( array(
    'key' => 'labs_start_date',
    'value' => $current_date,
    'compare' => '>=',
    'type' => 'numeric'
) )
);
// The Query
$the_query = new WP_Query( $args );
// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        include(locate_template('partials/vf-card-llabs-upcoming.php', false, false));
    }
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
?>
  </div>
</div>


<section class="vf-content">
  <h3>Browse or filter all courses</h3>
  <div class="vf-grid vf-grid__col-4 | vf-u-padding__top--400">
    <div>
      <?php include(locate_template('partials/llabs-filter.php', false, false)); ?>
    </div>
    <div class="vf-grid__col--span-3">
      <?php
        if ( have_posts() ) {
          while ( have_posts() ) {
            the_post();
            include(locate_template('partials/vf-summary-llab.php', false, false)); 
            if (($wp_query->current_post + 1) < ($wp_query->post_count)) {
              echo '<hr class="vf-divider">';
           }
          }
        } else {
          echo '<p>', __('No posts found', 'vfwp'), '</p>';
        } ?>
      <div class="vf-grid"> <?php vf_pagination();?></div>
      <p><a href="https://www.embl.org/ells/past-ells-learninglabs/">See the list of past LearningLABs</a></p>
    </div>
  </div>
</section>

<?php include(locate_template('partials/ells-footer.php', false, false)); ?>
