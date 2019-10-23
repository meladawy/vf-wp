<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists('VF_Gutenberg_Core_Paragraph') ) :

class VF_Gutenberg_Core_Paragraph {

  const SIZE_CLASSES = array(
    'extra-large' => 'vf-text--body vf-text-body--1',
    'large'       => 'vf-text--body vf-text-body--2',
    'regular'     => 'vf-text--body vf-text-body--3',
    'small'       => 'vf-text--body vf-text-body--4',
    'extra-small' => 'vf-text--body vf-text-body--5',
  );


  /**
   * Filter `core/paragraph` default Gutenberg block
   * Add `vf-text` markup
   */
  static function render($html, $block) {

    // Replace WordPress font size classes
    $html = preg_replace_callback(
      '#(<p[^>]*?)class="(.*?)has-([a-z-]+?)-font-size(.*?)"([^>]*?>)#',
      /*
      array(6) {
        [0]=>
        string(37) "<p class="has-extra-small-font-size">"
        [1]=>
        string(3) "<p "
        [2]=>
        string(0) ""
        [3]=>
        string(11) "extra-small"
        [4]=>
        string(0) ""
        [5]=>
        string(1) ">"
      }
      */
      function ($matches) {
        // Return unchanged if size is not recognised
        if ( ! array_key_exists($matches[3],
          VF_Gutenberg_Core_Paragraph::SIZE_CLASSES
        )) {
          return $matches[0];
        }
        // Generate new class attribute value
        $classes = array(
          trim($matches[2]),
          trim($matches[4]),
          VF_Gutenberg_Core_Paragraph::SIZE_CLASSES[$matches[3]]
        );
        // Return HTML with new class appended
        return
            $matches[1]
          . 'class="'
          . trim(implode(' ', $classes))
          . '"'
          . $matches[5];
      },
      $html
    );

    // Wrap in content class
    $html = '<div class="vf-content">' . $html . '</div>';

    return $html;
  }

} // VF_Gutenberg_Core_Paragraph

vf_gutenberg()->add_compatible(
  'core/paragraph',
  array('VF_Gutenberg_Core_Paragraph', 'render')
);

endif;

?>
