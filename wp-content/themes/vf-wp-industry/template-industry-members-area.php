<?php
/**
* Template Name: Members area
*/

$current_date = date('Ymd');


get_header();

global $post;
setup_postdata($post);

global $vf_theme;

$title = get_the_title();

?>

<?php 

  
$open_wrap = function($html, $block_name) {
  $html = '
<div class="embl-grid embl-grid--has-centered-content">
  <div></div>
  <div>
' . $html;
return $html;
};

$close_wrap = function($html, $block_name) {
  $html .= '
  </div>
  <div></div>
</div>
<!--/embl-grid-->';
return $html;
};

add_filter(
'vf/__experimental__/theme/content/open_block_wrap',
$open_wrap,
10, 2
);

add_filter(
'vf/__experimental__/theme/content/close_block_wrap',
$close_wrap,
10, 2
);

?>

<?php

  if ( has_block( 'acf/vfwp-intro', $post ) ) {  
  parse_blocks( 'acf/vfwp-intro' ); } 

  else if ( has_block( 'acf/vfwp-page-header', $post ) ) {
  parse_blocks( 'acf/vfwp-page-header' ); }

  else if ( has_block( 'acf/vfwp-hero', $post ) ) {
    parse_blocks( 'acf/vfwp-hero' ); }
  
  else if ( has_block( 'acf/vfwp-masthead', $post ) ) {
    parse_blocks( 'acf/vfwp-masthead' ); }

  else {  ?>
<div>
  <h1 class="vf-text vf-text-heading--1">
    <?php echo $title;?>
  </h1>
</div>
<?php } 

$vf_theme->the_content(); ?>


<div class="vf-grid vf-grid__col-3 | vf-content">
    <div class="vf-grid__col--span-2" >
  <div class="vf-grid vf-grid__col-2">
      <div>
      <h2>Forthcoming Quarterly Meetings</h2>
    <?php

$forthcomingLoop = new WP_Query (array( 
    'tax_query' => array(
      array (
          'taxonomy' => 'type',
          'field' => 'slug',
          'terms' => 'quarterly-meeting',
      )
    ), 
    'post_type' => 'industry_event', 
    'order' => 'ASC', 
    'posts_per_page' => 6, 
    'meta_key' => 'vf_event_industry_event_type', 
    'meta_query' => array(
        array(
            'key' => 'vf_event_industry_start_date',
            'value' => $current_date,
            'compare' => '>=',
            'type' => 'numeric'
        ),  
    ) ));
$ids = array();
while ($forthcomingLoop->have_posts()) : $forthcomingLoop->the_post();
$ids[] = get_the_ID();
$start_date = get_field('vf_event_industry_start_date', $post->post_parent);
$start = DateTime::createFromFormat('j M Y', $start_date);

$end_date = get_field('vf_event_industry_end_date', $post->post_parent);
$end = DateTime::createFromFormat('j M Y', $end_date);

include(locate_template('partials/vf-summary-event.php', false, false)); ?>
    <?php endwhile;?>
    <?php wp_reset_postdata(); ?>
    </div>
    <div>
    <h2>Forthcoming workshops</h2>
    <?php

$forthcomingWorkshopsLoop = new WP_Query (array(
    'tax_query' => array(
        array (
            'taxonomy' => 'type',
            'field' => 'slug',
            'terms' => 'workshop',
        )
    ),
    'post_type' => 'industry_event', 
    'order' => 'ASC', 'posts_per_page' => 6, 
    'meta_key' => 'vf_event_industry_event_type', 
    'meta_query' => array(
    array(
        'key' => 'vf_event_industry_start_date',
        'value' => $current_date,
        'compare' => '>=',
        'type' => 'numeric'
    ),    
) ));
$ids = array();
while ($forthcomingWorkshopsLoop->have_posts()) : $forthcomingWorkshopsLoop->the_post();
$ids[] = get_the_ID();
$start_date = get_field('vf_event_industry_start_date', $post->post_parent);
$start = DateTime::createFromFormat('j M Y', $start_date);

$end_date = get_field('vf_event_industry_end_date', $post->post_parent);
$end = DateTime::createFromFormat('j M Y', $end_date);

include(locate_template('partials/vf-summary-event.php', false, false)); ?>
    <?php endwhile;?>
    <?php wp_reset_postdata(); ?>
</div>
</div>
  </div>
  <div></div>
</div>
