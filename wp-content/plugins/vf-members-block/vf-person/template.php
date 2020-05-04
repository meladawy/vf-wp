<?php
/**

Query vars:
&pattern=vf-summary-profile-s&filter-content-type=person

by Full Name:
&filter-field-contains[field_person_full_name]=Ken%20Hawkins&limit=1&source=contenthub

by EMBL CP-ID:
&filter-field-contains[field_person_embl_id]=CP-60022294&limit=1&source=contenthub

*/

// Block preview in Gutenberg editor
$is_preview = isset($is_preview) && $is_preview;

// Get search field and value (default `full_name`)
$field = get_field('field');
$value = get_field('full_name');
if ($field === 'embl_id') {
  $value = get_field('embl_id');
}
$value = trim($value);

// Show default preview instruction
if (empty($value)) {
  if ($is_preview) {
?>
<div class="vf-banner vf-banner--phase vf-banner--alert vf-banner--info">
  <div class="vf-banner__content">
    <p class="vf-text--body-r vf-banner__text">
      <?php esc_html_e('Enter a search query to find a person.', 'vfwp'); ?>
    </p>
  </div>
</div>
<!--/vf-banner-->
<?php
  }
  return;
}

// Get pattern variation
$variation = get_field('variation');
$suffix = '';
if ( ! empty($variation)) {
  $suffix = "-{$variation}";
}

// Setup base API URL
$url = VF_Cache::get_api_url();
$url .= '/pattern.html';
$url = add_query_arg(array(
  'source'              => 'contenthub',
  'pattern'             => "vf-summary-profile{$suffix}",
  'filter-content-type' => 'person',
  'limit'               => 1
), $url);

// Add search field query var
$url = add_query_arg(array(
  "filter-field-contains[field_person_{$field}]" => $value
), $url);

// Request HTML from the Content Hub API
$content = VF_Cache::fetch($url);
$hash = VF_Cache::hash(
  esc_url_raw($url)
);

// Escape and show error if nothing found
if (
  vf_cache_empty($content)
  || ( vf_html_empty($content) && $is_preview )
) {
  if ($is_preview) {
?>
<div class="vf-banner vf-banner--phase vf-banner--alert vf-banner--danger">
  <div class="vf-banner__content">
    <p class="vf-text--body-r vf-banner__text">
      <?php esc_html_e('No person found.', 'vfwp'); ?>
    </p>
  </div>
</div>
<!--/vf-banner-->
<?php
  }
  return;
}

// Add hash attribute to opening tag
$content = preg_replace(
  '#^\s*<([^>]+?)>#',
  '<$1 data-cache="' . esc_attr($hash) . '">',
  $content
);

echo $content;

?>