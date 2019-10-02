/**
 * VF Framework Badge
 */
import React from 'react';
import {__} from '@wordpress/i18n';
import useVFCoreSettings from '../hooks/use-vf-core-settings';

export default useVFCoreSettings({
  name: 'vf/activity-item',
  title: __('Activity Item'),
  parent: ['vf/activity-list'],
  isRenderable: false,
  attributes: {
    text: {
      type: 'string',
      default: '<strong>Author</strong> published <a href="#">\'Article Title\'</a> on <a href="#">Source</a>.'
    }
  },
  fields: [
    {
      name: 'text',
      control: 'rich',
      label: '',
      tag: 'p',
      placeholder: __('Type activity…')
    }
  ]
});
