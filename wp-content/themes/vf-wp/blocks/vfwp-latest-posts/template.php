<?php

$heading_singular = get_field('heading_singular');
$heading_singular = trim($heading_singular);

$heading_plural = get_field('heading_plural');
$heading_plural = trim($heading_plural);

if (empty($heading_singular)) {
  $heading_singular = __('Latest blog post', 'vfwp');
}

if (empty($heading_plural)) {
  $heading_plural = __('Latest posts', 'vfwp');
}

$latest_posts = get_posts(array(
  'posts_per_page' => 3
));

if (count($latest_posts)) {
  // Setup first post data so template tags work
  global $post;
  $old_post = $post;
  $post = $latest_posts[0];
  setup_postdata($post);

  $excerpt = apply_filters(
    'get_the_excerpt',
    $post->post_content
  );
?>
<section class="vf-inlay">
  <div class="vf-inlay__content vf-u-background-color-ui--white">
    <main class="vf-inlay__content--main">
      <?php if ( ! empty($heading_singular)) { ?>
      <div class="vf-section-header">
        <h2 class="vf-section-header__heading"><?php echo esc_html($heading_singular); ?></h2>
      </div>
      <?php } ?>
      <article class="vf-summary vf-summary--article">
        <h2 class="vf-summary__title">
          <a href="<?php the_permalink(); ?>" class="vf-summary__link"><?php echo esc_html(get_the_title()); ?></a>
        </h2>
        <span class="vf-summary__meta">
          <a class="vf-summary__author vf-summary__link" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
          <time class="vf-summary__date" title="<?php the_time('c'); ?>" datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time>
      <?php if (comments_open()) { ?>
          <a class="vf-summary__link" href="<?php the_permalink(); ?>#respond"><?php _e('Leave a comment', 'vfwp'); ?></a>
      <?php } ?>
        </span>
        <p class="vf-summary__text"><?php echo $excerpt; ?></p>
      </article>
      <!--/vf-summary-->
    </main>
    <aside class="vf-inlay__content--additional">

      <div class="vf-links | vf-box vf-box--inlay">
        <h3 class="vf-links__heading"><?php echo esc_html($heading_plural); ?></h3>
        <ul class="vf-links__list | vf-list">
          <?php foreach ($latest_posts as $latest) { ?>
          <li class="vf-list__item">
            <a class="vf-list__link" href="<?php the_permalink($latest->ID); ?>"><?php echo esc_html(get_the_title($latest->ID)); ?></a>
          </li>
          <?php } ?>
        </ul>
      </div>

    </aside>
  </div>
</section>
<?php
  // Reset post data back to plugin
  $post = $old_post;
  setup_postdata($post);
}
?>
