/**
 * Precompiled Nunjucks template: vf-embed.njk
 * based on vf-video.njk

{% if src %}
<div class="vf-video"{% if style %} style="{{ style }}"{% endif %}>
    <iframe width="{{ width }}" height="{{ height }}" src="{{ src }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
{% endif %}

 */
(function() {(window.nunjucksPrecompiled = window.nunjucksPrecompiled || {})["vf-embed"] = (function() {
function root(env, context, frame, runtime, cb) {
var lineno = 0;
var colno = 0;
var output = "";
try {
var parentTemplate = null;
if(runtime.contextOrFrameLookup(context, frame, "src")) {
output += "\n<div class=\"vf-video\"";
if(runtime.contextOrFrameLookup(context, frame, "style")) {
output += " style=\"";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "style"), env.opts.autoescape);
output += "\"";
;
}
output += ">\n    <iframe width=\"";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "width"), env.opts.autoescape);
output += "\" height=\"";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "height"), env.opts.autoescape);
output += "\" src=\"";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "src"), env.opts.autoescape);
output += "\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>\n</div>\n";
;
}
if(parentTemplate) {
parentTemplate.rootRenderFunc(env, context, frame, runtime, cb);
} else {
cb(null, output);
}
;
} catch (e) {
  cb(runtime.handleError(e, lineno, colno));
}
}
return {
root: root
};

})();
})();