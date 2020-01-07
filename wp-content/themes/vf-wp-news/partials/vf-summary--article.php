<?php

$title = esc_html(get_the_title());
$author_url = get_author_posts_url(get_the_author_meta('ID'));

?>
<article class="vf-summary vf-summary--article">
	<div class="post-image">
		<a style="display: grid;" href="<?php the_permalink(); ?>">
		    <?php the_post_thumbnail(); ?>
</a>
	</div>
    <div class="article-summary">
        <h2 class="vf-summary__title | vf-u-margin__bottom--sm vf-u-margin__top--sm">
            <a href="<?php the_permalink(); ?>" class="vf-summary__link"><?php echo $title; ?></a>
        </h2>
        <p class="vf-summary__text | vf-u-margin__bottom--sm"><?php echo get_the_excerpt(); ?></p>
        <span class="vf-summary__meta | vf-u-margin__bottom--xs">
			<p class="vf-summary__meta">By&nbsp;</p>
            <a class="vf-summary__author vf-summary__link" href="<?php echo $author_url; ?>"><?php the_author(); ?></a>
            <time class="vf-summary__date" title="<?php the_time('c'); ?>"
                datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time>
        </span>
        <div class="vf-summary__meta | topics-info">
            <p class="vf-summary__meta">Topics:&nbsp;</p><a class="vf-link"><?php the_category(); ?>&nbsp;&nbsp;&nbsp;</a>
			<p class="vf-summary__meta"><?php echo reading_time(); ?> read</p>
        </div>
    </div>
</article>
