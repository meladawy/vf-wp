/**
 * RichControl (component)
 * Wrapper for `InnerBlocks`
 */
import React, {useState} from 'react';

const {__} = wp.i18n;
const {RichText} = wp.editor;
const {BaseControl} = wp.components;

const RichControl = props => {
  return (
    <BaseControl label={props.label}>
      <div className="components-base-control__rich-text">
        <RichText
          tagName={props.tag}
          value={props.value}
          placeholder={props.placeholder}
          onChange={props.onChange}
        />
      </div>
    </BaseControl>
  );
};

export default RichControl;
