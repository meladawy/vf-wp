<?php

$title = esc_html(get_the_title());
$author_url = get_author_posts_url(get_the_author_meta('ID'));
$user_id = get_the_author_meta('ID');

?>
<article class="vf-card">

  <?php the_post_thumbnail( 'full', array( 'class' => 'vf-card__image' ) ); ?>

  <div class="vf-card__content | vf-stack vf-stack--400">
    <h3 class="vf-card__title">
      <a href="<?php the_permalink(); ?>" class="vf-card__link"><?php echo $title; ?></a>
    </h3>
    <p class="vf-card__text">
    <?php echo get_the_excerpt(); ?></p>
    <time class="vf-summary__date" style="margin-left: 0;" title="<?php the_time('c'); ?>"
      datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time>
    <span class="vf-summary__meta | vf-u-margin__bottom--100">
      <p class="vf-summary__meta vf-u-margin__bottom--100 vf-u-margin__top--100">By&nbsp;<a
          class="vf-summary__author vf-summary__link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></p>
      <p class="vf-summary__meta vf-u-margin__bottom--100"><a
          class="vf-link"><?php echo get_the_category_list(','); ?></a></p>
    </span>
  </div>
</article>