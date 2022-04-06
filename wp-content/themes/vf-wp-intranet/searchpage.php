<?php 
/**
 * Template Name: Search Page
 */

get_header(); 

if (class_exists('VF_Global_Header')) {
  VF_Plugin::render(VF_Global_Header::get_plugin('vf_global_header'));
}
if (class_exists('VF_Intranet_Breadcrumbs')) {
  VF_Plugin::render(VF_Intranet_Breadcrumbs::get_plugin('vf_wp_breadcrumbs_intranet'));
}

$total_results = $wp_query->found_posts;

?>

<section class="vf-hero | vf-u-fullbleed | vf-hero--800 | vf-u-margin__bottom--0">
<style>
    .vf-hero {
      --vf-hero--bg-image: url('https://www.embl.org/internal-information/wp-content/uploads/20220325_Intranet-hero-scaled.jpg');
            }
  </style>  <div class="vf-hero__content | vf-box | vf-stack vf-stack--200">
    <h2 class="vf-hero__heading">
      <a class="vf-hero__heading_link" href="https://www.embl.org/internal-information">
        EMBL Intranet </a>
    </h2>
  </div>
</section>

<?php

if (class_exists('VF_Navigation')) {
  VF_Plugin::render(VF_Navigation::get_plugin('vf_navigation'));
}

?>

<section class="vf-intro | vf-u-margin__bottom--0">
  <div>
    <!-- empty -->
  </div>
  <div class="vf-stack">
    <h1 class="vf-intro__heading">
      Search
    </h1>
  </div>
</section>

<div
  class="embl-grid embl-grid--has-centered-content | vf-u-padding__top--500 vf-u-padding__bottom--500 | vf-u-margin__bottom--800">
  <div></div>
  <form role="search" method="get"
    class="vf-form vf-form--search vf-form--search--responsive | vf-sidebar vf-sidebar--end"
    action="<?php echo esc_url(home_url('/')); ?>">
    <div class="vf-sidebar__inner">
      <div class="vf-form__item | vf-search__item">
        <input type="search" class="vf-form__input | vf-search__input" placeholder="Enter your search term"
          value="<?php echo esc_attr(get_search_query()); ?>" name="s">
      </div>
      <div class="vf-form__item | vf-search__item" style="display: none">
        <label class="vf-form__label vf-u-sr-only | vf-search__label" for="vf-form__select">Category</label>
        <select class="vf-form__select" id="vf-form__select" name="post_type" value="post_type">
          <option value="any" selected="">Everything</option>
          <option value="page" name="post_type[]">Pages</option>
          <option value="insites" name="post_type[]">Internal news</option>
          <option value="events" name="post_type[]">Events</option>
          <option value="people" name="post_type[]">People</option>
          <option value="documents" name="post_type[]">Documents</option>
        </select>
      </div>
      <input type="submit" class="vf-search__button | vf-button vf-button--primary"
        value="<?php esc_attr_e('Search', 'vfwp'); ?>">
    </div>
  </form>
</div>

<section class="embl-grid embl-grid--has-centered-content">
  <div>
  </div>
  <div>
  </div>
</section>
<?php
if (class_exists('VF_Global_Footer')) {
  VF_Plugin::render(VF_Global_Footer::get_plugin('vf_global_footer'));
} ?>

<?php get_footer(); ?>
