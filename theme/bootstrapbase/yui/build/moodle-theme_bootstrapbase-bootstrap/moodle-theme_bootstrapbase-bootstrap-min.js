YUI.add("gallery-bootstrap-engine",function(e){function n(){n.superclass.constructor.apply(this,arguments)}var t="host";e.mix(n,{NAME:"bootstrap",ATTRS:{container:{getter:function(e){var n=this.get(t);return n&&n.one(e)}},iframe:{getter:function(){var e=this.get("container");return e&&e.one("iframe")}},host:{readyOnly:!0},ready:{value:!1,readyOnly:!0}}}),e.extend(n,e.Base,{EXTRAS:[],initializer:function(){var n=this,r,i,s,o=e.Array(n.EXTRAS),u,a=function(){e.later(0,n,function(){n._boot()})};try{r=e.config.win.parent,i=r&&r.window,s=i&&i.document}catch(f){}r&&i&&s?(u=YUI({bootstrap:!1,win:i,doc:s}),o.push("node",function(){a()}),n._set(t,u.use.apply(u,o))):a()},_boot:function(){var e=this,t;t=e._connect(),e._styleIframe(),e._init(),e._bind(),t&&e._ready(),e._set("ready",!0)},_connect:function(){var n=e.config.guid,r=this.get(t),i=r&&r.config.win,s=n&&i&&i.YUI&&i.YUI.Env[n];return s?s(this):!1},_init:function(){},_bind:function(){},_ready:function(){},_styleIframe:function(){var t=this.get("iframe");t&&e.each(["border","marginWidth","marginHeight","leftMargin","topMargin"],function(e){t.setAttribute(e,0)})}}),e.BootstrapEngine=n},"@VERSION@",{requires:["node","base-base"]}),YUI.add("gallery-bootstrap-collapse",function(e){function t(){t.superclass.constructor.apply(this,arguments)}t.NAME="Bootstrap.Collapse",t.NS="collapse",e.extend(t,e.Plugin.Base,{defaults:{duration:.25,easing:"ease-in",showClass:"in",hideClass:"out",groupSelector:"> .accordion-group > .in"},transitioning:!1,initializer:function(t){this._node=t.host,this.config=e.mix(t,this.defaults),this.publish("show",{preventable:!0,defaultFn:this.show}),this.publish("hide",{preventable:!0,defaultFn:this.hide}),this._node.on("click",this.toggle,this)},_getTarget:function(){var t=this._node,n;return t.getData("target")?n=e.one(t.getData("target")):t.getAttribute("href").indexOf("#")>=0&&(n=e.one(t.getAttribute("href").substr(t.getAttribute("href").indexOf("#")))),n},hide:function(){var e=this._getTarget();if(this.transitioning)return;e&&this._hideElement(e)},show:function(){var t=this._getTarget(),n=this._node,r=this,i,s=this.config.groupSelector;if(this.transitioning)return;n.getData("parent")&&(i=e.one(n.getData("parent")),i&&i.all(s).each(function(e){r._hideElement(e)})),this._showElement(t)},toggle:function(t){t&&e.Lang.isFunction(t.preventDefault)&&t.preventDefault();var n=this._getTarget();n.hasClass(this.config.showClass)?this.fire("hide"):this.fire("show")},_transition:function(e,t){var n=this,r=this.config,i=r.duration,s=r.easing,o=t==="hide"?r.showClass:r.hideClass,u=t==="hide"?r.hideClass:r.showClass,a=t==="hide"?0:null,f=t==="hide"?"hidden":"shown",l=function(){e.removeClass(o),e.addClass(u),n.transitioning=!1,this.fire(f)};a===null&&(a=0,e.all("> *").each(function(e){a+=e.get("scrollHeight")})),this.transitioning=!0,e.transition({height:a+"px",duration:i,easing:s},l)},_hideElement:function(e){this._transition(e,"hide")},_showElement:function(e){this._transition(e,"show")}}),e.namespace("Bootstrap").Collapse=t},"@VERSION@",{requires:["plugin","transition","event","event-delegate"]}),YUI.add("gallery-bootstrap-dropdown",function(e){function n(){n.superclass.constructor.apply(this,arguments)}var t=e.namespace("Bootstrap");n.NAME="Bootstrap.Dropdown",n.NS="dropdown",e.extend(n,e.Plugin.Base,{defaults:{className:"open",target:"target",selector:""},initializer:function(t){this._node=t.host,this.config=e.mix(t,this.defaults),this.publish("show",{preventable:!0,defaultFn:this.show}),this.publish("hide",{preventable:!0,defaultFn:this.hide}),this._node.on("click",this.toggle,this)},toggle:function(){var e=this.getTarget(),t=this.config.className;e.toggleClass(t),e.once("clickoutside",function(){e.toggleClass(t)})},show:function(){this.getTarget().addClass(this.config.className)},hide:function(){this.getTarget().removeClass(this.config.className)},open:function(){this.getTarget().addClass(this.config.className)},close:function(){this.getTarget().removeClass(this.config.className)},getTarget:function(){var t=this._node,n=t.getData(this.config.target),r;return n||(n=t.getAttribute("href"),n=r&&r.replace(/.*(?=#[^\s]*$)/,"")),r=e.all(n),r.size()===0&&(r=t.get("parentNode")),r}}),t.Dropdown=n,t.dropdown_delegation=function(){e.delegate("click",function(e){var t=e.currentTarget;e.preventDefault(),typeof e.target.dropdown=="undefined"&&(t.plug(n),t.dropdown.toggle())},document.body,"*[data-toggle=dropdown]")}},"@VERSION@",{requires:["plugin","event","event-outside"]}),YUI.add("moodle-theme_bootstrapbase-bootstrap",function(e,t){var n={ACTIVE:"active"},r={NAVBAR_BUTTON:".btn-navbar",TOGGLECOLLAPSE:'*[data-disabledtoggle="collapse"]'},i=e.namespace("Moodle.theme_bootstrapbase.bootstrap");i.init=function(){e.use("gallery-bootstrap-dropdown","gallery-bootstrap-collapse","gallery-bootstrap-engine",function(){i.setup_toggle_expandable(),i.setup_toggle_show(),e.Bootstrap.dropdown_delegation()})},i.setup_toggle_expandable=function(){e.delegate("click",this.toggle_expandable,e.config.doc,r.TOGGLECOLLAPSE,this)},i.toggle_expandable=function(t){typeof t.currentTarget.collapse=="undefined"&&(t.currentTarget.plug(e.Bootstrap.Collapse),t.currentTarget.collapse.toggle(),t.preventDefault())},i.setup_toggle_show=function(){e.delegate("click",this.toggle_show,e.config.doc,r.NAVBAR_BUTTON)},i.toggle_show=function(e){var t=this.get("parentNode").one(this.getAttribute("data-target"));t&&(this.siblings(".btn-navbar").removeClass(n.ACTIVE),t.siblings(".nav-collapse").removeClass(n.ACTIVE),t.toggleClass(n.ACTIVE)),e.currentTarget.toggleClass(n.ACTIVE)}},"@VERSION@",{requires:["node","selector-css3"]});