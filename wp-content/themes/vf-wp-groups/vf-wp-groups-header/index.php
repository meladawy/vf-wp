<?php
/*
Plugin Name: VF-WP Groups Header
Description: VF-WP Groups theme global container.
Version: 0.1.0
Author: EMBL-EBI Web Development
Plugin URI: https://github.com/visual-framework/vf-wp
Text Domain: vfwp
*/

if ( ! defined( 'ABSPATH' ) ) exit;

$path = WP_PLUGIN_DIR . '/vf-wp/vf-plugin.php';
if ( ! file_exists($path)) return;
require_once($path);

class VF_WP_Groups_Header extends VF_Plugin {

  protected $file = __FILE__;

  protected $config = array(
    'post_name'  => 'vf_wp_groups_header',
    'post_title' => 'Groups Header',
    'post_type'  => 'vf_container',
  );

  function __construct(array $params = array()) {
    parent::__construct();
    if (array_key_exists('init', $params)) {
      parent::initialize();
    }
  }

} // VF_WP_Groups_Header

$plugin = new VF_WP_Groups_Header(
  array('init' => true)
);

?>
