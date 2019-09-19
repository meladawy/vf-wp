<?php

global $post, $vf_plugin;
if ( ! $vf_plugin instanceof VF_Data_resources) return;

$heading = trim(get_field('vf_data_resources_heading', $post->ID));

$content = $vf_plugin->api_html();

if (vf_cache_empty($content)) {
  return;
}

// Add grid layout classes to wrapping element
$content = preg_replace(
  '#vf-content-hub-html#',
  // '$1 vf-grid vf-grid__col-2',
  '$1',
  $content
);
?>
<?php if ( ! empty($heading)) { ?>
  <div class="vf-section-header">
    <h2 class="vf-section-header__heading vf-u-margin__bottom--r"><?php echo esc_html($heading); ?></h2>
  </div>
<?php } ?>
<div <?php $vf_plugin->api_attr(); ?>>
  <?php echo $content; ?>
</div>
