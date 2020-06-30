<?php

if( ! defined( 'ABSPATH' ) ) exit;

require_once('functions/walker-comment.php');

require_once('functions/admin.php');
require_once('functions/theme.php');

// Require Gutenberg block classes

require_once('functions/theme-block.php');
require_once('blocks/vfwp-latest-posts/index.php');
require_once('blocks/vfwp-summary/index.php');
require_once('blocks/vfwp-card/index.php');
require_once('blocks/vfwp-links-list/index.php');
require_once('blocks/vfwp-box/index.php');
require_once('blocks/vfwp-intro/index.php');
require_once('blocks/vfwp-activity-list/index.php');
require_once('blocks/vfwp-page-header/index.php');
require_once('blocks/vfwp-section-header/index.php');
require_once('blocks/vfwp-figure/index.php');
require_once('blocks/vfwp-embed/index.php');
require_once('blocks/vfwp-divider/index.php');
require_once('blocks/vfwp-tabs/index.php');
require_once('blocks/vfwp-banner/index.php');


global $vf_admin;
if ( ! isset($vf_admin)) {
  $vf_admin = new VF_Admin();
}

global $vf_theme;
if ( ! isset($vf_theme)) {
  $vf_theme = new VF_Theme();
}

?>
