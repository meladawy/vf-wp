<?php

if( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists('VFWP') ) :

class VF_Theme {

  protected $domain = '';

  public function __construct() {
    add_action(
      'after_setup_theme',
      array($this, 'after_setup_theme')
    );
    add_action(
      'wp_head',
      array($this, 'wp_head'),
      5
    );
  }

  public function after_setup_theme() {
    // Setup theme translation domain
    $theme = wp_get_theme();
    $this->domain = $theme->get('TextDomain');
    $dir = untrailingslashit(get_template_directory());
    load_theme_textdomain($this->domain, "{$dir}/languages");

    register_nav_menu('primary', __('Primary', $this->domain));
    register_nav_menu('secondary', __('Secondary', $this->domain));

    /**
     * Setup default theme supports
     */
    $supports = array(
      'title-tag',
      'disable-custom-font-sizes',
      'disable-custom-colors',
      'responsive-embeds',
      array(
        'html5',
        array(
          'comment-list',
          'comment-form',
          'search-form',
          'gallery',
          'caption'
        )
      )
    );

    // Add default color palette
    add_filter(
      'vf/theme/supports',
      array($this, 'editor_color_palette'),
      1, 1
    );

    // Add default font sizes
    add_filter(
      'vf/theme/supports',
      array($this, 'editor_font_sizes'),
      1, 1
    );

    // Filter and validate supports
    $supports = apply_filters('vf/theme/supports', $supports);
    if ( ! is_array($supports)) {
      $supports = array();
    }

    // Add theme support options
    foreach ($supports as $option) {
      if (is_string($option)) {
        add_theme_support($option);
      }
      if (is_array($option) && count($option) > 1 && is_string($option[0])) {
        add_theme_support($option[0], $option[1]);
      }
    }

  }

  /**
   * Filter: `vf/theme/supports`
   * Setup and filter initial Gutenberg editor color palette
   * https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
   */
  public function editor_color_palette($supports) {
    $color_palette = array(
      array(
        'name' => __('EMBL Grey', $this->domain),
        'slug' => 'embl-grey',
        'color' => '#707372',
      ),
      array(
        'name' => __('EMBL Green', $this->domain),
        'slug' => 'embl-green',
        'color' => '#009f4d',
      ),
      array(
        'name' => __('EMBL Blue', $this->domain),
        'slug' => 'embl-blue',
        'color' => '#307fe2',
      ),
      array(
        'name' => __('EMBL Red', $this->domain),
        'slug' => 'embl-red',
        'color' => '#e40046',
      ),
      // array(
      //   'name' => __('EMBL Purple', $this->domain),
      //   'slug' => 'embl-purple',
      //   'color' => '#8246af',
      // ),
      // array(
      //   'name' => __('EMBL Orange', $this->domain),
      //   'slug' => 'embl-orange',
      //   'color' => '#ffa300',
      // ),
      // array(
      //   'name' => __('EMBL Yellow', $this->domain),
      //   'slug' => 'embl-yellow',
      //   'color' => '#ffcd00',
      // ),
    );
    // Apply filters
    $color_palette = apply_filters(
      'vf/theme/editor_color_palette',
      $color_palette
    );
    // Append to theme supports
    $supports[] = array(
      'editor-color-palette',
      $color_palette
    );
    return $supports;
  }

  /**
   * Filter: `vf/theme/supports`
   * Setup and filter initial Gutenberg editor font sizes
   * https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
   */
  public function editor_font_sizes($supports) {
    $font_sizes = array(
      array(
        'name' => __('Extra Small', $this->domain),
        'shortName' => __('XS', $this->domain),
        'size' => 13.99,
        'slug' => 'extra-small'
      ),
      array(
        'name' => __('Small', $this->domain),
        'shortName' => __('S', $this->domain),
        'size' => 14,
        'slug' => 'small'
      ),
      array(
        'name' => __('Regular', $this->domain),
        'shortName' => __('R', $this->domain),
        'size' => 16,
        'slug' => 'regular'
      ),
      array(
        'name' => __('Large', $this->domain),
        'shortName' => __('L', $this->domain),
        'size' => 19,
        'slug' => 'large'
      ),
      array(
        'name' => __('Extra Large', $this->domain),
        'shortName' => __('XL', $this->domain),
        'size' => 32,
        'slug' => 'extra-large'
      ),
    );
    // Apply filters
    $font_sizes = apply_filters(
      'vf/theme/editor_font_sizes',
      $font_sizes
    );
    // Append to theme supports
    $supports[] = array(
      'editor-font-sizes',
      $font_sizes
    );
    return $supports;
  }

  /**
   * Output inline JavaScript to `<head>`
   */
  public function wp_head() {
    $path = untrailingslashit(get_template_directory());
    $path = "{$path}/assets/js/head.js";
    if (file_exists($path)) {
      echo "<script>\n";
      include($path);
      echo "</script>\n";
    }
  }

} // VF_WP

endif;

global $vf_theme;
if ( ! isset($vf_theme)) {
  $vf_theme = new VF_Theme();
}


define('VF_THEME_COLOR', '009f4d');


/**
 * Filter page query
 */
add_filter('pre_get_posts','vf__pre_get_posts');

function vf__pre_get_posts($query) {
  if (is_admin()) {
    return $query;
  }
  if ( ! $query->is_main_query()) {
    return $query;
  }
  // Exclude non posts from search
  if ($query->is_search()) {
    $query->set('post_type', 'post');
  }
  return $query;
}

/**
 * Output inline <head> stuff
 */
add_action('wp_head', 'vf__wp_head__inline', 5);

function vf__wp_head__inline() {
  // Output theme customisation
  $theme_color = get_theme_mod('vf_theme_color', VF_THEME_COLOR);
?>
<style>
.vf-wp-theme .vf-box--secondary,
.vf-wp-theme .vf-masthead {
  --vf-masthead__color--background: #<?php echo $theme_color; ?>;
}
</style>
<?php
}

/**
 * Allow enqueued scripts to use `async` or `defer` attributes
 *  by prefixing `--async` or `--defer` to the `$handle`
 */
if ( ! is_admin()) {
  add_filter('script_loader_tag', 'vf__script_loader_tag', 10, 2);
}
function vf__script_loader_tag($tag, $handle) {
  if (preg_match('#--(async|defer)$#', $handle, $matches)) {
    $tag = str_replace('<script ', "<script {$matches[1]} ", $tag);
  }
  return $tag;
}

/**
 * Load CSS and JavaScript assets
 */
add_action('wp_enqueue_scripts', 'vf__wp_enqueue_scripts', 20);

function vf__wp_enqueue_scripts() {
  $theme = wp_get_theme();
  $dir = get_template_directory_uri();

  // Use jQuery supplied by theme and enqueue in footer
  wp_deregister_script('jquery');
  wp_register_script(
    'jquery',
    $dir . '/assets/js/jquery-3.3.1.min.js',
    false,
    '3.3.1',
    true
  );
  wp_enqueue_script('jquery');

  // Add VF stylesheet if global option exists
  if (function_exists('vf_get_stylesheet') && vf_get_stylesheet()) {
    wp_enqueue_style(
      'vf',
      vf_get_stylesheet(),
      array(),
      $theme->version,
      'all'
    );
  }

  // Add VF JavaScript if global option exists
  if (function_exists('vf_get_javascript') && vf_get_javascript()) {
    wp_enqueue_script(
      'vf',
      vf_get_javascript(),
      array('jquery'),
      $theme->version,
      true
    );
  }

  // Add theme specific stylesheet
  wp_enqueue_style(
    'vfwp',
    $dir . '/assets/css/styles.css',
    array(),
    $theme->version,
    'all'
  );

  // Enqueue VF JS
  wp_enqueue_script(
    'vf-scripts',
    $dir . '/assets/scripts/scripts.js',
    array(),
    $theme->version,
    true
  );

  // Register script - let plugins enqueue as necessary
  wp_register_script(
    'accessible-autocomplete',
    $dir . '/assets/js/accessible-autocomplete.min.js',
    array(),
    '1.6.2',
    true
  );
  wp_register_style(
    'accessible-autocomplete',
    $dir . '/assets/css/vf-accessible-autocomplete.css',
    array('vfwp'),
    '1.6.2',
    'all'
  );
}

/**
 * Append <body> class for Visual Framework
 */
add_filter('body_class', 'vf__body_class');

function vf__body_class($classes) {
  $classes[] = 'vf-body';
  $classes[] = 'vf-wp-theme';
  if (is_singular('vf_block') || is_singular('vf_container')) {
    return $classes;
  }
  $classes[] = 'vf-u-background-color-ui--grey';
  return $classes;
}

/**
 * Add VF class to primary menu items
 */
add_filter('nav_menu_css_class', 'vf__nav_menu_css_class', 10, 4);

function vf__nav_menu_css_class($classes, $item, $args, $depth) {
  if (in_array($args->theme_location, array('primary', 'secondary'))) {
    return ['vf-navigation__item'];
  }
  return $classes;
}

/**
 * Add VF class to primary menu items
 */
add_filter('nav_menu_link_attributes', 'vf__nav_menu_link_attributes', 10, 4);

function vf__nav_menu_link_attributes($atts, $item, $args, $depth) {
  if (in_array($args->theme_location, array('primary', 'secondary'))) {
    $atts['class'] = 'vf-navigation__link';
  }
  return $atts;
}

/**
 * Filter the blog description to load via Content Hub
 */
add_filter('option_blogdescription', 'vf__blog_description', 10, 1);

function vf__blog_description($value) {
  // remove filter to avoid update recursion
  remove_filter('option_blogdescription', 'vf__blog_description', 10, 1);

  if ( ! class_exists('VF_Cache')) {
    return $value;
  }

  // generate API request
  $term_id = get_field('embl_taxonomy_term_what', 'option');
  $uuid = embl_taxonomy_get_uuid($term_id);

  if ( ! $uuid) {
    return $value;
  }

  $url = VF_Cache::get_api_url();
  $url .= '/pattern.html';
  $url = add_query_arg(array(
    'filter-uuid'         => $uuid,
    'filter-content-type' => 'profiles',
    'pattern'             => 'node-strapline',
    'source'              => 'contenthub',
  ), $url);

  // cache for one day
  $max_age = 60 * 60 * 24 * 1;

  // fetch content via the Content Hub cache
  $description = VF_Cache::fetch($url, $max_age);

  // strip HTML comments
  $description = preg_replace('#<!--(.*?)-->#s', '', $description);
  // strip edit link
  $description = preg_replace(
    '#<a[^>]*class="[^"]*embl-conditional-edit[^"]*"[^>]*>.*</a>#s',
    '', $description
  );
  // strip tags except for allowed
  $description = wp_kses(
    $description,
    array(
      'span' => array()
    )
  );
  $description = trim($description);

  // save updated description
  if ( ! empty($description) && $value !== $description) {
    $value = $description;
    update_option('blogdescription', $value);
  }

  return $value;
}

?>
