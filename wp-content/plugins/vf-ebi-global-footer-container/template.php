<?php

global $vf_plugin;
if ( ! $vf_plugin instanceof VF_EBI_Global_Footer) return;

$content = $vf_plugin->api_html();

if ( ! empty($content)) {
?>
<div <?php $vf_plugin->api_attr(array('class' => 'vf-u-grid--reset')); ?>>
  <?php echo $content; ?>
</div>
<?php } ?>
