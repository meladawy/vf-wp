/**
 * Return `onLoad` and `onUnload` functions for an iframe.
 * Adjust iframe height automatically whilst mounted.
 */
const useVFIFrame = (iframe, html) => {
  // update iframe height from `postMessage` event
  const onMessage = ({data}) => {
    if (data !== Object(data) || data.id !== iframe.id) {
      return;
    }
    window.requestAnimationFrame(() => {
      iframe.style.height = `${data.height}px`;
    });
  };

  const onLoad = () => {
    if (!iframe.vfActive) {
      window.addEventListener('message', onMessage);
    }
    iframe.vfActive = true;

    // set HTML content for block
    const body = iframe.contentWindow.document.body;
    const div = '<div style="clear:both;height:0;"></div>';
    body.innerHTML = `${div}${html}${div}`;

    // create and append script to handle automatic iframe resize
    // this cannot be inline of `html` for browser security
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.innerHTML = `
      window.vfResize = function() {
        requestAnimationFrame(function() {
          window.parent.postMessage({
              id: '${iframe.id}',
              height: document.documentElement.scrollHeight
            }, '*'
          );
        });
      };
      window.addEventListener('resize', vfResize);
      window.vfResize();
    `;
    body.appendChild(script);
  };

  // cleanup function for dismount
  const onUnload = () => {
    window.removeEventListener('message', onMessage);
    iframe.vfActive = false;
  };

  return {onLoad, onUnload};
};

export default useVFIFrame;
