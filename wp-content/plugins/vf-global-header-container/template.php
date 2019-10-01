<?php

global $vf_plugin;
if ( ! $vf_plugin instanceof VF_Global_Header) return;

$content = $vf_plugin->api_html();

if ( ! empty($content)) {
?>
<header class="vf-header">
  <div <?php $vf_plugin->api_attr(array('class' => 'vf-u-grid--reset')); ?>>
    <?php echo $content; ?>
  </div>
</header>
<?php } ?>
