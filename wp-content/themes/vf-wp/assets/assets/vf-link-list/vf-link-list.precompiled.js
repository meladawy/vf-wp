/**
 * Precompiled Nunjucks template: vf-link-list.njk
 */
(function() {(window.nunjucksPrecompiled = window.nunjucksPrecompiled || {})["vf-link-list"] = (function() {
function root(env, context, frame, runtime, cb) {
var lineno = 0;
var colno = 0;
var output = "";
try {
var parentTemplate = null;
output += "<div class=\"vf-links";
if(runtime.contextOrFrameLookup(context, frame, "component_modifier")) {
output += " ";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "component_modifier"), env.opts.autoescape);
;
}
output += "\">\n  <h3 class=\"vf-links__heading\">";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "title"), env.opts.autoescape);
output += "</h3>\n  <ul class=\"vf-links__list";
if(runtime.contextOrFrameLookup(context, frame, "list_modifier")) {
output += " vf-links__list--";
output += runtime.suppressValue(runtime.contextOrFrameLookup(context, frame, "list_modifier"), env.opts.autoescape);
;
}
output += " | vf-list\">\n";
frame = frame.push();
var t_3 = runtime.fromIterator(runtime.contextOrFrameLookup(context, frame, "list"));
runtime.asyncEach(t_3, 1, function(item, t_1, t_2,next) {
frame.set("item", item);
frame.set("loop.index", t_1 + 1);
frame.set("loop.index0", t_1);
frame.set("loop.revindex", t_2 - t_1);
frame.set("loop.revindex0", t_2 - t_1 - 1);
frame.set("loop.first", t_1 === 0);
frame.set("loop.last", t_1 === t_2 - 1);
frame.set("loop.length", t_2);
output += "    <li class=\"vf-list__item\">\n      <a class=\"vf-list__link\" href=\"";
output += runtime.suppressValue(runtime.memberLookup((item),"link_list_href"), env.opts.autoescape);
output += "\">\n";
if(runtime.memberLookup((item),"image")) {
if(runtime.memberLookup((item),"image") == "blank") {
output += "            <span><!-- no image --></span>\n";
;
}
else {
output += "            ";
output += runtime.suppressValue(runtime.memberLookup((item),"image"), env.opts.autoescape);
output += "\n";
;
}
;
}
output += "        ";
output += runtime.suppressValue(runtime.memberLookup((item),"text"), env.opts.autoescape);
output += "\n      </a>\n";
(function(cb) {if(runtime.memberLookup((item),"badge")) {
env.getExtension("render")["run"](context,"@vf-badge", function(t_5,t_4) {
if(t_5) { cb(t_5); return; }
output += runtime.suppressValue(t_4, true && env.opts.autoescape);
cb()});
}
else {
cb()}
})(function(t_6) {
if(t_6) { cb(t_6); return; }if(runtime.memberLookup((item),"meta")) {
output += "        <p class=\"vf-links__meta\">";
output += runtime.suppressValue(runtime.memberLookup((item),"meta"), env.opts.autoescape);
output += "</p>\n";
;
}
output += "    </li>\n";
next(t_1);
});
}, function(t_8,t_7) {
if(t_8) { cb(t_8); return; }
frame = frame.pop();
output += "  </ul>\n</div>\n";
if(parentTemplate) {
parentTemplate.rootRenderFunc(env, context, frame, runtime, cb);
} else {
cb(null, output);
}
});
} catch (e) {
  cb(runtime.handleError(e, lineno, colno));
}
}
return {
root: root
};

})();
})();