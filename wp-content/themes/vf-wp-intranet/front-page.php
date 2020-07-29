

<?php

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
<section class="vf-hero vf-hero--inlay vf-hero--hard  | vf-hero-theme--primary" style="">
    <style>
  .vf-hero {
    --vf-hero-bg-image: url('https://wwwdev.embl.org/internal-information/wp-content/uploads/2020/07/EBI_webbanner_test_V1-1224x348.jpg');
    --vf-hero-grid__row--initial: 384px;
  }

  </style>
        <div class="vf-hero__content">
    <h2 class="vf-hero__heading">
      EMBL Intranet    </h2>
    <p class="vf-hero__text">
      This portal connects you to information on the public EMBL.org site and contains internal-only information on the day-to-day activities of EMBL staff in four common themes.<a class="vf-link" href="#"></a>    </p>
  </div>
</section>

<?php 

$vf_theme->the_content();

?>
<?php 

get_footer();

?>

<?php /*
get_header();

global $vf_theme;

// Do not wrap any `vf` plugin blocks by default
$is_wrapped = function($is_wrap, $block_name, $blocks, $i) {
  $plugin = VF_Plugin::get_plugin(
    VF_Blocks::name_block_to_post($block_name)
  );
  if ($plugin) {
    $is_wrap = false;
  }
  return $is_wrap;
};

// Prepend the opening wrapper elements
$open_wrap = function($html, $block_name) {
    $html = '
<section class="vf-inlay">
  <div class="vf-inlay__content vf-u-background-color-ui--white">
    <main class="vf-inlay__content--main">
  ' . $html;
  return $html;
};

// Append the closing wrapper elements
$close_wrap = function($html, $block_name) {
    $html .= '
    </main>
  </div>
</section>';
  return $html;
};

$block_prefix = function($html, $block_name, $has_wrap) use ($open_wrap) {
  $plugin = VF_Plugin::get_plugin(
    VF_Blocks::name_block_to_post($block_name)
  );
  if ($plugin && ! $plugin->is_template_standalone()) {
    $html = $open_wrap('', $block_name);
  }
  return $html;
};

$block_suffix = function($html, $block_name, $has_wrap) use ($close_wrap) {
  $plugin = VF_Plugin::get_plugin(
    VF_Blocks::name_block_to_post($block_name)
  );
  if ($plugin && ! $plugin->is_template_standalone()) {
    $html = $close_wrap('', $block_name);
  }
  return $html;
};


// Add `vf-divider` to top of wrapper
$render_block_after = function($block_html, $block_name, $i) {
  $hr = '<hr class="vf-divider">';
  if ($i > 0) {
    if (strpos($block_html, $hr) === false) {
      $block_html = preg_replace(
        '#(<main[^>]*?vf-inlay__content--main[^>]*?>)#',
        "{$hr}$1",
        $block_html, 1
      );
    }
  }
  if (vf_html_empty($block_html)) {
    $block_html = '';
  }
  return $block_html;
};

// Add filters
add_filter(
  'vf/__experimental__/theme/content/is_block_wrapped',
  $is_wrapped,
  10, 4
);
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
add_filter(
  'vf/__experimental__/theme/content/block_prefix',
  $block_prefix,
  10, 3
);
add_filter(
  'vf/__experimental__/theme/content/block_suffix',
  $block_suffix,
  10, 3
);
add_filter(
  'vf/__experimental__/theme/content/render_block_after',
  $render_block_after,
  10, 3
);

// Output blocks
$vf_theme->the_content();

get_footer();

*/
?>