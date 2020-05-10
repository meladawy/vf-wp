/**!
 * VF Gutenberg blocks
 */
import {registerBlockType} from '@wordpress/blocks';
import useVFGutenberg from './hooks/use-vf-gutenberg';
import useVFPluginSettings from './hooks/use-vf-plugin-settings';

// Import Visual Framework core component settings
import vfActivityItem from './vf-core/vf-activity-item';
import vfActivityList from './vf-core/vf-activity-list';
import vfBadge from './vf-core/vf-badge';
import vfBlockquote from './vf-core/vf-blockquote';
import vfBox from './vf-core/vf-box';
import vfBreadcrumbsItem from './vf-core/vf-breadcrumbs-item';
import vfBreadcrumbs from './vf-core/vf-breadcrumbs';
import vfButton from './vf-core/vf-button';
import vfDivider from './vf-core/vf-divider';
import vfEmbed from './vf-core/vf-embed';
import vfGridColumn from './vf-core/vf-grid-column';
import vfEMBLGrid from './vf-core/vf-embl-grid';
import vfGrid from './vf-core/vf-grid';
import vfLede from './vf-core/vf-lede';

// Get "localized" global script settings
const {plugins, coreOptin} = useVFGutenberg();

// Register VF Core blocks
if (parseInt(coreOptin) === 1) {
  const coreBlocks = [
    // Grid
    vfGridColumn,
    vfEMBLGrid,
    vfGrid,
    // Elements
    vfBadge,
    vfBlockquote,
    vfButton,
    vfDivider,
    // Blocks
    vfActivityItem,
    vfActivityList,
    vfBox,
    vfBreadcrumbsItem,
    vfBreadcrumbs,
    vfLede,
    vfEmbed
  ];
  coreBlocks.forEach((settings) => registerBlockType(settings.name, settings));
}

// DEPRECATED
// Register deprecated VF Plugin blocks for legacy support
// These blocks are placed by full ACF versions
for (const [name, plugin] of Object.entries(plugins)) {
  const settings = useVFPluginSettings({
    name,
    title: plugin.title,
    category: plugin.category
  });
  registerBlockType(name, settings);
}

// Handle iframe preview resizing globally
// TODO: remove necessity from `useVFIFrame`
window.addEventListener('message', ({data}) => {
  if (data !== Object(data) || ! /^vfwp_/.test(data.id)) {
    return;
  }
  const iframe = document.getElementById(data.id);
  if ( ! iframe || ! iframe.vfActive) {
    return;
  }
  window.requestAnimationFrame(() => {
    iframe.style.height = `${data.height}px`;
  });
});
