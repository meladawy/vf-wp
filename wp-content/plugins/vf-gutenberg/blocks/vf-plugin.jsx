/**
 * VF Plugin (base components)
 * https://visual-framework.github.io/vf-core/components/detail/vf-button.html
 */
import {useRef} from 'react';
import {useVF, useVFBlock, useIFrameResize} from './hooks';

const {__} = wp.i18n;

const {BlockControls} = wp.editor;
const {Toolbar, IconButton} = wp.components;

// const withId = Component => {
//   return props => {
//     const id = Date.now() * Math.random();
//     return <Component {...props} instanceId={id} />;
//   };
// };

const EditButton = ({onClick}) => {
  return (
    <IconButton label={__('Edit', 'vfwp')} icon="edit" onClick={onClick} />
  );
};

const ViewButton = ({onClick}) => {
  return (
    <IconButton
      label="__('Preview', 'vfwp')"
      icon="visibility"
      onClick={onClick}
    />
  );
};

const ViewControl = ({data}) => {
  const iframeEl = useRef();
  const {onLoad} = useIFrameResize(iframeEl, data.html);
  return (
    <div className="vf-gutenberg-view">
      <iframe
        ref={iframeEl}
        onLoad={onLoad}
        className="vf-gutenberg-iframe"
        scrolling="no"
      />
    </div>
  );
};

const PluginEdit = function(props) {
  const {
    pluginId,
    clientId,
    isSelected,
    attributes: {ver, mode}
  } = props;

  // Ensure version is encoded in post content
  if (!ver) {
    props.setAttributes({ver: 1});
  }

  const isEdit = mode === 'edit';

  const {data, isLoading} = useVFBlock({
    ...props.attributes,
    blockName: props.name,
    pluginId
  });

  const LoadingControl = () => {
    return <div>{__('Loading', 'vfwp')}</div>;
  };

  const onToggle = () => {
    props.setAttributes({mode: !isEdit ? 'edit' : 'view'});
  };

  return [
    <BlockControls>
      <Toolbar>
        {isEdit ? (
          <ViewButton onClick={onToggle} />
        ) : (
          <EditButton onClick={onToggle} />
        )}
      </Toolbar>
    </BlockControls>,
    <div
      className="vf-gutenberg-block"
      data-ver={ver}
      data-name={props.name}
      data-edit={isEdit}
      data-selected={isSelected}
      data-loading={isLoading}>
      {isEdit ? (
        <div className="vf-gutenberg-edit">{props.children}</div>
      ) : isLoading ? (
        <LoadingControl />
      ) : (
        <ViewControl data={data} />
      )}
    </div>
  ];
};

export default PluginEdit;
