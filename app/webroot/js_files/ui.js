/*
 AngularJS v1.0.3
 (c) 2010-2012 Google, Inc. http://angularjs.org
 License: MIT
*/
(function(U,ca,p){'use strict';function m(b,a,c){var d;if(b)if(N(b))for(d in b)d!="prototype"&&d!="length"&&d!="name"&&b.hasOwnProperty(d)&&a.call(c,b[d],d);else if(b.forEach&&b.forEach!==m)b.forEach(a,c);else if(L(b)&&wa(b.length))for(d=0;d<b.length;d++)a.call(c,b[d],d);else for(d in b)b.hasOwnProperty(d)&&a.call(c,b[d],d);return b}function lb(b){var a=[],c;for(c in b)b.hasOwnProperty(c)&&a.push(c);return a.sort()}function ec(b,a,c){for(var d=lb(b),e=0;e<d.length;e++)a.call(c,b[d[e]],d[e]);return d}
function mb(b){return function(a,c){b(c,a)}}function xa(){for(var b=Z.length,a;b;){b--;a=Z[b].charCodeAt(0);if(a==57)return Z[b]="A",Z.join("");if(a==90)Z[b]="0";else return Z[b]=String.fromCharCode(a+1),Z.join("")}Z.unshift("0");return Z.join("")}function x(b){m(arguments,function(a){a!==b&&m(a,function(a,d){b[d]=a})});return b}function G(b){return parseInt(b,10)}function ya(b,a){return x(new (x(function(){},{prototype:b})),a)}function D(){}function ma(b){return b}function I(b){return function(){return b}}
function t(b){return typeof b=="undefined"}function v(b){return typeof b!="undefined"}function L(b){return b!=null&&typeof b=="object"}function F(b){return typeof b=="string"}function wa(b){return typeof b=="number"}function na(b){return Sa.apply(b)=="[object Date]"}function J(b){return Sa.apply(b)=="[object Array]"}function N(b){return typeof b=="function"}function oa(b){return b&&b.document&&b.location&&b.alert&&b.setInterval}function R(b){return F(b)?b.replace(/^\s*/,"").replace(/\s*$/,""):b}function fc(b){return b&&
(b.nodeName||b.bind&&b.find)}function Ta(b,a,c){var d=[];m(b,function(b,g,i){d.push(a.call(c,b,g,i))});return d}function gc(b,a){var c=0,d;if(J(b)||F(b))return b.length;else if(L(b))for(d in b)(!a||b.hasOwnProperty(d))&&c++;return c}function za(b,a){if(b.indexOf)return b.indexOf(a);for(var c=0;c<b.length;c++)if(a===b[c])return c;return-1}function Ua(b,a){var c=za(b,a);c>=0&&b.splice(c,1);return a}function V(b,a){if(oa(b)||b&&b.$evalAsync&&b.$watch)throw B("Can't copy Window or Scope");if(a){if(b===
a)throw B("Can't copy equivalent objects or arrays");if(J(b)){for(;a.length;)a.pop();for(var c=0;c<b.length;c++)a.push(V(b[c]))}else for(c in m(a,function(b,c){delete a[c]}),b)a[c]=V(b[c])}else(a=b)&&(J(b)?a=V(b,[]):na(b)?a=new Date(b.getTime()):L(b)&&(a=V(b,{})));return a}function hc(b,a){var a=a||{},c;for(c in b)b.hasOwnProperty(c)&&c.substr(0,2)!=="$$"&&(a[c]=b[c]);return a}function ha(b,a){if(b===a)return!0;if(b===null||a===null)return!1;if(b!==b&&a!==a)return!0;var c=typeof b,d;if(c==typeof a&&
c=="object")if(J(b)){if((c=b.length)==a.length){for(d=0;d<c;d++)if(!ha(b[d],a[d]))return!1;return!0}}else if(na(b))return na(a)&&b.getTime()==a.getTime();else{if(b&&b.$evalAsync&&b.$watch||a&&a.$evalAsync&&a.$watch||oa(b)||oa(a))return!1;c={};for(d in b){if(d.charAt(0)!=="$"&&!N(b[d])&&!ha(b[d],a[d]))return!1;c[d]=!0}for(d in a)if(!c[d]&&d.charAt(0)!=="$"&&!N(a[d]))return!1;return!0}return!1}function Va(b,a){var c=arguments.length>2?ia.call(arguments,2):[];return N(a)&&!(a instanceof RegExp)?c.length?
function(){return arguments.length?a.apply(b,c.concat(ia.call(arguments,0))):a.apply(b,c)}:function(){return arguments.length?a.apply(b,arguments):a.call(b)}:a}function ic(b,a){var c=a;/^\$+/.test(b)?c=p:oa(a)?c="$WINDOW":a&&ca===a?c="$DOCUMENT":a&&a.$evalAsync&&a.$watch&&(c="$SCOPE");return c}function da(b,a){return JSON.stringify(b,ic,a?"  ":null)}function nb(b){return F(b)?JSON.parse(b):b}function Wa(b){b&&b.length!==0?(b=E(""+b),b=!(b=="f"||b=="0"||b=="false"||b=="no"||b=="n"||b=="[]")):b=!1;
return b}function pa(b){b=u(b).clone();try{b.html("")}catch(a){}return u("<div>").append(b).html().match(/^(<[^>]+>)/)[1].replace(/^<([\w\-]+)/,function(a,b){return"<"+E(b)})}function Xa(b){var a={},c,d;m((b||"").split("&"),function(b){b&&(c=b.split("="),d=decodeURIComponent(c[0]),a[d]=v(c[1])?decodeURIComponent(c[1]):!0)});return a}function ob(b){var a=[];m(b,function(b,d){a.push(Ya(d,!0)+(b===!0?"":"="+Ya(b,!0)))});return a.length?a.join("&"):""}function Za(b){return Ya(b,!0).replace(/%26/gi,"&").replace(/%3D/gi,
"=").replace(/%2B/gi,"+")}function Ya(b,a){return encodeURIComponent(b).replace(/%40/gi,"@").replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(a?null:/%20/g,"+")}function jc(b,a){function c(a){a&&d.push(a)}var d=[b],e,g,i=["ng:app","ng-app","x-ng-app","data-ng-app"],f=/\sng[:\-]app(:\s*([\w\d_]+);?)?\s/;m(i,function(a){i[a]=!0;c(ca.getElementById(a));a=a.replace(":","\\:");b.querySelectorAll&&(m(b.querySelectorAll("."+a),c),m(b.querySelectorAll("."+a+"\\:"),c),m(b.querySelectorAll("["+
a+"]"),c))});m(d,function(a){if(!e){var b=f.exec(" "+a.className+" ");b?(e=a,g=(b[2]||"").replace(/\s+/g,",")):m(a.attributes,function(b){if(!e&&i[b.name])e=a,g=b.value})}});e&&a(e,g?[g]:[])}function pb(b,a){b=u(b);a=a||[];a.unshift(["$provide",function(a){a.value("$rootElement",b)}]);a.unshift("ng");var c=qb(a);c.invoke(["$rootScope","$rootElement","$compile","$injector",function(a,b,c,i){a.$apply(function(){b.data("$injector",i);c(b)(a)})}]);return c}function $a(b,a){a=a||"_";return b.replace(kc,
function(b,d){return(d?a:"")+b.toLowerCase()})}function qa(b,a,c){if(!b)throw new B("Argument '"+(a||"?")+"' is "+(c||"required"));return b}function ra(b,a,c){c&&J(b)&&(b=b[b.length-1]);qa(N(b),a,"not a function, got "+(b&&typeof b=="object"?b.constructor.name||"Object":typeof b));return b}function lc(b){function a(a,b,e){return a[b]||(a[b]=e())}return a(a(b,"angular",Object),"module",function(){var b={};return function(d,e,g){e&&b.hasOwnProperty(d)&&(b[d]=null);return a(b,d,function(){function a(c,
d,e){return function(){b[e||"push"]([c,d,arguments]);return j}}if(!e)throw B("No module: "+d);var b=[],c=[],k=a("$injector","invoke"),j={_invokeQueue:b,_runBlocks:c,requires:e,name:d,provider:a("$provide","provider"),factory:a("$provide","factory"),service:a("$provide","service"),value:a("$provide","value"),constant:a("$provide","constant","unshift"),filter:a("$filterProvider","register"),controller:a("$controllerProvider","register"),directive:a("$compileProvider","directive"),config:k,run:function(a){c.push(a);
return this}};g&&k(g);return j})}})}function rb(b){return b.replace(mc,function(a,b,d,e){return e?d.toUpperCase():d}).replace(nc,"Moz$1")}function ab(b,a){function c(){var e;for(var b=[this],c=a,i,f,h,k,j,l;b.length;){i=b.shift();f=0;for(h=i.length;f<h;f++){k=u(i[f]);c?k.triggerHandler("$destroy"):c=!c;j=0;for(e=(l=k.children()).length,k=e;j<k;j++)b.push(ja(l[j]))}}return d.apply(this,arguments)}var d=ja.fn[b],d=d.$original||d;c.$original=d;ja.fn[b]=c}function Q(b){if(b instanceof Q)return b;if(!(this instanceof
Q)){if(F(b)&&b.charAt(0)!="<")throw B("selectors not implemented");return new Q(b)}if(F(b)){var a=ca.createElement("div");a.innerHTML="<div>&#160;</div>"+b;a.removeChild(a.firstChild);bb(this,a.childNodes);this.remove()}else bb(this,b)}function cb(b){return b.cloneNode(!0)}function sa(b){sb(b);for(var a=0,b=b.childNodes||[];a<b.length;a++)sa(b[a])}function tb(b,a,c){var d=$(b,"events");$(b,"handle")&&(t(a)?m(d,function(a,c){db(b,c,a);delete d[c]}):t(c)?(db(b,a,d[a]),delete d[a]):Ua(d[a],c))}function sb(b){var a=
b[Aa],c=Ba[a];c&&(c.handle&&(c.events.$destroy&&c.handle({},"$destroy"),tb(b)),delete Ba[a],b[Aa]=p)}function $(b,a,c){var d=b[Aa],d=Ba[d||-1];if(v(c))d||(b[Aa]=d=++oc,d=Ba[d]={}),d[a]=c;else return d&&d[a]}function ub(b,a,c){var d=$(b,"data"),e=v(c),g=!e&&v(a),i=g&&!L(a);!d&&!i&&$(b,"data",d={});if(e)d[a]=c;else if(g)if(i)return d&&d[a];else x(d,a);else return d}function Ca(b,a){return(" "+b.className+" ").replace(/[\n\t]/g," ").indexOf(" "+a+" ")>-1}function vb(b,a){a&&m(a.split(" "),function(a){b.className=
R((" "+b.className+" ").replace(/[\n\t]/g," ").replace(" "+R(a)+" "," "))})}function wb(b,a){a&&m(a.split(" "),function(a){if(!Ca(b,a))b.className=R(b.className+" "+R(a))})}function bb(b,a){if(a)for(var a=!a.nodeName&&v(a.length)&&!oa(a)?a:[a],c=0;c<a.length;c++)b.push(a[c])}function xb(b,a){return Da(b,"$"+(a||"ngController")+"Controller")}function Da(b,a,c){b=u(b);for(b[0].nodeType==9&&(b=b.find("html"));b.length;){if(c=b.data(a))return c;b=b.parent()}}function yb(b,a){var c=Ea[a.toLowerCase()];
return c&&zb[b.nodeName]&&c}function pc(b,a){var c=function(c,e){if(!c.preventDefault)c.preventDefault=function(){c.returnValue=!1};if(!c.stopPropagation)c.stopPropagation=function(){c.cancelBubble=!0};if(!c.target)c.target=c.srcElement||ca;if(t(c.defaultPrevented)){var g=c.preventDefault;c.preventDefault=function(){c.defaultPrevented=!0;g.call(c)};c.defaultPrevented=!1}c.isDefaultPrevented=function(){return c.defaultPrevented};m(a[e||c.type],function(a){a.call(b,c)});aa<=8?(c.preventDefault=null,
c.stopPropagation=null,c.isDefaultPrevented=null):(delete c.preventDefault,delete c.stopPropagation,delete c.isDefaultPrevented)};c.elem=b;return c}function ga(b){var a=typeof b,c;if(a=="object"&&b!==null)if(typeof(c=b.$$hashKey)=="function")c=b.$$hashKey();else{if(c===p)c=b.$$hashKey=xa()}else c=b;return a+":"+c}function Fa(b){m(b,this.put,this)}function eb(){}function Ab(b){var a,c;if(typeof b=="function"){if(!(a=b.$inject))a=[],c=b.toString().replace(qc,""),c=c.match(rc),m(c[1].split(sc),function(b){b.replace(tc,
function(b,c,d){a.push(d)})}),b.$inject=a}else J(b)?(c=b.length-1,ra(b[c],"fn"),a=b.slice(0,c)):ra(b,"fn",!0);return a}function qb(b){function a(a){return function(b,c){if(L(b))m(b,mb(a));else return a(b,c)}}function c(a,b){N(b)&&(b=l.instantiate(b));if(!b.$get)throw B("Provider "+a+" must define $get factory method.");return j[a+f]=b}function d(a,b){return c(a,{$get:b})}function e(a){var b=[];m(a,function(a){if(!k.get(a))if(k.put(a,!0),F(a)){var c=ta(a);b=b.concat(e(c.requires)).concat(c._runBlocks);
try{for(var d=c._invokeQueue,c=0,f=d.length;c<f;c++){var h=d[c],g=h[0]=="$injector"?l:l.get(h[0]);g[h[1]].apply(g,h[2])}}catch(n){throw n.message&&(n.message+=" from "+a),n;}}else if(N(a))try{b.push(l.invoke(a))}catch(i){throw i.message&&(i.message+=" from "+a),i;}else if(J(a))try{b.push(l.invoke(a))}catch(j){throw j.message&&(j.message+=" from "+String(a[a.length-1])),j;}else ra(a,"module")});return b}function g(a,b){function c(d){if(typeof d!=="string")throw B("Service name expected");if(a.hasOwnProperty(d)){if(a[d]===
i)throw B("Circular dependency: "+h.join(" <- "));return a[d]}else try{return h.unshift(d),a[d]=i,a[d]=b(d)}finally{h.shift()}}function d(a,b,e){var f=[],k=Ab(a),g,n,i;n=0;for(g=k.length;n<g;n++)i=k[n],f.push(e&&e.hasOwnProperty(i)?e[i]:c(i,h));a.$inject||(a=a[g]);switch(b?-1:f.length){case 0:return a();case 1:return a(f[0]);case 2:return a(f[0],f[1]);case 3:return a(f[0],f[1],f[2]);case 4:return a(f[0],f[1],f[2],f[3]);case 5:return a(f[0],f[1],f[2],f[3],f[4]);case 6:return a(f[0],f[1],f[2],f[3],
f[4],f[5]);case 7:return a(f[0],f[1],f[2],f[3],f[4],f[5],f[6]);case 8:return a(f[0],f[1],f[2],f[3],f[4],f[5],f[6],f[7]);case 9:return a(f[0],f[1],f[2],f[3],f[4],f[5],f[6],f[7],f[8]);case 10:return a(f[0],f[1],f[2],f[3],f[4],f[5],f[6],f[7],f[8],f[9]);default:return a.apply(b,f)}}return{invoke:d,instantiate:function(a,b){var c=function(){},e;c.prototype=(J(a)?a[a.length-1]:a).prototype;c=new c;e=d(a,c,b);return L(e)?e:c},get:c,annotate:Ab}}var i={},f="Provider",h=[],k=new Fa,j={$provide:{provider:a(c),
factory:a(d),service:a(function(a,b){return d(a,["$injector",function(a){return a.instantiate(b)}])}),value:a(function(a,b){return d(a,I(b))}),constant:a(function(a,b){j[a]=b;o[a]=b}),decorator:function(a,b){var c=l.get(a+f),d=c.$get;c.$get=function(){var a=r.invoke(d,c);return r.invoke(b,null,{$delegate:a})}}}},l=g(j,function(){throw B("Unknown provider: "+h.join(" <- "));}),o={},r=o.$injector=g(o,function(a){a=l.get(a+f);return r.invoke(a.$get,a)});m(e(b),function(a){r.invoke(a||D)});return r}function uc(){var b=
!0;this.disableAutoScrolling=function(){b=!1};this.$get=["$window","$location","$rootScope",function(a,c,d){function e(a){var b=null;m(a,function(a){!b&&E(a.nodeName)==="a"&&(b=a)});return b}function g(){var b=c.hash(),d;b?(d=i.getElementById(b))?d.scrollIntoView():(d=e(i.getElementsByName(b)))?d.scrollIntoView():b==="top"&&a.scrollTo(0,0):a.scrollTo(0,0)}var i=a.document;b&&d.$watch(function(){return c.hash()},function(){d.$evalAsync(g)});return g}]}function vc(b,a,c,d){function e(a){try{a.apply(null,
ia.call(arguments,1))}finally{if(n--,n===0)for(;w.length;)try{w.pop()()}catch(b){c.error(b)}}}function g(a,b){(function ea(){m(q,function(a){a()});s=b(ea,a)})()}function i(){O!=f.url()&&(O=f.url(),m(A,function(a){a(f.url())}))}var f=this,h=a[0],k=b.location,j=b.history,l=b.setTimeout,o=b.clearTimeout,r={};f.isMock=!1;var n=0,w=[];f.$$completeOutstandingRequest=e;f.$$incOutstandingRequestCount=function(){n++};f.notifyWhenNoOutstandingRequests=function(a){m(q,function(a){a()});n===0?a():w.push(a)};
var q=[],s;f.addPollFn=function(a){t(s)&&g(100,l);q.push(a);return a};var O=k.href,C=a.find("base");f.url=function(a,b){if(a){if(O!=a)return O=a,d.history?b?j.replaceState(null,"",a):(j.pushState(null,"",a),C.attr("href",C.attr("href"))):b?k.replace(a):k.href=a,f}else return k.href.replace(/%27/g,"'")};var A=[],K=!1;f.onUrlChange=function(a){K||(d.history&&u(b).bind("popstate",i),d.hashchange?u(b).bind("hashchange",i):f.addPollFn(i),K=!0);A.push(a);return a};f.baseHref=function(){var a=C.attr("href");
return a?a.replace(/^https?\:\/\/[^\/]*/,""):a};var W={},y="",M=f.baseHref();f.cookies=function(a,b){var d,e,f,k;if(a)if(b===p)h.cookie=escape(a)+"=;path="+M+";expires=Thu, 01 Jan 1970 00:00:00 GMT";else{if(F(b))d=(h.cookie=escape(a)+"="+escape(b)+";path="+M).length+1,d>4096&&c.warn("Cookie '"+a+"' possibly not set or overflowed because it was too large ("+d+" > 4096 bytes)!"),W.length>20&&c.warn("Cookie '"+a+"' possibly not set or overflowed because too many cookies were already set ("+W.length+
" > 20 )")}else{if(h.cookie!==y){y=h.cookie;d=y.split("; ");W={};for(f=0;f<d.length;f++)e=d[f],k=e.indexOf("="),k>0&&(W[unescape(e.substring(0,k))]=unescape(e.substring(k+1)))}return W}};f.defer=function(a,b){var c;n++;c=l(function(){delete r[c];e(a)},b||0);r[c]=!0;return c};f.defer.cancel=function(a){return r[a]?(delete r[a],o(a),e(D),!0):!1}}function wc(){this.$get=["$window","$log","$sniffer","$document",function(b,a,c,d){return new vc(b,d,a,c)}]}function xc(){this.$get=function(){function b(b,
d){function e(a){if(a!=l){if(o){if(o==a)o=a.n}else o=a;g(a.n,a.p);g(a,l);l=a;l.n=null}}function g(a,b){if(a!=b){if(a)a.p=b;if(b)b.n=a}}if(b in a)throw B("cacheId "+b+" taken");var i=0,f=x({},d,{id:b}),h={},k=d&&d.capacity||Number.MAX_VALUE,j={},l=null,o=null;return a[b]={put:function(a,b){var c=j[a]||(j[a]={key:a});e(c);t(b)||(a in h||i++,h[a]=b,i>k&&this.remove(o.key))},get:function(a){var b=j[a];if(b)return e(b),h[a]},remove:function(a){var b=j[a];if(b){if(b==l)l=b.p;if(b==o)o=b.n;g(b.n,b.p);delete j[a];
delete h[a];i--}},removeAll:function(){h={};i=0;j={};l=o=null},destroy:function(){j=f=h=null;delete a[b]},info:function(){return x({},f,{size:i})}}}var a={};b.info=function(){var b={};m(a,function(a,e){b[e]=a.info()});return b};b.get=function(b){return a[b]};return b}}function yc(){this.$get=["$cacheFactory",function(b){return b("templates")}]}function Bb(b){var a={},c="Directive",d=/^\s*directive\:\s*([\d\w\-_]+)\s+(.*)$/,e=/(([\d\w\-_]+)(?:\:([^;]+))?;?)/,g="Template must have exactly one root element. was: ";
this.directive=function f(d,e){F(d)?(qa(e,"directive"),a.hasOwnProperty(d)||(a[d]=[],b.factory(d+c,["$injector","$exceptionHandler",function(b,c){var e=[];m(a[d],function(a){try{var f=b.invoke(a);if(N(f))f={compile:I(f)};else if(!f.compile&&f.link)f.compile=I(f.link);f.priority=f.priority||0;f.name=f.name||d;f.require=f.require||f.controller&&f.name;f.restrict=f.restrict||"A";e.push(f)}catch(k){c(k)}});return e}])),a[d].push(e)):m(d,mb(f));return this};this.$get=["$injector","$interpolate","$exceptionHandler",
"$http","$templateCache","$parse","$controller","$rootScope",function(b,h,k,j,l,o,r,n){function w(a,b,c){a instanceof u||(a=u(a));m(a,function(b,c){b.nodeType==3&&(a[c]=u(b).wrap("<span></span>").parent()[0])});var d=s(a,b,a,c);return function(b,c){qa(b,"scope");var e=c?ua.clone.call(a):a;e.data("$scope",b);q(e,"ng-scope");c&&c(e,b);d&&d(b,e,e);return e}}function q(a,b){try{a.addClass(b)}catch(c){}}function s(a,b,c,d){function e(a,c,d,k){for(var g,h,j,n,o,l=0,r=0,q=f.length;l<q;r++)j=c[r],g=f[l++],
h=f[l++],g?(g.scope?(n=a.$new(L(g.scope)),u(j).data("$scope",n)):n=a,(o=g.transclude)||!k&&b?g(h,n,j,d,function(b){return function(c){var d=a.$new();return b(d,c).bind("$destroy",Va(d,d.$destroy))}}(o||b)):g(h,n,j,p,k)):h&&h(a,j.childNodes,p,k)}for(var f=[],k,g,h,j=0;j<a.length;j++)g=new ea,k=O(a[j],[],g,d),g=(k=k.length?C(k,a[j],g,b,c):null)&&k.terminal||!a[j].childNodes.length?null:s(a[j].childNodes,k?k.transclude:b),f.push(k),f.push(g),h=h||k||g;return h?e:null}function O(a,b,c,f){var k=c.$attr,
g;switch(a.nodeType){case 1:A(b,fa(Cb(a).toLowerCase()),"E",f);var h,j,n;g=a.attributes;for(var o=0,l=g&&g.length;o<l;o++)if(h=g[o],h.specified)j=h.name,n=fa(j.toLowerCase()),k[n]=j,c[n]=h=R(aa&&j=="href"?decodeURIComponent(a.getAttribute(j,2)):h.value),yb(a,n)&&(c[n]=!0),X(a,b,h,n),A(b,n,"A",f);a=a.className;if(F(a)&&a!=="")for(;g=e.exec(a);)n=fa(g[2]),A(b,n,"C",f)&&(c[n]=R(g[3])),a=a.substr(g.index+g[0].length);break;case 3:H(b,a.nodeValue);break;case 8:try{if(g=d.exec(a.nodeValue))n=fa(g[1]),A(b,
n,"M",f)&&(c[n]=R(g[2]))}catch(r){}}b.sort(y);return b}function C(a,b,c,d,e){function f(a,b){if(a)a.require=z.require,l.push(a);if(b)b.require=z.require,ba.push(b)}function h(a,b){var c,d="data",e=!1;if(F(a)){for(;(c=a.charAt(0))=="^"||c=="?";)a=a.substr(1),c=="^"&&(d="inheritedData"),e=e||c=="?";c=b[d]("$"+a+"Controller");if(!c&&!e)throw B("No controller: "+a);}else J(a)&&(c=[],m(a,function(a){c.push(h(a,b))}));return c}function j(a,d,e,f,g){var n,q,w,K,s;n=b===e?c:hc(c,new ea(u(e),c.$attr));q=n.$$element;
if(C){var zc=/^\s*([@=&])\s*(\w*)\s*$/,O=d.$parent||d;m(C.scope,function(a,b){var c=a.match(zc)||[],e=c[2]||b,f,g,k;switch(c[1]){case "@":n.$observe(e,function(a){d[b]=a});n.$$observers[e].$$scope=O;break;case "=":g=o(n[e]);k=g.assign||function(){f=d[b]=g(O);throw B(Db+n[e]+" (directive: "+C.name+")");};f=d[b]=g(O);d.$watch(function(){var a=g(O);a!==d[b]&&(a!==f?f=d[b]=a:k(O,a=f=d[b]));return a});break;case "&":g=o(n[e]);d[b]=function(a){return g(O,a)};break;default:throw B("Invalid isolate scope definition for directive "+
C.name+": "+a);}})}t&&m(t,function(a){var b={$scope:d,$element:q,$attrs:n,$transclude:g};s=a.controller;s=="@"&&(s=n[a.name]);q.data("$"+a.name+"Controller",r(s,b))});f=0;for(w=l.length;f<w;f++)try{K=l[f],K(d,q,n,K.require&&h(K.require,q))}catch(y){k(y,pa(q))}a&&a(d,e.childNodes,p,g);f=0;for(w=ba.length;f<w;f++)try{K=ba[f],K(d,q,n,K.require&&h(K.require,q))}catch(Ha){k(Ha,pa(q))}}for(var n=-Number.MAX_VALUE,l=[],ba=[],s=null,C=null,A=null,y=c.$$element=u(b),z,H,X,D,v=d,t,x,Y,E=0,G=a.length;E<G;E++){z=
a[E];X=p;if(n>z.priority)break;if(Y=z.scope)M("isolated scope",C,z,y),L(Y)&&(q(y,"ng-isolate-scope"),C=z),q(y,"ng-scope"),s=s||z;H=z.name;if(Y=z.controller)t=t||{},M("'"+H+"' controller",t[H],z,y),t[H]=z;if(Y=z.transclude)M("transclusion",D,z,y),D=z,n=z.priority,Y=="element"?(X=u(b),y=c.$$element=u("<\!-- "+H+": "+c[H]+" --\>"),b=y[0],Ga(e,u(X[0]),b),v=w(X,d,n)):(X=u(cb(b)).contents(),y.html(""),v=w(X,d));if(Y=z.template)if(M("template",A,z,y),A=z,Y=Ha(Y),z.replace){X=u("<div>"+R(Y)+"</div>").contents();
b=X[0];if(X.length!=1||b.nodeType!==1)throw new B(g+Y);Ga(e,y,b);H={$attr:{}};a=a.concat(O(b,a.splice(E+1,a.length-(E+1)),H));K(c,H);G=a.length}else y.html(Y);if(z.templateUrl)M("template",A,z,y),A=z,j=W(a.splice(E,a.length-E),j,y,c,e,z.replace,v),G=a.length;else if(z.compile)try{x=z.compile(y,c,v),N(x)?f(null,x):x&&f(x.pre,x.post)}catch(I){k(I,pa(y))}if(z.terminal)j.terminal=!0,n=Math.max(n,z.priority)}j.scope=s&&s.scope;j.transclude=D&&v;return j}function A(d,e,g,h){var j=!1;if(a.hasOwnProperty(e))for(var n,
e=b.get(e+c),o=0,l=e.length;o<l;o++)try{if(n=e[o],(h===p||h>n.priority)&&n.restrict.indexOf(g)!=-1)d.push(n),j=!0}catch(r){k(r)}return j}function K(a,b){var c=b.$attr,d=a.$attr,e=a.$$element;m(a,function(d,e){e.charAt(0)!="$"&&(b[e]&&(d+=(e==="style"?";":" ")+b[e]),a.$set(e,d,!0,c[e]))});m(b,function(b,f){f=="class"?(q(e,b),a["class"]=(a["class"]?a["class"]+" ":"")+b):f=="style"?e.attr("style",e.attr("style")+";"+b):f.charAt(0)!="$"&&!a.hasOwnProperty(f)&&(a[f]=b,d[f]=c[f])})}function W(a,b,c,d,e,
f,k){var h=[],n,o,r=c[0],q=a.shift(),w=x({},q,{controller:null,templateUrl:null,transclude:null,scope:null});c.html("");j.get(q.templateUrl,{cache:l}).success(function(j){var l,q,j=Ha(j);if(f){q=u("<div>"+R(j)+"</div>").contents();l=q[0];if(q.length!=1||l.nodeType!==1)throw new B(g+j);j={$attr:{}};Ga(e,c,l);O(l,a,j);K(d,j)}else l=r,c.html(j);a.unshift(w);n=C(a,c,d,k);for(o=s(c.contents(),k);h.length;){var ba=h.pop(),j=h.pop();q=h.pop();var y=h.pop(),m=l;q!==r&&(m=cb(l),Ga(j,u(q),m));n(function(){b(o,
y,m,e,ba)},y,m,e,ba)}h=null}).error(function(a,b,c,d){throw B("Failed to load template: "+d.url);});return function(a,c,d,e,f){h?(h.push(c),h.push(d),h.push(e),h.push(f)):n(function(){b(o,c,d,e,f)},c,d,e,f)}}function y(a,b){return b.priority-a.priority}function M(a,b,c,d){if(b)throw B("Multiple directives ["+b.name+", "+c.name+"] asking for "+a+" on: "+pa(d));}function H(a,b){var c=h(b,!0);c&&a.push({priority:0,compile:I(function(a,b){var d=b.parent(),e=d.data("$binding")||[];e.push(c);q(d.data("$binding",
e),"ng-binding");a.$watch(c,function(a){b[0].nodeValue=a})})})}function X(a,b,c,d){var e=h(c,!0);e&&b.push({priority:100,compile:I(function(a,b,c){b=c.$$observers||(c.$$observers={});d==="class"&&(e=h(c[d],!0));c[d]=p;(b[d]||(b[d]=[])).$$inter=!0;(c.$$observers&&c.$$observers[d].$$scope||a).$watch(e,function(a){c.$set(d,a)})})})}function Ga(a,b,c){var d=b[0],e=d.parentNode,f,g;if(a){f=0;for(g=a.length;f<g;f++)if(a[f]==d){a[f]=c;break}}e&&e.replaceChild(c,d);c[u.expando]=d[u.expando];b[0]=c}var ea=
function(a,b){this.$$element=a;this.$attr=b||{}};ea.prototype={$normalize:fa,$set:function(a,b,c,d){var e=yb(this.$$element[0],a),f=this.$$observers;e&&(this.$$element.prop(a,b),d=e);this[a]=b;d?this.$attr[a]=d:(d=this.$attr[a])||(this.$attr[a]=d=$a(a,"-"));c!==!1&&(b===null||b===p?this.$$element.removeAttr(d):this.$$element.attr(d,b));f&&m(f[a],function(a){try{a(b)}catch(c){k(c)}})},$observe:function(a,b){var c=this,d=c.$$observers||(c.$$observers={}),e=d[a]||(d[a]=[]);e.push(b);n.$evalAsync(function(){e.$$inter||
b(c[a])});return b}};var D=h.startSymbol(),ba=h.endSymbol(),Ha=D=="{{"||ba=="}}"?ma:function(a){return a.replace(/\{\{/g,D).replace(/}}/g,ba)};return w}]}function fa(b){return rb(b.replace(Ac,""))}function Bc(){var b={};this.register=function(a,c){L(a)?x(b,a):b[a]=c};this.$get=["$injector","$window",function(a,c){return function(d,e){if(F(d)){var g=d,d=b.hasOwnProperty(g)?b[g]:fb(e.$scope,g,!0)||fb(c,g,!0);ra(d,g,!0)}return a.instantiate(d,e)}}]}function Cc(){this.$get=["$window",function(b){return u(b.document)}]}
function Dc(){this.$get=["$log",function(b){return function(a,c){b.error.apply(b,arguments)}}]}function Ec(){var b="{{",a="}}";this.startSymbol=function(a){return a?(b=a,this):b};this.endSymbol=function(b){return b?(a=b,this):a};this.$get=["$parse",function(c){function d(d,f){for(var h,k,j=0,l=[],o=d.length,r=!1,n=[];j<o;)(h=d.indexOf(b,j))!=-1&&(k=d.indexOf(a,h+e))!=-1?(j!=h&&l.push(d.substring(j,h)),l.push(j=c(r=d.substring(h+e,k))),j.exp=r,j=k+g,r=!0):(j!=o&&l.push(d.substring(j)),j=o);if(!(o=
l.length))l.push(""),o=1;if(!f||r)return n.length=o,j=function(a){for(var b=0,c=o,d;b<c;b++){if(typeof(d=l[b])=="function")d=d(a),d==null||d==p?d="":typeof d!="string"&&(d=da(d));n[b]=d}return n.join("")},j.exp=d,j.parts=l,j}var e=b.length,g=a.length;d.startSymbol=function(){return b};d.endSymbol=function(){return a};return d}]}function Eb(b){for(var b=b.split("/"),a=b.length;a--;)b[a]=Za(b[a]);return b.join("/")}function va(b,a){var c=Fb.exec(b),c={protocol:c[1],host:c[3],port:G(c[5])||Gb[c[1]]||
null,path:c[6]||"/",search:c[8],hash:c[10]};if(a)a.$$protocol=c.protocol,a.$$host=c.host,a.$$port=c.port;return c}function ka(b,a,c){return b+"://"+a+(c==Gb[b]?"":":"+c)}function Fc(b,a,c){var d=va(b);return decodeURIComponent(d.path)!=a||t(d.hash)||d.hash.indexOf(c)!==0?b:ka(d.protocol,d.host,d.port)+a.substr(0,a.lastIndexOf("/"))+d.hash.substr(c.length)}function Gc(b,a,c){var d=va(b);if(decodeURIComponent(d.path)==a)return b;else{var e=d.search&&"?"+d.search||"",g=d.hash&&"#"+d.hash||"",i=a.substr(0,
a.lastIndexOf("/")),f=d.path.substr(i.length);if(d.path.indexOf(i)!==0)throw B('Invalid url "'+b+'", missing path prefix "'+i+'" !');return ka(d.protocol,d.host,d.port)+a+"#"+c+f+e+g}}function gb(b,a,c){a=a||"";this.$$parse=function(b){var c=va(b,this);if(c.path.indexOf(a)!==0)throw B('Invalid url "'+b+'", missing path prefix "'+a+'" !');this.$$path=decodeURIComponent(c.path.substr(a.length));this.$$search=Xa(c.search);this.$$hash=c.hash&&decodeURIComponent(c.hash)||"";this.$$compose()};this.$$compose=
function(){var b=ob(this.$$search),c=this.$$hash?"#"+Za(this.$$hash):"";this.$$url=Eb(this.$$path)+(b?"?"+b:"")+c;this.$$absUrl=ka(this.$$protocol,this.$$host,this.$$port)+a+this.$$url};this.$$rewriteAppUrl=function(a){if(a.indexOf(c)==0)return a};this.$$parse(b)}function Ia(b,a,c){var d;this.$$parse=function(b){var c=va(b,this);if(c.hash&&c.hash.indexOf(a)!==0)throw B('Invalid url "'+b+'", missing hash prefix "'+a+'" !');d=c.path+(c.search?"?"+c.search:"");c=Hc.exec((c.hash||"").substr(a.length));
this.$$path=c[1]?(c[1].charAt(0)=="/"?"":"/")+decodeURIComponent(c[1]):"";this.$$search=Xa(c[3]);this.$$hash=c[5]&&decodeURIComponent(c[5])||"";this.$$compose()};this.$$compose=function(){var b=ob(this.$$search),c=this.$$hash?"#"+Za(this.$$hash):"";this.$$url=Eb(this.$$path)+(b?"?"+b:"")+c;this.$$absUrl=ka(this.$$protocol,this.$$host,this.$$port)+d+(this.$$url?"#"+a+this.$$url:"")};this.$$rewriteAppUrl=function(a){if(a.indexOf(c)==0)return a};this.$$parse(b)}function Hb(b,a,c,d){Ia.apply(this,arguments);
this.$$rewriteAppUrl=function(b){if(b.indexOf(c)==0)return c+d+"#"+a+b.substr(c.length)}}function Ja(b){return function(){return this[b]}}function Ib(b,a){return function(c){if(t(c))return this[b];this[b]=a(c);this.$$compose();return this}}function Ic(){var b="",a=!1;this.hashPrefix=function(a){return v(a)?(b=a,this):b};this.html5Mode=function(b){return v(b)?(a=b,this):a};this.$get=["$rootScope","$browser","$sniffer","$rootElement",function(c,d,e,g){function i(a){c.$broadcast("$locationChangeSuccess",
f.absUrl(),a)}var f,h,k,j=d.url(),l=va(j);a?(h=d.baseHref()||"/",k=h.substr(0,h.lastIndexOf("/")),l=ka(l.protocol,l.host,l.port)+k+"/",f=e.history?new gb(Fc(j,h,b),k,l):new Hb(Gc(j,h,b),b,l,h.substr(k.length+1))):(l=ka(l.protocol,l.host,l.port)+(l.path||"")+(l.search?"?"+l.search:"")+"#"+b+"/",f=new Ia(j,b,l));g.bind("click",function(a){if(!a.ctrlKey&&!(a.metaKey||a.which==2)){for(var b=u(a.target);E(b[0].nodeName)!=="a";)if(b[0]===g[0]||!(b=b.parent())[0])return;var d=b.prop("href"),e=f.$$rewriteAppUrl(d);
d&&!b.attr("target")&&e&&(f.$$parse(e),c.$apply(),a.preventDefault(),U.angular["ff-684208-preventDefault"]=!0)}});f.absUrl()!=j&&d.url(f.absUrl(),!0);d.onUrlChange(function(a){f.absUrl()!=a&&(c.$evalAsync(function(){var b=f.absUrl();f.$$parse(a);i(b)}),c.$$phase||c.$digest())});var o=0;c.$watch(function(){var a=d.url(),b=f.$$replace;if(!o||a!=f.absUrl())o++,c.$evalAsync(function(){c.$broadcast("$locationChangeStart",f.absUrl(),a).defaultPrevented?f.$$parse(a):(d.url(f.absUrl(),b),i(a))});f.$$replace=
!1;return o});return f}]}function Jc(){this.$get=["$window",function(b){function a(a){a instanceof B&&(a.stack?a=a.message&&a.stack.indexOf(a.message)===-1?"Error: "+a.message+"\n"+a.stack:a.stack:a.sourceURL&&(a=a.message+"\n"+a.sourceURL+":"+a.line));return a}function c(c){var e=b.console||{},g=e[c]||e.log||D;return g.apply?function(){var b=[];m(arguments,function(c){b.push(a(c))});return g.apply(e,b)}:function(a,b){g(a,b)}}return{log:c("log"),warn:c("warn"),info:c("info"),error:c("error")}}]}function Kc(b,
a){function c(a){return a.indexOf(q)!=-1}function d(){return n+1<b.length?b.charAt(n+1):!1}function e(a){return"0"<=a&&a<="9"}function g(a){return a==" "||a=="\r"||a=="\t"||a=="\n"||a=="\u000b"||a=="\u00a0"}function i(a){return"a"<=a&&a<="z"||"A"<=a&&a<="Z"||"_"==a||a=="$"}function f(a){return a=="-"||a=="+"||e(a)}function h(a,c,d){d=d||n;throw B("Lexer Error: "+a+" at column"+(v(c)?"s "+c+"-"+n+" ["+b.substring(c,d)+"]":" "+d)+" in expression ["+b+"].");}function k(){for(var a="",c=n;n<b.length;){var k=
E(b.charAt(n));if(k=="."||e(k))a+=k;else{var g=d();if(k=="e"&&f(g))a+=k;else if(f(k)&&g&&e(g)&&a.charAt(a.length-1)=="e")a+=k;else if(f(k)&&(!g||!e(g))&&a.charAt(a.length-1)=="e")h("Invalid exponent");else break}n++}a*=1;o.push({index:c,text:a,json:!0,fn:function(){return a}})}function j(){for(var c="",d=n,f,k,h;n<b.length;){var j=b.charAt(n);if(j=="."||i(j)||e(j))j=="."&&(f=n),c+=j;else break;n++}if(f)for(k=n;k<b.length;){j=b.charAt(k);if(j=="("){h=c.substr(f-d+1);c=c.substr(0,f-d);n=k;break}if(g(j))k++;
else break}d={index:d,text:c};if(Ka.hasOwnProperty(c))d.fn=d.json=Ka[c];else{var l=Jb(c,a);d.fn=x(function(a,b){return l(a,b)},{assign:function(a,b){return Kb(a,c,b)}})}o.push(d);h&&(o.push({index:f,text:".",json:!1}),o.push({index:f+1,text:h,json:!1}))}function l(a){var c=n;n++;for(var d="",e=a,f=!1;n<b.length;){var k=b.charAt(n);e+=k;if(f)k=="u"?(k=b.substring(n+1,n+5),k.match(/[\da-f]{4}/i)||h("Invalid unicode escape [\\u"+k+"]"),n+=4,d+=String.fromCharCode(parseInt(k,16))):(f=Lc[k],d+=f?f:k),
f=!1;else if(k=="\\")f=!0;else if(k==a){n++;o.push({index:c,text:e,string:d,json:!0,fn:function(){return d}});return}else d+=k;n++}h("Unterminated quote",c)}for(var o=[],r,n=0,w=[],q,s=":";n<b.length;){q=b.charAt(n);if(c("\"'"))l(q);else if(e(q)||c(".")&&e(d()))k();else if(i(q)){if(j(),"{,".indexOf(s)!=-1&&w[0]=="{"&&(r=o[o.length-1]))r.json=r.text.indexOf(".")==-1}else if(c("(){}[].,;:"))o.push({index:n,text:q,json:":[,".indexOf(s)!=-1&&c("{[")||c("}]:,")}),c("{[")&&w.unshift(q),c("}]")&&w.shift(),
n++;else if(g(q)){n++;continue}else{var m=q+d(),C=Ka[q],A=Ka[m];A?(o.push({index:n,text:m,fn:A}),n+=2):C?(o.push({index:n,text:q,fn:C,json:"[,:".indexOf(s)!=-1&&c("+-")}),n+=1):h("Unexpected next character ",n,n+1)}s=q}return o}function Mc(b,a,c,d){function e(a,c){throw B("Syntax Error: Token '"+c.text+"' "+a+" at column "+(c.index+1)+" of the expression ["+b+"] starting at ["+b.substring(c.index)+"].");}function g(){if(M.length===0)throw B("Unexpected end of expression: "+b);return M[0]}function i(a,
b,c,d){if(M.length>0){var e=M[0],f=e.text;if(f==a||f==b||f==c||f==d||!a&&!b&&!c&&!d)return e}return!1}function f(b,c,d,f){return(b=i(b,c,d,f))?(a&&!b.json&&e("is not valid json",b),M.shift(),b):!1}function h(a){f(a)||e("is unexpected, expecting ["+a+"]",i())}function k(a,b){return function(c,d){return a(c,d,b)}}function j(a,b,c){return function(d,e){return b(d,e,a,c)}}function l(){for(var a=[];;)if(M.length>0&&!i("}",")",";","]")&&a.push(v()),!f(";"))return a.length==1?a[0]:function(b,c){for(var d,
e=0;e<a.length;e++){var f=a[e];f&&(d=f(b,c))}return d}}function o(){for(var a=f(),b=c(a.text),d=[];;)if(a=f(":"))d.push(H());else{var e=function(a,c,e){for(var e=[e],f=0;f<d.length;f++)e.push(d[f](a,c));return b.apply(a,e)};return function(){return e}}}function r(){for(var a=n(),b;;)if(b=f("||"))a=j(a,b.fn,n());else return a}function n(){var a=w(),b;if(b=f("&&"))a=j(a,b.fn,n());return a}function w(){var a=q(),b;if(b=f("==","!="))a=j(a,b.fn,w());return a}function q(){var a;a=s();for(var b;b=f("+",
"-");)a=j(a,b.fn,s());if(b=f("<",">","<=",">="))a=j(a,b.fn,q());return a}function s(){for(var a=m(),b;b=f("*","/","%");)a=j(a,b.fn,m());return a}function m(){var a;return f("+")?C():(a=f("-"))?j(W,a.fn,m()):(a=f("!"))?k(a.fn,m()):C()}function C(){var a;if(f("("))a=v(),h(")");else if(f("["))a=A();else if(f("{"))a=K();else{var b=f();(a=b.fn)||e("not a primary expression",b)}for(var c;b=f("(","[",".");)b.text==="("?(a=u(a,c),c=null):b.text==="["?(c=a,a=ea(a)):b.text==="."?(c=a,a=t(a)):e("IMPOSSIBLE");
return a}function A(){var a=[];if(g().text!="]"){do a.push(H());while(f(","))}h("]");return function(b,c){for(var d=[],e=0;e<a.length;e++)d.push(a[e](b,c));return d}}function K(){var a=[];if(g().text!="}"){do{var b=f(),b=b.string||b.text;h(":");var c=H();a.push({key:b,value:c})}while(f(","))}h("}");return function(b,c){for(var d={},e=0;e<a.length;e++){var f=a[e],k=f.value(b,c);d[f.key]=k}return d}}var W=I(0),y,M=Kc(b,d),H=function(){var a=r(),c,d;return(d=f("="))?(a.assign||e("implies assignment but ["+
b.substring(0,d.index)+"] can not be assigned to",d),c=r(),function(b,d){return a.assign(b,c(b,d),d)}):a},u=function(a,b){var c=[];if(g().text!=")"){do c.push(H());while(f(","))}h(")");return function(d,e){for(var f=[],k=b?b(d,e):d,h=0;h<c.length;h++)f.push(c[h](d,e));h=a(d,e)||D;return h.apply?h.apply(k,f):h(f[0],f[1],f[2],f[3],f[4])}},t=function(a){var b=f().text,c=Jb(b,d);return x(function(b,d){return c(a(b,d),d)},{assign:function(c,d,e){return Kb(a(c,e),b,d)}})},ea=function(a){var b=H();h("]");
return x(function(c,d){var e=a(c,d),f=b(c,d),k;if(!e)return p;if((e=e[f])&&e.then){k=e;if(!("$$v"in e))k.$$v=p,k.then(function(a){k.$$v=a});e=e.$$v}return e},{assign:function(c,d,e){return a(c,e)[b(c,e)]=d}})},v=function(){for(var a=H(),b;;)if(b=f("|"))a=j(a,b.fn,o());else return a};a?(H=r,u=t=ea=v=function(){e("is not valid json",{text:b,index:0})},y=C()):y=l();M.length!==0&&e("is an unexpected token",M[0]);return y}function Kb(b,a,c){for(var a=a.split("."),d=0;a.length>1;d++){var e=a.shift(),g=
b[e];g||(g={},b[e]=g);b=g}return b[a.shift()]=c}function fb(b,a,c){if(!a)return b;for(var a=a.split("."),d,e=b,g=a.length,i=0;i<g;i++)d=a[i],b&&(b=(e=b)[d]);return!c&&N(b)?Va(e,b):b}function Lb(b,a,c,d,e){return function(g,i){var f=i&&i.hasOwnProperty(b)?i:g,h;if(f===null||f===p)return f;if((f=f[b])&&f.then){if(!("$$v"in f))h=f,h.$$v=p,h.then(function(a){h.$$v=a});f=f.$$v}if(!a||f===null||f===p)return f;if((f=f[a])&&f.then){if(!("$$v"in f))h=f,h.$$v=p,h.then(function(a){h.$$v=a});f=f.$$v}if(!c||f===
null||f===p)return f;if((f=f[c])&&f.then){if(!("$$v"in f))h=f,h.$$v=p,h.then(function(a){h.$$v=a});f=f.$$v}if(!d||f===null||f===p)return f;if((f=f[d])&&f.then){if(!("$$v"in f))h=f,h.$$v=p,h.then(function(a){h.$$v=a});f=f.$$v}if(!e||f===null||f===p)return f;if((f=f[e])&&f.then){if(!("$$v"in f))h=f,h.$$v=p,h.then(function(a){h.$$v=a});f=f.$$v}return f}}function Jb(b,a){if(hb.hasOwnProperty(b))return hb[b];var c=b.split("."),d=c.length,e;if(a)e=d<6?Lb(c[0],c[1],c[2],c[3],c[4]):function(a,b){var e=0,
k;do k=Lb(c[e++],c[e++],c[e++],c[e++],c[e++])(a,b),b=p,a=k;while(e<d);return k};else{var g="var l, fn, p;\n";m(c,function(a,b){g+="if(s === null || s === undefined) return s;\nl=s;\ns="+(b?"s":'((k&&k.hasOwnProperty("'+a+'"))?k:s)')+'["'+a+'"];\nif (s && s.then) {\n if (!("$$v" in s)) {\n p=s;\n p.$$v = undefined;\n p.then(function(v) {p.$$v=v;});\n}\n s=s.$$v\n}\n'});g+="return s;";e=Function("s","k",g);e.toString=function(){return g}}return hb[b]=e}function Nc(){var b={};this.$get=["$filter","$sniffer",
function(a,c){return function(d){switch(typeof d){case "string":return b.hasOwnProperty(d)?b[d]:b[d]=Mc(d,!1,a,c.csp);case "function":return d;default:return D}}}]}function Oc(){this.$get=["$rootScope","$exceptionHandler",function(b,a){return Pc(function(a){b.$evalAsync(a)},a)}]}function Pc(b,a){function c(a){return a}function d(a){return i(a)}var e=function(){var f=[],h,k;return k={resolve:function(a){if(f){var c=f;f=p;h=g(a);c.length&&b(function(){for(var a,b=0,d=c.length;b<d;b++)a=c[b],h.then(a[0],
a[1])})}},reject:function(a){k.resolve(i(a))},promise:{then:function(b,k){var g=e(),i=function(d){try{g.resolve((b||c)(d))}catch(e){a(e),g.reject(e)}},n=function(b){try{g.resolve((k||d)(b))}catch(c){a(c),g.reject(c)}};f?f.push([i,n]):h.then(i,n);return g.promise}}}},g=function(a){return a&&a.then?a:{then:function(c){var d=e();b(function(){d.resolve(c(a))});return d.promise}}},i=function(a){return{then:function(c,k){var g=e();b(function(){g.resolve((k||d)(a))});return g.promise}}};return{defer:e,reject:i,
when:function(f,h,k){var j=e(),l,o=function(b){try{return(h||c)(b)}catch(d){return a(d),i(d)}},r=function(b){try{return(k||d)(b)}catch(c){return a(c),i(c)}};b(function(){g(f).then(function(a){l||(l=!0,j.resolve(g(a).then(o,r)))},function(a){l||(l=!0,j.resolve(r(a)))})});return j.promise},all:function(a){var b=e(),c=a.length,d=[];c?m(a,function(a,e){g(a).then(function(a){e in d||(d[e]=a,--c||b.resolve(d))},function(a){e in d||b.reject(a)})}):b.resolve(d);return b.promise}}}function Qc(){var b={};this.when=
function(a,c){b[a]=x({reloadOnSearch:!0},c);if(a){var d=a[a.length-1]=="/"?a.substr(0,a.length-1):a+"/";b[d]={redirectTo:a}}return this};this.otherwise=function(a){this.when(null,a);return this};this.$get=["$rootScope","$location","$routeParams","$q","$injector","$http","$templateCache",function(a,c,d,e,g,i,f){function h(){var b=k(),h=r.current;if(b&&h&&b.$route===h.$route&&ha(b.pathParams,h.pathParams)&&!b.reloadOnSearch&&!o)h.params=b.params,V(h.params,d),a.$broadcast("$routeUpdate",h);else if(b||
h)o=!1,a.$broadcast("$routeChangeStart",b,h),(r.current=b)&&b.redirectTo&&(F(b.redirectTo)?c.path(j(b.redirectTo,b.params)).search(b.params).replace():c.url(b.redirectTo(b.pathParams,c.path(),c.search())).replace()),e.when(b).then(function(){if(b){var a=[],c=[],d;m(b.resolve||{},function(b,d){a.push(d);c.push(F(b)?g.get(b):g.invoke(b))});if(!v(d=b.template))if(v(d=b.templateUrl))d=i.get(d,{cache:f}).then(function(a){return a.data});v(d)&&(a.push("$template"),c.push(d));return e.all(c).then(function(b){var c=
{};m(b,function(b,d){c[a[d]]=b});return c})}}).then(function(c){if(b==r.current){if(b)b.locals=c,V(b.params,d);a.$broadcast("$routeChangeSuccess",b,h)}},function(c){b==r.current&&a.$broadcast("$routeChangeError",b,h,c)})}function k(){var a,d;m(b,function(b,e){if(!d&&(a=l(c.path(),e)))d=ya(b,{params:x({},c.search(),a),pathParams:a}),d.$route=b});return d||b[null]&&ya(b[null],{params:{},pathParams:{}})}function j(a,b){var c=[];m((a||"").split(":"),function(a,d){if(d==0)c.push(a);else{var e=a.match(/(\w+)(.*)/),
f=e[1];c.push(b[f]);c.push(e[2]||"");delete b[f]}});return c.join("")}var l=function(a,b){var c="^"+b.replace(/([\.\\\(\)\^\$])/g,"\\$1")+"$",d=[],e={};m(b.split(/\W/),function(a){if(a){var b=RegExp(":"+a+"([\\W])");c.match(b)&&(c=c.replace(b,"([^\\/]*)$1"),d.push(a))}});var f=a.match(RegExp(c));f&&m(d,function(a,b){e[a]=f[b+1]});return f?e:null},o=!1,r={routes:b,reload:function(){o=!0;a.$evalAsync(h)}};a.$on("$locationChangeSuccess",h);return r}]}function Rc(){this.$get=I({})}function Sc(){var b=
10;this.digestTtl=function(a){arguments.length&&(b=a);return b};this.$get=["$injector","$exceptionHandler","$parse",function(a,c,d){function e(){this.$id=xa();this.$$phase=this.$parent=this.$$watchers=this.$$nextSibling=this.$$prevSibling=this.$$childHead=this.$$childTail=null;this["this"]=this.$root=this;this.$$asyncQueue=[];this.$$listeners={}}function g(a){if(h.$$phase)throw B(h.$$phase+" already in progress");h.$$phase=a}function i(a,b){var c=d(a);ra(c,b);return c}function f(){}e.prototype={$new:function(a){if(N(a))throw B("API-CHANGE: Use $controller to instantiate controllers.");
a?(a=new e,a.$root=this.$root):(a=function(){},a.prototype=this,a=new a,a.$id=xa());a["this"]=a;a.$$listeners={};a.$parent=this;a.$$asyncQueue=[];a.$$watchers=a.$$nextSibling=a.$$childHead=a.$$childTail=null;a.$$prevSibling=this.$$childTail;this.$$childHead?this.$$childTail=this.$$childTail.$$nextSibling=a:this.$$childHead=this.$$childTail=a;return a},$watch:function(a,b,c){var d=i(a,"watch"),e=this.$$watchers,g={fn:b,last:f,get:d,exp:a,eq:!!c};if(!N(b)){var h=i(b||D,"listener");g.fn=function(a,b,
c){h(c)}}if(!e)e=this.$$watchers=[];e.unshift(g);return function(){Ua(e,g)}},$digest:function(){var a,d,e,i,r,n,m,q=b,s,p=[],C,A;g("$digest");do{m=!1;s=this;do{for(r=s.$$asyncQueue;r.length;)try{s.$eval(r.shift())}catch(K){c(K)}if(i=s.$$watchers)for(n=i.length;n--;)try{if(a=i[n],(d=a.get(s))!==(e=a.last)&&!(a.eq?ha(d,e):typeof d=="number"&&typeof e=="number"&&isNaN(d)&&isNaN(e)))m=!0,a.last=a.eq?V(d):d,a.fn(d,e===f?d:e,s),q<5&&(C=4-q,p[C]||(p[C]=[]),A=N(a.exp)?"fn: "+(a.exp.name||a.exp.toString()):
a.exp,A+="; newVal: "+da(d)+"; oldVal: "+da(e),p[C].push(A))}catch(W){c(W)}if(!(i=s.$$childHead||s!==this&&s.$$nextSibling))for(;s!==this&&!(i=s.$$nextSibling);)s=s.$parent}while(s=i);if(m&&!q--)throw h.$$phase=null,B(b+" $digest() iterations reached. Aborting!\nWatchers fired in the last 5 iterations: "+da(p));}while(m||r.length);h.$$phase=null},$destroy:function(){if(h!=this){var a=this.$parent;this.$broadcast("$destroy");if(a.$$childHead==this)a.$$childHead=this.$$nextSibling;if(a.$$childTail==
this)a.$$childTail=this.$$prevSibling;if(this.$$prevSibling)this.$$prevSibling.$$nextSibling=this.$$nextSibling;if(this.$$nextSibling)this.$$nextSibling.$$prevSibling=this.$$prevSibling;this.$parent=this.$$nextSibling=this.$$prevSibling=this.$$childHead=this.$$childTail=null}},$eval:function(a,b){return d(a)(this,b)},$evalAsync:function(a){this.$$asyncQueue.push(a)},$apply:function(a){try{return g("$apply"),this.$eval(a)}catch(b){c(b)}finally{h.$$phase=null;try{h.$digest()}catch(d){throw c(d),d;}}},
$on:function(a,b){var c=this.$$listeners[a];c||(this.$$listeners[a]=c=[]);c.push(b);return function(){c[za(c,b)]=null}},$emit:function(a,b){var d=[],e,f=this,g=!1,h={name:a,targetScope:f,stopPropagation:function(){g=!0},preventDefault:function(){h.defaultPrevented=!0},defaultPrevented:!1},i=[h].concat(ia.call(arguments,1)),m,p;do{e=f.$$listeners[a]||d;h.currentScope=f;m=0;for(p=e.length;m<p;m++)if(e[m])try{if(e[m].apply(null,i),g)return h}catch(C){c(C)}else e.splice(m,1),m--,p--;f=f.$parent}while(f);
return h},$broadcast:function(a,b){var d=this,e=this,f={name:a,targetScope:this,preventDefault:function(){f.defaultPrevented=!0},defaultPrevented:!1},g=[f].concat(ia.call(arguments,1)),h,i;do{d=e;f.currentScope=d;e=d.$$listeners[a]||[];h=0;for(i=e.length;h<i;h++)if(e[h])try{e[h].apply(null,g)}catch(m){c(m)}else e.splice(h,1),h--,i--;if(!(e=d.$$childHead||d!==this&&d.$$nextSibling))for(;d!==this&&!(e=d.$$nextSibling);)d=d.$parent}while(d=e);return f}};var h=new e;return h}]}function Tc(){this.$get=
["$window",function(b){var a={},c=G((/android (\d+)/.exec(E(b.navigator.userAgent))||[])[1]);return{history:!(!b.history||!b.history.pushState||c<4),hashchange:"onhashchange"in b&&(!b.document.documentMode||b.document.documentMode>7),hasEvent:function(c){if(c=="input"&&aa==9)return!1;if(t(a[c])){var e=b.document.createElement("div");a[c]="on"+c in e}return a[c]},csp:!1}}]}function Uc(){this.$get=I(U)}function Mb(b){var a={},c,d,e;if(!b)return a;m(b.split("\n"),function(b){e=b.indexOf(":");c=E(R(b.substr(0,
e)));d=R(b.substr(e+1));c&&(a[c]?a[c]+=", "+d:a[c]=d)});return a}function Nb(b){var a=L(b)?b:p;return function(c){a||(a=Mb(b));return c?a[E(c)]||null:a}}function Ob(b,a,c){if(N(c))return c(b,a);m(c,function(c){b=c(b,a)});return b}function Vc(){var b=/^\s*(\[|\{[^\{])/,a=/[\}\]]\s*$/,c=/^\)\]\}',?\n/,d=this.defaults={transformResponse:[function(d){F(d)&&(d=d.replace(c,""),b.test(d)&&a.test(d)&&(d=nb(d,!0)));return d}],transformRequest:[function(a){return L(a)&&Sa.apply(a)!=="[object File]"?da(a):a}],
headers:{common:{Accept:"application/json, text/plain, */*","X-Requested-With":"XMLHttpRequest"},post:{"Content-Type":"application/json;charset=utf-8"},put:{"Content-Type":"application/json;charset=utf-8"}}},e=this.responseInterceptors=[];this.$get=["$httpBackend","$browser","$cacheFactory","$rootScope","$q","$injector",function(a,b,c,h,k,j){function l(a){function c(a){var b=x({},a,{data:Ob(a.data,a.headers,f)});return 200<=a.status&&a.status<300?b:k.reject(b)}a.method=la(a.method);var e=a.transformRequest||
d.transformRequest,f=a.transformResponse||d.transformResponse,h=d.headers,h=x({"X-XSRF-TOKEN":b.cookies()["XSRF-TOKEN"]},h.common,h[E(a.method)],a.headers),e=Ob(a.data,Nb(h),e),g;t(a.data)&&delete h["Content-Type"];g=o(a,e,h);g=g.then(c,c);m(w,function(a){g=a(g)});g.success=function(b){g.then(function(c){b(c.data,c.status,c.headers,a)});return g};g.error=function(b){g.then(null,function(c){b(c.data,c.status,c.headers,a)});return g};return g}function o(b,c,d){function e(a,b,c){m&&(200<=a&&a<300?m.put(w,
[a,b,Mb(c)]):m.remove(w));f(b,a,c);h.$apply()}function f(a,c,d){c=Math.max(c,0);(200<=c&&c<300?j.resolve:j.reject)({data:a,status:c,headers:Nb(d),config:b})}function i(){var a=za(l.pendingRequests,b);a!==-1&&l.pendingRequests.splice(a,1)}var j=k.defer(),o=j.promise,m,p,w=r(b.url,b.params);l.pendingRequests.push(b);o.then(i,i);b.cache&&b.method=="GET"&&(m=L(b.cache)?b.cache:n);if(m)if(p=m.get(w))if(p.then)return p.then(i,i),p;else J(p)?f(p[1],p[0],V(p[2])):f(p,200,{});else m.put(w,o);p||a(b.method,
w,c,e,d,b.timeout,b.withCredentials);return o}function r(a,b){if(!b)return a;var c=[];ec(b,function(a,b){a==null||a==p||(L(a)&&(a=da(a)),c.push(encodeURIComponent(b)+"="+encodeURIComponent(a)))});return a+(a.indexOf("?")==-1?"?":"&")+c.join("&")}var n=c("$http"),w=[];m(e,function(a){w.push(F(a)?j.get(a):j.invoke(a))});l.pendingRequests=[];(function(a){m(arguments,function(a){l[a]=function(b,c){return l(x(c||{},{method:a,url:b}))}})})("get","delete","head","jsonp");(function(a){m(arguments,function(a){l[a]=
function(b,c,d){return l(x(d||{},{method:a,url:b,data:c}))}})})("post","put");l.defaults=d;return l}]}function Wc(){this.$get=["$browser","$window","$document",function(b,a,c){return Xc(b,Yc,b.defer,a.angular.callbacks,c[0],a.location.protocol.replace(":",""))}]}function Xc(b,a,c,d,e,g){function i(a,b){var c=e.createElement("script"),d=function(){e.body.removeChild(c);b&&b()};c.type="text/javascript";c.src=a;aa?c.onreadystatechange=function(){/loaded|complete/.test(c.readyState)&&d()}:c.onload=c.onerror=
d;e.body.appendChild(c)}return function(e,h,k,j,l,o,r){function n(a,c,d,e){c=(h.match(Fb)||["",g])[1]=="file"?d?200:404:c;a(c==1223?204:c,d,e);b.$$completeOutstandingRequest(D)}b.$$incOutstandingRequestCount();h=h||b.url();if(E(e)=="jsonp"){var p="_"+(d.counter++).toString(36);d[p]=function(a){d[p].data=a};i(h.replace("JSON_CALLBACK","angular.callbacks."+p),function(){d[p].data?n(j,200,d[p].data):n(j,-2);delete d[p]})}else{var q=new a;q.open(e,h,!0);m(l,function(a,b){a&&q.setRequestHeader(b,a)});
var s;q.onreadystatechange=function(){q.readyState==4&&n(j,s||q.status,q.responseText,q.getAllResponseHeaders())};if(r)q.withCredentials=!0;q.send(k||"");o>0&&c(function(){s=-1;q.abort()},o)}}}function Zc(){this.$get=function(){return{id:"en-us",NUMBER_FORMATS:{DECIMAL_SEP:".",GROUP_SEP:",",PATTERNS:[{minInt:1,minFrac:0,maxFrac:3,posPre:"",posSuf:"",negPre:"-",negSuf:"",gSize:3,lgSize:3},{minInt:1,minFrac:2,maxFrac:2,posPre:"\u00a4",posSuf:"",negPre:"(\u00a4",negSuf:")",gSize:3,lgSize:3}],CURRENCY_SYM:"$"},
DATETIME_FORMATS:{MONTH:"January,February,March,April,May,June,July,August,September,October,November,December".split(","),SHORTMONTH:"Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec".split(","),DAY:"Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(","),SHORTDAY:"Sun,Mon,Tue,Wed,Thu,Fri,Sat".split(","),AMPMS:["AM","PM"],medium:"MMM d, y h:mm:ss a","short":"M/d/yy h:mm a",fullDate:"EEEE, MMMM d, y",longDate:"MMMM d, y",mediumDate:"MMM d, y",shortDate:"M/d/yy",mediumTime:"h:mm:ss a",
shortTime:"h:mm a"},pluralCat:function(b){return b===1?"one":"other"}}}}function $c(){this.$get=["$rootScope","$browser","$q","$exceptionHandler",function(b,a,c,d){function e(e,f,h){var k=c.defer(),j=k.promise,l=v(h)&&!h,f=a.defer(function(){try{k.resolve(e())}catch(a){k.reject(a),d(a)}l||b.$apply()},f),h=function(){delete g[j.$$timeoutId]};j.$$timeoutId=f;g[f]=k;j.then(h,h);return j}var g={};e.cancel=function(b){return b&&b.$$timeoutId in g?(g[b.$$timeoutId].reject("canceled"),a.defer.cancel(b.$$timeoutId)):
!1};return e}]}function Pb(b){function a(a,e){return b.factory(a+c,e)}var c="Filter";this.register=a;this.$get=["$injector",function(a){return function(b){return a.get(b+c)}}];a("currency",Qb);a("date",Rb);a("filter",ad);a("json",bd);a("limitTo",cd);a("lowercase",dd);a("number",Sb);a("orderBy",Tb);a("uppercase",ed)}function ad(){return function(b,a){if(!(b instanceof Array))return b;var c=[];c.check=function(a){for(var b=0;b<c.length;b++)if(!c[b](a))return!1;return!0};var d=function(a,b){if(b.charAt(0)===
"!")return!d(a,b.substr(1));switch(typeof a){case "boolean":case "number":case "string":return(""+a).toLowerCase().indexOf(b)>-1;case "object":for(var c in a)if(c.charAt(0)!=="$"&&d(a[c],b))return!0;return!1;case "array":for(c=0;c<a.length;c++)if(d(a[c],b))return!0;return!1;default:return!1}};switch(typeof a){case "boolean":case "number":case "string":a={$:a};case "object":for(var e in a)e=="$"?function(){var b=(""+a[e]).toLowerCase();b&&c.push(function(a){return d(a,b)})}():function(){var b=e,f=
(""+a[e]).toLowerCase();f&&c.push(function(a){return d(fb(a,b),f)})}();break;case "function":c.push(a);break;default:return b}for(var g=[],i=0;i<b.length;i++){var f=b[i];c.check(f)&&g.push(f)}return g}}function Qb(b){var a=b.NUMBER_FORMATS;return function(b,d){if(t(d))d=a.CURRENCY_SYM;return Ub(b,a.PATTERNS[1],a.GROUP_SEP,a.DECIMAL_SEP,2).replace(/\u00A4/g,d)}}function Sb(b){var a=b.NUMBER_FORMATS;return function(b,d){return Ub(b,a.PATTERNS[0],a.GROUP_SEP,a.DECIMAL_SEP,d)}}function Ub(b,a,c,d,e){if(isNaN(b)||
!isFinite(b))return"";var g=b<0,b=Math.abs(b),i=b+"",f="",h=[],k=!1;if(i.indexOf("e")!==-1){var j=i.match(/([\d\.]+)e(-?)(\d+)/);j&&j[2]=="-"&&j[3]>e+1?i="0":(f=i,k=!0)}if(!k){i=(i.split(Vb)[1]||"").length;t(e)&&(e=Math.min(Math.max(a.minFrac,i),a.maxFrac));var i=Math.pow(10,e),b=Math.round(b*i)/i,b=(""+b).split(Vb),i=b[0],b=b[1]||"",k=0,j=a.lgSize,l=a.gSize;if(i.length>=j+l)for(var k=i.length-j,o=0;o<k;o++)(k-o)%l===0&&o!==0&&(f+=c),f+=i.charAt(o);for(o=k;o<i.length;o++)(i.length-o)%j===0&&o!==0&&
(f+=c),f+=i.charAt(o);for(;b.length<e;)b+="0";e&&(f+=d+b.substr(0,e))}h.push(g?a.negPre:a.posPre);h.push(f);h.push(g?a.negSuf:a.posSuf);return h.join("")}function ib(b,a,c){var d="";b<0&&(d="-",b=-b);for(b=""+b;b.length<a;)b="0"+b;c&&(b=b.substr(b.length-a));return d+b}function P(b,a,c,d){return function(e){e=e["get"+b]();if(c>0||e>-c)e+=c;e===0&&c==-12&&(e=12);return ib(e,a,d)}}function La(b,a){return function(c,d){var e=c["get"+b](),g=la(a?"SHORT"+b:b);return d[g][e]}}function Rb(b){function a(a){var b;
if(b=a.match(c)){var a=new Date(0),g=0,i=0;b[9]&&(g=G(b[9]+b[10]),i=G(b[9]+b[11]));a.setUTCFullYear(G(b[1]),G(b[2])-1,G(b[3]));a.setUTCHours(G(b[4]||0)-g,G(b[5]||0)-i,G(b[6]||0),G(b[7]||0))}return a}var c=/^(\d{4})-?(\d\d)-?(\d\d)(?:T(\d\d)(?::?(\d\d)(?::?(\d\d)(?:\.(\d+))?)?)?(Z|([+-])(\d\d):?(\d\d))?)?$/;return function(c,e){var g="",i=[],f,h,e=e||"mediumDate",e=b.DATETIME_FORMATS[e]||e;F(c)&&(c=fd.test(c)?G(c):a(c));wa(c)&&(c=new Date(c));if(!na(c))return c;for(;e;)(h=gd.exec(e))?(i=i.concat(ia.call(h,
1)),e=i.pop()):(i.push(e),e=null);m(i,function(a){f=hd[a];g+=f?f(c,b.DATETIME_FORMATS):a.replace(/(^'|'$)/g,"").replace(/''/g,"'")});return g}}function bd(){return function(b){return da(b,!0)}}function cd(){return function(b,a){if(!(b instanceof Array))return b;var a=G(a),c=[],d,e;if(!b||!(b instanceof Array))return c;a>b.length?a=b.length:a<-b.length&&(a=-b.length);a>0?(d=0,e=a):(d=b.length+a,e=b.length);for(;d<e;d++)c.push(b[d]);return c}}function Tb(b){return function(a,c,d){function e(a,b){return Wa(b)?
function(b,c){return a(c,b)}:a}if(!(a instanceof Array))return a;if(!c)return a;for(var c=J(c)?c:[c],c=Ta(c,function(a){var c=!1,d=a||ma;if(F(a)){if(a.charAt(0)=="+"||a.charAt(0)=="-")c=a.charAt(0)=="-",a=a.substring(1);d=b(a)}return e(function(a,b){var c;c=d(a);var e=d(b),f=typeof c,g=typeof e;f==g?(f=="string"&&(c=c.toLowerCase()),f=="string"&&(e=e.toLowerCase()),c=c===e?0:c<e?-1:1):c=f<g?-1:1;return c},c)}),g=[],i=0;i<a.length;i++)g.push(a[i]);return g.sort(e(function(a,b){for(var d=0;d<c.length;d++){var e=
c[d](a,b);if(e!==0)return e}return 0},d))}}function S(b){N(b)&&(b={link:b});b.restrict=b.restrict||"AC";return I(b)}function Wb(b,a){function c(a,c){c=c?"-"+$a(c,"-"):"";b.removeClass((a?Ma:Na)+c).addClass((a?Na:Ma)+c)}var d=this,e=b.parent().controller("form")||Oa,g=0,i=d.$error={};d.$name=a.name;d.$dirty=!1;d.$pristine=!0;d.$valid=!0;d.$invalid=!1;e.$addControl(d);b.addClass(Pa);c(!0);d.$addControl=function(a){a.$name&&!d.hasOwnProperty(a.$name)&&(d[a.$name]=a)};d.$removeControl=function(a){a.$name&&
d[a.$name]===a&&delete d[a.$name];m(i,function(b,c){d.$setValidity(c,!0,a)})};d.$setValidity=function(a,b,k){var j=i[a];if(b){if(j&&(Ua(j,k),!j.length)){g--;if(!g)c(b),d.$valid=!0,d.$invalid=!1;i[a]=!1;c(!0,a);e.$setValidity(a,!0,d)}}else{g||c(b);if(j){if(za(j,k)!=-1)return}else i[a]=j=[],g++,c(!1,a),e.$setValidity(a,!1,d);j.push(k);d.$valid=!1;d.$invalid=!0}};d.$setDirty=function(){b.removeClass(Pa).addClass(Xb);d.$dirty=!0;d.$pristine=!1;e.$setDirty()}}function T(b){return t(b)||b===""||b===null||
b!==b}function Qa(b,a,c,d,e,g){var i=function(){var c=R(a.val());d.$viewValue!==c&&b.$apply(function(){d.$setViewValue(c)})};if(e.hasEvent("input"))a.bind("input",i);else{var f;a.bind("keydown",function(a){a=a.keyCode;a===91||15<a&&a<19||37<=a&&a<=40||f||(f=g.defer(function(){i();f=null}))});a.bind("change",i)}d.$render=function(){a.val(T(d.$viewValue)?"":d.$viewValue)};var h=c.ngPattern,k=function(a,b){return T(b)||a.test(b)?(d.$setValidity("pattern",!0),b):(d.$setValidity("pattern",!1),p)};h&&(h.match(/^\/(.*)\/$/)?
(h=RegExp(h.substr(1,h.length-2)),e=function(a){return k(h,a)}):e=function(a){var c=b.$eval(h);if(!c||!c.test)throw new B("Expected "+h+" to be a RegExp but was "+c);return k(c,a)},d.$formatters.push(e),d.$parsers.push(e));if(c.ngMinlength){var j=G(c.ngMinlength),e=function(a){return!T(a)&&a.length<j?(d.$setValidity("minlength",!1),p):(d.$setValidity("minlength",!0),a)};d.$parsers.push(e);d.$formatters.push(e)}if(c.ngMaxlength){var l=G(c.ngMaxlength),c=function(a){return!T(a)&&a.length>l?(d.$setValidity("maxlength",
!1),p):(d.$setValidity("maxlength",!0),a)};d.$parsers.push(c);d.$formatters.push(c)}}function jb(b,a){b="ngClass"+b;return S(function(c,d,e){function g(b,d){if(a===!0||c.$index%2===a)d&&b!==d&&i(d),f(b)}function i(a){L(a)&&!J(a)&&(a=Ta(a,function(a,b){if(a)return b}));d.removeClass(J(a)?a.join(" "):a)}function f(a){L(a)&&!J(a)&&(a=Ta(a,function(a,b){if(a)return b}));a&&d.addClass(J(a)?a.join(" "):a)}c.$watch(e[b],g,!0);e.$observe("class",function(){var a=c.$eval(e[b]);g(a,a)});b!=="ngClass"&&c.$watch("$index",
function(d,g){var j=d%2;j!==g%2&&(j==a?f(c.$eval(e[b])):i(c.$eval(e[b])))})})}var E=function(b){return F(b)?b.toLowerCase():b},la=function(b){return F(b)?b.toUpperCase():b},B=U.Error,aa=G((/msie (\d+)/.exec(E(navigator.userAgent))||[])[1]),u,ja,ia=[].slice,Ra=[].push,Sa=Object.prototype.toString,Yb=U.angular||(U.angular={}),ta,Cb,Z=["0","0","0"];D.$inject=[];ma.$inject=[];Cb=aa<9?function(b){b=b.nodeName?b:b[0];return b.scopeName&&b.scopeName!="HTML"?la(b.scopeName+":"+b.nodeName):b.nodeName}:function(b){return b.nodeName?
b.nodeName:b[0].nodeName};var kc=/[A-Z]/g,id={full:"1.0.3",major:1,minor:0,dot:3,codeName:"bouncy-thunder"},Ba=Q.cache={},Aa=Q.expando="ng-"+(new Date).getTime(),oc=1,Zb=U.document.addEventListener?function(b,a,c){b.addEventListener(a,c,!1)}:function(b,a,c){b.attachEvent("on"+a,c)},db=U.document.removeEventListener?function(b,a,c){b.removeEventListener(a,c,!1)}:function(b,a,c){b.detachEvent("on"+a,c)},mc=/([\:\-\_]+(.))/g,nc=/^moz([A-Z])/,ua=Q.prototype={ready:function(b){function a(){c||(c=!0,b())}
var c=!1;this.bind("DOMContentLoaded",a);Q(U).bind("load",a)},toString:function(){var b=[];m(this,function(a){b.push(""+a)});return"["+b.join(", ")+"]"},eq:function(b){return b>=0?u(this[b]):u(this[this.length+b])},length:0,push:Ra,sort:[].sort,splice:[].splice},Ea={};m("multiple,selected,checked,disabled,readOnly,required".split(","),function(b){Ea[E(b)]=b});var zb={};m("input,select,option,textarea,button,form".split(","),function(b){zb[la(b)]=!0});m({data:ub,inheritedData:Da,scope:function(b){return Da(b,
"$scope")},controller:xb,injector:function(b){return Da(b,"$injector")},removeAttr:function(b,a){b.removeAttribute(a)},hasClass:Ca,css:function(b,a,c){a=rb(a);if(v(c))b.style[a]=c;else{var d;aa<=8&&(d=b.currentStyle&&b.currentStyle[a],d===""&&(d="auto"));d=d||b.style[a];aa<=8&&(d=d===""?p:d);return d}},attr:function(b,a,c){var d=E(a);if(Ea[d])if(v(c))c?(b[a]=!0,b.setAttribute(a,d)):(b[a]=!1,b.removeAttribute(d));else return b[a]||(b.attributes.getNamedItem(a)||D).specified?d:p;else if(v(c))b.setAttribute(a,
c);else if(b.getAttribute)return b=b.getAttribute(a,2),b===null?p:b},prop:function(b,a,c){if(v(c))b[a]=c;else return b[a]},text:x(aa<9?function(b,a){if(b.nodeType==1){if(t(a))return b.innerText;b.innerText=a}else{if(t(a))return b.nodeValue;b.nodeValue=a}}:function(b,a){if(t(a))return b.textContent;b.textContent=a},{$dv:""}),val:function(b,a){if(t(a))return b.value;b.value=a},html:function(b,a){if(t(a))return b.innerHTML;for(var c=0,d=b.childNodes;c<d.length;c++)sa(d[c]);b.innerHTML=a}},function(b,
a){Q.prototype[a]=function(a,d){var e,g;if((b.length==2&&b!==Ca&&b!==xb?a:d)===p)if(L(a)){for(e=0;e<this.length;e++)if(b===ub)b(this[e],a);else for(g in a)b(this[e],g,a[g]);return this}else{if(this.length)return b(this[0],a,d)}else{for(e=0;e<this.length;e++)b(this[e],a,d);return this}return b.$dv}});m({removeData:sb,dealoc:sa,bind:function a(c,d,e){var g=$(c,"events"),i=$(c,"handle");g||$(c,"events",g={});i||$(c,"handle",i=pc(c,g));m(d.split(" "),function(d){var h=g[d];if(!h){if(d=="mouseenter"||
d=="mouseleave"){var k=0;g.mouseenter=[];g.mouseleave=[];a(c,"mouseover",function(a){k++;k==1&&i(a,"mouseenter")});a(c,"mouseout",function(a){k--;k==0&&i(a,"mouseleave")})}else Zb(c,d,i),g[d]=[];h=g[d]}h.push(e)})},unbind:tb,replaceWith:function(a,c){var d,e=a.parentNode;sa(a);m(new Q(c),function(c){d?e.insertBefore(c,d.nextSibling):e.replaceChild(c,a);d=c})},children:function(a){var c=[];m(a.childNodes,function(a){a.nodeName!="#text"&&c.push(a)});return c},contents:function(a){return a.childNodes},
append:function(a,c){m(new Q(c),function(c){a.nodeType===1&&a.appendChild(c)})},prepend:function(a,c){if(a.nodeType===1){var d=a.firstChild;m(new Q(c),function(c){d?a.insertBefore(c,d):(a.appendChild(c),d=c)})}},wrap:function(a,c){var c=u(c)[0],d=a.parentNode;d&&d.replaceChild(c,a);c.appendChild(a)},remove:function(a){sa(a);var c=a.parentNode;c&&c.removeChild(a)},after:function(a,c){var d=a,e=a.parentNode;m(new Q(c),function(a){e.insertBefore(a,d.nextSibling);d=a})},addClass:wb,removeClass:vb,toggleClass:function(a,
c,d){t(d)&&(d=!Ca(a,c));(d?wb:vb)(a,c)},parent:function(a){return(a=a.parentNode)&&a.nodeType!==11?a:null},next:function(a){return a.nextSibling},find:function(a,c){return a.getElementsByTagName(c)},clone:cb,triggerHandler:function(a,c){var d=($(a,"events")||{})[c];m(d,function(c){c.call(a,null)})}},function(a,c){Q.prototype[c]=function(c,e){for(var g,i=0;i<this.length;i++)g==p?(g=a(this[i],c,e),g!==p&&(g=u(g))):bb(g,a(this[i],c,e));return g==p?this:g}});Fa.prototype={put:function(a,c){this[ga(a)]=
c},get:function(a){return this[ga(a)]},remove:function(a){var c=this[a=ga(a)];delete this[a];return c}};eb.prototype={push:function(a,c){var d=this[a=ga(a)];d?d.push(c):this[a]=[c]},shift:function(a){var c=this[a=ga(a)];if(c)return c.length==1?(delete this[a],c[0]):c.shift()},peek:function(a){if(a=this[ga(a)])return a[0]}};var rc=/^function\s*[^\(]*\(\s*([^\)]*)\)/m,sc=/,/,tc=/^\s*(_?)(\S+?)\1\s*$/,qc=/((\/\/.*$)|(\/\*[\s\S]*?\*\/))/mg,Db="Non-assignable model expression: ";Bb.$inject=["$provide"];
var Ac=/^(x[\:\-_]|data[\:\-_])/i,Fb=/^([^:]+):\/\/(\w+:{0,1}\w*@)?([\w\.-]*)(:([0-9]+))?(\/[^\?#]*)?(\?([^#]*))?(#(.*))?$/,$b=/^([^\?#]*)?(\?([^#]*))?(#(.*))?$/,Hc=$b,Gb={http:80,https:443,ftp:21};gb.prototype={$$replace:!1,absUrl:Ja("$$absUrl"),url:function(a,c){if(t(a))return this.$$url;var d=$b.exec(a);d[1]&&this.path(decodeURIComponent(d[1]));if(d[2]||d[1])this.search(d[3]||"");this.hash(d[5]||"",c);return this},protocol:Ja("$$protocol"),host:Ja("$$host"),port:Ja("$$port"),path:Ib("$$path",function(a){return a.charAt(0)==
"/"?a:"/"+a}),search:function(a,c){if(t(a))return this.$$search;v(c)?c===null?delete this.$$search[a]:this.$$search[a]=c:this.$$search=F(a)?Xa(a):a;this.$$compose();return this},hash:Ib("$$hash",ma),replace:function(){this.$$replace=!0;return this}};Ia.prototype=ya(gb.prototype);Hb.prototype=ya(Ia.prototype);var Ka={"null":function(){return null},"true":function(){return!0},"false":function(){return!1},undefined:D,"+":function(a,c,d,e){d=d(a,c);e=e(a,c);return v(d)?v(e)?d+e:d:v(e)?e:p},"-":function(a,
c,d,e){d=d(a,c);e=e(a,c);return(v(d)?d:0)-(v(e)?e:0)},"*":function(a,c,d,e){return d(a,c)*e(a,c)},"/":function(a,c,d,e){return d(a,c)/e(a,c)},"%":function(a,c,d,e){return d(a,c)%e(a,c)},"^":function(a,c,d,e){return d(a,c)^e(a,c)},"=":D,"==":function(a,c,d,e){return d(a,c)==e(a,c)},"!=":function(a,c,d,e){return d(a,c)!=e(a,c)},"<":function(a,c,d,e){return d(a,c)<e(a,c)},">":function(a,c,d,e){return d(a,c)>e(a,c)},"<=":function(a,c,d,e){return d(a,c)<=e(a,c)},">=":function(a,c,d,e){return d(a,c)>=e(a,
c)},"&&":function(a,c,d,e){return d(a,c)&&e(a,c)},"||":function(a,c,d,e){return d(a,c)||e(a,c)},"&":function(a,c,d,e){return d(a,c)&e(a,c)},"|":function(a,c,d,e){return e(a,c)(a,c,d(a,c))},"!":function(a,c,d){return!d(a,c)}},Lc={n:"\n",f:"\u000c",r:"\r",t:"\t",v:"\u000b","'":"'",'"':'"'},hb={},Yc=U.XMLHttpRequest||function(){try{return new ActiveXObject("Msxml2.XMLHTTP.6.0")}catch(a){}try{return new ActiveXObject("Msxml2.XMLHTTP.3.0")}catch(c){}try{return new ActiveXObject("Msxml2.XMLHTTP")}catch(d){}throw new B("This browser does not support XMLHttpRequest.");
};Pb.$inject=["$provide"];Qb.$inject=["$locale"];Sb.$inject=["$locale"];var Vb=".",hd={yyyy:P("FullYear",4),yy:P("FullYear",2,0,!0),y:P("FullYear",1),MMMM:La("Month"),MMM:La("Month",!0),MM:P("Month",2,1),M:P("Month",1,1),dd:P("Date",2),d:P("Date",1),HH:P("Hours",2),H:P("Hours",1),hh:P("Hours",2,-12),h:P("Hours",1,-12),mm:P("Minutes",2),m:P("Minutes",1),ss:P("Seconds",2),s:P("Seconds",1),EEEE:La("Day"),EEE:La("Day",!0),a:function(a,c){return a.getHours()<12?c.AMPMS[0]:c.AMPMS[1]},Z:function(a){a=a.getTimezoneOffset();
return ib(a/60,2)+ib(Math.abs(a%60),2)}},gd=/((?:[^yMdHhmsaZE']+)|(?:'(?:[^']|'')*')|(?:E+|y+|M+|d+|H+|h+|m+|s+|a|Z))(.*)/,fd=/^\d+$/;Rb.$inject=["$locale"];var dd=I(E),ed=I(la);Tb.$inject=["$parse"];var jd=I({restrict:"E",compile:function(a,c){c.href||c.$set("href","");return function(a,c){c.bind("click",function(a){if(!c.attr("href"))return a.preventDefault(),!1})}}}),kb={};m(Ea,function(a,c){var d=fa("ng-"+c);kb[d]=function(){return{priority:100,compile:function(){return function(a,g,i){a.$watch(i[d],
function(a){i.$set(c,!!a)})}}}}});m(["src","href"],function(a){var c=fa("ng-"+a);kb[c]=function(){return{priority:99,link:function(d,e,g){g.$observe(c,function(c){c&&(g.$set(a,c),aa&&e.prop(a,c))})}}}});var Oa={$addControl:D,$removeControl:D,$setValidity:D,$setDirty:D};Wb.$inject=["$element","$attrs","$scope"];var Ra=function(a){return["$timeout",function(c){var d={name:"form",restrict:"E",controller:Wb,compile:function(){return{pre:function(a,d,i,f){if(!i.action){var h=function(a){a.preventDefault?
a.preventDefault():a.returnValue=!1};Zb(d[0],"submit",h);d.bind("$destroy",function(){c(function(){db(d[0],"submit",h)},0,!1)})}var k=d.parent().controller("form"),j=i.name||i.ngForm;j&&(a[j]=f);k&&d.bind("$destroy",function(){k.$removeControl(f);j&&(a[j]=p);x(f,Oa)})}}}};return a?x(V(d),{restrict:"EAC"}):d}]},kd=Ra(),ld=Ra(!0),md=/^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,nd=/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,od=/^\s*(\-|\+)?(\d+|(\d*(\.\d*)))\s*$/,
ac={text:Qa,number:function(a,c,d,e,g,i){Qa(a,c,d,e,g,i);e.$parsers.push(function(a){var c=T(a);return c||od.test(a)?(e.$setValidity("number",!0),a===""?null:c?a:parseFloat(a)):(e.$setValidity("number",!1),p)});e.$formatters.push(function(a){return T(a)?"":""+a});if(d.min){var f=parseFloat(d.min),a=function(a){return!T(a)&&a<f?(e.$setValidity("min",!1),p):(e.$setValidity("min",!0),a)};e.$parsers.push(a);e.$formatters.push(a)}if(d.max){var h=parseFloat(d.max),d=function(a){return!T(a)&&a>h?(e.$setValidity("max",
!1),p):(e.$setValidity("max",!0),a)};e.$parsers.push(d);e.$formatters.push(d)}e.$formatters.push(function(a){return T(a)||wa(a)?(e.$setValidity("number",!0),a):(e.$setValidity("number",!1),p)})},url:function(a,c,d,e,g,i){Qa(a,c,d,e,g,i);a=function(a){return T(a)||md.test(a)?(e.$setValidity("url",!0),a):(e.$setValidity("url",!1),p)};e.$formatters.push(a);e.$parsers.push(a)},email:function(a,c,d,e,g,i){Qa(a,c,d,e,g,i);a=function(a){return T(a)||nd.test(a)?(e.$setValidity("email",!0),a):(e.$setValidity("email",
!1),p)};e.$formatters.push(a);e.$parsers.push(a)},radio:function(a,c,d,e){t(d.name)&&c.attr("name",xa());c.bind("click",function(){c[0].checked&&a.$apply(function(){e.$setViewValue(d.value)})});e.$render=function(){c[0].checked=d.value==e.$viewValue};d.$observe("value",e.$render)},checkbox:function(a,c,d,e){var g=d.ngTrueValue,i=d.ngFalseValue;F(g)||(g=!0);F(i)||(i=!1);c.bind("click",function(){a.$apply(function(){e.$setViewValue(c[0].checked)})});e.$render=function(){c[0].checked=e.$viewValue};e.$formatters.push(function(a){return a===
g});e.$parsers.push(function(a){return a?g:i})},hidden:D,button:D,submit:D,reset:D},bc=["$browser","$sniffer",function(a,c){return{restrict:"E",require:"?ngModel",link:function(d,e,g,i){i&&(ac[E(g.type)]||ac.text)(d,e,g,i,c,a)}}}],Na="ng-valid",Ma="ng-invalid",Pa="ng-pristine",Xb="ng-dirty",pd=["$scope","$exceptionHandler","$attrs","$element","$parse",function(a,c,d,e,g){function i(a,c){c=c?"-"+$a(c,"-"):"";e.removeClass((a?Ma:Na)+c).addClass((a?Na:Ma)+c)}this.$modelValue=this.$viewValue=Number.NaN;
this.$parsers=[];this.$formatters=[];this.$viewChangeListeners=[];this.$pristine=!0;this.$dirty=!1;this.$valid=!0;this.$invalid=!1;this.$name=d.name;var f=g(d.ngModel),h=f.assign;if(!h)throw B(Db+d.ngModel+" ("+pa(e)+")");this.$render=D;var k=e.inheritedData("$formController")||Oa,j=0,l=this.$error={};e.addClass(Pa);i(!0);this.$setValidity=function(a,c){if(l[a]!==!c){if(c){if(l[a]&&j--,!j)i(!0),this.$valid=!0,this.$invalid=!1}else i(!1),this.$invalid=!0,this.$valid=!1,j++;l[a]=!c;i(c,a);k.$setValidity(a,
c,this)}};this.$setViewValue=function(d){this.$viewValue=d;if(this.$pristine)this.$dirty=!0,this.$pristine=!1,e.removeClass(Pa).addClass(Xb),k.$setDirty();m(this.$parsers,function(a){d=a(d)});if(this.$modelValue!==d)this.$modelValue=d,h(a,d),m(this.$viewChangeListeners,function(a){try{a()}catch(d){c(d)}})};var o=this;a.$watch(function(){var c=f(a);if(o.$modelValue!==c){var d=o.$formatters,e=d.length;for(o.$modelValue=c;e--;)c=d[e](c);if(o.$viewValue!==c)o.$viewValue=c,o.$render()}})}],qd=function(){return{require:["ngModel",
"^?form"],controller:pd,link:function(a,c,d,e){var g=e[0],i=e[1]||Oa;i.$addControl(g);c.bind("$destroy",function(){i.$removeControl(g)})}}},rd=I({require:"ngModel",link:function(a,c,d,e){e.$viewChangeListeners.push(function(){a.$eval(d.ngChange)})}}),cc=function(){return{require:"?ngModel",link:function(a,c,d,e){if(e){d.required=!0;var g=function(a){if(d.required&&(T(a)||a===!1))e.$setValidity("required",!1);else return e.$setValidity("required",!0),a};e.$formatters.push(g);e.$parsers.unshift(g);
d.$observe("required",function(){g(e.$viewValue)})}}}},sd=function(){return{require:"ngModel",link:function(a,c,d,e){var g=(a=/\/(.*)\//.exec(d.ngList))&&RegExp(a[1])||d.ngList||",";e.$parsers.push(function(a){var c=[];a&&m(a.split(g),function(a){a&&c.push(R(a))});return c});e.$formatters.push(function(a){return J(a)?a.join(", "):p})}}},td=/^(true|false|\d+)$/,ud=function(){return{priority:100,compile:function(a,c){return td.test(c.ngValue)?function(a,c,g){g.$set("value",a.$eval(g.ngValue))}:function(a,
c,g){a.$watch(g.ngValue,function(a){g.$set("value",a,!1)})}}}},vd=S(function(a,c,d){c.addClass("ng-binding").data("$binding",d.ngBind);a.$watch(d.ngBind,function(a){c.text(a==p?"":a)})}),wd=["$interpolate",function(a){return function(c,d,e){c=a(d.attr(e.$attr.ngBindTemplate));d.addClass("ng-binding").data("$binding",c);e.$observe("ngBindTemplate",function(a){d.text(a)})}}],xd=[function(){return function(a,c,d){c.addClass("ng-binding").data("$binding",d.ngBindHtmlUnsafe);a.$watch(d.ngBindHtmlUnsafe,
function(a){c.html(a||"")})}}],yd=jb("",!0),zd=jb("Odd",0),Ad=jb("Even",1),Bd=S({compile:function(a,c){c.$set("ngCloak",p);a.removeClass("ng-cloak")}}),Cd=[function(){return{scope:!0,controller:"@"}}],Dd=["$sniffer",function(a){return{priority:1E3,compile:function(){a.csp=!0}}}],dc={};m("click dblclick mousedown mouseup mouseover mouseout mousemove mouseenter mouseleave".split(" "),function(a){var c=fa("ng-"+a);dc[c]=["$parse",function(d){return function(e,g,i){var f=d(i[c]);g.bind(E(a),function(a){e.$apply(function(){f(e,
{$event:a})})})}}]});var Ed=S(function(a,c,d){c.bind("submit",function(){a.$apply(d.ngSubmit)})}),Fd=["$http","$templateCache","$anchorScroll","$compile",function(a,c,d,e){return{restrict:"ECA",terminal:!0,compile:function(g,i){var f=i.ngInclude||i.src,h=i.onload||"",k=i.autoscroll;return function(g,i){var o=0,m,n=function(){m&&(m.$destroy(),m=null);i.html("")};g.$watch(f,function(f){var p=++o;f?a.get(f,{cache:c}).success(function(a){p===o&&(m&&m.$destroy(),m=g.$new(),i.html(a),e(i.contents())(m),
v(k)&&(!k||g.$eval(k))&&d(),m.$emit("$includeContentLoaded"),g.$eval(h))}).error(function(){p===o&&n()}):n()})}}}}],Gd=S({compile:function(){return{pre:function(a,c,d){a.$eval(d.ngInit)}}}}),Hd=S({terminal:!0,priority:1E3}),Id=["$locale","$interpolate",function(a,c){var d=/{}/g;return{restrict:"EA",link:function(e,g,i){var f=i.count,h=g.attr(i.$attr.when),k=i.offset||0,j=e.$eval(h),l={},o=c.startSymbol(),r=c.endSymbol();m(j,function(a,e){l[e]=c(a.replace(d,o+f+"-"+k+r))});e.$watch(function(){var c=
parseFloat(e.$eval(f));return isNaN(c)?"":(j[c]||(c=a.pluralCat(c-k)),l[c](e,g,!0))},function(a){g.text(a)})}}}],Jd=S({transclude:"element",priority:1E3,terminal:!0,compile:function(a,c,d){return function(a,c,i){var f=i.ngRepeat,i=f.match(/^\s*(.+)\s+in\s+(.*)\s*$/),h,k,j;if(!i)throw B("Expected ngRepeat in form of '_item_ in _collection_' but got '"+f+"'.");f=i[1];h=i[2];i=f.match(/^(?:([\$\w]+)|\(([\$\w]+)\s*,\s*([\$\w]+)\))$/);if(!i)throw B("'item' in 'item in collection' should be identifier or (key, value) but got '"+
f+"'.");k=i[3]||i[1];j=i[2];var l=new eb;a.$watch(function(a){var e,f,i=a.$eval(h),m=gc(i,!0),p,u=new eb,C,A,v,t,y=c;if(J(i))v=i||[];else{v=[];for(C in i)i.hasOwnProperty(C)&&C.charAt(0)!="$"&&v.push(C);v.sort()}e=0;for(f=v.length;e<f;e++){C=i===v?e:v[e];A=i[C];if(t=l.shift(A)){p=t.scope;u.push(A,t);if(e!==t.index)t.index=e,y.after(t.element);y=t.element}else p=a.$new();p[k]=A;j&&(p[j]=C);p.$index=e;p.$first=e===0;p.$last=e===m-1;p.$middle=!(p.$first||p.$last);t||d(p,function(a){y.after(a);t={scope:p,
element:y=a,index:e};u.push(A,t)})}for(C in l)if(l.hasOwnProperty(C))for(v=l[C];v.length;)A=v.pop(),A.element.remove(),A.scope.$destroy();l=u})}}}),Kd=S(function(a,c,d){a.$watch(d.ngShow,function(a){c.css("display",Wa(a)?"":"none")})}),Ld=S(function(a,c,d){a.$watch(d.ngHide,function(a){c.css("display",Wa(a)?"none":"")})}),Md=S(function(a,c,d){a.$watch(d.ngStyle,function(a,d){d&&a!==d&&m(d,function(a,d){c.css(d,"")});a&&c.css(a)},!0)}),Nd=I({restrict:"EA",compile:function(a,c){var d=c.ngSwitch||c.on,
e={};a.data("ng-switch",e);return function(a,i){var f,h,k;a.$watch(d,function(d){h&&(k.$destroy(),h.remove(),h=k=null);if(f=e["!"+d]||e["?"])a.$eval(c.change),k=a.$new(),f(k,function(a){h=a;i.append(a)})})}}}),Od=S({transclude:"element",priority:500,compile:function(a,c,d){a=a.inheritedData("ng-switch");qa(a);a["!"+c.ngSwitchWhen]=d}}),Pd=S({transclude:"element",priority:500,compile:function(a,c,d){a=a.inheritedData("ng-switch");qa(a);a["?"]=d}}),Qd=S({controller:["$transclude","$element",function(a,
c){a(function(a){c.append(a)})}]}),Rd=["$http","$templateCache","$route","$anchorScroll","$compile","$controller",function(a,c,d,e,g,i){return{restrict:"ECA",terminal:!0,link:function(a,c,k){function j(){var j=d.current&&d.current.locals,k=j&&j.$template;if(k){c.html(k);l&&(l.$destroy(),l=null);var k=g(c.contents()),p=d.current;l=p.scope=a.$new();if(p.controller)j.$scope=l,j=i(p.controller,j),c.contents().data("$ngControllerController",j);k(l);l.$emit("$viewContentLoaded");l.$eval(m);e()}else c.html(""),
l&&(l.$destroy(),l=null)}var l,m=k.onload||"";a.$on("$routeChangeSuccess",j);j()}}}],Sd=["$templateCache",function(a){return{restrict:"E",terminal:!0,compile:function(c,d){d.type=="text/ng-template"&&a.put(d.id,c[0].text)}}}],Td=I({terminal:!0}),Ud=["$compile","$parse",function(a,c){var d=/^\s*(.*?)(?:\s+as\s+(.*?))?(?:\s+group\s+by\s+(.*))?\s+for\s+(?:([\$\w][\$\w\d]*)|(?:\(\s*([\$\w][\$\w\d]*)\s*,\s*([\$\w][\$\w\d]*)\s*\)))\s+in\s+(.*)$/,e={$setViewValue:D};return{restrict:"E",require:["select",
"?ngModel"],controller:["$element","$scope","$attrs",function(a,c,d){var h=this,k={},j=e,l;h.databound=d.ngModel;h.init=function(a,c,d){j=a;l=d};h.addOption=function(c){k[c]=!0;j.$viewValue==c&&(a.val(c),l.parent()&&l.remove())};h.removeOption=function(a){this.hasOption(a)&&(delete k[a],j.$viewValue==a&&this.renderUnknownOption(a))};h.renderUnknownOption=function(c){c="? "+ga(c)+" ?";l.val(c);a.prepend(l);a.val(c);l.prop("selected",!0)};h.hasOption=function(a){return k.hasOwnProperty(a)};c.$on("$destroy",
function(){h.renderUnknownOption=D})}],link:function(e,i,f,h){function k(a,c,d,e){d.$render=function(){var a=d.$viewValue;e.hasOption(a)?(A.parent()&&A.remove(),c.val(a),a===""&&s.prop("selected",!0)):t(a)&&s?c.val(""):e.renderUnknownOption(a)};c.bind("change",function(){a.$apply(function(){A.parent()&&A.remove();d.$setViewValue(c.val())})})}function j(a,c,d){var e;d.$render=function(){var a=new Fa(d.$viewValue);m(c.children(),function(c){c.selected=v(a.get(c.value))})};a.$watch(function(){ha(e,d.$viewValue)||
(e=V(d.$viewValue),d.$render())});c.bind("change",function(){a.$apply(function(){var a=[];m(c.children(),function(c){c.selected&&a.push(c.value)});d.$setViewValue(a)})})}function l(e,f,g){function h(){var a={"":[]},c=[""],d,i,s,t,u;s=g.$modelValue;t=r(e)||[];var y=l?lb(t):t,A,w,x;w={};u=!1;var z,B;if(n)u=new Fa(s);else if(s===null||q)a[""].push({selected:s===null,id:"",label:""}),u=!0;for(x=0;A=y.length,x<A;x++){w[k]=t[l?w[l]=y[x]:x];d=m(e,w)||"";if(!(i=a[d]))i=a[d]=[],c.push(d);n?d=u.remove(o(e,
w))!=p:(d=s===o(e,w),u=u||d);z=j(e,w);z=z===p?"":z;i.push({id:l?y[x]:x,label:z,selected:d})}!n&&!u&&a[""].unshift({id:"?",label:"",selected:!0});w=0;for(y=c.length;w<y;w++){d=c[w];i=a[d];if(v.length<=w)s={element:C.clone().attr("label",d),label:i.label},t=[s],v.push(t),f.append(s.element);else if(t=v[w],s=t[0],s.label!=d)s.element.attr("label",s.label=d);z=null;x=0;for(A=i.length;x<A;x++)if(d=i[x],u=t[x+1]){z=u.element;if(u.label!==d.label)z.text(u.label=d.label);if(u.id!==d.id)z.val(u.id=d.id);if(u.element.selected!==
d.selected)z.prop("selected",u.selected=d.selected)}else d.id===""&&q?B=q:(B=D.clone()).val(d.id).attr("selected",d.selected).text(d.label),t.push({element:B,label:d.label,id:d.id,selected:d.selected}),z?z.after(B):s.element.append(B),z=B;for(x++;t.length>x;)t.pop().element.remove()}for(;v.length>w;)v.pop()[0].element.remove()}var i;if(!(i=w.match(d)))throw B("Expected ngOptions in form of '_select_ (as _label_)? for (_key_,)?_value_ in _collection_' but got '"+w+"'.");var j=c(i[2]||i[1]),k=i[4]||
i[6],l=i[5],m=c(i[3]||""),o=c(i[2]?i[1]:k),r=c(i[7]),v=[[{element:f,label:""}]];q&&(a(q)(e),q.removeClass("ng-scope"),q.remove());f.html("");f.bind("change",function(){e.$apply(function(){var a,c=r(e)||[],d={},h,i,j,m,q,s;if(n){i=[];m=0;for(s=v.length;m<s;m++){a=v[m];j=1;for(q=a.length;j<q;j++)if((h=a[j].element)[0].selected)h=h.val(),l&&(d[l]=h),d[k]=c[h],i.push(o(e,d))}}else h=f.val(),h=="?"?i=p:h==""?i=null:(d[k]=c[h],l&&(d[l]=h),i=o(e,d));g.$setViewValue(i)})});g.$render=h;e.$watch(h)}if(h[1]){for(var o=
h[0],r=h[1],n=f.multiple,w=f.ngOptions,q=!1,s,D=u(ca.createElement("option")),C=u(ca.createElement("optgroup")),A=D.clone(),h=0,x=i.children(),E=x.length;h<E;h++)if(x[h].value==""){s=q=x.eq(h);break}o.init(r,q,A);if(n&&(f.required||f.ngRequired)){var y=function(a){r.$setValidity("required",!f.required||a&&a.length);return a};r.$parsers.push(y);r.$formatters.unshift(y);f.$observe("required",function(){y(r.$viewValue)})}w?l(e,i,r):n?j(e,i,r):k(e,i,r,o)}}}}],Vd=["$interpolate",function(a){var c={addOption:D,
removeOption:D};return{restrict:"E",priority:100,compile:function(d,e){if(t(e.value)){var g=a(d.text(),!0);g||e.$set("value",d.text())}return function(a,d,e){var k=d.parent(),j=k.data("$selectController")||k.parent().data("$selectController");j&&j.databound?d.prop("selected",!1):j=c;g?a.$watch(g,function(a,c){e.$set("value",a);a!==c&&j.removeOption(c);j.addOption(a)}):j.addOption(e.value);d.bind("$destroy",function(){j.removeOption(e.value)})}}}}],Wd=I({restrict:"E",terminal:!0});(ja=U.jQuery)?(u=
ja,x(ja.fn,{scope:ua.scope,controller:ua.controller,injector:ua.injector,inheritedData:ua.inheritedData}),ab("remove",!0),ab("empty"),ab("html")):u=Q;Yb.element=u;(function(a){x(a,{bootstrap:pb,copy:V,extend:x,equals:ha,element:u,forEach:m,injector:qb,noop:D,bind:Va,toJson:da,fromJson:nb,identity:ma,isUndefined:t,isDefined:v,isString:F,isFunction:N,isObject:L,isNumber:wa,isElement:fc,isArray:J,version:id,isDate:na,lowercase:E,uppercase:la,callbacks:{counter:0}});ta=lc(U);try{ta("ngLocale")}catch(c){ta("ngLocale",
[]).provider("$locale",Zc)}ta("ng",["ngLocale"],["$provide",function(a){a.provider("$compile",Bb).directive({a:jd,input:bc,textarea:bc,form:kd,script:Sd,select:Ud,style:Wd,option:Vd,ngBind:vd,ngBindHtmlUnsafe:xd,ngBindTemplate:wd,ngClass:yd,ngClassEven:Ad,ngClassOdd:zd,ngCsp:Dd,ngCloak:Bd,ngController:Cd,ngForm:ld,ngHide:Ld,ngInclude:Fd,ngInit:Gd,ngNonBindable:Hd,ngPluralize:Id,ngRepeat:Jd,ngShow:Kd,ngSubmit:Ed,ngStyle:Md,ngSwitch:Nd,ngSwitchWhen:Od,ngSwitchDefault:Pd,ngOptions:Td,ngView:Rd,ngTransclude:Qd,
ngModel:qd,ngList:sd,ngChange:rd,required:cc,ngRequired:cc,ngValue:ud}).directive(kb).directive(dc);a.provider({$anchorScroll:uc,$browser:wc,$cacheFactory:xc,$controller:Bc,$document:Cc,$exceptionHandler:Dc,$filter:Pb,$interpolate:Ec,$http:Vc,$httpBackend:Wc,$location:Ic,$log:Jc,$parse:Nc,$route:Qc,$routeParams:Rc,$rootScope:Sc,$q:Oc,$sniffer:Tc,$templateCache:yc,$timeout:$c,$window:Uc})}])})(Yb);u(ca).ready(function(){jc(ca,pb)})})(window,document);angular.element(document).find("head").append('<style type="text/css">@charset "UTF-8";[ng\\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak{display:none;}ng\\:form{display:block;}</style>');
/**
 * AngularUI - The companion suite for AngularJS
 * @version v0.4.0 - 2013-02-15
 * @link http://angular-ui.github.com
 * @license MIT License, http://www.opensource.org/licenses/MIT
 */
(function(e){var t=window.ieShivDebug||!1,n=["ngInclude","ngPluralize","ngView","ngSwitch","uiCurrency","uiCodemirror","uiDate","uiEvent","uiKeypress","uiKeyup","uiKeydown","uiMask","uiMapInfoWindow","uiMapMarker","uiMapPolyline","uiMapPolygon","uiMapRectangle","uiMapCircle","uiMapGroundOverlay","uiModal","uiReset","uiScrollfix","uiSelect2","uiShow","uiHide","uiToggle","uiSortable","uiTinymce"];window.myCustomTags=window.myCustomTags||[],n.push.apply(n,window.myCustomTags);var r=function(e){var t=[],n=e.replace(/([A-Z])/g,function(e){return" "+e.toLowerCase()}),r=n.split(" "),i=r[0],s=r.slice(1).join("-");return t.push(i+":"+s),t.push(i+"-"+s),t.push("x-"+i+"-"+s),t.push("data-"+i+"-"+s),t};for(var i=0,s=n.length;i<s;i++){var o=r(n[i]);for(var u=0,a=o.length;u<a;u++){var f=o[u];document.createElement(f)}}})(window);/**
 * AngularUI - The companion suite for AngularJS
 * @version v0.4.0 - 2013-02-15
 * @link http://angular-ui.github.com
 * @license MIT License, http://www.opensource.org/licenses/MIT
 */
angular.module("ui.config",[]).value("ui.config",{}),angular.module("ui.filters",["ui.config"]),angular.module("ui.directives",["ui.config"]),angular.module("ui",["ui.filters","ui.directives","ui.config"]),angular.module("ui.directives").directive("uiAnimate",["ui.config","$timeout",function(e,t){var n={};return angular.isString(e.animate)?n["class"]=e.animate:e.animate&&(n=e.animate),{restrict:"A",link:function(e,r,i){var s={};i.uiAnimate&&(s=e.$eval(i.uiAnimate),angular.isString(s)&&(s={"class":s})),s=angular.extend({"class":"ui-animate"},n,s),r.addClass(s["class"]),t(function(){r.removeClass(s["class"])},20,!1)}}}]),angular.module("ui.directives").directive("uiCalendar",["ui.config","$parse",function(e,t){return e.uiCalendar=e.uiCalendar||{},{require:"ngModel",restrict:"A",link:function(t,n,r,i){function a(){t.calendar=n.html("");var i=t.calendar.fullCalendar("getView");i&&(i=i.name);var o,u={defaultView:i,eventSources:s};r.uiCalendar?o=t.$eval(r.uiCalendar):o={},angular.extend(u,e.uiCalendar,o),t.calendar.fullCalendar(u)}var s=t.$eval(r.ngModel),o=0,u=function(){var e=t.$eval(r.equalsTracker);return o=0,angular.forEach(s,function(e,t){angular.isArray(e)&&(o+=e.length)}),angular.isNumber(e)?o+s.length+e:o+s.length};a(),t.$watch(u,function(e,t){a()})}}}]),angular.module("ui.directives").directive("uiCodemirror",["ui.config","$timeout",function(e,t){"use strict";var n=["cursorActivity","viewportChange","gutterClick","focus","blur","scroll","update"];return{restrict:"A",require:"ngModel",link:function(r,i,s,o){var u,a,f,l,c;if(i[0].type!=="textarea")throw new Error("uiCodemirror3 can only be applied to a textarea element");u=e.codemirror||{},a=angular.extend({},u,r.$eval(s.uiCodemirror)),f=function(e){return function(t,n){var i=t.getValue();i!==o.$viewValue&&(o.$setViewValue(i),r.$apply()),typeof e=="function"&&e(t,n)}},l=function(){c=CodeMirror.fromTextArea(i[0],a),c.on("change",f(a.onChange));for(var e=0,u=n.length,l;e<u;++e){l=a["on"+n[e].charAt(0).toUpperCase()+n[e].slice(1)];if(l===void 0)continue;if(typeof l!="function")continue;c.on(n[e],l)}o.$formatters.push(function(e){if(angular.isUndefined(e)||e===null)return"";if(angular.isObject(e)||angular.isArray(e))throw new Error("ui-codemirror cannot use an object or an array as a model");return e}),o.$render=function(){c.setValue(o.$viewValue)},s.uiRefresh&&r.$watch(s.uiRefresh,function(e,n){e!==n&&t(c.refresh)})},t(l)}}}]),angular.module("ui.directives").directive("uiCurrency",["ui.config","currencyFilter",function(e,t){var n={pos:"ui-currency-pos",neg:"ui-currency-neg",zero:"ui-currency-zero"};return e.currency&&angular.extend(n,e.currency),{restrict:"EAC",require:"ngModel",link:function(e,r,i,s){var o,u,a;o=angular.extend({},n,e.$eval(i.uiCurrency)),u=function(e){var n;return n=e*1,r.toggleClass(o.pos,n>0),r.toggleClass(o.neg,n<0),r.toggleClass(o.zero,n===0),e===""?r.text(""):r.text(t(n,o.symbol)),!0},s.$render=function(){a=s.$viewValue,r.val(a),u(a)}}}}]),angular.module("ui.directives").directive("uiDate",["ui.config",function(e){"use strict";var t;return t={},angular.isObject(e.date)&&angular.extend(t,e.date),{require:"?ngModel",link:function(t,n,r,i){var s=function(){return angular.extend({},e.date,t.$eval(r.uiDate))},o=function(){var e=s();if(i){var r=function(){t.$apply(function(){var e=n.datepicker("getDate");n.datepicker("setDate",n.val()),i.$setViewValue(e),n.blur()})};if(e.onSelect){var o=e.onSelect;e.onSelect=function(e,n){r(),t.$apply(function(){o(e,n)})}}else e.onSelect=r;n.bind("change",r),i.$render=function(){var e=i.$viewValue;if(angular.isDefined(e)&&e!==null&&!angular.isDate(e))throw new Error("ng-Model value must be a Date object - currently it is a "+typeof e+" - use ui-date-format to convert it from a string");n.datepicker("setDate",e)}}n.datepicker("destroy"),n.datepicker(e),i&&i.$render()};t.$watch(s,o,!0)}}}]).directive("uiDateFormat",["ui.config",function(e){var t={require:"ngModel",link:function(t,n,r,i){var s=r.uiDateFormat||e.dateFormat;s?(i.$formatters.push(function(e){if(angular.isString(e))return $.datepicker.parseDate(s,e)}),i.$parsers.push(function(e){if(e)return $.datepicker.formatDate(s,e)})):(i.$formatters.push(function(e){if(angular.isString(e))return new Date(e)}),i.$parsers.push(function(e){if(e)return e.toISOString()}))}};return t}]),angular.module("ui.directives").directive("uiEvent",["$parse",function(e){return function(t,n,r){var i=t.$eval(r.uiEvent);angular.forEach(i,function(r,i){var s=e(r);n.bind(i,function(e){var n=Array.prototype.slice.call(arguments);n=n.splice(1),t.$apply(function(){s(t,{$event:e,$params:n})})})})}}]),angular.module("ui.directives").directive("uiIf",[function(){return{transclude:"element",priority:1e3,terminal:!0,restrict:"A",compile:function(e,t,n){return function(e,t,r){var i,s;e.$watch(r.uiIf,function(r){i&&(i.remove(),i=undefined),s&&(s.$destroy(),s=undefined),r&&(s=e.$new(),n(s,function(e){i=e,t.after(e)}))})}}}}]),angular.module("ui.directives").directive("uiJq",["ui.config","$timeout",function(t,n){return{restrict:"A",compile:function(r,i){if(!angular.isFunction(r[i.uiJq]))throw new Error('ui-jq: The "'+i.uiJq+'" function does not exist');var s=t.jq&&t.jq[i.uiJq];return function(t,r,i){function u(){n(function(){r[i.uiJq].apply(r,o)},0,!1)}var o=[];i.uiOptions?(o=t.$eval("["+i.uiOptions+"]"),angular.isObject(s)&&angular.isObject(o[0])&&(o[0]=angular.extend({},s,o[0]))):s&&(o=[s]),i.ngModel&&r.is("select,input,textarea")&&r.on("change",function(){r.trigger("input")}),i.uiRefresh&&t.$watch(i.uiRefresh,function(e){u()}),u()}}}}]),angular.module("ui.directives").factory("keypressHelper",["$parse",function(t){var n={8:"backspace",9:"tab",13:"enter",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"insert",46:"delete"},r=function(e){return e.charAt(0).toUpperCase()+e.slice(1)};return function(e,i,s,o){var u,a=[];u=i.$eval(o["ui"+r(e)]),angular.forEach(u,function(e,n){var r,i;i=t(e),angular.forEach(n.split(" "),function(e){r={expression:i,keys:{}},angular.forEach(e.split("-"),function(e){r.keys[e]=!0}),a.push(r)})}),s.bind(e,function(t){var r=t.metaKey||t.altKey,s=t.ctrlKey,o=t.shiftKey,u=t.keyCode;e==="keypress"&&!o&&u>=97&&u<=122&&(u-=32),angular.forEach(a,function(e){var u=e.keys[n[t.keyCode]]||e.keys[t.keyCode.toString()]||!1,a=e.keys.alt||!1,f=e.keys.ctrl||!1,l=e.keys.shift||!1;u&&a==r&&f==s&&l==o&&i.$apply(function(){e.expression(i,{$event:t})})})})}}]),angular.module("ui.directives").directive("uiKeydown",["keypressHelper",function(e){return{link:function(t,n,r){e("keydown",t,n,r)}}}]),angular.module("ui.directives").directive("uiKeypress",["keypressHelper",function(e){return{link:function(t,n,r){e("keypress",t,n,r)}}}]),angular.module("ui.directives").directive("uiKeyup",["keypressHelper",function(e){return{link:function(t,n,r){e("keyup",t,n,r)}}}]),function(){function t(e,t,n,r){angular.forEach(t.split(" "),function(t){var i={type:"map-"+t};google.maps.event.addListener(n,t,function(t){r.triggerHandler(angular.extend({},i,t)),e.$$phase||e.$apply()})})}function n(n,r){e.directive(n,[function(){return{restrict:"A",link:function(e,i,s){e.$watch(s[n],function(n){t(e,r,n,i)})}}}])}var e=angular.module("ui.directives");e.directive("uiMap",["ui.config","$parse",function(e,n){var r="bounds_changed center_changed click dblclick drag dragend dragstart heading_changed idle maptypeid_changed mousemove mouseout mouseover projection_changed resize rightclick tilesloaded tilt_changed zoom_changed",i=e.map||{};return{restrict:"A",link:function(e,s,o){var u=angular.extend({},i,e.$eval(o.uiOptions)),a=new google.maps.Map(s[0],u),f=n(o.uiMap);f.assign(e,a),t(e,r,a,s)}}}]),e.directive("uiMapInfoWindow",["ui.config","$parse","$compile",function(e,n,r){var i="closeclick content_change domready position_changed zindex_changed",s=e.mapInfoWindow||{};return{link:function(e,o,u){var a=angular.extend({},s,e.$eval(u.uiOptions));a.content=o[0];var f=n(u.uiMapInfoWindow),l=f(e);l||(l=new google.maps.InfoWindow(a),f.assign(e,l)),t(e,i,l,o),o.replaceWith("<div></div>");var c=l.open;l.open=function(n,i,s,u,a,f){r(o.contents())(e),c.call(l,n,i,s,u,a,f)}}}}]),n("uiMapMarker","animation_changed click clickable_changed cursor_changed dblclick drag dragend draggable_changed dragstart flat_changed icon_changed mousedown mouseout mouseover mouseup position_changed rightclick shadow_changed shape_changed title_changed visible_changed zindex_changed"),n("uiMapPolyline","click dblclick mousedown mousemove mouseout mouseover mouseup rightclick"),n("uiMapPolygon","click dblclick mousedown mousemove mouseout mouseover mouseup rightclick"),n("uiMapRectangle","bounds_changed click dblclick mousedown mousemove mouseout mouseover mouseup rightclick"),n("uiMapCircle","center_changed click dblclick mousedown mousemove mouseout mouseover mouseup radius_changed rightclick"),n("uiMapGroundOverlay","click dblclick")}(),angular.module("ui.directives").directive("uiMask",[function(){return{require:"ngModel",link:function(e,t,n,r){r.$render=function(){var i=r.$viewValue||"";t.val(i),t.mask(e.$eval(n.uiMask))},r.$parsers.push(function(e){var n=t.isMaskValid()||angular.isUndefined(t.isMaskValid())&&t.val().length>0;return r.$setValidity("mask",n),n?e:undefined}),t.bind("keyup",function(){e.$apply(function(){r.$setViewValue(t.mask())})})}}}]),angular.module("ui.directives").directive("uiReset",["ui.config",function(e){var t=null;return e.reset!==undefined&&(t=e.reset),{require:"ngModel",link:function(e,n,r,i){var s;s=angular.element('<a class="ui-reset" />'),n.wrap('<span class="ui-resetwrap" />').after(s),s.bind("click",function(n){n.preventDefault(),e.$apply(function(){r.uiReset?i.$setViewValue(e.$eval(r.uiReset)):i.$setViewValue(t),i.$render()})})}}}]),angular.module("ui.directives").directive("uiRoute",["$location","$parse",function(e,t){return{restrict:"AC",compile:function(n,r){var i;if(r.uiRoute)i="uiRoute";else if(r.ngHref)i="ngHref";else{if(!r.href)throw new Error("uiRoute missing a route or href property on "+n[0]);i="href"}return function(n,r,s){function a(t){(hash=t.indexOf("#"))>-1&&(t=t.substr(hash+1)),u=function(){o(n,e.path().indexOf(t)>-1)},u()}function f(t){(hash=t.indexOf("#"))>-1&&(t=t.substr(hash+1)),u=function(){var i=new RegExp("^"+t+"$",["i"]);o(n,i.test(e.path()))},u()}var o=t(s.ngModel||s.routeModel||"$uiRoute").assign,u=angular.noop;switch(i){case"uiRoute":s.uiRoute?f(s.uiRoute):s.$observe("uiRoute",f);break;case"ngHref":s.ngHref?a(s.ngHref):s.$observe("ngHref",a);break;case"href":a(s.href)}n.$on("$routeChangeSuccess",function(){u()})}}}}]),angular.module("ui.directives").directive("uiScrollfix",["$window",function(e){"use strict";return{link:function(t,n,r){var i=n.offset().top;r.uiScrollfix?r.uiScrollfix.charAt(0)==="-"?r.uiScrollfix=i-r.uiScrollfix.substr(1):r.uiScrollfix.charAt(0)==="+"&&(r.uiScrollfix=i+parseFloat(r.uiScrollfix.substr(1))):r.uiScrollfix=i,angular.element(e).on("scroll.ui-scrollfix",function(){var t;if(angular.isDefined(e.pageYOffset))t=e.pageYOffset;else{var i=document.compatMode&&document.compatMode!=="BackCompat"?document.documentElement:document.body;t=i.scrollTop}!n.hasClass("ui-scrollfix")&&t>r.uiScrollfix?n.addClass("ui-scrollfix"):n.hasClass("ui-scrollfix")&&t<r.uiScrollfix&&n.removeClass("ui-scrollfix")})}}}]),angular.module("ui.directives").directive("uiSelect2",["ui.config","$timeout",function(e,t){var n={};return e.select2&&angular.extend(n,e.select2),{require:"?ngModel",compile:function(e,r){var i,s,o,u=e.is("select"),a=r.multiple!==undefined;return e.is("select")&&(s=e.find("option[ng-repeat], option[data-ng-repeat]"),s.length&&(o=s.attr("ng-repeat")||s.attr("data-ng-repeat"),i=jQuery.trim(o.split("|")[0]).split(" ").pop())),function(e,r,s,o){var f=angular.extend({},n,e.$eval(s.uiSelect2));u?(delete f.multiple,delete f.initSelection):a&&(f.multiple=!0);if(o){o.$render=function(){u?r.select2("val",o.$modelValue):a?o.$modelValue?angular.isArray(o.$modelValue)?r.select2("data",o.$modelValue):r.select2("val",o.$modelValue):r.select2("data",[]):angular.isObject(o.$modelValue)?r.select2("data",o.$modelValue):r.select2("val",o.$modelValue)},i&&e.$watch(i,function(e,n,i){if(!e)return;t(function(){r.select2("val",o.$viewValue),r.trigger("change")})});if(!u){r.bind("change",function(){e.$apply(function(){o.$setViewValue(r.select2("data"))})});if(f.initSelection){var l=f.initSelection;f.initSelection=function(e,t){l(e,function(e){o.$setViewValue(e),t(e)})}}}}s.$observe("disabled",function(e){r.select2(e&&"disable"||"enable")}),s.ngMultiple&&e.$watch(s.ngMultiple,function(e){r.select2(f)}),r.val(e.$eval(s.ngModel)),t(function(){r.select2(f),!f.initSelection&&!u&&o.$setViewValue(r.select2("data"))})}}}}]),angular.module("ui.directives").directive("uiShow",[function(){return function(e,t,n){e.$watch(n.uiShow,function(e,n){e?t.addClass("ui-show"):t.removeClass("ui-show")})}}]).directive("uiHide",[function(){return function(e,t,n){e.$watch(n.uiHide,function(e,n){e?t.addClass("ui-hide"):t.removeClass("ui-hide")})}}]).directive("uiToggle",[function(){return function(e,t,n){e.$watch(n.uiToggle,function(e,n){e?t.removeClass("ui-hide").addClass("ui-show"):t.removeClass("ui-show").addClass("ui-hide")})}}]),angular.module("ui.directives").directive("uiSortable",["ui.config",function(e){return{require:"?ngModel",link:function(t,n,r,i){var s,o,u,a,f,l,c,h,p;f=angular.extend({},e.sortable,t.$eval(r.uiSortable)),i&&(i.$render=function(){n.sortable("refresh")},u=function(e,t){t.item.sortable={index:t.item.index()}},a=function(e,t){t.item.sortable.resort=i},s=function(e,t){t.item.sortable.relocate=!0,i.$modelValue.splice(t.item.index(),0,t.item.sortable.moved)},o=function(e,t){i.$modelValue.length===1?t.item.sortable.moved=i.$modelValue.splice(0,1)[0]:t.item.sortable.moved=i.$modelValue.splice(t.item.sortable.index,1)[0]},onStop=function(e,n){if(n.item.sortable.resort&&!n.item.sortable.relocate){var r,i;i=n.item.sortable.index,r=n.item.index(),i<r&&r--,n.item.sortable.resort.$modelValue.splice(r,0,n.item.sortable.resort.$modelValue.splice(i,1)[0])}(n.item.sortable.resort||n.item.sortable.relocate)&&t.$apply()},h=f.start,f.start=function(e,t){u(e,t),typeof h=="function"&&h(e,t)},_stop=f.stop,f.stop=function(e,t){onStop(e,t),typeof _stop=="function"&&_stop(e,t)},p=f.update,f.update=function(e,t){a(e,t),typeof p=="function"&&p(e,t)},l=f.receive,f.receive=function(e,t){s(e,t),typeof l=="function"&&l(e,t)},c=f.remove,f.remove=function(e,t){o(e,t),typeof c=="function"&&c(e,t)}),n.sortable(f)}}}]),angular.module("ui.directives").directive("uiTinymce",["ui.config",function(e){return e.tinymce=e.tinymce||{},{require:"ngModel",link:function(t,n,r,i){var s,o={onchange_callback:function(e){e.isDirty()&&(e.save(),i.$setViewValue(n.val()),t.$$phase||t.$apply())},handle_event_callback:function(e){return this.isDirty()&&(this.save(),i.$setViewValue(n.val()),t.$$phase||t.$apply()),!0},setup:function(e){e.onSetContent.add(function(e,r){e.isDirty()&&(e.save(),i.$setViewValue(n.val()),t.$$phase||t.$apply())})}};r.uiTinymce?s=t.$eval(r.uiTinymce):s={},angular.extend(o,e.tinymce,s),setTimeout(function(){n.tinymce(o)})}}}]),angular.module("ui.directives").directive("uiValidate",function(){return{restrict:"A",require:"ngModel",link:function(e,t,n,r){var i,s,o={},u=e.$eval(n.uiValidate);if(!u)return;angular.isString(u)&&(u={validator:u}),angular.forEach(u,function(t,n){i=function(i){return e.$eval(t,{$value:i})?(r.$setValidity(n,!0),i):(r.$setValidity(n,!1),undefined)},o[n]=i,r.$formatters.push(i),r.$parsers.push(i)}),n.uiValidateWatch&&(s=e.$eval(n.uiValidateWatch),angular.isString(s)?e.$watch(s,function(){angular.forEach(o,function(e,t){e(r.$modelValue)})}):angular.forEach(s,function(t,n){e.$watch(t,function(){o[n](r.$modelValue)})}))}}}),angular.module("ui.filters").filter("format",function(){return function(e,t){if(!e)return e;var n=e.toString(),r;return t===undefined?n:!angular.isArray(t)&&!angular.isObject(t)?n.split("$0").join(t):(r=angular.isArray(t)&&"$"||":",angular.forEach(t,function(e,t){n=n.split(r+t).join(e)}),n)}}),angular.module("ui.filters").filter("highlight",function(){return function(e,t,n){return t||angular.isNumber(t)?(e=e.toString(),t=t.toString(),n?e.split(t).join('<span class="ui-match">'+t+"</span>"):e.replace(new RegExp(t,"gi"),'<span class="ui-match">$&</span>')):e}}),angular.module("ui.filters").filter("inflector",function(){function e(e){return e.replace(/^([a-z])|\s+([a-z])/g,function(e){return e.toUpperCase()})}function t(e,t){return e.replace(/[A-Z]/g,function(e){return t+e})}var n={humanize:function(n){return e(t(n," ").split("_").join(" "))},underscore:function(e){return e.substr(0,1).toLowerCase()+t(e.substr(1),"_").toLowerCase().split(" ").join("_")},variable:function(t){return t=t.substr(0,1).toLowerCase()+e(t.split("_").join(" ")).substr(1).split(" ").join(""),t}};return function(e,t,r){return t!==!1&&angular.isString(e)?(t=t||"humanize",n[t](e)):e}}),angular.module("ui.filters").filter("unique",function(){return function(e,t){if(t===!1)return e;if((t||angular.isUndefined(t))&&angular.isArray(e)){var n={},r=[],i=function(e){return angular.isObject(e)&&angular.isString(t)?e[t]:e};angular.forEach(e,function(e){var t,n=!1;for(var s=0;s<r.length;s++)if(angular.equals(i(r[s]),i(e))){n=!0;break}n||r.push(e)}),e=r}return e}});angular.module("ui.bootstrap",["ui.bootstrap.tpls","ui.bootstrap.transition","ui.bootstrap.collapse","ui.bootstrap.accordion","ui.bootstrap.alert","ui.bootstrap.buttons","ui.bootstrap.carousel","ui.bootstrap.dialog","ui.bootstrap.dropdownToggle","ui.bootstrap.modal","ui.bootstrap.pagination","ui.bootstrap.position","ui.bootstrap.tooltip","ui.bootstrap.popover","ui.bootstrap.progressbar","ui.bootstrap.rating","ui.bootstrap.tabs","ui.bootstrap.typeahead"]),angular.module("ui.bootstrap.tpls",["template/accordion/accordion-group.html","template/accordion/accordion.html","template/alert/alert.html","template/carousel/carousel.html","template/carousel/slide.html","template/dialog/message.html","template/pagination/pagination.html","template/tooltip/tooltip-html-unsafe-popup.html","template/tooltip/tooltip-popup.html","template/popover/popover.html","template/progressbar/bar.html","template/progressbar/progress.html","template/rating/rating.html","template/tabs/pane.html","template/tabs/tabs.html","template/typeahead/typeahead.html"]),angular.module("ui.bootstrap.transition",[]).factory("$transition",["$q","$timeout","$rootScope",function(t,e,n){function o(t){for(var e in t)if(void 0!==i.style[e])return t[e]}var a=function(o,i,r){r=r||{};var l=t.defer(),s=a[r.animation?"animationEndEventName":"transitionEndEventName"],c=function(){n.$apply(function(){o.unbind(s,c),l.resolve(o)})};return s&&o.bind(s,c),e(function(){angular.isString(i)?o.addClass(i):angular.isFunction(i)?i(o):angular.isObject(i)&&o.css(i),s||l.resolve(o)}),l.promise.cancel=function(){s&&o.unbind(s,c),l.reject("Transition cancelled")},l.promise},i=document.createElement("trans"),r={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",transition:"transitionend"},l={WebkitTransition:"webkitAnimationEnd",MozTransition:"animationend",OTransition:"oAnimationEnd",transition:"animationend"};return a.transitionEndEventName=o(r),a.animationEndEventName=o(l),a}]),angular.module("ui.bootstrap.collapse",["ui.bootstrap.transition"]).directive("collapse",["$transition",function(t){var e=function(t,e,n){e.removeClass("collapse"),e.css({height:n}),e[0].offsetWidth,e.addClass("collapse")};return{link:function(n,o,a){var i,r=!0;n.$watch(function(){return o[0].scrollHeight},function(){0!==o[0].scrollHeight&&(i||(r?e(n,o,o[0].scrollHeight+"px"):e(n,o,"auto")))}),n.$watch(a.collapse,function(t){t?u():c()});var l,s=function(e){return l&&l.cancel(),l=t(o,e),l.then(function(){l=void 0},function(){l=void 0}),l},c=function(){r?(r=!1,i||e(n,o,"auto")):s({height:o[0].scrollHeight+"px"}).then(function(){i||e(n,o,"auto")}),i=!1},u=function(){i=!0,r?(r=!1,e(n,o,0)):(e(n,o,o[0].scrollHeight+"px"),s({height:"0"}))}}}}]),angular.module("ui.bootstrap.accordion",["ui.bootstrap.collapse"]).constant("accordionConfig",{closeOthers:!0}).controller("AccordionController",["$scope","$attrs","accordionConfig",function(t,e,n){this.groups=[],this.closeOthers=function(o){var a=angular.isDefined(e.closeOthers)?t.$eval(e.closeOthers):n.closeOthers;a&&angular.forEach(this.groups,function(t){t!==o&&(t.isOpen=!1)})},this.addGroup=function(t){var e=this;this.groups.push(t),t.$on("$destroy",function(){e.removeGroup(t)})},this.removeGroup=function(t){var e=this.groups.indexOf(t);-1!==e&&this.groups.splice(this.groups.indexOf(t),1)}}]).directive("accordion",function(){return{restrict:"EA",controller:"AccordionController",transclude:!0,replace:!1,templateUrl:"template/accordion/accordion.html"}}).directive("accordionGroup",["$parse","$transition","$timeout",function(t){return{require:"^accordion",restrict:"EA",transclude:!0,replace:!0,templateUrl:"template/accordion/accordion-group.html",scope:{heading:"@"},controller:["$scope",function(){this.setHeading=function(t){this.heading=t}}],link:function(e,n,o,a){var i,r;a.addGroup(e),e.isOpen=!1,o.isOpen&&(i=t(o.isOpen),r=i.assign,e.$watch(function(){return i(e.$parent)},function(t){e.isOpen=t}),e.isOpen=i?i(e.$parent):!1),e.$watch("isOpen",function(t){t&&a.closeOthers(e),r&&r(e.$parent,t)})}}}]).directive("accordionHeading",function(){return{restrict:"E",transclude:!0,template:"",replace:!0,require:"^accordionGroup",compile:function(t,e,n){return function(t,e,o,a){a.setHeading(n(t,function(){}))}}}}).directive("accordionTransclude",function(){return{require:"^accordionGroup",link:function(t,e,n,o){t.$watch(function(){return o[n.accordionTransclude]},function(t){t&&(e.html(""),e.append(t))})}}}),angular.module("ui.bootstrap.alert",[]).directive("alert",function(){return{restrict:"EA",templateUrl:"template/alert/alert.html",transclude:!0,replace:!0,scope:{type:"=",close:"&"},link:function(t,e,n){t.closeable="close"in n}}}),angular.module("ui.bootstrap.buttons",[]).constant("buttonConfig",{activeClass:"active",toggleEvent:"click"}).directive("btnRadio",["buttonConfig",function(t){var e=t.activeClass||"active",n=t.toggleEvent||"click";return{require:"ngModel",link:function(t,o,a,i){var r=t.$eval(a.btnRadio);t.$watch(function(){return i.$modelValue},function(t){angular.equals(t,r)?o.addClass(e):o.removeClass(e)}),o.bind(n,function(){o.hasClass(e)||t.$apply(function(){i.$setViewValue(r)})})}}}]).directive("btnCheckbox",["buttonConfig",function(t){var e=t.activeClass||"active",n=t.toggleEvent||"click";return{require:"ngModel",link:function(t,o,a,i){var r=t.$eval(a.btnCheckboxTrue),l=t.$eval(a.btnCheckboxFalse);r=angular.isDefined(r)?r:!0,l=angular.isDefined(l)?l:!1,t.$watch(function(){return i.$modelValue},function(t){angular.equals(t,r)?o.addClass(e):o.removeClass(e)}),o.bind(n,function(){t.$apply(function(){i.$setViewValue(o.hasClass(e)?l:r)})})}}}]),angular.module("ui.bootstrap.carousel",["ui.bootstrap.transition"]).controller("CarouselController",["$scope","$timeout","$transition","$q",function(t,e,n){function o(){function n(){i?(t.next(),o()):t.pause()}a&&e.cancel(a);var r=+t.interval;!isNaN(r)&&r>=0&&(a=e(n,r))}var a,i,r=this,l=r.slides=[],s=-1;r.currentSlide=null,r.select=function(a,i){function c(){r.currentSlide&&angular.isString(i)&&!t.noTransition&&a.$element?(a.$element.addClass(i),a.$element[0].offsetWidth=a.$element[0].offsetWidth,angular.forEach(l,function(t){angular.extend(t,{direction:"",entering:!1,leaving:!1,active:!1})}),angular.extend(a,{direction:i,active:!0,entering:!0}),angular.extend(r.currentSlide||{},{direction:i,leaving:!0}),t.$currentTransition=n(a.$element,{}),function(e,n){t.$currentTransition.then(function(){u(e,n)},function(){u(e,n)})}(a,r.currentSlide)):u(a,r.currentSlide),r.currentSlide=a,s=p,o()}function u(e,n){angular.extend(e,{direction:"",active:!0,leaving:!1,entering:!1}),angular.extend(n||{},{direction:"",active:!1,leaving:!1,entering:!1}),t.$currentTransition=null}var p=l.indexOf(a);void 0===i&&(i=p>s?"next":"prev"),a&&a!==r.currentSlide&&(t.$currentTransition?(t.$currentTransition.cancel(),e(c)):c())},r.indexOfSlide=function(t){return l.indexOf(t)},t.next=function(){var t=(s+1)%l.length;return r.select(l[t],"next")},t.prev=function(){var t=0>s-1?l.length-1:s-1;return r.select(l[t],"prev")},t.select=function(t){r.select(t)},t.isActive=function(t){return r.currentSlide===t},t.slides=function(){return l},t.$watch("interval",o),t.play=function(){i||(i=!0,o())},t.pause=function(){i=!1,a&&e.cancel(a)},r.addSlide=function(e,n){e.$element=n,l.push(e),1===l.length||e.active?(r.select(l[l.length-1]),1==l.length&&t.play()):e.active=!1},r.removeSlide=function(t){var e=l.indexOf(t);l.splice(e,1),l.length>0&&t.active&&(e>=l.length?r.select(l[e-1]):r.select(l[e]))}}]).directive("carousel",[function(){return{restrict:"EA",transclude:!0,replace:!0,controller:"CarouselController",require:"carousel",templateUrl:"template/carousel/carousel.html",scope:{interval:"=",noTransition:"="}}}]).directive("slide",[function(){return{require:"^carousel",restrict:"EA",transclude:!0,replace:!0,templateUrl:"template/carousel/slide.html",scope:{active:"="},link:function(t,e,n,o){o.addSlide(t,e),t.$on("$destroy",function(){o.removeSlide(t)}),t.$watch("active",function(e){e&&o.select(t)})}}}]);var dialogModule=angular.module("ui.bootstrap.dialog",["ui.bootstrap.transition"]);dialogModule.controller("MessageBoxController",["$scope","dialog","model",function(t,e,n){t.title=n.title,t.message=n.message,t.buttons=n.buttons,t.close=function(t){e.close(t)}}]),dialogModule.provider("$dialog",function(){var t={backdrop:!0,dialogClass:"modal",backdropClass:"modal-backdrop",transitionClass:"fade",triggerClass:"in",dialogOpenClass:"modal-open",resolve:{},backdropFade:!1,dialogFade:!1,keyboard:!0,backdropClick:!0},e={},n={value:0};this.options=function(t){e=t},this.$get=["$http","$document","$compile","$rootScope","$controller","$templateCache","$q","$transition","$injector",function(o,a,i,r,l,s,c,u,p){function d(t){var e=angular.element("<div>");return e.addClass(t),e}function f(n){var o=this,a=this.options=angular.extend({},t,e,n);this._open=!1,this.backdropEl=d(a.backdropClass),a.backdropFade&&(this.backdropEl.addClass(a.transitionClass),this.backdropEl.removeClass(a.triggerClass)),this.modalEl=d(a.dialogClass),a.dialogFade&&(this.modalEl.addClass(a.transitionClass),this.modalEl.removeClass(a.triggerClass)),this.handledEscapeKey=function(t){27===t.which&&(o.close(),t.preventDefault(),o.$scope.$apply())},this.handleBackDropClick=function(t){o.close(),t.preventDefault(),o.$scope.$apply()},this.handleLocationChange=function(){o.close()}}var g=a.find("body");return f.prototype.isOpen=function(){return this._open},f.prototype.open=function(t,e){var n=this,o=this.options;if(t&&(o.templateUrl=t),e&&(o.controller=e),!o.template&&!o.templateUrl)throw Error("Dialog.open expected template or templateUrl, neither found. Use options or open method to specify them.");return this._loadResolves().then(function(t){var e=t.$scope=n.$scope=t.$scope?t.$scope:r.$new();if(n.modalEl.html(t.$template),n.options.controller){var o=l(n.options.controller,t);n.modalEl.children().data("ngControllerController",o)}i(n.modalEl)(e),n._addElementsToDom(),g.addClass(n.options.dialogOpenClass),setTimeout(function(){n.options.dialogFade&&n.modalEl.addClass(n.options.triggerClass),n.options.backdropFade&&n.backdropEl.addClass(n.options.triggerClass)}),n._bindEvents()}),this.deferred=c.defer(),this.deferred.promise},f.prototype.close=function(t){function e(t){t.removeClass(o.options.triggerClass)}function n(){o._open&&o._onCloseComplete(t)}var o=this,a=this._getFadingElements();if(g.removeClass(o.options.dialogOpenClass),a.length>0)for(var i=a.length-1;i>=0;i--)u(a[i],e).then(n);else this._onCloseComplete(t)},f.prototype._getFadingElements=function(){var t=[];return this.options.dialogFade&&t.push(this.modalEl),this.options.backdropFade&&t.push(this.backdropEl),t},f.prototype._bindEvents=function(){this.options.keyboard&&g.bind("keydown",this.handledEscapeKey),this.options.backdrop&&this.options.backdropClick&&this.backdropEl.bind("click",this.handleBackDropClick),this.$scope.$on("$locationChangeSuccess",this.handleLocationChange)},f.prototype._unbindEvents=function(){this.options.keyboard&&g.unbind("keydown",this.handledEscapeKey),this.options.backdrop&&this.options.backdropClick&&this.backdropEl.unbind("click",this.handleBackDropClick)},f.prototype._onCloseComplete=function(t){this._removeElementsFromDom(),this._unbindEvents(),this.deferred.resolve(t)},f.prototype._addElementsToDom=function(){g.append(this.modalEl),this.options.backdrop&&(0===n.value&&g.append(this.backdropEl),n.value++),this._open=!0},f.prototype._removeElementsFromDom=function(){this.modalEl.remove(),this.options.backdrop&&(n.value--,0===n.value&&this.backdropEl.remove()),this._open=!1},f.prototype._loadResolves=function(){var t,e=[],n=[],a=this;return this.options.template?t=c.when(this.options.template):this.options.templateUrl&&(t=o.get(this.options.templateUrl,{cache:s}).then(function(t){return t.data})),angular.forEach(this.options.resolve||[],function(t,o){n.push(o),e.push(angular.isString(t)?p.get(t):p.invoke(t))}),n.push("$template"),e.push(t),c.all(e).then(function(t){var e={};return angular.forEach(t,function(t,o){e[n[o]]=t}),e.dialog=a,e})},{dialog:function(t){return new f(t)},messageBox:function(t,e,n){return new f({templateUrl:"template/dialog/message.html",controller:"MessageBoxController",resolve:{model:function(){return{title:t,message:e,buttons:n}}}})}}}]}),angular.module("ui.bootstrap.dropdownToggle",[]).directive("dropdownToggle",["$document","$location","$window",function(t){var e=null,n=angular.noop;return{restrict:"CA",link:function(o,a){o.$watch("$location.path",function(){n()}),a.parent().bind("click",function(){n()}),a.bind("click",function(o){o.preventDefault(),o.stopPropagation();var i=a===e;e&&n(),i||(a.parent().addClass("open"),e=a,n=function(o){o&&(o.preventDefault(),o.stopPropagation()),t.unbind("click",n),a.parent().removeClass("open"),n=angular.noop,e=null},t.bind("click",n))})}}}]),angular.module("ui.bootstrap.modal",["ui.bootstrap.dialog"]).directive("modal",["$parse","$dialog",function(t,e){return{restrict:"EA",terminal:!0,link:function(n,o,a){var i,r=angular.extend({},n.$eval(a.uiOptions||a.bsOptions||a.options)),l=a.modal||a.show;r=angular.extend(r,{template:o.html(),resolve:{$scope:function(){return n}}});var s=e.dialog(r);o.remove(),i=a.close?function(){t(a.close)(n)}:function(){angular.isFunction(t(l).assign)&&t(l).assign(n,!1)},n.$watch(l,function(t){t?s.open().then(function(){i()}):s.isOpen()&&s.close()})}}}]),angular.module("ui.bootstrap.pagination",[]).constant("paginationConfig",{boundaryLinks:!1,directionLinks:!0,firstText:"First",previousText:"Previous",nextText:"Next",lastText:"Last"}).directive("pagination",["paginationConfig",function(t){return{restrict:"EA",scope:{numPages:"=",currentPage:"=",maxSize:"=",onSelectPage:"&"},templateUrl:"template/pagination/pagination.html",replace:!0,link:function(e,n,o){function a(t,e,n,o){return{number:t,text:e,active:n,disabled:o}}var i=angular.isDefined(o.boundaryLinks)?e.$eval(o.boundaryLinks):t.boundaryLinks,r=angular.isDefined(o.directionLinks)?e.$eval(o.directionLinks):t.directionLinks,l=angular.isDefined(o.firstText)?o.firstText:t.firstText,s=angular.isDefined(o.previousText)?o.previousText:t.previousText,c=angular.isDefined(o.nextText)?o.nextText:t.nextText,u=angular.isDefined(o.lastText)?o.lastText:t.lastText;e.$watch("numPages + currentPage + maxSize",function(){e.pages=[];var t=1,n=e.numPages;e.maxSize&&e.maxSize<e.numPages&&(t=Math.max(e.currentPage-Math.floor(e.maxSize/2),1),n=t+e.maxSize-1,n>e.numPages&&(n=e.numPages,t=n-e.maxSize+1));for(var o=t;n>=o;o++){var p=a(o,o,e.isActive(o),!1);e.pages.push(p)}if(r){var d=a(e.currentPage-1,s,!1,e.noPrevious());e.pages.unshift(d);var f=a(e.currentPage+1,c,!1,e.noNext());e.pages.push(f)}if(i){var g=a(1,l,!1,e.noPrevious());e.pages.unshift(g);var m=a(e.numPages,u,!1,e.noNext());e.pages.push(m)}e.currentPage>e.numPages&&e.selectPage(e.numPages)}),e.noPrevious=function(){return 1===e.currentPage},e.noNext=function(){return e.currentPage===e.numPages},e.isActive=function(t){return e.currentPage===t},e.selectPage=function(t){!e.isActive(t)&&t>0&&e.numPages>=t&&(e.currentPage=t,e.onSelectPage({page:t}))}}}}]),angular.module("ui.bootstrap.position",[]).factory("$position",["$document","$window",function(t,e){function n(t,n){return t.currentStyle?t.currentStyle[n]:e.getComputedStyle?e.getComputedStyle(t)[n]:t.style[n]}function o(t){return"static"===(n(t,"position")||"static")}var a=function(e){for(var n=t[0],a=e.offsetParent||n;a&&a!==n&&o(a);)a=a.offsetParent;return a||n};return{position:function(e){var n=this.offset(e),o={top:0,left:0},i=a(e[0]);return i!=t[0]&&(o=this.offset(angular.element(i)),o.top+=i.clientTop,o.left+=i.clientLeft),{width:e.prop("offsetWidth"),height:e.prop("offsetHeight"),top:n.top-o.top,left:n.left-o.left}},offset:function(n){var o=n[0].getBoundingClientRect();return{width:n.prop("offsetWidth"),height:n.prop("offsetHeight"),top:o.top+(e.pageYOffset||t[0].body.scrollTop),left:o.left+(e.pageXOffset||t[0].body.scrollLeft)}}}}]),angular.module("ui.bootstrap.tooltip",["ui.bootstrap.position"]).provider("$tooltip",function(){function t(t){var e=/[A-Z]/g,n="-";return t.replace(e,function(t,e){return(e?n:"")+t.toLowerCase()})}var e={placement:"top",animation:!0,popupDelay:0},n={mouseenter:"mouseleave",click:"click",focus:"blur"},o={};this.options=function(t){angular.extend(o,t)},this.$get=["$window","$compile","$timeout","$parse","$document","$position",function(a,i,r,l,s,c){return function(a,u,p){function d(t){var e,o;return e=t||f.trigger||p,o=angular.isDefined(f.trigger)?n[f.trigger]||e:n[e]||e,{show:e,hide:o}}var f=angular.extend({},e,o),g=t(a),m=d(void 0),h="<"+g+"-popup "+'title="{{tt_title}}" '+'content="{{tt_content}}" '+'placement="{{tt_placement}}" '+'animation="tt_animation()" '+'is-open="tt_isOpen"'+">"+"</"+g+"-popup>";return{restrict:"EA",scope:!0,link:function(t,e,n){function o(){t.tt_isOpen?g():p()}function p(){t.tt_popupDelay?y=r(v,t.tt_popupDelay):t.$apply(v)}function g(){t.$apply(function(){b()})}function v(){var n,o,a,i;if(t.tt_content){switch($&&r.cancel($),C.css({top:0,left:0,display:"block"}),f.appendToBody?(k=k||s.find("body"),k.append(C)):e.after(C),n=c.position(e),o=C.prop("offsetWidth"),a=C.prop("offsetHeight"),t.tt_placement){case"right":i={top:n.top+n.height/2-a/2+"px",left:n.left+n.width+"px"};break;case"bottom":i={top:n.top+n.height+"px",left:n.left+n.width/2-o/2+"px"};break;case"left":i={top:n.top+n.height/2-a/2+"px",left:n.left-o+"px"};break;default:i={top:n.top-a+"px",left:n.left+n.width/2-o/2+"px"}}C.css(i),t.tt_isOpen=!0}}function b(){t.tt_isOpen=!1,r.cancel(y),angular.isDefined(t.tt_animation)&&t.tt_animation()?$=r(function(){C.remove()},500):C.remove()}var $,y,k,C=i(h)(t);t.tt_isOpen=!1,n.$observe(a,function(e){t.tt_content=e}),n.$observe(u+"Title",function(e){t.tt_title=e}),n.$observe(u+"Placement",function(e){t.tt_placement=angular.isDefined(e)?e:f.placement}),n.$observe(u+"Animation",function(e){t.tt_animation=angular.isDefined(e)?l(e):function(){return f.animation}}),n.$observe(u+"PopupDelay",function(e){var n=parseInt(e,10);t.tt_popupDelay=isNaN(n)?f.popupDelay:n}),n.$observe(u+"Trigger",function(t){e.unbind(m.show),e.unbind(m.hide),m=d(t),m.show===m.hide?e.bind(m.show,o):(e.bind(m.show,p),e.bind(m.hide,g))})}}}}]}).directive("tooltipPopup",function(){return{restrict:"E",replace:!0,scope:{content:"@",placement:"@",animation:"&",isOpen:"&"},templateUrl:"template/tooltip/tooltip-popup.html"}}).directive("tooltip",["$tooltip",function(t){return t("tooltip","tooltip","mouseenter")}]).directive("tooltipHtmlUnsafePopup",function(){return{restrict:"E",replace:!0,scope:{content:"@",placement:"@",animation:"&",isOpen:"&"},templateUrl:"template/tooltip/tooltip-html-unsafe-popup.html"}}).directive("tooltipHtmlUnsafe",["$tooltip",function(t){return t("tooltipHtmlUnsafe","tooltip","mouseenter")}]),angular.module("ui.bootstrap.popover",["ui.bootstrap.tooltip"]).directive("popoverPopup",function(){return{restrict:"EA",replace:!0,scope:{title:"@",content:"@",placement:"@",animation:"&",isOpen:"&"},templateUrl:"template/popover/popover.html"}}).directive("popover",["$compile","$timeout","$parse","$window","$tooltip",function(t,e,n,o,a){return a("popover","popover","click")}]),angular.module("ui.bootstrap.progressbar",["ui.bootstrap.transition"]).constant("progressConfig",{animate:!0,autoType:!1,stackedTypes:["success","info","warning","danger"]}).controller("ProgressBarController",["$scope","$attrs","progressConfig",function(t,e,n){function o(t){return r[t]}var a=angular.isDefined(e.animate)?t.$eval(e.animate):n.animate,i=angular.isDefined(e.autoType)?t.$eval(e.autoType):n.autoType,r=angular.isDefined(e.stackedTypes)?t.$eval("["+e.stackedTypes+"]"):n.stackedTypes;this.makeBar=function(t,e,n){var r=angular.isObject(t)?t.value:t||0,l=angular.isObject(e)?e.value:e||0,s=angular.isObject(t)&&angular.isDefined(t.type)?t.type:i?o(n||0):null;return{from:l,to:r,type:s,animate:a}},this.addBar=function(e){t.bars.push(e),t.totalPercent+=e.to},this.clearBars=function(){t.bars=[],t.totalPercent=0},this.clearBars()}]).directive("progress",function(){return{restrict:"EA",replace:!0,controller:"ProgressBarController",scope:{value:"=",onFull:"&",onEmpty:"&"},templateUrl:"template/progressbar/progress.html",link:function(t,e,n,o){t.$watch("value",function(t,e){if(o.clearBars(),angular.isArray(t))for(var n=0,a=t.length;a>n;n++)o.addBar(o.makeBar(t[n],e[n],n));else o.addBar(o.makeBar(t,e))},!0),t.$watch("totalPercent",function(e){e>=100?t.onFull():0>=e&&t.onEmpty()},!0)}}}).directive("progressbar",["$transition",function(t){return{restrict:"EA",replace:!0,scope:{width:"=",old:"=",type:"=",animate:"="},templateUrl:"template/progressbar/bar.html",link:function(e,n){e.$watch("width",function(o){e.animate?(n.css("width",e.old+"%"),t(n,{width:o+"%"})):n.css("width",o+"%")})}}}]),angular.module("ui.bootstrap.rating",[]).constant("ratingConfig",{max:5}).directive("rating",["ratingConfig","$parse",function(t,e){return{restrict:"EA",scope:{value:"="},templateUrl:"template/rating/rating.html",replace:!0,link:function(n,o,a){var i=angular.isDefined(a.max)?n.$eval(a.max):t.max;n.range=[];for(var r=1;i>=r;r++)n.range.push(r);n.rate=function(t){n.readonly||(n.value=t)},n.enter=function(t){n.readonly||(n.val=t)},n.reset=function(){n.val=angular.copy(n.value)},n.reset(),n.$watch("value",function(t){n.val=t}),n.readonly=!1,a.readonly&&n.$parent.$watch(e(a.readonly),function(t){n.readonly=!!t})}}}]),angular.module("ui.bootstrap.tabs",[]).controller("TabsController",["$scope","$element",function(t){var e=t.panes=[];this.select=t.select=function(t){angular.forEach(e,function(t){t.selected=!1}),t.selected=!0},this.addPane=function(n){e.length||t.select(n),e.push(n)},this.removePane=function(n){var o=e.indexOf(n);e.splice(o,1),n.selected&&e.length>0&&t.select(e[e.length>o?o:o-1])}}]).directive("tabs",function(){return{restrict:"EA",transclude:!0,scope:{},controller:"TabsController",templateUrl:"template/tabs/tabs.html",replace:!0}}).directive("pane",["$parse",function(t){return{require:"^tabs",restrict:"EA",transclude:!0,scope:{heading:"@"},link:function(e,n,o,a){var i,r;e.selected=!1,o.active&&(i=t(o.active),r=i.assign,e.$watch(function(){return i(e.$parent)},function(t){e.selected=t}),e.selected=i?i(e.$parent):!1),e.$watch("selected",function(t){t&&a.select(e),r&&r(e.$parent,t)}),a.addPane(e),e.$on("$destroy",function(){a.removePane(e)})},templateUrl:"template/tabs/pane.html",replace:!0}}]),angular.module("ui.bootstrap.typeahead",["ui.bootstrap.position"]).factory("typeaheadParser",["$parse",function(t){var e=/^\s*(.*?)(?:\s+as\s+(.*?))?\s+for\s+(?:([\$\w][\$\w\d]*))\s+in\s+(.*)$/;return{parse:function(n){var o=n.match(e);if(!o)throw Error("Expected typeahead specification in form of '_modelValue_ (as _label_)? for _item_ in _collection_' but got '"+n+"'.");return{itemName:o[3],source:t(o[4]),viewMapper:t(o[2]||o[1]),modelMapper:t(o[1])}}}}]).directive("typeahead",["$compile","$parse","$q","$document","$position","typeaheadParser",function(t,e,n,o,a,i){var r=[9,13,27,38,40];return{require:"ngModel",link:function(l,s,c,u){var p,d=l.$eval(c.typeaheadMinLength)||1,f=i.parse(c.typeahead),g=l.$eval(c.typeaheadEditable)!==!1,m=e(c.typeaheadLoading).assign||angular.noop,h=angular.element("<typeahead-popup matches='matches' active='activeIdx' select='select(activeIdx)' query='query' position='position'></typeahead-popup>"),v=l.$new();l.$on("$destroy",function(){v.$destroy()});var b=function(){v.matches=[],v.activeIdx=-1},$=function(t){var e={$viewValue:t};m(l,!0),n.when(f.source(v,e)).then(function(n){if(t===u.$viewValue){if(n.length>0){v.activeIdx=0,v.matches.length=0;for(var o=0;n.length>o;o++)e[f.itemName]=n[o],v.matches.push({label:f.viewMapper(v,e),model:n[o]});v.query=t,v.position=a.position(s),v.position.top=v.position.top+s.prop("offsetHeight")}else b();m(l,!1)}},function(){b(),m(l,!1)})};b(),v.query=void 0,u.$parsers.push(function(t){return b(),p?t:(t&&t.length>=d&&$(t),g?t:void 0)}),u.$render=function(){var t={};t[f.itemName]=p||u.$viewValue,s.val(f.viewMapper(v,t)||u.$viewValue),p=void 0},v.select=function(t){var e={};e[f.itemName]=p=v.matches[t].model,u.$setViewValue(f.modelMapper(v,e)),u.$render()},s.bind("keydown",function(t){0!==v.matches.length&&-1!==r.indexOf(t.which)&&(t.preventDefault(),40===t.which?(v.activeIdx=(v.activeIdx+1)%v.matches.length,v.$digest()):38===t.which?(v.activeIdx=(v.activeIdx?v.activeIdx:v.matches.length)-1,v.$digest()):13===t.which||9===t.which?v.$apply(function(){v.select(v.activeIdx)}):27===t.which&&(t.stopPropagation(),b(),v.$digest()))}),o.bind("click",function(){b(),v.$digest()}),s.after(t(h)(v))}}}]).directive("typeaheadPopup",function(){return{restrict:"E",scope:{matches:"=",query:"=",active:"=",position:"=",select:"&"},replace:!0,templateUrl:"template/typeahead/typeahead.html",link:function(t){t.isOpen=function(){return t.matches.length>0},t.isActive=function(e){return t.active==e},t.selectActive=function(e){t.active=e},t.selectMatch=function(e){t.select({activeIdx:e})}}}}).filter("typeaheadHighlight",function(){function t(t){return t.replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1")}return function(e,n){return n?e.replace(RegExp(t(n),"gi"),"<strong>$&</strong>"):n}}),angular.module("template/accordion/accordion-group.html",[]).run(["$templateCache",function(t){t.put("template/accordion/accordion-group.html",'<div class="accordion-group">\n  <div class="accordion-heading" ><a class="accordion-toggle" ng-click="isOpen = !isOpen" accordion-transclude="heading">{{heading}}</a></div>\n  <div class="accordion-body" collapse="!isOpen">\n    <div class="accordion-inner" ng-transclude></div>  </div>\n</div>')}]),angular.module("template/accordion/accordion.html",[]).run(["$templateCache",function(t){t.put("template/accordion/accordion.html",'<div class="accordion" ng-transclude></div>')}]),angular.module("template/alert/alert.html",[]).run(["$templateCache",function(t){t.put("template/alert/alert.html","<div class='alert' ng-class='type && \"alert-\" + type'>\n    <button ng-show='closeable' type='button' class='close' ng-click='close()'>&times;</button>\n    <div ng-transclude></div>\n</div>\n")}]),angular.module("template/carousel/carousel.html",[]).run(["$templateCache",function(t){t.put("template/carousel/carousel.html",'<div ng-mouseenter="pause()" ng-mouseleave="play()" class="carousel">\n    <ol class="carousel-indicators" ng-show="slides().length > 1">\n        <li ng-repeat="slide in slides()" ng-class="{active: isActive(slide)}" ng-click="select(slide)"></li>\n    </ol>\n    <div class="carousel-inner" ng-transclude></div>\n    <a ng-click="prev()" class="carousel-control left" ng-show="slides().length > 1">&lsaquo;</a>\n    <a ng-click="next()" class="carousel-control right" ng-show="slides().length > 1">&rsaquo;</a>\n</div>\n')}]),angular.module("template/carousel/slide.html",[]).run(["$templateCache",function(t){t.put("template/carousel/slide.html","<div ng-class=\"{\n    'active': leaving || (active && !entering),\n    'prev': (next || active) && direction=='prev',\n    'next': (next || active) && direction=='next',\n    'right': direction=='prev',\n    'left': direction=='next'\n  }\" class=\"item\" ng-transclude></div>\n")}]),angular.module("template/dialog/message.html",[]).run(["$templateCache",function(t){t.put("template/dialog/message.html",'<div class="modal-header">\n	<h1>{{ title }}</h1>\n</div>\n<div class="modal-body">\n	<p>{{ message }}</p>\n</div>\n<div class="modal-footer">\n	<button ng-repeat="btn in buttons" ng-click="close(btn.result)" class=btn ng-class="btn.cssClass">{{ btn.label }}</button>\n</div>\n')}]),angular.module("template/pagination/pagination.html",[]).run(["$templateCache",function(t){t.put("template/pagination/pagination.html",'<div class="pagination"><ul>\n  <li ng-repeat="page in pages" ng-class="{active: page.active, disabled: page.disabled}"><a ng-click="selectPage(page.number)">{{page.text}}</a></li>\n  </ul>\n</div>\n')}]),angular.module("template/tooltip/tooltip-html-unsafe-popup.html",[]).run(["$templateCache",function(t){t.put("template/tooltip/tooltip-html-unsafe-popup.html",'<div class="tooltip {{placement}}" ng-class="{ in: isOpen(), fade: animation() }">\n  <div class="tooltip-arrow"></div>\n  <div class="tooltip-inner" ng-bind-html-unsafe="content"></div>\n</div>\n')}]),angular.module("template/tooltip/tooltip-popup.html",[]).run(["$templateCache",function(t){t.put("template/tooltip/tooltip-popup.html",'<div class="tooltip {{placement}}" ng-class="{ in: isOpen(), fade: animation() }">\n  <div class="tooltip-arrow"></div>\n  <div class="tooltip-inner" ng-bind="content"></div>\n</div>\n')}]),angular.module("template/popover/popover.html",[]).run(["$templateCache",function(t){t.put("template/popover/popover.html",'<div class="popover {{placement}}" ng-class="{ in: isOpen(), fade: animation() }">\n  <div class="arrow"></div>\n\n  <div class="popover-inner">\n      <h3 class="popover-title" ng-bind="title" ng-show="title"></h3>\n      <div class="popover-content" ng-bind="content"></div>\n  </div>\n</div>\n')}]),angular.module("template/progressbar/bar.html",[]).run(["$templateCache",function(t){t.put("template/progressbar/bar.html",'<div class="bar" ng-class=\'type && "bar-" + type\'></div>')}]),angular.module("template/progressbar/progress.html",[]).run(["$templateCache",function(t){t.put("template/progressbar/progress.html",'<div class="progress"><progressbar ng-repeat="bar in bars" width="bar.to" old="bar.from" animate="bar.animate" type="bar.type"></progressbar></div>')}]),angular.module("template/rating/rating.html",[]).run(["$templateCache",function(t){t.put("template/rating/rating.html",'<span ng-mouseleave="reset()">\n	<i ng-repeat="number in range" ng-mouseenter="enter(number)" ng-click="rate(number)" ng-class="{\'icon-star\': number <= val, \'icon-star-empty\': number > val}"></i>\n</span>\n')}]),angular.module("template/tabs/pane.html",[]).run(["$templateCache",function(t){t.put("template/tabs/pane.html",'<div class="tab-pane" ng-class="{active: selected}" ng-show="selected" ng-transclude></div>\n')}]),angular.module("template/tabs/tabs.html",[]).run(["$templateCache",function(t){t.put("template/tabs/tabs.html",'<div class="tabbable">\n  <ul class="nav nav-tabs">\n    <li ng-repeat="pane in panes" ng-class="{active:pane.selected}">\n      <a ng-click="select(pane)">{{pane.heading}}</a>\n    </li>\n  </ul>\n  <div class="tab-content" ng-transclude></div>\n</div>\n')}]),angular.module("template/typeahead/match.html",[]).run(["$templateCache",function(t){t.put("template/typeahead/match.html",'<a tabindex="-1" ng-bind-html-unsafe="match.label | typeaheadHighlight:query"></a>')}]),angular.module("template/typeahead/typeahead.html",[]).run(["$templateCache",function(t){t.put("template/typeahead/typeahead.html",'<ul class="typeahead dropdown-menu" ng-style="{display: isOpen()&&\'block\' || \'none\', top: position.top+\'px\', left: position.left+\'px\'}">\n    <li ng-repeat="match in matches" ng-class="{active: isActive($index) }" ng-mouseenter="selectActive($index)">\n        <a tabindex="-1" ng-click="selectMatch($index)" ng-bind-html-unsafe="match.label | typeaheadHighlight:query"></a>\n    </li>\n</ul>')}]);/*
Copyright 2012 Igor Vaynberg

Version: @@ver@@ Timestamp: @@timestamp@@

This software is licensed under the Apache License, Version 2.0 (the "Apache License") or the GNU
General Public License version 2 (the "GPL License"). You may choose either license to govern your
use of this software only upon the condition that you accept all of the terms of either the Apache
License or the GPL License.

You may obtain a copy of the Apache License and the GPL License at:

    http://www.apache.org/licenses/LICENSE-2.0
    http://www.gnu.org/licenses/gpl-2.0.html

Unless required by applicable law or agreed to in writing, software distributed under the
Apache License or the GPL Licesnse is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
CONDITIONS OF ANY KIND, either express or implied. See the Apache License and the GPL License for
the specific language governing permissions and limitations under the Apache License and the GPL License.
*/
 (function ($) {
 	if(typeof $.fn.each2 == "undefined"){
 		$.fn.extend({
 			/*
			* 4-10 times faster .each replacement
			* use it carefully, as it overrides jQuery context of element on each iteration
			*/
			each2 : function (c) {
				var j = $([0]), i = -1, l = this.length;
				while (
					++i < l
					&& (j.context = j[0] = this[i])
					&& c.call(j[0], i, j) !== false //"this"=DOM, i=index, j=jQuery object
				);
				return this;
			}
 		});
 	}
})(jQuery);

(function ($, undefined) {
    "use strict";
    /*global document, window, jQuery, console */

    if (window.Select2 !== undefined) {
        return;
    }

    var KEY, AbstractSelect2, SingleSelect2, MultiSelect2, nextUid, sizer,
        lastMousePosition, $document;

    KEY = {
        TAB: 9,
        ENTER: 13,
        ESC: 27,
        SPACE: 32,
        LEFT: 37,
        UP: 38,
        RIGHT: 39,
        DOWN: 40,
        SHIFT: 16,
        CTRL: 17,
        ALT: 18,
        PAGE_UP: 33,
        PAGE_DOWN: 34,
        HOME: 36,
        END: 35,
        BACKSPACE: 8,
        DELETE: 46,
        isArrow: function (k) {
            k = k.which ? k.which : k;
            switch (k) {
            case KEY.LEFT:
            case KEY.RIGHT:
            case KEY.UP:
            case KEY.DOWN:
                return true;
            }
            return false;
        },
        isControl: function (e) {
            var k = e.which;
            switch (k) {
            case KEY.SHIFT:
            case KEY.CTRL:
            case KEY.ALT:
                return true;
            }

            if (e.metaKey) return true;

            return false;
        },
        isFunctionKey: function (k) {
            k = k.which ? k.which : k;
            return k >= 112 && k <= 123;
        }
    };

    $document = $(document);

    nextUid=(function() { var counter=1; return function() { return counter++; }; }());

    function indexOf(value, array) {
        var i = 0, l = array.length;
        for (; i < l; i = i + 1) if (value === array[i]) return i;
        return -1;
    }

    /**
     * Compares equality of a and b
     * @param a
     * @param b
     */
    function equal(a, b) {
        return a===b;
    }

    /**
     * Splits the string into an array of values, trimming each value. An empty array is returned for nulls or empty
     * strings
     * @param string
     * @param separator
     */
    function splitVal(string, separator) {
        var val, i, l;
        if (string === null || string.length < 1) return [];
        val = string.split(separator);
        for (i = 0, l = val.length; i < l; i = i + 1) val[i] = $.trim(val[i]);
        return val;
    }

    function getSideBorderPadding(element) {
        return element.outerWidth(false) - element.width();
    }

    function installKeyUpChangeEvent(element) {
        var key="keyup-change-value";
        element.bind("keydown", function () {
            if ($.data(element, key) === undefined) {
                $.data(element, key, element.val());
            }
        });
        element.bind("keyup", function () {
            var val= $.data(element, key);
            if (val !== undefined && element.val() !== val) {
                $.removeData(element, key);
                element.trigger("keyup-change");
            }
        });
    }

    $document.bind("mousemove", function (e) {
        lastMousePosition = {x: e.pageX, y: e.pageY};
    });

    /**
     * filters mouse events so an event is fired only if the mouse moved.
     *
     * filters out mouse events that occur when mouse is stationary but
     * the elements under the pointer are scrolled.
     */
    function installFilteredMouseMove(element) {
	    element.bind("mousemove", function (e) {
            var lastpos = lastMousePosition;
            if (lastpos === undefined || lastpos.x !== e.pageX || lastpos.y !== e.pageY) {
                $(e.target).trigger("mousemove-filtered", e);
            }
        });
    }

    /**
     * Debounces a function. Returns a function that calls the original fn function only if no invocations have been made
     * within the last quietMillis milliseconds.
     *
     * @param quietMillis number of milliseconds to wait before invoking fn
     * @param fn function to be debounced
     * @param ctx object to be used as this reference within fn
     * @return debounced version of fn
     */
    function debounce(quietMillis, fn, ctx) {
        ctx = ctx || undefined;
        var timeout;
        return function () {
            var args = arguments;
            window.clearTimeout(timeout);
            timeout = window.setTimeout(function() {
                fn.apply(ctx, args);
            }, quietMillis);
        };
    }

    /**
     * A simple implementation of a thunk
     * @param formula function used to lazily initialize the thunk
     * @return {Function}
     */
    function thunk(formula) {
        var evaluated = false,
            value;
        return function() {
            if (evaluated === false) { value = formula(); evaluated = true; }
            return value;
        };
    };

    function installDebouncedScroll(threshold, element) {
        var notify = debounce(threshold, function (e) { element.trigger("scroll-debounced", e);});
        element.bind("scroll", function (e) {
            if (indexOf(e.target, element.get()) >= 0) notify(e);
        });
    }

    function focus($el) {
        if ($el[0] === document.activeElement) return;

        /* set the focus in a 0 timeout - that way the focus is set after the processing
            of the current event has finished - which seems like the only reliable way
            to set focus */
        window.setTimeout(function() {
            var el=$el[0], pos=$el.val().length, range;

            $el.focus();

            /* after the focus is set move the caret to the end, necessary when we val()
                just before setting focus */
            if(el.setSelectionRange)
            {
                el.setSelectionRange(pos, pos);
            }
            else if (el.createTextRange) {
                range = el.createTextRange();
                range.collapse(true);
                range.moveEnd('character', pos);
                range.moveStart('character', pos);
                range.select();
            }

        }, 0);
    }

    function killEvent(event) {
        event.preventDefault();
        event.stopPropagation();
    }
    function killEventImmediately(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
    }

    function measureTextWidth(e) {
        if (!sizer){
        	var style = e[0].currentStyle || window.getComputedStyle(e[0], null);
        	sizer = $(document.createElement("div")).css({
	            position: "absolute",
	            left: "-10000px",
	            top: "-10000px",
	            display: "none",
	            fontSize: style.fontSize,
	            fontFamily: style.fontFamily,
	            fontStyle: style.fontStyle,
	            fontWeight: style.fontWeight,
	            letterSpacing: style.letterSpacing,
	            textTransform: style.textTransform,
	            whiteSpace: "nowrap"
	        });
            sizer.attr("class","select2-sizer");
        	$("body").append(sizer);
        }
        sizer.text(e.val());
        return sizer.width();
    }

    function syncCssClasses(dest, src, adapter) {
        var classes, replacements = [], adapted;

        classes = dest.attr("class");
        if (typeof classes === "string") {
            $(classes.split(" ")).each2(function() {
                if (this.indexOf("select2-") === 0) {
                    replacements.push(this);
                }
            });
        }
        classes = src.attr("class");
        if (typeof classes === "string") {
            $(classes.split(" ")).each2(function() {
                if (this.indexOf("select2-") !== 0) {
                    adapted = adapter(this);
                    if (typeof adapted === "string" && adapted.length > 0) {
                        replacements.push(this);
                    }
                }
            });
        }
        dest.attr("class", replacements.join(" "));
    }


    function markMatch(text, term, markup, escapeMarkup) {
        var match=text.toUpperCase().indexOf(term.toUpperCase()),
            tl=term.length;

        if (match<0) {
            markup.push(escapeMarkup(text));
            return;
        }

        markup.push(escapeMarkup(text.substring(0, match)));
        markup.push("<span class='select2-match'>");
        markup.push(escapeMarkup(text.substring(match, match + tl)));
        markup.push("</span>");
        markup.push(escapeMarkup(text.substring(match + tl, text.length)));
    }

    /**
     * Produces an ajax-based query function
     *
     * @param options object containing configuration paramters
     * @param options.transport function that will be used to execute the ajax request. must be compatible with parameters supported by $.ajax
     * @param options.url url for the data
     * @param options.data a function(searchTerm, pageNumber, context) that should return an object containing query string parameters for the above url.
     * @param options.dataType request data type: ajax, jsonp, other datatatypes supported by jQuery's $.ajax function or the transport function if specified
     * @param options.traditional a boolean flag that should be true if you wish to use the traditional style of param serialization for the ajax request
     * @param options.quietMillis (optional) milliseconds to wait before making the ajaxRequest, helps debounce the ajax function if invoked too often
     * @param options.results a function(remoteData, pageNumber) that converts data returned form the remote request to the format expected by Select2.
     *      The expected format is an object containing the following keys:
     *      results array of objects that will be used as choices
     *      more (optional) boolean indicating whether there are more results available
     *      Example: {results:[{id:1, text:'Red'},{id:2, text:'Blue'}], more:true}
     */
    function ajax(options) {
        var timeout, // current scheduled but not yet executed request
            requestSequence = 0, // sequence used to drop out-of-order responses
            handler = null,
            quietMillis = options.quietMillis || 100;

        return function (query) {
            window.clearTimeout(timeout);
            timeout = window.setTimeout(function () {
                requestSequence += 1; // increment the sequence
                var requestNumber = requestSequence, // this request's sequence number
                    data = options.data, // ajax data function
                    url = options.url, // ajax url string or function
                    transport = options.transport || $.ajax,
                    type = options.type || 'GET', // set type of request (GET or POST)
                    params = {};

                data = data ? data.call(this, query.term, query.page, query.context) : null;
                url = (typeof url === 'function') ? url.call(this, query.term, query.page, query.context) : url;

                if( null !== handler) { handler.abort(); }

                if (options.params) {
                    if ($.isFunction(options.params)) {
                        $.extend(params, options.params.call(null));
                    } else {
                        $.extend(params, options.params);
                    }
                }

                $.extend(params, {
                    url: url,
                    dataType: options.dataType,
                    data: data,
                    type: type,
                    cache: false,
                    success: function (data) {
                        if (requestNumber < requestSequence) {
                            return;
                        }
                        // TODO - replace query.page with query so users have access to term, page, etc.
                        var results = options.results(data, query.page);
                        query.callback(results);
                    }
                });
                handler = transport.call(null, params);
            }, quietMillis);
        };
    }

    /**
     * Produces a query function that works with a local array
     *
     * @param options object containing configuration parameters. The options parameter can either be an array or an
     * object.
     *
     * If the array form is used it is assumed that it contains objects with 'id' and 'text' keys.
     *
     * If the object form is used ti is assumed that it contains 'data' and 'text' keys. The 'data' key should contain
     * an array of objects that will be used as choices. These objects must contain at least an 'id' key. The 'text'
     * key can either be a String in which case it is expected that each element in the 'data' array has a key with the
     * value of 'text' which will be used to match choices. Alternatively, text can be a function(item) that can extract
     * the text.
     */
    function local(options) {
        var data = options, // data elements
            dataText,
            text = function (item) { return ""+item.text; }; // function used to retrieve the text portion of a data item that is matched against the search

        if (!$.isArray(data)) {
            text = data.text;
            // if text is not a function we assume it to be a key name
            if (!$.isFunction(text)) {
              dataText = data.text; // we need to store this in a separate variable because in the next step data gets reset and data.text is no longer available
              text = function (item) { return item[dataText]; };
            }
            data = data.results;
        }

        return function (query) {
            var t = query.term, filtered = { results: [] }, process;
            if (t === "") {
                query.callback({results: data});
                return;
            }

            process = function(datum, collection) {
                var group, attr;
                datum = datum[0];
                if (datum.children) {
                    group = {};
                    for (attr in datum) {
                        if (datum.hasOwnProperty(attr)) group[attr]=datum[attr];
                    }
                    group.children=[];
                    $(datum.children).each2(function(i, childDatum) { process(childDatum, group.children); });
                    if (group.children.length || query.matcher(t, text(group), datum)) {
                        collection.push(group);
                    }
                } else {
                    if (query.matcher(t, text(datum), datum)) {
                        collection.push(datum);
                    }
                }
            };

            $(data).each2(function(i, datum) { process(datum, filtered.results); });
            query.callback(filtered);
        };
    }

    // TODO javadoc
    function tags(data) {
        var isFunc = $.isFunction(data);
        return function (query) {
            var t = query.term, filtered = {results: []};
            $(isFunc ? data() : data).each(function () {
                var isObject = this.text !== undefined,
                    text = isObject ? this.text : this;
                if (t === "" || query.matcher(t, text)) {
                    filtered.results.push(isObject ? this : {id: this, text: this});
                }
            });
            query.callback(filtered);
        };
    }

    /**
     * Checks if the formatter function should be used.
     *
     * Throws an error if it is not a function. Returns true if it should be used,
     * false if no formatting should be performed.
     *
     * @param formatter
     */
    function checkFormatter(formatter, formatterName) {
        if ($.isFunction(formatter)) return true;
        if (!formatter) return false;
        throw new Error("formatterName must be a function or a falsy value");
    }

    function evaluate(val) {
        return $.isFunction(val) ? val() : val;
    }

    function countResults(results) {
        var count = 0;
        $.each(results, function(i, item) {
            if (item.children) {
                count += countResults(item.children);
            } else {
                count++;
            }
        });
        return count;
    }

    /**
     * Default tokenizer. This function uses breaks the input on substring match of any string from the
     * opts.tokenSeparators array and uses opts.createSearchChoice to create the choice object. Both of those
     * two options have to be defined in order for the tokenizer to work.
     *
     * @param input text user has typed so far or pasted into the search field
     * @param selection currently selected choices
     * @param selectCallback function(choice) callback tho add the choice to selection
     * @param opts select2's opts
     * @return undefined/null to leave the current input unchanged, or a string to change the input to the returned value
     */
    function defaultTokenizer(input, selection, selectCallback, opts) {
        var original = input, // store the original so we can compare and know if we need to tell the search to update its text
            dupe = false, // check for whether a token we extracted represents a duplicate selected choice
            token, // token
            index, // position at which the separator was found
            i, l, // looping variables
            separator; // the matched separator

        if (!opts.createSearchChoice || !opts.tokenSeparators || opts.tokenSeparators.length < 1) return undefined;

        while (true) {
            index = -1;

            for (i = 0, l = opts.tokenSeparators.length; i < l; i++) {
                separator = opts.tokenSeparators[i];
                index = input.indexOf(separator);
                if (index >= 0) break;
            }

            if (index < 0) break; // did not find any token separator in the input string, bail

            token = input.substring(0, index);
            input = input.substring(index + separator.length);

            if (token.length > 0) {
                token = opts.createSearchChoice(token, selection);
                if (token !== undefined && token !== null && opts.id(token) !== undefined && opts.id(token) !== null) {
                    dupe = false;
                    for (i = 0, l = selection.length; i < l; i++) {
                        if (equal(opts.id(token), opts.id(selection[i]))) {
                            dupe = true; break;
                        }
                    }

                    if (!dupe) selectCallback(token);
                }
            }
        }

        if (original!==input) return input;
    }

    /**
     * Creates a new class
     *
     * @param superClass
     * @param methods
     */
    function clazz(SuperClass, methods) {
        var constructor = function () {};
        constructor.prototype = new SuperClass;
        constructor.prototype.constructor = constructor;
        constructor.prototype.parent = SuperClass.prototype;
        constructor.prototype = $.extend(constructor.prototype, methods);
        return constructor;
    }

    AbstractSelect2 = clazz(Object, {

        // abstract
        bind: function (func) {
            var self = this;
            return function () {
                func.apply(self, arguments);
            };
        },

        // abstract
        init: function (opts) {
            var results, search, resultsSelector = ".select2-results", mask;

            // prepare options
            this.opts = opts = this.prepareOpts(opts);

            this.id=opts.id;

            // destroy if called on an existing component
            if (opts.element.data("select2") !== undefined &&
                opts.element.data("select2") !== null) {
                this.destroy();
            }

            this.enabled=true;
            this.container = this.createContainer();

            this.containerId="s2id_"+(opts.element.attr("id") || "autogen"+nextUid());
            this.containerSelector="#"+this.containerId.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1');
            this.container.attr("id", this.containerId);

            // cache the body so future lookups are cheap
            this.body = thunk(function() { return opts.element.closest("body"); });

            // create the dropdown mask if doesnt already exist
            mask = $("#select2-drop-mask");
            if (mask.length == 0) {
                mask = $(document.createElement("div"));
                mask.attr("id","select2-drop-mask").attr("class","select2-drop-mask");
                mask.hide();
                mask.appendTo(this.body());
                mask.bind("mousedown touchstart", function (e) {
                    var dropdown = $("#select2-drop"), self;
                    if (dropdown.length > 0) {
                        self=dropdown.data("select2");
                        if (self.opts.selectOnBlur) {
                            self.selectHighlighted({noFocus: true});
                        }
                        self.close();
                    }
                });
            }

            syncCssClasses(this.container, this.opts.element, this.opts.adaptContainerCssClass);

            this.container.css(evaluate(opts.containerCss));
            this.container.addClass(evaluate(opts.containerCssClass));

            this.elementTabIndex = this.opts.element.attr("tabIndex");

            // swap container for the element
            this.opts.element
                .data("select2", this)
                .addClass("select2-offscreen")
                .bind("focus.select2", function() { $(this).select2("focus"); })
                .attr("tabIndex", "-1")
                .before(this.container);
            this.container.data("select2", this);

            this.dropdown = this.container.find(".select2-drop");
            this.dropdown.addClass(evaluate(opts.dropdownCssClass));
            this.dropdown.data("select2", this);

            this.results = results = this.container.find(resultsSelector);
            this.search = search = this.container.find("input.select2-input");

            search.attr("tabIndex", this.elementTabIndex);

            this.resultsPage = 0;
            this.context = null;

            // initialize the container
            this.initContainer();
            this.initContainerWidth();

            installFilteredMouseMove(this.results);
            this.dropdown.delegate(resultsSelector, "mousemove-filtered", this.bind(this.highlightUnderEvent));

            installDebouncedScroll(80, this.results);
            this.dropdown.delegate(resultsSelector, "scroll-debounced", this.bind(this.loadMoreIfNeeded));

            // if jquery.mousewheel plugin is installed we can prevent out-of-bounds scrolling of results via mousewheel
            if ($.fn.mousewheel) {
                results.mousewheel(function (e, delta, deltaX, deltaY) {
                    var top = results.scrollTop(), height;
                    if (deltaY > 0 && top - deltaY <= 0) {
                        results.scrollTop(0);
                        killEvent(e);
                    } else if (deltaY < 0 && results.get(0).scrollHeight - results.scrollTop() + deltaY <= results.height()) {
                        results.scrollTop(results.get(0).scrollHeight - results.height());
                        killEvent(e);
                    }
                });
            }

            installKeyUpChangeEvent(search);
            search.bind("keyup-change input paste", this.bind(this.updateResults));
            search.bind("focus", function () { search.addClass("select2-focused"); });
            search.bind("blur", function () { search.removeClass("select2-focused");});

            this.dropdown.delegate(resultsSelector, "mouseup", this.bind(function (e) {
                if ($(e.target).closest(".select2-result-selectable").length > 0) {
                    this.highlightUnderEvent(e);
                    this.selectHighlighted(e);
                } else {
                    this.focusSearch();
                }
                killEvent(e);
            }));

            // trap all mouse events from leaving the dropdown. sometimes there may be a modal that is listening
            // for mouse events outside of itself so it can close itself. since the dropdown is now outside the select2's
            // dom it will trigger the popup close, which is not what we want
            this.dropdown.bind("click mouseup mousedown", function (e) { e.stopPropagation(); });

            if ($.isFunction(this.opts.initSelection)) {
                // initialize selection based on the current value of the source element
                this.initSelection();

                // if the user has provided a function that can set selection based on the value of the source element
                // we monitor the change event on the element and trigger it, allowing for two way synchronization
                this.monitorSource();
            }

            if (opts.element.is(":disabled") || opts.element.is("[readonly='readonly']")) this.disable();
        },

        // abstract
        destroy: function () {
            var select2 = this.opts.element.data("select2");

            if (this.propertyObserver) { delete this.propertyObserver; this.propertyObserver = null; }

            if (select2 !== undefined) {

                select2.container.remove();
                select2.dropdown.remove();
                select2.opts.element
                    .removeClass("select2-offscreen")
                    .removeData("select2")
                    .unbind(".select2")
                    .attr({"tabIndex": this.elementTabIndex})
                    .show();
            }
        },

        // abstract
        prepareOpts: function (opts) {
            var element, select, idKey, ajaxUrl;

            element = opts.element;

            if (element.get(0).tagName.toLowerCase() === "select") {
                this.select = select = opts.element;
            }

            if (select) {
                // these options are not allowed when attached to a select because they are picked up off the element itself
                $.each(["id", "multiple", "ajax", "query", "createSearchChoice", "initSelection", "data", "tags"], function () {
                    if (this in opts) {
                        throw new Error("Option '" + this + "' is not allowed for Select2 when attached to a <select> element.");
                    }
                });
            }

            opts = $.extend({}, {
                populateResults: function(container, results, query) {
                    var populate,  data, result, children, id=this.opts.id, self=this;

                    populate=function(results, container, depth) {

                        var i, l, result, selectable, disabled, compound, node, label, innerContainer, formatted;

                        results = opts.sortResults(results, container, query);

                        for (i = 0, l = results.length; i < l; i = i + 1) {

                            result=results[i];

                            disabled = (result.disabled === true);
                            selectable = (!disabled) && (id(result) !== undefined);

                            compound=result.children && result.children.length > 0;

                            node=$("<li></li>");
                            node.addClass("select2-results-dept-"+depth);
                            node.addClass("select2-result");
                            node.addClass(selectable ? "select2-result-selectable" : "select2-result-unselectable");
                            if (disabled) { node.addClass("select2-disabled"); }
                            if (compound) { node.addClass("select2-result-with-children"); }
                            node.addClass(self.opts.formatResultCssClass(result));

                            label=$(document.createElement("div"));
                            label.addClass("select2-result-label");

                            formatted=opts.formatResult(result, label, query, self.opts.escapeMarkup);
                            if (formatted!==undefined) {
                                label.html(formatted);
                            }

                            node.append(label);

                            if (compound) {

                                innerContainer=$("<ul></ul>");
                                innerContainer.addClass("select2-result-sub");
                                populate(result.children, innerContainer, depth+1);
                                node.append(innerContainer);
                            }

                            node.data("select2-data", result);
                            container.append(node);
                        }
                    };

                    populate(results, container, 0);
                }
            }, $.fn.select2.defaults, opts);

            if (typeof(opts.id) !== "function") {
                idKey = opts.id;
                opts.id = function (e) { return e[idKey]; };
            }

            if ($.isArray(opts.element.data("select2Tags"))) {
                if ("tags" in opts) {
                    throw "tags specified as both an attribute 'data-select2-tags' and in options of Select2 " + opts.element.attr("id");
                }
                opts.tags=opts.element.attr("data-select2-tags");
            }

            if (select) {
                opts.query = this.bind(function (query) {
                    var data = { results: [], more: false },
                        term = query.term,
                        children, firstChild, process;

                    process=function(element, collection) {
                        var group;
                        if (element.is("option")) {
                            if (query.matcher(term, element.text(), element)) {
                                collection.push({id:element.attr("value") || element.text(), text:element.text(), element: element.get(), css: element.attr("class"), disabled: equal(element.attr("disabled"), "disabled") });
                            }
                        } else if (element.is("optgroup")) {
                            group={text:element.attr("label"), children:[], element: element.get(), css: element.attr("class")};
                            element.children().each2(function(i, elm) { process(elm, group.children); });
                            if (group.children.length>0) {
                                collection.push(group);
                            }
                        }
                    };

                    children=element.children();

                    // ignore the placeholder option if there is one
                    if (this.getPlaceholder() !== undefined && children.length > 0) {
                        firstChild = children[0];
                        if ($(firstChild).text() === "") {
                            children=children.not(firstChild);
                        }
                    }

                    children.each2(function(i, elm) { process(elm, data.results); });

                    query.callback(data);
                });
                // this is needed because inside val() we construct choices from options and there id is hardcoded
                opts.id=function(e) { return e.id; };
                opts.formatResultCssClass = function(data) { return data.css; };
            } else {
                if (!("query" in opts)) {

                    if ("ajax" in opts) {
                        ajaxUrl = opts.element.data("ajax-url");
                        if (ajaxUrl && ajaxUrl.length > 0) {
                            opts.ajax.url = ajaxUrl;
                        }
                        opts.query = ajax(opts.ajax);
                    } else if ("data" in opts) {
                        opts.query = local(opts.data);
                    } else if ("tags" in opts) {
                        opts.query = tags(opts.tags);
                        if (opts.createSearchChoice === undefined) {
                            opts.createSearchChoice = function (term) { return {id: term, text: term}; };
                        }
                        if (opts.initSelection === undefined) {
                            opts.initSelection = function (element, callback) {
                                var data = [];
                                $(splitVal(element.val(), opts.separator)).each(function () {
                                    var id = this, text = this, tags=opts.tags;
                                    if ($.isFunction(tags)) tags=tags();
                                    $(tags).each(function() { if (equal(this.id, id)) { text = this.text; return false; } });
                                    data.push({id: id, text: text});
                                });

                                callback(data);
                            };
                        }
                    }
                }
            }
            if (typeof(opts.query) !== "function") {
                throw "query function not defined for Select2 " + opts.element.attr("id");
            }

            return opts;
        },

        /**
         * Monitor the original element for changes and update select2 accordingly
         */
        // abstract
        monitorSource: function () {
            var el = this.opts.element, sync;

            el.bind("change.select2", this.bind(function (e) {
                if (this.opts.element.data("select2-change-triggered") !== true) {
                    this.initSelection();
                }
            }));

            sync = this.bind(function () {

                var enabled, readonly, self = this;

                // sync enabled state

                enabled = this.opts.element.attr("disabled") !== "disabled";
                readonly = this.opts.element.attr("readonly") === "readonly";

                enabled = enabled && !readonly;

                if (this.enabled !== enabled) {
                    if (enabled) {
                        this.enable();
                    } else {
                        this.disable();
                    }
                }


                syncCssClasses(this.container, this.opts.element, this.opts.adaptContainerCssClass);
                this.container.addClass(evaluate(this.opts.containerCssClass));

                syncCssClasses(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass);
                this.dropdown.addClass(evaluate(this.opts.dropdownCssClass));

            });

            // mozilla and IE
            el.bind("propertychange.select2 DOMAttrModified.select2", sync);
            // safari and chrome
            if (typeof WebKitMutationObserver !== "undefined") {
                if (this.propertyObserver) { delete this.propertyObserver; this.propertyObserver = null; }
                this.propertyObserver = new WebKitMutationObserver(function (mutations) {
                    mutations.forEach(sync);
                });
                this.propertyObserver.observe(el.get(0), { attributes:true, subtree:false });
            }
        },

        /**
         * Triggers the change event on the source element
         */
        // abstract
        triggerChange: function (details) {

            details = details || {};
            details= $.extend({}, details, { type: "change", val: this.val() });
            // prevents recursive triggering
            this.opts.element.data("select2-change-triggered", true);
            this.opts.element.trigger(details);
            this.opts.element.data("select2-change-triggered", false);

            // some validation frameworks ignore the change event and listen instead to keyup, click for selects
            // so here we trigger the click event manually
            this.opts.element.click();

            // ValidationEngine ignorea the change event and listens instead to blur
            // so here we trigger the blur event manually if so desired
            if (this.opts.blurOnChange)
                this.opts.element.blur();
        },

        // abstract
        enable: function() {
            if (this.enabled) return;

            this.enabled=true;
            this.container.removeClass("select2-container-disabled");
            this.opts.element.removeAttr("disabled");
        },

        // abstract
        disable: function() {
            if (!this.enabled) return;

            this.close();

            this.enabled=false;
            this.container.addClass("select2-container-disabled");
            this.opts.element.attr("disabled", "disabled");
        },

        // abstract
        opened: function () {
            return this.container.hasClass("select2-dropdown-open");
        },

        // abstract
        positionDropdown: function() {
            var offset = this.container.offset(),
                height = this.container.outerHeight(false),
                width = this.container.outerWidth(false),
                dropHeight = this.dropdown.outerHeight(false),
	            viewPortRight = $(window).scrollLeft() + $(window).width(),
                viewportBottom = $(window).scrollTop() + $(window).height(),
                dropTop = offset.top + height,
                dropLeft = offset.left,
                enoughRoomBelow = dropTop + dropHeight <= viewportBottom,
                enoughRoomAbove = (offset.top - dropHeight) >= this.body().scrollTop(),
	            dropWidth = this.dropdown.outerWidth(false),
	            enoughRoomOnRight = dropLeft + dropWidth <= viewPortRight,
                aboveNow = this.dropdown.hasClass("select2-drop-above"),
                bodyOffset,
                above,
                css;

            //console.log("below/ droptop:", dropTop, "dropHeight", dropHeight, "sum", (dropTop+dropHeight)+" viewport bottom", viewportBottom, "enough?", enoughRoomBelow);
            //console.log("above/ offset.top", offset.top, "dropHeight", dropHeight, "top", (offset.top-dropHeight), "scrollTop", this.body().scrollTop(), "enough?", enoughRoomAbove);

            // fix positioning when body has an offset and is not position: static

            if (this.body().css('position') !== 'static') {
                bodyOffset = this.body().offset();
                dropTop -= bodyOffset.top;
                dropLeft -= bodyOffset.left;
            }

            // always prefer the current above/below alignment, unless there is not enough room

            if (aboveNow) {
                above = true;
                if (!enoughRoomAbove && enoughRoomBelow) above = false;
            } else {
                above = false;
                if (!enoughRoomBelow && enoughRoomAbove) above = true;
            }

            if (!enoughRoomOnRight) {
               dropLeft = offset.left + width - dropWidth;
            }

            if (above) {
                dropTop = offset.top - dropHeight;
                this.container.addClass("select2-drop-above");
                this.dropdown.addClass("select2-drop-above");
            }
            else {
                this.container.removeClass("select2-drop-above");
                this.dropdown.removeClass("select2-drop-above");
            }

            css = $.extend({
                top: dropTop,
                left: dropLeft,
                width: width
            }, evaluate(this.opts.dropdownCss));

            this.dropdown.css(css);
        },

        // abstract
        shouldOpen: function() {
            var event;

            if (this.opened()) return false;

            event = $.Event("opening");
            this.opts.element.trigger(event);
            return !event.isDefaultPrevented();
        },

        // abstract
        clearDropdownAlignmentPreference: function() {
            // clear the classes used to figure out the preference of where the dropdown should be opened
            this.container.removeClass("select2-drop-above");
            this.dropdown.removeClass("select2-drop-above");
        },

        /**
         * Opens the dropdown
         *
         * @return {Boolean} whether or not dropdown was opened. This method will return false if, for example,
         * the dropdown is already open, or if the 'open' event listener on the element called preventDefault().
         */
        // abstract
        open: function () {

            if (!this.shouldOpen()) return false;

            window.setTimeout(this.bind(this.opening), 1);

            return true;
        },

        /**
         * Performs the opening of the dropdown
         */
        // abstract
        opening: function() {
            var cid = this.containerId,
                scroll = "scroll." + cid,
                resize = "resize."+cid,
                orient = "orientationchange."+cid,
                mask;

            this.clearDropdownAlignmentPreference();

            this.container.addClass("select2-dropdown-open").addClass("select2-container-active");


            if(this.dropdown[0] !== this.body().children().last()[0]) {
                this.dropdown.detach().appendTo(this.body());
            }

            this.updateResults(true);

            mask = $("#select2-drop-mask");

            // ensure the mask is always right before the dropdown
            if (this.dropdown.prev()[0] !== mask[0]) {
                this.dropdown.before(mask);
            }

            // move the global id to the correct dropdown
            $("#select2-drop").removeAttr("id");
            this.dropdown.attr("id", "select2-drop");

            // show the elements
            mask.css({
                width: document.documentElement.scrollWidth,
                height: document.documentElement.scrollHeight});
            mask.show();
            this.dropdown.show();
            this.positionDropdown();

            this.dropdown.addClass("select2-drop-active");
            this.ensureHighlightVisible();

            // attach listeners to events that can change the position of the container and thus require
            // the position of the dropdown to be updated as well so it does not come unglued from the container
            this.container.parents().add(window).each(function () {
                $(this).bind(resize+" "+scroll+" "+orient, function (e) {
                    $("#select2-drop-mask").css({
                        width:document.documentElement.scrollWidth,
                        height:document.documentElement.scrollHeight});
                    $("#select2-drop").data("select2").positionDropdown();
                });
            });

            this.focusSearch();
        },

        // abstract
        close: function () {
            if (!this.opened()) return;

            var cid = this.containerId,
                scroll = "scroll." + cid,
                resize = "resize."+cid,
                orient = "orientationchange."+cid;

            // unbind event listeners
            this.container.parents().add(window).each(function () { $(this).unbind(scroll).unbind(resize).unbind(orient); });

            this.clearDropdownAlignmentPreference();

            $("#select2-drop-mask").hide();
            this.dropdown.removeAttr("id"); // only the active dropdown has the select2-drop id
            this.dropdown.hide();
            this.container.removeClass("select2-dropdown-open");
            this.results.empty();
            this.clearSearch();

            this.opts.element.trigger($.Event("close"));
        },

        // abstract
        clearSearch: function () {

        },

        //abstract
        getMaximumSelectionSize: function() {
            return evaluate(this.opts.maximumSelectionSize);
        },

        // abstract
        ensureHighlightVisible: function () {
            var results = this.results, children, index, child, hb, rb, y, more;

            index = this.highlight();

            if (index < 0) return;

            if (index == 0) {

                // if the first element is highlighted scroll all the way to the top,
                // that way any unselectable headers above it will also be scrolled
                // into view

                results.scrollTop(0);
                return;
            }

            children = this.findHighlightableChoices();

            child = $(children[index]);

            hb = child.offset().top + child.outerHeight(true);

            // if this is the last child lets also make sure select2-more-results is visible
            if (index === children.length - 1) {
                more = results.find("li.select2-more-results");
                if (more.length > 0) {
                    hb = more.offset().top + more.outerHeight(true);
                }
            }

            rb = results.offset().top + results.outerHeight(true);
            if (hb > rb) {
                results.scrollTop(results.scrollTop() + (hb - rb));
            }
            y = child.offset().top - results.offset().top;

            // make sure the top of the element is visible
            if (y < 0 && child.css('display') != 'none' ) {
                results.scrollTop(results.scrollTop() + y); // y is negative
            }
        },

        // abstract
        findHighlightableChoices: function() {
            var h=this.results.find(".select2-result-selectable:not(.select2-selected):not(.select2-disabled)");
            return this.results.find(".select2-result-selectable:not(.select2-selected):not(.select2-disabled)");
        },

        // abstract
        moveHighlight: function (delta) {
            var choices = this.findHighlightableChoices(),
                index = this.highlight();

            while (index > -1 && index < choices.length) {
                index += delta;
                var choice = $(choices[index]);
                if (choice.hasClass("select2-result-selectable") && !choice.hasClass("select2-disabled") && !choice.hasClass("select2-selected")) {
                    this.highlight(index);
                    break;
                }
            }
        },

        // abstract
        highlight: function (index) {
            var choices = this.findHighlightableChoices(),
                choice,
                data;

            if (arguments.length === 0) {
                return indexOf(choices.filter(".select2-highlighted")[0], choices.get());
            }

            if (index >= choices.length) index = choices.length - 1;
            if (index < 0) index = 0;

            this.results.find(".select2-highlighted").removeClass("select2-highlighted");

            choice = $(choices[index]);
            choice.addClass("select2-highlighted");

            this.ensureHighlightVisible();

            data = choice.data("select2-data");
            if (data) {
                this.opts.element.trigger({ type: "highlight", val: this.id(data), choice: data });
            }
        },

        // abstract
        countSelectableResults: function() {
            return this.findHighlightableChoices().length;
        },

        // abstract
        highlightUnderEvent: function (event) {
            var el = $(event.target).closest(".select2-result-selectable");
            if (el.length > 0 && !el.is(".select2-highlighted")) {
        		var choices = this.findHighlightableChoices();
                this.highlight(choices.index(el));
            } else if (el.length == 0) {
                // if we are over an unselectable item remove al highlights
                this.results.find(".select2-highlighted").removeClass("select2-highlighted");
            }
        },

        // abstract
        loadMoreIfNeeded: function () {
            var results = this.results,
                more = results.find("li.select2-more-results"),
                below, // pixels the element is below the scroll fold, below==0 is when the element is starting to be visible
                offset = -1, // index of first element without data
                page = this.resultsPage + 1,
                self=this,
                term=this.search.val(),
                context=this.context;

            if (more.length === 0) return;
            below = more.offset().top - results.offset().top - results.height();

            if (below <= this.opts.loadMorePadding) {
                more.addClass("select2-active");
                this.opts.query({
                        element: this.opts.element,
                        term: term,
                        page: page,
                        context: context,
                        matcher: this.opts.matcher,
                        callback: this.bind(function (data) {

                    // ignore a response if the select2 has been closed before it was received
                    if (!self.opened()) return;


                    self.opts.populateResults.call(this, results, data.results, {term: term, page: page, context:context});

                    if (data.more===true) {
                        more.detach().appendTo(results).text(self.opts.formatLoadMore(page+1));
                        window.setTimeout(function() { self.loadMoreIfNeeded(); }, 10);
                    } else {
                        more.remove();
                    }
                    self.positionDropdown();
                    self.resultsPage = page;
                    self.context = data.context;
                })});
            }
        },

        /**
         * Default tokenizer function which does nothing
         */
        tokenize: function() {

        },

        /**
         * @param initial whether or not this is the call to this method right after the dropdown has been opened
         */
        // abstract
        updateResults: function (initial) {
            var search = this.search, results = this.results, opts = this.opts, data, self=this, input;

            // if the search is currently hidden we do not alter the results
            if (initial !== true && (this.showSearchInput === false || !this.opened())) {
                return;
            }

            search.addClass("select2-active");

            function postRender() {
                results.scrollTop(0);
                search.removeClass("select2-active");
                self.positionDropdown();
            }

            function render(html) {
                results.html(html);
                postRender();
            }

            var maxSelSize = this.getMaximumSelectionSize();
            if (maxSelSize >=1) {
                data = this.data();
                if ($.isArray(data) && data.length >= maxSelSize && checkFormatter(opts.formatSelectionTooBig, "formatSelectionTooBig")) {
            	    render("<li class='select2-selection-limit'>" + opts.formatSelectionTooBig(maxSelSize) + "</li>");
            	    return;
                }
            }

            if (search.val().length < opts.minimumInputLength) {
                if (checkFormatter(opts.formatInputTooShort, "formatInputTooShort")) {
                    render("<li class='select2-no-results'>" + opts.formatInputTooShort(search.val(), opts.minimumInputLength) + "</li>");
                } else {
                    render("");
                }
                return;
            }
            else if (opts.formatSearching() && initial===true) {
                render("<li class='select2-searching'>" + opts.formatSearching() + "</li>");
            }

            if (opts.maximumInputLength && search.val().length > opts.maximumInputLength) {
                if (checkFormatter(opts.formatInputTooLong, "formatInputTooLong")) {
                    render("<li class='select2-no-results'>" + opts.formatInputTooLong(search.val(), opts.maximumInputLength) + "</li>");
                } else {
                    render("");
                }
                return;
            }

            // give the tokenizer a chance to pre-process the input
            input = this.tokenize();
            if (input != undefined && input != null) {
                search.val(input);
            }

            this.resultsPage = 1;
            opts.query({
                element: opts.element,
                    term: search.val(),
                    page: this.resultsPage,
                    context: null,
                    matcher: opts.matcher,
                    callback: this.bind(function (data) {
                var def; // default choice

                // ignore a response if the select2 has been closed before it was received
                if (!this.opened()) return;

                // save context, if any
                this.context = (data.context===undefined) ? null : data.context;

                // create a default choice and prepend it to the list
                if (this.opts.createSearchChoice && search.val() !== "") {
                    def = this.opts.createSearchChoice.call(null, search.val(), data.results);
                    if (def !== undefined && def !== null && self.id(def) !== undefined && self.id(def) !== null) {
                        if ($(data.results).filter(
                            function () {
                                return equal(self.id(this), self.id(def));
                            }).length === 0) {
                            data.results.unshift(def);
                        }
                    }
                }

                if (data.results.length === 0 && checkFormatter(opts.formatNoMatches, "formatNoMatches")) {
                    render("<li class='select2-no-results'>" + opts.formatNoMatches(search.val()) + "</li>");
                    return;
                }

                results.empty();
                self.opts.populateResults.call(this, results, data.results, {term: search.val(), page: this.resultsPage, context:null});

                if (data.more === true && checkFormatter(opts.formatLoadMore, "formatLoadMore")) {
                    results.append("<li class='select2-more-results'>" + self.opts.escapeMarkup(opts.formatLoadMore(this.resultsPage)) + "</li>");
                    window.setTimeout(function() { self.loadMoreIfNeeded(); }, 10);
                }

                this.postprocessResults(data, initial);

                postRender();
            })});
        },

        // abstract
        cancel: function () {
            this.close();
        },

        // abstract
        blur: function () {
            // if selectOnBlur == true, select the currently highlighted option
            if (this.opts.selectOnBlur)
                this.selectHighlighted({noFocus: true});

            this.close();
            this.container.removeClass("select2-container-active");
            // synonymous to .is(':focus'), which is available in jquery >= 1.6
            if (this.search[0] === document.activeElement) { this.search.blur(); }
            this.clearSearch();
            this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus");
        },

        // abstract
        focusSearch: function () {
            focus(this.search);
        },

        // abstract
        selectHighlighted: function (options) {
            var index=this.highlight(),
                highlighted=this.results.find(".select2-highlighted"),
                data = highlighted.closest('.select2-result').data("select2-data");

            if (data) {
                this.highlight(index);
                this.onSelect(data, options);
            }
        },

        // abstract
        getPlaceholder: function () {

            // if a placeholder is specified on a select without the first empty option ignore it
            if (this.select) {
               if (this.select.find("option").first().text() !== "") {
                   return undefined;
               }
            }

            return this.opts.element.attr("placeholder") ||
                this.opts.element.attr("data-placeholder") || // jquery 1.4 compat
                this.opts.element.data("placeholder") ||
                this.opts.placeholder;
        },

        /**
         * Get the desired width for the container element.  This is
         * derived first from option `width` passed to select2, then
         * the inline 'style' on the original element, and finally
         * falls back to the jQuery calculated element width.
         */
        // abstract
        initContainerWidth: function () {
            function resolveContainerWidth() {
                var style, attrs, matches, i, l;

                if (this.opts.width === "off") {
                    return null;
                } else if (this.opts.width === "element"){
                    return this.opts.element.outerWidth(false) === 0 ? 'auto' : this.opts.element.outerWidth(false) + 'px';
                } else if (this.opts.width === "copy" || this.opts.width === "resolve") {
                    // check if there is inline style on the element that contains width
                    style = this.opts.element.attr('style');
                    if (style !== undefined) {
                        attrs = style.split(';');
                        for (i = 0, l = attrs.length; i < l; i = i + 1) {
                            matches = attrs[i].replace(/\s/g, '')
                                .match(/width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/);
                            if (matches !== null && matches.length >= 1)
                                return matches[1];
                        }
                    }

                    if (this.opts.width === "resolve") {
                        // next check if css('width') can resolve a width that is percent based, this is sometimes possible
                        // when attached to input type=hidden or elements hidden via css
                        style = this.opts.element.css('width');
                        if (style.indexOf("%") > 0) return style;

                        // finally, fallback on the calculated width of the element
                        return (this.opts.element.outerWidth(false) === 0 ? 'auto' : this.opts.element.outerWidth(false) + 'px');
                    }

                    return null;
                } else if ($.isFunction(this.opts.width)) {
                    return this.opts.width();
                } else {
                    return this.opts.width;
               }
            };

            var width = resolveContainerWidth.call(this);
            if (width !== null) {
                this.container.css("width", width);
            }
        }
    });

    SingleSelect2 = clazz(AbstractSelect2, {

        // single

		createContainer: function () {
            var container = $(document.createElement("div")).attr({
                "class": "select2-container"
            }).html([
                "<a href='javascript:void(0)' onclick='return false;' class='select2-choice' tabindex='-1'>",
                "   <span></span><abbr class='select2-search-choice-close' style='display:none;'>×</abbr>",
                "   <div><b></b></div>" ,
                "</a>",
                "<input class='select2-focusser select2-offscreen' type='text'/>",
                "<div class='select2-drop' style='display:none'>" ,
                "   <div class='select2-search'>" ,
                "       <input type='text' autocomplete='off' class='select2-input'/>" ,
                "   </div>" ,
                "   <ul class='select2-results'>" ,
                "   </ul>" ,
                "</div>"].join(""));
            return container;
        },

        // single
        disable: function() {
            if (!this.enabled) return;

            this.parent.disable.apply(this, arguments);

            this.focusser.attr("disabled", "disabled");
        },

        // single
        enable: function() {
            if (this.enabled) return;

            this.parent.enable.apply(this, arguments);

            this.focusser.removeAttr("disabled");
        },

        // single
        opening: function () {
            this.parent.opening.apply(this, arguments);
            this.focusser.attr("disabled", "disabled");

            this.opts.element.trigger($.Event("open"));
        },

        // single
        close: function () {
            if (!this.opened()) return;
            this.parent.close.apply(this, arguments);
            this.focusser.removeAttr("disabled");
            focus(this.focusser);
        },

        // single
        focus: function () {
            if (this.opened()) {
                this.close();
            } else {
                this.focusser.removeAttr("disabled");
                this.focusser.focus();
            }
        },

        // single
        isFocused: function () {
            return this.container.hasClass("select2-container-active");
        },

        // single
        cancel: function () {
            this.parent.cancel.apply(this, arguments);
            this.focusser.removeAttr("disabled");
            this.focusser.focus();
        },

        // single
        initContainer: function () {

            var selection,
                container = this.container,
                dropdown = this.dropdown,
                clickingInside = false;

            this.selection = selection = container.find(".select2-choice");

            this.focusser = container.find(".select2-focusser");

            this.search.bind("keydown", this.bind(function (e) {
                if (!this.enabled) return;

                if (e.which === KEY.PAGE_UP || e.which === KEY.PAGE_DOWN) {
                    // prevent the page from scrolling
                    killEvent(e);
                    return;
                }

                switch (e.which) {
                    case KEY.UP:
                    case KEY.DOWN:
                        this.moveHighlight((e.which === KEY.UP) ? -1 : 1);
                        killEvent(e);
                        return;
                    case KEY.TAB:
                    case KEY.ENTER:
                        this.selectHighlighted();
                        killEvent(e);
                        return;
                    case KEY.ESC:
                        this.cancel(e);
                        killEvent(e);
                        return;
                }
            }));

            this.focusser.bind("keydown", this.bind(function (e) {
                if (!this.enabled) return;

                if (e.which === KEY.TAB || KEY.isControl(e) || KEY.isFunctionKey(e) || e.which === KEY.ESC) {
                    return;
                }

                if (this.opts.openOnEnter === false && e.which === KEY.ENTER) {
                    killEvent(e);
                    return;
                }

                if (e.which == KEY.DOWN || e.which == KEY.UP
                    || (e.which == KEY.ENTER && this.opts.openOnEnter)) {
                    this.open();
                    killEvent(e);
                    return;
                }

                if (e.which == KEY.DELETE || e.which == KEY.BACKSPACE) {
                    if (this.opts.allowClear) {
                        this.clear();
                    }
                    killEvent(e);
                    return;
                }
            }));


            installKeyUpChangeEvent(this.focusser);
            this.focusser.bind("keyup-change input", this.bind(function(e) {
                if (this.opened()) return;
                this.open();
                this.search.val(this.focusser.val());
                this.focusser.val("");
                killEvent(e);
            }));

            selection.delegate("abbr", "mousedown", this.bind(function (e) {
                if (!this.enabled) return;
                this.clear();
                killEventImmediately(e);
                this.close();
                this.triggerChange();
                this.selection.focus();
            }));

            selection.bind("mousedown", this.bind(function (e) {
                clickingInside = true;

                if (this.opened()) {
                    this.close();
                } else if (this.enabled) {
                    this.open();
                }

                killEvent(e);

                clickingInside = false;
            }));

            dropdown.bind("mousedown", this.bind(function() { this.search.focus(); }));

            selection.bind("focus", this.bind(function(e) {
                killEvent(e);
            }));

            this.focusser.bind("focus", this.bind(function(){
                this.container.addClass("select2-container-active");
            })).bind("blur", this.bind(function() {
                if (!this.opened()) {
                    this.container.removeClass("select2-container-active");
                }
            }));
            this.search.bind("focus", this.bind(function(){
                this.container.addClass("select2-container-active");
            }))
            this.setPlaceholder();

        },

        // single
        clear: function() {
            var data=this.selection.data("select2-data");
            this.opts.element.val("");
            this.selection.find("span").empty();
            this.selection.removeData("select2-data");
            this.setPlaceholder();

            this.opts.element.trigger({ type: "removed", val: this.id(data), choice: data });
            this.triggerChange({removed:data});
        },

        /**
         * Sets selection based on source element's value
         */
        // single
        initSelection: function () {
            var selected;
            if (this.opts.element.val() === "" && this.opts.element.text() === "") {
                this.close();
                this.setPlaceholder();
            } else {
                var self = this;
                this.opts.initSelection.call(null, this.opts.element, function(selected){
                    if (selected !== undefined && selected !== null) {
                        self.updateSelection(selected);
                        self.close();
                        self.setPlaceholder();
                    }
                });
            }
        },

        // single
        prepareOpts: function () {
            var opts = this.parent.prepareOpts.apply(this, arguments);

            if (opts.element.get(0).tagName.toLowerCase() === "select") {
                // install the selection initializer
                opts.initSelection = function (element, callback) {
                    var selected = element.find(":selected");
                    // a single select box always has a value, no need to null check 'selected'
                    if ($.isFunction(callback))
                        callback({id: selected.attr("value") || selected.text(), text: selected.text(), element:selected});
                };
            } else if ("data" in opts) {
                // install default initSelection when applied to hidden input and data is local
                opts.initSelection = opts.initSelection || function (element, callback) {
                    var id = element.val();
                    //search in data by id
                    opts.query({
                        matcher: function(term, text, el){
                            return equal(id, opts.id(el));
                        },
                        callback: !$.isFunction(callback) ? $.noop : function(filtered) {
                            callback(filtered.results.length ? filtered.results[0] : null);
                        }
                    });
                };
            }

            return opts;
        },

        // single
        setPlaceholder: function () {
            var placeholder = this.getPlaceholder();

            if (this.opts.element.val() === "" && placeholder !== undefined) {

                // check for a first blank option if attached to a select
                if (this.select && this.select.find("option:first").text() !== "") return;

                this.selection.find("span").html(this.opts.escapeMarkup(placeholder));

                this.selection.addClass("select2-default");

                this.selection.find("abbr").hide();
            }
        },

        // single
        postprocessResults: function (data, initial) {
            var selected = 0, self = this, showSearchInput = true;

            // find the selected element in the result list

            this.findHighlightableChoices().each2(function (i, elm) {
                if (equal(self.id(elm.data("select2-data")), self.opts.element.val())) {
                    selected = i;
                    return false;
                }
            });

            // and highlight it

            this.highlight(selected);

            // hide the search box if this is the first we got the results and there are a few of them

            if (initial === true) {
                showSearchInput = this.showSearchInput = countResults(data.results) >= this.opts.minimumResultsForSearch;
                this.dropdown.find(".select2-search")[showSearchInput ? "removeClass" : "addClass"]("select2-search-hidden");

                //add "select2-with-searchbox" to the container if search box is shown
                $(this.dropdown, this.container)[showSearchInput ? "addClass" : "removeClass"]("select2-with-searchbox");
            }

        },

        // single
        onSelect: function (data, options) {
            var old = this.opts.element.val();

            this.opts.element.val(this.id(data));
            this.updateSelection(data);

            this.opts.element.trigger({ type: "selected", val: this.id(data), choice: data });

            this.close();

            if (!options || !options.noFocus)
                this.selection.focus();

            if (!equal(old, this.id(data))) { this.triggerChange(); }
        },

        // single
        updateSelection: function (data) {

            var container=this.selection.find("span"), formatted;

            this.selection.data("select2-data", data);

            container.empty();
            formatted=this.opts.formatSelection(data, container);
            if (formatted !== undefined) {
                container.append(this.opts.escapeMarkup(formatted));
            }

            this.selection.removeClass("select2-default");

            if (this.opts.allowClear && this.getPlaceholder() !== undefined) {
                this.selection.find("abbr").show();
            }
        },

        // single
        val: function () {
            var val, triggerChange = false, data = null, self = this;

            if (arguments.length === 0) {
                return this.opts.element.val();
            }

            val = arguments[0];

            if (arguments.length > 1) {
                triggerChange = arguments[1];
            }

            if (this.select) {
                this.select
                    .val(val)
                    .find(":selected").each2(function (i, elm) {
                        data = {id: elm.attr("value") || elm.text(), text: elm.text()};
                        return false;
                    });
                this.updateSelection(data);
                this.setPlaceholder();
                if (triggerChange) {
                    this.triggerChange();
                }
            } else {
                if (this.opts.initSelection === undefined) {
                    throw new Error("cannot call val() if initSelection() is not defined");
                }
                // val is an id. !val is true for [undefined,null,'',0] - 0 is legal
                if (!val && val !== 0) {
                    this.clear();
                    if (triggerChange) {
                        this.triggerChange();
                    }
                    return;
                }
                this.opts.element.val(val);
                this.opts.initSelection(this.opts.element, function(data){
                    self.opts.element.val(!data ? "" : self.id(data));
                    self.updateSelection(data);
                    self.setPlaceholder();
                    if (triggerChange) {
                        self.triggerChange();
                    }
                });
            }
        },

        // single
        clearSearch: function () {
            this.search.val("");
            this.focusser.val("");
        },

        // single
        data: function(value) {
            var data;

            if (arguments.length === 0) {
                data = this.selection.data("select2-data");
                if (data == undefined) data = null;
                return data;
            } else {
                if (!value || value === "") {
                    this.clear();
                } else {
                    this.opts.element.val(!value ? "" : this.id(value));
                    this.updateSelection(value);
                }
            }
        }
    });

    MultiSelect2 = clazz(AbstractSelect2, {

        // multi
        createContainer: function () {
            var container = $(document.createElement("div")).attr({
                "class": "select2-container select2-container-multi"
            }).html([
                "    <ul class='select2-choices'>",
                //"<li class='select2-search-choice'><span>California</span><a href="javascript:void(0)" class="select2-search-choice-close"></a></li>" ,
                "  <li class='select2-search-field'>" ,
                "    <input type='text' autocomplete='off' class='select2-input'>" ,
                "  </li>" ,
                "</ul>" ,
                "<div class='select2-drop select2-drop-multi' style='display:none;'>" ,
                "   <ul class='select2-results'>" ,
                "   </ul>" ,
                "</div>"].join(""));
			return container;
        },

        // multi
        prepareOpts: function () {
            var opts = this.parent.prepareOpts.apply(this, arguments);

            // TODO validate placeholder is a string if specified

            if (opts.element.get(0).tagName.toLowerCase() === "select") {
                // install sthe selection initializer
                opts.initSelection = function (element, callback) {

                    var data = [];

                    element.find(":selected").each2(function (i, elm) {
                        data.push({id: elm.attr("value") || elm.text(), text: elm.text(), element: elm[0]});
                    });
                    callback(data);
                };
            } else if ("data" in opts) {
                // install default initSelection when applied to hidden input and data is local
                opts.initSelection = opts.initSelection || function (element, callback) {
                    var ids = splitVal(element.val(), opts.separator);
                    //search in data by array of ids
                    opts.query({
                        matcher: function(term, text, el){
                            return $.grep(ids, function(id) {
                                return equal(id, opts.id(el));
                            }).length;
                        },
                        callback: !$.isFunction(callback) ? $.noop : function(filtered) {
                            callback(filtered.results);
                        }
                    });
                };
            }

            return opts;
        },

        // multi
        initContainer: function () {

            var selector = ".select2-choices", selection;

            this.searchContainer = this.container.find(".select2-search-field");
            this.selection = selection = this.container.find(selector);

            this.search.bind("input paste", this.bind(function() {
                if (!this.enabled) return;
                if (!this.opened()) {
                    this.open();
                }
            }));

            this.search.bind("keydown", this.bind(function (e) {
                if (!this.enabled) return;

                if (e.which === KEY.BACKSPACE && this.search.val() === "") {
                    this.close();

                    var choices,
                        selected = selection.find(".select2-search-choice-focus");
                    if (selected.length > 0) {
                        this.unselect(selected.first());
                        this.search.width(10);
                        killEvent(e);
                        return;
                    }

                    choices = selection.find(".select2-search-choice:not(.select2-locked)");
                    if (choices.length > 0) {
                        choices.last().addClass("select2-search-choice-focus");
                    }
                } else {
                    selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus");
                }

                if (this.opened()) {
                    switch (e.which) {
                    case KEY.UP:
                    case KEY.DOWN:
                        this.moveHighlight((e.which === KEY.UP) ? -1 : 1);
                        killEvent(e);
                        return;
                    case KEY.ENTER:
                    case KEY.TAB:
                        this.selectHighlighted();
                        killEvent(e);
                        return;
                    case KEY.ESC:
                        this.cancel(e);
                        killEvent(e);
                        return;
                    }
                }

                if (e.which === KEY.TAB || KEY.isControl(e) || KEY.isFunctionKey(e)
                 || e.which === KEY.BACKSPACE || e.which === KEY.ESC) {
                    return;
                }

                if (e.which === KEY.ENTER) {
                    if (this.opts.openOnEnter === false) {
                        return;
                    } else if (e.altKey || e.ctrlKey || e.shiftKey || e.metaKey) {
                        return;
                    }
                }

                this.open();

                if (e.which === KEY.PAGE_UP || e.which === KEY.PAGE_DOWN) {
                    // prevent the page from scrolling
                    killEvent(e);
                }
            }));

            this.search.bind("keyup", this.bind(this.resizeSearch));

            this.search.bind("blur", this.bind(function(e) {
                this.container.removeClass("select2-container-active");
                this.search.removeClass("select2-focused");
                if (!this.opened()) this.clearSearch();
                e.stopImmediatePropagation();
            }));

            this.container.delegate(selector, "mousedown", this.bind(function (e) {
                if (!this.enabled) return;
                if ($(e.target).closest(".select2-search-choice").length > 0) {
                    // clicked inside a select2 search choice, do not open
                    return;
                }
                this.clearPlaceholder();
                this.open();
                this.focusSearch();
                e.preventDefault();
            }));

            this.container.delegate(selector, "focus", this.bind(function () {
                if (!this.enabled) return;
                this.container.addClass("select2-container-active");
                this.dropdown.addClass("select2-drop-active");
                this.clearPlaceholder();
            }));

            // set the placeholder if necessary
            this.clearSearch();
        },

        // multi
        enable: function() {
            if (this.enabled) return;

            this.parent.enable.apply(this, arguments);

            this.search.removeAttr("disabled");
        },

        // multi
        disable: function() {
            if (!this.enabled) return;

            this.parent.disable.apply(this, arguments);

            this.search.attr("disabled", true);
        },

        // multi
        initSelection: function () {
            var data;
            if (this.opts.element.val() === "" && this.opts.element.text() === "") {
                this.updateSelection([]);
                this.close();
                // set the placeholder if necessary
                this.clearSearch();
            }
            if (this.select || this.opts.element.val() !== "") {
                var self = this;
                this.opts.initSelection.call(null, this.opts.element, function(data){
                    if (data !== undefined && data !== null) {
                        self.updateSelection(data);
                        self.close();
                        // set the placeholder if necessary
                        self.clearSearch();
                    }
                });
            }
        },

        // multi
        clearSearch: function () {
            var placeholder = this.getPlaceholder();

            if (placeholder !== undefined  && this.getVal().length === 0 && this.search.hasClass("select2-focused") === false) {
                this.search.val(placeholder).addClass("select2-default");
                // stretch the search box to full width of the container so as much of the placeholder is visible as possible
                this.resizeSearch();
            } else {
                this.search.val("").width(10);
            }
        },

        // multi
        clearPlaceholder: function () {
            if (this.search.hasClass("select2-default")) {
                this.search.val("").removeClass("select2-default");
            }
        },

        // multi
        opening: function () {
            this.parent.opening.apply(this, arguments);

            this.clearPlaceholder();
			this.resizeSearch();
            this.focusSearch();

            this.opts.element.trigger($.Event("open"));
        },

        // multi
        close: function () {
            if (!this.opened()) return;
            this.parent.close.apply(this, arguments);
        },

        // multi
        focus: function () {
            this.close();
            this.search.focus();
            this.opts.element.triggerHandler("focus");
        },

        // multi
        isFocused: function () {
            return this.search.hasClass("select2-focused");
        },

        // multi
        updateSelection: function (data) {
            var ids = [], filtered = [], self = this;

            // filter out duplicates
            $(data).each(function () {
                if (indexOf(self.id(this), ids) < 0) {
                    ids.push(self.id(this));
                    filtered.push(this);
                }
            });
            data = filtered;

            this.selection.find(".select2-search-choice").remove();
            $(data).each(function () {
                self.addSelectedChoice(this);
            });
            self.postprocessResults();
        },

        tokenize: function() {
            var input = this.search.val();
            input = this.opts.tokenizer(input, this.data(), this.bind(this.onSelect), this.opts);
            if (input != null && input != undefined) {
                this.search.val(input);
                if (input.length > 0) {
                    this.open();
                }
            }

        },

        // multi
        onSelect: function (data, options) {
            this.addSelectedChoice(data);

            this.opts.element.trigger({ type: "selected", val: this.id(data), choice: data });

            if (this.select || !this.opts.closeOnSelect) this.postprocessResults();

            if (this.opts.closeOnSelect) {
                this.close();
                this.search.width(10);
            } else {
                if (this.countSelectableResults()>0) {
                    this.search.width(10);
                    this.resizeSearch();
                    if (this.val().length >= this.getMaximumSelectionSize()) {
                        // if we reached max selection size repaint the results so choices
                        // are replaced with the max selection reached message
                        this.updateResults(true);
                    }
                    this.positionDropdown();
                } else {
                    // if nothing left to select close
                    this.close();
                    this.search.width(10);
                }
            }

            // since its not possible to select an element that has already been
            // added we do not need to check if this is a new element before firing change
            this.triggerChange({ added: data });

            if (!options || !options.noFocus)
                this.focusSearch();
        },

        // multi
        cancel: function () {
            this.close();
            this.focusSearch();
        },

        addSelectedChoice: function (data) {
            var enableChoice = !data.locked,
                enabledItem = $(
                    "<li class='select2-search-choice'>" +
                    "    <div></div>" +
                    "    <a href='#' onclick='return false;' class='select2-search-choice-close' tabindex='-1'>×</a>" +
                    "</li>"),
                disabledItem = $(
                    "<li class='select2-search-choice select2-locked'>" +
                    "<div></div>" +
                    "</li>");
            var choice = enableChoice ? enabledItem : disabledItem,
                id = this.id(data),
                val = this.getVal(),
                formatted;

            formatted=this.opts.formatSelection(data, choice.find("div"));
            if (formatted != undefined) {
                choice.find("div").replaceWith("<div>"+this.opts.escapeMarkup(formatted)+"</div>");
            }

            if(enableChoice){
              choice.find(".select2-search-choice-close")
                  .bind("mousedown", killEvent)
                  .bind("click dblclick", this.bind(function (e) {
                  if (!this.enabled) return;

                  $(e.target).closest(".select2-search-choice").fadeOut('fast', this.bind(function(){
                      this.unselect($(e.target));
                      this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus");
                      this.close();
                      this.focusSearch();
                  })).dequeue();
                  killEvent(e);
              })).bind("focus", this.bind(function () {
                  if (!this.enabled) return;
                  this.container.addClass("select2-container-active");
                  this.dropdown.addClass("select2-drop-active");
              }));
            }

            choice.data("select2-data", data);
            choice.insertBefore(this.searchContainer);

            val.push(id);
            this.setVal(val);
        },

        // multi
        unselect: function (selected) {
            var val = this.getVal(),
                data,
                index;

            selected = selected.closest(".select2-search-choice");

            if (selected.length === 0) {
                throw "Invalid argument: " + selected + ". Must be .select2-search-choice";
            }

            data = selected.data("select2-data");

            if (!data) {
                // prevent a race condition when the 'x' is clicked really fast repeatedly the event can be queued
                // and invoked on an element already removed
                return;
            }

            index = indexOf(this.id(data), val);

            if (index >= 0) {
                val.splice(index, 1);
                this.setVal(val);
                if (this.select) this.postprocessResults();
            }
            selected.remove();

            this.opts.element.trigger({ type: "removed", val: this.id(data), choice: data });
            this.triggerChange({ removed: data });
        },

        // multi
        postprocessResults: function () {
            var val = this.getVal(),
                choices = this.results.find(".select2-result"),
                compound = this.results.find(".select2-result-with-children"),
                self = this;

            choices.each2(function (i, choice) {
                var id = self.id(choice.data("select2-data"));
                if (indexOf(id, val) >= 0) {
                    choice.addClass("select2-selected");
                    // mark all children of the selected parent as selected
                    choice.find(".select2-result-selectable").addClass("select2-selected");
                }
            });

            compound.each2(function(i, choice) {
                // hide an optgroup if it doesnt have any selectable children
                if (!choice.is('.select2-result-selectable')
                    && choice.find(".select2-result-selectable:not(.select2-selected)").length === 0) {
                    choice.addClass("select2-selected");
                }
            });

            if (this.highlight() == -1){
                self.highlight(0);
            }

        },

        // multi
        resizeSearch: function () {

            var minimumWidth, left, maxWidth, containerLeft, searchWidth,
            	sideBorderPadding = getSideBorderPadding(this.search);

            minimumWidth = measureTextWidth(this.search) + 10;

            left = this.search.offset().left;

            maxWidth = this.selection.width();
            containerLeft = this.selection.offset().left;

            searchWidth = maxWidth - (left - containerLeft) - sideBorderPadding;
            if (searchWidth < minimumWidth) {
                searchWidth = maxWidth - sideBorderPadding;
            }

            if (searchWidth < 40) {
                searchWidth = maxWidth - sideBorderPadding;
            }

            if (searchWidth <= 0) {
              searchWidth = minimumWidth;
            }

            this.search.width(searchWidth);
        },

        // multi
        getVal: function () {
            var val;
            if (this.select) {
                val = this.select.val();
                return val === null ? [] : val;
            } else {
                val = this.opts.element.val();
                return splitVal(val, this.opts.separator);
            }
        },

        // multi
        setVal: function (val) {
            var unique;
            if (this.select) {
                this.select.val(val);
            } else {
                unique = [];
                // filter out duplicates
                $(val).each(function () {
                    if (indexOf(this, unique) < 0) unique.push(this);
                });
                this.opts.element.val(unique.length === 0 ? "" : unique.join(this.opts.separator));
            }
        },

        // multi
        val: function () {
            var val, triggerChange = false, data = [], self=this;

            if (arguments.length === 0) {
                return this.getVal();
            }

            val = arguments[0];

            if (arguments.length > 1) {
                triggerChange = arguments[1];
            }

            // val is an id. !val is true for [undefined,null,'',0] - 0 is legal
            if (!val && val !== 0) {
                this.opts.element.val("");
                this.updateSelection([]);
                this.clearSearch();
                if (triggerChange) {
                    this.triggerChange();
                }
                return;
            }

            // val is a list of ids
            this.setVal(val);

            if (this.select) {
                this.opts.initSelection(this.select, this.bind(this.updateSelection));
                if (triggerChange) {
                    this.triggerChange();
                }
            } else {
                if (this.opts.initSelection === undefined) {
                    throw new Error("val() cannot be called if initSelection() is not defined");
                }

                this.opts.initSelection(this.opts.element, function(data){
                    var ids=$(data).map(self.id);
                    self.setVal(ids);
                    self.updateSelection(data);
                    self.clearSearch();
                    if (triggerChange) {
                        self.triggerChange();
                    }
                });
            }
            this.clearSearch();
        },

        // multi
        onSortStart: function() {
            if (this.select) {
                throw new Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");
            }

            // collapse search field into 0 width so its container can be collapsed as well
            this.search.width(0);
            // hide the container
            this.searchContainer.hide();
        },

        // multi
        onSortEnd:function() {

            var val=[], self=this;

            // show search and move it to the end of the list
            this.searchContainer.show();
            // make sure the search container is the last item in the list
            this.searchContainer.appendTo(this.searchContainer.parent());
            // since we collapsed the width in dragStarted, we resize it here
            this.resizeSearch();

            // update selection

            this.selection.find(".select2-search-choice").each(function() {
                val.push(self.opts.id($(this).data("select2-data")));
            });
            this.setVal(val);
            this.triggerChange();
        },

        // multi
        data: function(values) {
            var self=this, ids;
            if (arguments.length === 0) {
                 return this.selection
                     .find(".select2-search-choice")
                     .map(function() { return $(this).data("select2-data"); })
                     .get();
            } else {
                if (!values) { values = []; }
                ids = $.map(values, function(e) { return self.opts.id(e); });
                this.setVal(ids);
                this.updateSelection(values);
                this.clearSearch();
            }
        }
    });

    $.fn.select2 = function () {

        var args = Array.prototype.slice.call(arguments, 0),
            opts,
            select2,
            value, multiple, allowedMethods = ["val", "destroy", "opened", "open", "close", "focus", "isFocused", "container", "onSortStart", "onSortEnd", "enable", "disable", "positionDropdown", "data"];

        this.each(function () {
            if (args.length === 0 || typeof(args[0]) === "object") {
                opts = args.length === 0 ? {} : $.extend({}, args[0]);
                opts.element = $(this);

                if (opts.element.get(0).tagName.toLowerCase() === "select") {
                    multiple = opts.element.attr("multiple");
                } else {
                    multiple = opts.multiple || false;
                    if ("tags" in opts) {opts.multiple = multiple = true;}
                }

                select2 = multiple ? new MultiSelect2() : new SingleSelect2();
                select2.init(opts);
            } else if (typeof(args[0]) === "string") {

                if (indexOf(args[0], allowedMethods) < 0) {
                    throw "Unknown method: " + args[0];
                }

                value = undefined;
                select2 = $(this).data("select2");
                if (select2 === undefined) return;
                if (args[0] === "container") {
                    value=select2.container;
                } else {
                    value = select2[args[0]].apply(select2, args.slice(1));
                }
                if (value !== undefined) {return false;}
            } else {
                throw "Invalid arguments to select2 plugin: " + args;
            }
        });
        return (value === undefined) ? this : value;
    };

    // plugin defaults, accessible to users
    $.fn.select2.defaults = {
        width: "copy",
        loadMorePadding: 0,
        closeOnSelect: true,
        openOnEnter: true,
        containerCss: {},
        dropdownCss: {},
        containerCssClass: "",
        dropdownCssClass: "",
        formatResult: function(result, container, query, escapeMarkup) {
            var markup=[];
            markMatch(result.text, query.term, markup, escapeMarkup);
            return markup.join("");
        },
        formatSelection: function (data, container) {
            return data ? data.text : undefined;
        },
        sortResults: function (results, container, query) {
            return results;
        },
        formatResultCssClass: function(data) {return undefined;},
        formatNoMatches: function () { return "No hay ocurrencias"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Escribe " + n + " caracter(es) más" + (n == 1? "" : "s"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Elimina " + n + " caracter(es) " + (n == 1? "" : "s"); },
        formatSelectionTooBig: function (limit) { return "Solo puedes elegir " + limit + " items" + (limit == 1 ? "" : "s"); },
        formatLoadMore: function (pageNumber) { return "Cargando más resultados..."; },
        formatSearching: function () { return "Buscando..."; },
        minimumResultsForSearch: 0,
        minimumInputLength: 0,
        maximumInputLength: null,
        maximumSelectionSize: 0,
        id: function (e) { return e.id; },
        matcher: function(term, text) {
            return text.toUpperCase().indexOf(term.toUpperCase()) >= 0;
        },
        separator: ",",
        tokenSeparators: [],
        tokenizer: defaultTokenizer,
        escapeMarkup: function (markup) {
            var replace_map = {
                '\\': '&#92;',
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&apos;',
                "/": '&#47;'
            };

            return String(markup).replace(/[&<>"'/\\]/g, function (match) {
                    return replace_map[match[0]];
            });
        },
        blurOnChange: false,
        selectOnBlur: false,
        adaptContainerCssClass: function(c) { return c; },
        adaptDropdownCssClass: function(c) { return null; }
    };

    // exports
    window.Select2 = {
        query: {
            ajax: ajax,
            local: local,
            tags: tags
        }, util: {
            debounce: debounce,
            markMatch: markMatch
        }, "class": {
            "abstract": AbstractSelect2,
            "single": SingleSelect2,
            "multi": MultiSelect2
        }
    };

}(jQuery));/* Start angularLocalStorage */

var angularLocalStorage = angular.module('LocalStorageModule', []);

// You should set a prefix to avoid overwriting any local storage variables from the rest of your app
// e.g. angularLocalStorage.constant('prefix', 'youAppName');
angularLocalStorage.constant('prefix', 'axoggi');
// Cookie options (usually in case of fallback)
// expiry = Number of days before cookies expire // 0 = Does not expire
// path = The web path the cookie represents
angularLocalStorage.constant('cookie', { expiry:30, path: '/'});
angularLocalStorage.constant('notify', { setItem: true, removeItem: false} );

angularLocalStorage.service('localStorageService', [
  '$rootScope',
  'prefix',
  'cookie',
  'notify',
  function($rootScope, prefix, cookie, notify) {

  // If there is a prefix set in the config lets use that with an appended period for readability
  //var prefix = angularLocalStorage.constant;
  if (prefix.substr(-1)!=='.') {
    prefix = !!prefix ? prefix + '.' : '';
  }

  // Checks the browser to see if local storage is supported
  var browserSupportsLocalStorage = function () {
    try {
        return ('localStorage' in window && window['localStorage'] !== null);
    } catch (e) {
        $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
        return false;
    }
  };

  // Directly adds a value to local storage
  // If local storage is not available in the browser use cookies
  // Example use: localStorageService.add('library','angular');
  var addToLocalStorage = function (key, value) {

    // If this browser does not support local storage use cookies
    if (!browserSupportsLocalStorage()) {
      $rootScope.$broadcast('LocalStorageModule.notification.warning','LOCAL_STORAGE_NOT_SUPPORTED');
      if (notify.setItem) {
        $rootScope.$broadcast('LocalStorageModule.notification.setitem', {key: key, newvalue: value, storageType: 'cookie'});
      }
      return addToCookies(key, value);
    }

    // 0 and "" is allowed as a value but let's limit other falsey values like "undefined"
    if (!value && value!==0 && value!=="") return false;

    try {
      localStorage.setItem(prefix+key, value);
      if (notify.setItem) {
        $rootScope.$broadcast('LocalStorageModule.notification.setitem', {key: key, newvalue: value, storageType: 'localStorage'});
      }
    } catch (e) {
      $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
      return addToCookies(key, value);
    }
    return true;
  };

  // Directly get a value from local storage
  // Example use: localStorageService.get('library'); // returns 'angular'
  var getFromLocalStorage = function (key) {
    if (!browserSupportsLocalStorage()) {
      $rootScope.$broadcast('LocalStorageModule.notification.warning','LOCAL_STORAGE_NOT_SUPPORTED');
      return getFromCookies(key);
    }

    var item = localStorage.getItem(prefix+key);
    if (!item) return null;
    return item;
  };

  // Remove an item from local storage
  // Example use: localStorageService.remove('library'); // removes the key/value pair of library='angular'
  var removeFromLocalStorage = function (key) {
    if (!browserSupportsLocalStorage()) {
      $rootScope.$broadcast('LocalStorageModule.notification.warning','LOCAL_STORAGE_NOT_SUPPORTED');
       if (notify.removeItem) {
        $rootScope.$broadcast('LocalStorageModule.notification.removeitem', {key: key, storageType: 'cookie'});
      }
      return removeFromCookies(key);
    }

    try {
      localStorage.removeItem(prefix+key);
      if (notify.removeItem) {
        $rootScope.$broadcast('LocalStorageModule.notification.removeitem', {key: key, storageType: 'localStorage'});
      }
    } catch (e) {
      $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
      return removeFromCookies(key);
    }
    return true;
  };

  // Remove all data for this app from local storage
  // Example use: localStorageService.clearAll();
  // Should be used mostly for development purposes
  var clearAllFromLocalStorage = function () {

    if (!browserSupportsLocalStorage()) {
      $rootScope.$broadcast('LocalStorageModule.notification.warning','LOCAL_STORAGE_NOT_SUPPORTED');
      return clearAllFromCookies();
    }

    var prefixLength = prefix.length;

    for (var key in localStorage) {
      // Only remove items that are for this app
      if (key.substr(0,prefixLength) === prefix) {
        try {
          removeFromLocalStorage(key.substr(prefixLength));
        } catch (e) {
          $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
          return clearAllFromCookies();
        }
      }
    }
    return true;
  };

  // Checks the browser to see if cookies are supported
  var browserSupportsCookies = function() {
    try {
      return navigator.cookieEnabled ||
        ("cookie" in document && (document.cookie.length > 0 ||
        (document.cookie = "test").indexOf.call(document.cookie, "test") > -1));
    } catch (e) {
      $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
      return false;
    }
  };

  // Directly adds a value to cookies
  // Typically used as a fallback is local storage is not available in the browser
  // Example use: localStorageService.cookie.add('library','angular');
  var addToCookies = function (key, value) {

    if (typeof value == "undefined") return false;

    if (!browserSupportsCookies()) {
      $rootScope.$broadcast('LocalStorageModule.notification.error','COOKIES_NOT_SUPPORTED');
      return false;
    }

    try {
      var expiry = '', expiryDate = new Date();
      if (value === null) {
        cookie.expiry = -1;
        value = '';
      }
      if (cookie.expiry !== 0) {
        expiryDate.setTime(expiryDate.getTime() + (cookie.expiry*24*60*60*1000));
        expiry = ", expires="+expiryDate.toGMTString();
      }
      if (!!key) {
        document.cookie = prefix + key + "=" + encodeURIComponent(value) + expiry + ", path="+cookie.path;
      }
    } catch (e) {
      $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
      return false;
    }
    return true;
  };

  // Directly get a value from a cookie
  // Example use: localStorageService.cookie.get('library'); // returns 'angular'
  var getFromCookies = function (key) {
    if (!browserSupportsCookies()) {
      $rootScope.$broadcast('LocalStorageModule.notification.error','COOKIES_NOT_SUPPORTED');
      return false;
    }

    var cookies = document.cookie.split(',');
    for(var i=0;i < cookies.length;i++) {
      var thisCookie = cookies[i];
      while (thisCookie.charAt(0)==' ') {
        thisCookie = thisCookie.substring(1,thisCookie.length);
      }
      if (thisCookie.indexOf(prefix+key+'=') === 0) {
        return decodeURIComponent(thisCookie.substring(prefix.length+key.length+1,thisCookie.length));
      }
    }
    return null;
  };

  var removeFromCookies = function (key) {
    addToCookies(key,null);
  };

  var clearAllFromCookies = function () {
    var thisCookie = null, thisKey = null;
    var prefixLength = prefix.length;
    var cookies = document.cookie.split(';');
    for(var i=0;i < cookies.length;i++) {
      thisCookie = cookies[i];
      while (thisCookie.charAt(0)==' ') {
        thisCookie = thisCookie.substring(1,thisCookie.length);
      }
      key = thisCookie.substring(prefixLength,thisCookie.indexOf('='));
      removeFromCookies(key);
    }
  };

  // JSON stringify functions based on https://developer.mozilla.org/en-US/docs/JavaScript/Reference/Global_Objects/JSON
  var stringifyJson = function (vContent, isJSON) {
    // If this is only a string and not a string in a recursive run of an object then let's return the string unadulterated
    if (typeof vContent === "string" && vContent.charAt(0) !== "{" && !isJSON) {
      return vContent;
    }
    if (vContent instanceof Object) {
      var sOutput = "";
      if (vContent.constructor === Array) {
        for (var nId = 0; nId < vContent.length; sOutput += this.stringifyJson(vContent[nId], true) + ",", nId++);
        return "[" + sOutput.substr(0, sOutput.length - 1) + "]";
      }
      if (vContent.toString !== Object.prototype.toString) { return "\"" + vContent.toString().replace(/"/g, "\\$&") + "\""; }
      for (var sProp in vContent) { sOutput += "\"" + sProp.replace(/"/g, "\\$&") + "\":" + this.stringifyJson(vContent[sProp], true) + ","; }
      return "{" + sOutput.substr(0, sOutput.length - 1) + "}";
    }
    return typeof vContent === "string" ? "\"" + vContent.replace(/"/g, "\\$&") + "\"" : String(vContent);
  };

  var parseJson = function (sJSON) {
    if (sJSON.charAt(0)!=='{') {
      return sJSON;
    }
    return eval("(" + sJSON + ")");
  };

  return {
    isSupported: browserSupportsLocalStorage,
    add: addToLocalStorage,
    get: getFromLocalStorage,
    remove: removeFromLocalStorage,
    clearAll: clearAllFromLocalStorage,
    stringifyJson: stringifyJson,
    parseJson: parseJson,
    cookie: {
      add: addToCookies,
      get: getFromCookies,
      remove: removeFromCookies,
      clearAll: clearAllFromCookies
    }
  };

}]);
/**
 * http://github.com/valums/file-uploader
 * 
 * Multiple file upload component with progress-bar, drag-and-drop. 
 * © 2010 Andrew Valums ( andrew(at)valums.com ) 
 * 
 * Licensed under GNU GPL 2 or later and GNU LGPL 2 or later, see license.txt.
 */    

//
// Helper functions
//

var qq = qq || {};

/**
 * Adds all missing properties from second obj to first obj
 */ 
qq.extend = function(first, second){
    for (var prop in second){
        first[prop] = second[prop];
    }
};  

/**
 * Searches for a given element in the array, returns -1 if it is not present.
 * @param {Number} [from] The index at which to begin the search
 */
qq.indexOf = function(arr, elt, from){
    if (arr.indexOf) return arr.indexOf(elt, from);
    
    from = from || 0;
    var len = arr.length;    
    
    if (from < 0) from += len;  

    for (; from < len; from++){  
        if (from in arr && arr[from] === elt){  
            return from;
        }
    }  
    return -1;  
}; 
    
qq.getUniqueId = (function(){
    var id = 0;
    return function(){ return id++; };
})();

//
// Events

qq.attach = function(element, type, fn){
    if (element.addEventListener){
        element.addEventListener(type, fn, false);
    } else if (element.attachEvent){
        element.attachEvent('on' + type, fn);
    }
};
qq.detach = function(element, type, fn){
    if (element.removeEventListener){
        element.removeEventListener(type, fn, false);
    } else if (element.attachEvent){
        element.detachEvent('on' + type, fn);
    }
};

qq.preventDefault = function(e){
    if (e.preventDefault){
        e.preventDefault();
    } else{
        e.returnValue = false;
    }
};

//
// Node manipulations

/**
 * Insert node a before node b.
 */
qq.insertBefore = function(a, b){
    b.parentNode.insertBefore(a, b);
};
qq.remove = function(element){
    element.parentNode.removeChild(element);
};

qq.contains = function(parent, descendant){       
    // compareposition returns false in this case
    if (parent == descendant) return true;
    
    if (parent.contains){
        return parent.contains(descendant);
    } else {
        return !!(descendant.compareDocumentPosition(parent) & 8);
    }
};

/**
 * Creates and returns element from html string
 * Uses innerHTML to create an element
 */
qq.toElement = (function(){
    var div = document.createElement('div');
    return function(html){
        div.innerHTML = html;
        var element = div.firstChild;
        div.removeChild(element);
        return element;
    };
})();

//
// Node properties and attributes

/**
 * Sets styles for an element.
 * Fixes opacity in IE6-8.
 */
qq.css = function(element, styles){
    if (styles.opacity != null){
        if (typeof element.style.opacity != 'string' && typeof(element.filters) != 'undefined'){
            styles.filter = 'alpha(opacity=' + Math.round(100 * styles.opacity) + ')';
        }
    }
    qq.extend(element.style, styles);
};
qq.hasClass = function(element, name){
    var re = new RegExp('(^| )' + name + '( |$)');
    return re.test(element.className);
};
qq.addClass = function(element, name){
    if (!qq.hasClass(element, name)){
        element.className += ' ' + name;
    }
};
qq.removeClass = function(element, name){
    var re = new RegExp('(^| )' + name + '( |$)');
    element.className = element.className.replace(re, ' ').replace(/^\s+|\s+$/g, "");
};
qq.setText = function(element, text){
    element.innerText = text;
    element.textContent = text;
};

//
// Selecting elements

qq.children = function(element){
    var children = [],
    child = element.firstChild;

    while (child){
        if (child.nodeType == 1){
            children.push(child);
        }
        child = child.nextSibling;
    }

    return children;
};

qq.getByClass = function(element, className){
    if (element.querySelectorAll){
        return element.querySelectorAll('.' + className);
    }

    var result = [];
    var candidates = element.getElementsByTagName("*");
    var len = candidates.length;

    for (var i = 0; i < len; i++){
        if (qq.hasClass(candidates[i], className)){
            result.push(candidates[i]);
        }
    }
    return result;
};

/**
 * obj2url() takes a json-object as argument and generates
 * a querystring. pretty much like jQuery.param()
 * 
 * how to use:
 *
 *    `qq.obj2url({a:'b',c:'d'},'http://any.url/upload?otherParam=value');`
 *
 * will result in:
 *
 *    `http://any.url/upload?otherParam=value&a=b&c=d`
 *
 * @param  Object JSON-Object
 * @param  String current querystring-part
 * @return String encoded querystring
 */
qq.obj2url = function(obj, temp, prefixDone){
    var uristrings = [],
        prefix = '&',
        add = function(nextObj, i){
            var nextTemp = temp 
                ? (/\[\]$/.test(temp)) // prevent double-encoding
                   ? temp
                   : temp+'['+i+']'
                : i;
            if ((nextTemp != 'undefined') && (i != 'undefined')) {  
                uristrings.push(
                    (typeof nextObj === 'object') 
                        ? qq.obj2url(nextObj, nextTemp, true)
                        : (Object.prototype.toString.call(nextObj) === '[object Function]')
                            ? encodeURIComponent(nextTemp) + '=' + encodeURIComponent(nextObj())
                            : encodeURIComponent(nextTemp) + '=' + encodeURIComponent(nextObj)                                                          
                );
            }
        }; 

    if (!prefixDone && temp) {
      prefix = (/\?/.test(temp)) ? (/\?$/.test(temp)) ? '' : '&' : '?';
      uristrings.push(temp);
      uristrings.push(qq.obj2url(obj));
    } else if ((Object.prototype.toString.call(obj) === '[object Array]') && (typeof obj != 'undefined') ) {
        // we wont use a for-in-loop on an array (performance)
        for (var i = 0, len = obj.length; i < len; ++i){
            add(obj[i], i);
        }
    } else if ((typeof obj != 'undefined') && (obj !== null) && (typeof obj === "object")){
        // for anything else but a scalar, we will use for-in-loop
        for (var i in obj){
            add(obj[i], i);
        }
    } else {
        uristrings.push(encodeURIComponent(temp) + '=' + encodeURIComponent(obj));
    }

    return uristrings.join(prefix)
                     .replace(/^&/, '')
                     .replace(/%20/g, '+'); 
};

//
//
// Uploader Classes
//
//

var qq = qq || {};
    
/**
 * Creates upload button, validates upload, but doesn't create file list or dd. 
 */
qq.FileUploaderBasic = function(o){
    this._options = {
        // set to true to see the server response
        debug: false,
        action: '/server/upload',
        params: {},
        button: null,
        multiple: true,
        maxConnections: 3,
        // validation        
        allowedExtensions: [],               
        sizeLimit: 0,   
        minSizeLimit: 0,                             
        // events
        // return false to cancel submit
        onSubmit: function(id, fileName){},
        onProgress: function(id, fileName, loaded, total){},
        onComplete: function(id, fileName, responseJSON){},
        onCancel: function(id, fileName){},
        // messages                
        messages: {
            typeError: "{file} has invalid extension. Only {extensions} are allowed.",
            sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
            minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
            emptyError: "{file} is empty, please select files again without it.",
            onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."            
        },
        showMessage: function(message){
            alert(message);
        }               
    };
    qq.extend(this._options, o);
        
    // number of files being uploaded
    this._filesInProgress = 0;
    this._handler = this._createUploadHandler(); 
    
    if (this._options.button){ 
        this._button = this._createUploadButton(this._options.button);
    }
                        
    this._preventLeaveInProgress();         
};
   
qq.FileUploaderBasic.prototype = {
    setParams: function(params){
        this._options.params = params;
    },
    getInProgress: function(){
        return this._filesInProgress;         
    },
    _createUploadButton: function(element){
        var self = this;
        
        return new qq.UploadButton({
            element: element,
            multiple: this._options.multiple && qq.UploadHandlerXhr.isSupported(),
            onChange: function(input){
                self._onInputChange(input);
            }        
        });           
    },    
    _createUploadHandler: function(){
        var self = this,
            handlerClass;        
        
        if(qq.UploadHandlerXhr.isSupported()){           
            handlerClass = 'UploadHandlerXhr';                        
        } else {
            handlerClass = 'UploadHandlerForm';
        }

        var handler = new qq[handlerClass]({
            debug: this._options.debug,
            action: this._options.action,         
            maxConnections: this._options.maxConnections,   
            onProgress: function(id, fileName, loaded, total){                
                self._onProgress(id, fileName, loaded, total);
                self._options.onProgress(id, fileName, loaded, total);                    
            },            
            onComplete: function(id, fileName, result){
                self._onComplete(id, fileName, result);
                self._options.onComplete(id, fileName, result);
            },
            onCancel: function(id, fileName){
                self._onCancel(id, fileName);
                self._options.onCancel(id, fileName);
            }
        });

        return handler;
    },    
    _preventLeaveInProgress: function(){
        var self = this;
        
        qq.attach(window, 'beforeunload', function(e){
            if (!self._filesInProgress){return;}
            
            var e = e || window.event;
            // for ie, ff
            e.returnValue = self._options.messages.onLeave;
            // for webkit
            return self._options.messages.onLeave;             
        });        
    },    
    _onSubmit: function(id, fileName){
        this._filesInProgress++;  
    },
    _onProgress: function(id, fileName, loaded, total){        
    },
    _onComplete: function(id, fileName, result){
        this._filesInProgress--;                 
        if (result.error){
            this._options.showMessage(result.error);
        }             
    },
    _onCancel: function(id, fileName){
        this._filesInProgress--;        
    },
    _onInputChange: function(input){
        if (this._handler instanceof qq.UploadHandlerXhr){                
            this._uploadFileList(input.files);                   
        } else {             
            if (this._validateFile(input)){                
                this._uploadFile(input);                                    
            }                      
        }               
        this._button.reset();   
    },  
    _uploadFileList: function(files){
        for (var i=0; i<files.length; i++){
            if ( !this._validateFile(files[i])){
                return;
            }            
        }
        
        for (var i=0; i<files.length; i++){
            this._uploadFile(files[i]);        
        }        
    },       
    _uploadFile: function(fileContainer){      
        var id = this._handler.add(fileContainer);
        var fileName = this._handler.getName(id);
        
        if (this._options.onSubmit(id, fileName) !== false){
            this._onSubmit(id, fileName);
            this._handler.upload(id, this._options.params);
        }
    },      
    _validateFile: function(file){
        var name, size;
        
        if (file.value){
            // it is a file input            
            // get input value and remove path to normalize
            name = file.value.replace(/.*(\/|\\)/, "");
        } else {
            // fix missing properties in Safari
            name = file.fileName != null ? file.fileName : file.name;
            size = file.fileSize != null ? file.fileSize : file.size;
        }
                    
        if (! this._isAllowedExtension(name)){            
            this._error('typeError', name);
            return false;
            
        } else if (size === 0){            
            this._error('emptyError', name);
            return false;
                                                     
        } else if (size && this._options.sizeLimit && size > this._options.sizeLimit){            
            this._error('sizeError', name);
            return false;
                        
        } else if (size && size < this._options.minSizeLimit){
            this._error('minSizeError', name);
            return false;            
        }
        
        return true;                
    },
    _error: function(code, fileName){
        var message = this._options.messages[code];        
        function r(name, replacement){ message = message.replace(name, replacement); }
        
        r('{file}', this._formatFileName(fileName));        
        r('{extensions}', this._options.allowedExtensions.join(', '));
        r('{sizeLimit}', this._formatSize(this._options.sizeLimit));
        r('{minSizeLimit}', this._formatSize(this._options.minSizeLimit));
        
        this._options.showMessage(message);                
    },
    _formatFileName: function(name){
        if (name.length > 33){
            name = name.slice(0, 19) + '...' + name.slice(-13);    
        }
        return name;
    },
    _isAllowedExtension: function(fileName){
        var ext = (-1 !== fileName.indexOf('.')) ? fileName.replace(/.*[.]/, '').toLowerCase() : '';
        var allowed = this._options.allowedExtensions;
        
        if (!allowed.length){return true;}        
        
        for (var i=0; i<allowed.length; i++){
            if (allowed[i].toLowerCase() == ext){ return true;}    
        }
        
        return false;
    },    
    _formatSize: function(bytes){
        var i = -1;                                    
        do {
            bytes = bytes / 1024;
            i++;  
        } while (bytes > 99);
        
        return Math.max(bytes, 0.1).toFixed(1) + ['kB', 'MB', 'GB', 'TB', 'PB', 'EB'][i];          
    }
};
    
       
/**
 * Class that creates upload widget with drag-and-drop and file list
 * @inherits qq.FileUploaderBasic
 */
qq.FileUploader = function(o){
    // call parent constructor
    qq.FileUploaderBasic.apply(this, arguments);
    
    // additional options    
    qq.extend(this._options, {
        element: null,
        // if set, will be used instead of qq-upload-list in template
        listElement: null,
                
        template: '<div class="qq-uploader">' + 
                '<div class="qq-upload-drop-area"><span>Arrastra y Suelta Aqui los Archivos</span></div>' +
                '<div class="btn btn-primary qq-upload-button">Adjuntar Archivo</div>' +
                '<ul class="qq-upload-list"></ul>' + 
             '</div>',

        // template for one item in file list
        fileTemplate: '<li>' +
                '<span class="qq-upload-file"></span>' +
                '<span class="qq-upload-spinner"></span>' +
                '<span class="qq-upload-size"></span>' +
                '<a class="qq-upload-cancel" href="#">Cancelar</a>' +
                '<span class="qq-upload-failed-text">Error</span>' +
            '</li>',        
        
        classes: {
            // used to get elements from templates
            button: 'qq-upload-button',
            drop: 'qq-upload-drop-area',
            dropActive: 'qq-upload-drop-area-active',
            list: 'qq-upload-list',
                        
            file: 'qq-upload-file',
            spinner: 'qq-upload-spinner',
            size: 'qq-upload-size',
            cancel: 'qq-upload-cancel',

            // added to list item when upload completes
            // used in css to hide progress spinner
            success: 'qq-upload-success',
            fail: 'qq-upload-fail'
        }
    });
    // overwrite options with user supplied    
    qq.extend(this._options, o);       

    this._element = this._options.element;
    this._element.innerHTML = this._options.template;        
    this._listElement = this._options.listElement || this._find(this._element, 'list');
    
    this._classes = this._options.classes;
        
    this._button = this._createUploadButton(this._find(this._element, 'button'));        
    
    this._bindCancelEvent();
    this._setupDragDrop();
};

// inherit from Basic Uploader
qq.extend(qq.FileUploader.prototype, qq.FileUploaderBasic.prototype);

qq.extend(qq.FileUploader.prototype, {
    /**
     * Gets one of the elements listed in this._options.classes
     **/
    _find: function(parent, type){                                
        var element = qq.getByClass(parent, this._options.classes[type])[0];        
        if (!element){
            throw new Error('element not found ' + type);
        }
        
        return element;
    },
    _setupDragDrop: function(){
        var self = this,
            dropArea = this._find(this._element, 'drop');                        

        var dz = new qq.UploadDropZone({
            element: dropArea,
            onEnter: function(e){
                qq.addClass(dropArea, self._classes.dropActive);
                e.stopPropagation();
            },
            onLeave: function(e){
                e.stopPropagation();
            },
            onLeaveNotDescendants: function(e){
                qq.removeClass(dropArea, self._classes.dropActive);  
            },
            onDrop: function(e){
                dropArea.style.display = 'none';
                qq.removeClass(dropArea, self._classes.dropActive);
                self._uploadFileList(e.dataTransfer.files);    
            }
        });
                
        dropArea.style.display = 'none';

        qq.attach(document, 'dragenter', function(e){     
            if (!dz._isValidFileDrag(e)) return; 
            
            dropArea.style.display = 'block';            
        });                 
        qq.attach(document, 'dragleave', function(e){
            if (!dz._isValidFileDrag(e)) return;            
            
            var relatedTarget = document.elementFromPoint(e.clientX, e.clientY);
            // only fire when leaving document out
            if ( ! relatedTarget || relatedTarget.nodeName == "HTML"){               
                dropArea.style.display = 'none';                                            
            }
        });                
    },
    _onSubmit: function(id, fileName){
        qq.FileUploaderBasic.prototype._onSubmit.apply(this, arguments);
        this._addToList(id, fileName);  
    },
    _onProgress: function(id, fileName, loaded, total){
        qq.FileUploaderBasic.prototype._onProgress.apply(this, arguments);

        var item = this._getItemByFileId(id);
        var size = this._find(item, 'size');
        size.style.display = 'inline';
        
        var text; 
        if (loaded != total){
            text = Math.round(loaded / total * 100) + '% from ' + this._formatSize(total);
        } else {                                   
            text = this._formatSize(total);
        }          
        
        qq.setText(size, text);         
    },
    _onComplete: function(id, fileName, result){
        qq.FileUploaderBasic.prototype._onComplete.apply(this, arguments);

        // mark completed
        var item = this._getItemByFileId(id);                
        qq.remove(this._find(item, 'cancel'));
        qq.remove(this._find(item, 'spinner'));
        
        if (result.success){
            qq.addClass(item, this._classes.success);    
        } else {
            qq.addClass(item, this._classes.fail);
        }         
    },
    _addToList: function(id, fileName){
        var item = qq.toElement(this._options.fileTemplate);                
        item.qqFileId = id;

        var fileElement = this._find(item, 'file');        
        qq.setText(fileElement, this._formatFileName(fileName));
        this._find(item, 'size').style.display = 'none';        

        this._listElement.appendChild(item);
    },
    _getItemByFileId: function(id){
        var item = this._listElement.firstChild;        
        
        // there can't be txt nodes in dynamically created list
        // and we can  use nextSibling
        while (item){            
            if (item.qqFileId == id) return item;            
            item = item.nextSibling;
        }          
    },
    /**
     * delegate click event for cancel link 
     **/
    _bindCancelEvent: function(){
        var self = this,
            list = this._listElement;            
        
        qq.attach(list, 'click', function(e){            
            e = e || window.event;
            var target = e.target || e.srcElement;
            
            if (qq.hasClass(target, self._classes.cancel)){                
                qq.preventDefault(e);
               
                var item = target.parentNode;
                self._handler.cancel(item.qqFileId);
                qq.remove(item);
            }
        });
    }    
});
    
qq.UploadDropZone = function(o){
    this._options = {
        element: null,  
        onEnter: function(e){},
        onLeave: function(e){},  
        // is not fired when leaving element by hovering descendants   
        onLeaveNotDescendants: function(e){},   
        onDrop: function(e){}                       
    };
    qq.extend(this._options, o); 
    
    this._element = this._options.element;
    
    this._disableDropOutside();
    this._attachEvents();   
};

qq.UploadDropZone.prototype = {
    _disableDropOutside: function(e){
        // run only once for all instances
        if (!qq.UploadDropZone.dropOutsideDisabled ){

            qq.attach(document, 'dragover', function(e){
                if (e.dataTransfer){
                    e.dataTransfer.dropEffect = 'none';
                    e.preventDefault(); 
                }           
            });
            
            qq.UploadDropZone.dropOutsideDisabled = true; 
        }        
    },
    _attachEvents: function(){
        var self = this;              
                  
        qq.attach(self._element, 'dragover', function(e){
            if (!self._isValidFileDrag(e)) return;
            
            var effect = e.dataTransfer.effectAllowed;
            if (effect == 'move' || effect == 'linkMove'){
                e.dataTransfer.dropEffect = 'move'; // for FF (only move allowed)    
            } else {                    
                e.dataTransfer.dropEffect = 'copy'; // for Chrome
            }
                                                     
            e.stopPropagation();
            e.preventDefault();                                                                    
        });
        
        qq.attach(self._element, 'dragenter', function(e){
            if (!self._isValidFileDrag(e)) return;
                        
            self._options.onEnter(e);
        });
        
        qq.attach(self._element, 'dragleave', function(e){
            if (!self._isValidFileDrag(e)) return;
            
            self._options.onLeave(e);
            
            var relatedTarget = document.elementFromPoint(e.clientX, e.clientY);                      
            // do not fire when moving a mouse over a descendant
            if (qq.contains(this, relatedTarget)) return;
                        
            self._options.onLeaveNotDescendants(e); 
        });
                
        qq.attach(self._element, 'drop', function(e){
            if (!self._isValidFileDrag(e)) return;
            
            e.preventDefault();
            self._options.onDrop(e);
        });          
    },
    _isValidFileDrag: function(e){
        var dt = e.dataTransfer,
            // do not check dt.types.contains in webkit, because it crashes safari 4            
            isWebkit = navigator.userAgent.indexOf("AppleWebKit") > -1;                        

        // dt.effectAllowed is none in Safari 5
        // dt.types.contains check is for firefox            
        return dt && dt.effectAllowed != 'none' && 
            (dt.files || (!isWebkit && dt.types.contains && dt.types.contains('Files')));
        
    }        
}; 

qq.UploadButton = function(o){
    this._options = {
        element: null,  
        // if set to true adds multiple attribute to file input      
        multiple: false,
        // name attribute of file input
        name: 'file',
        onChange: function(input){},
        hoverClass: 'qq-upload-button-hover',
        focusClass: 'qq-upload-button-focus'                       
    };
    
    qq.extend(this._options, o);
        
    this._element = this._options.element;
    
    // make button suitable container for input
    qq.css(this._element, {
        position: 'relative',
        overflow: 'hidden',
        // Make sure browse button is in the right side
        // in Internet Explorer
        direction: 'ltr'
    });   
    
    this._input = this._createInput();
};

qq.UploadButton.prototype = {
    /* returns file input element */    
    getInput: function(){
        return this._input;
    },
    /* cleans/recreates the file input */
    reset: function(){
        if (this._input.parentNode){
            qq.remove(this._input);    
        }                
        
        qq.removeClass(this._element, this._options.focusClass);
        this._input = this._createInput();
    },    
    _createInput: function(){                
        var input = document.createElement("input");
        
        if (this._options.multiple){
            input.setAttribute("multiple", "multiple");
        }
                
        input.setAttribute("type", "file");
        input.setAttribute("name", this._options.name);
        
        qq.css(input, {
            position: 'absolute',
            // in Opera only 'browse' button
            // is clickable and it is located at
            // the right side of the input
            right: 0,
            top: 0,
            fontFamily: 'Helvetica, Arial, sans-serif',
            // 4 persons reported this, the max values that worked for them were 243, 236, 236, 118
            fontSize: '96px',
            margin: 0,
            padding: 0,
            cursor: 'pointer',
            opacity: 0,
			borderRadius: '6px',
		});
        
        this._element.appendChild(input);

        var self = this;
        qq.attach(input, 'change', function(){
            self._options.onChange(input);
        });
                
        qq.attach(input, 'mouseover', function(){
            qq.addClass(self._element, self._options.hoverClass);
        });
        qq.attach(input, 'mouseout', function(){
            qq.removeClass(self._element, self._options.hoverClass);
        });
        qq.attach(input, 'focus', function(){
            qq.addClass(self._element, self._options.focusClass);
        });
        qq.attach(input, 'blur', function(){
            qq.removeClass(self._element, self._options.focusClass);
        });

        // IE and Opera, unfortunately have 2 tab stops on file input
        // which is unacceptable in our case, disable keyboard access
        if (window.attachEvent){
            // it is IE or Opera
            input.setAttribute('tabIndex', "-1");
        }

        return input;            
    }        
};

/**
 * Class for uploading files, uploading itself is handled by child classes
 */
qq.UploadHandlerAbstract = function(o){
    this._options = {
        debug: false,
        action: '/upload.php',
        // maximum number of concurrent uploads        
        maxConnections: 999,
        onProgress: function(id, fileName, loaded, total){},
        onComplete: function(id, fileName, response){},
        onCancel: function(id, fileName){}
    };
    qq.extend(this._options, o);    
    
    this._queue = [];
    // params for files in queue
    this._params = [];
};
qq.UploadHandlerAbstract.prototype = {
    log: function(str){
        if (this._options.debug && window.console) console.log('[uploader] ' + str);        
    },
    /**
     * Adds file or file input to the queue
     * @returns id
     **/    
    add: function(file){},
    /**
     * Sends the file identified by id and additional query params to the server
     */
    upload: function(id, params){
        var len = this._queue.push(id);

        var copy = {};        
        qq.extend(copy, params);
        this._params[id] = copy;        
                
        // if too many active uploads, wait...
        if (len <= this._options.maxConnections){               
            this._upload(id, this._params[id]);
        }
    },
    /**
     * Cancels file upload by id
     */
    cancel: function(id){
        this._cancel(id);
        this._dequeue(id);
    },
    /**
     * Cancells all uploads
     */
    cancelAll: function(){
        for (var i=0; i<this._queue.length; i++){
            this._cancel(this._queue[i]);
        }
        this._queue = [];
    },
    /**
     * Returns name of the file identified by id
     */
    getName: function(id){},
    /**
     * Returns size of the file identified by id
     */          
    getSize: function(id){},
    /**
     * Returns id of files being uploaded or
     * waiting for their turn
     */
    getQueue: function(){
        return this._queue;
    },
    /**
     * Actual upload method
     */
    _upload: function(id){},
    /**
     * Actual cancel method
     */
    _cancel: function(id){},     
    /**
     * Removes element from queue, starts upload of next
     */
    _dequeue: function(id){
        var i = qq.indexOf(this._queue, id);
        this._queue.splice(i, 1);
                
        var max = this._options.maxConnections;
        
        if (this._queue.length >= max && i < max){
            var nextId = this._queue[max-1];
            this._upload(nextId, this._params[nextId]);
        }
    }        
};

/**
 * Class for uploading files using form and iframe
 * @inherits qq.UploadHandlerAbstract
 */
qq.UploadHandlerForm = function(o){
    qq.UploadHandlerAbstract.apply(this, arguments);
       
    this._inputs = {};
};
// @inherits qq.UploadHandlerAbstract
qq.extend(qq.UploadHandlerForm.prototype, qq.UploadHandlerAbstract.prototype);

qq.extend(qq.UploadHandlerForm.prototype, {
    add: function(fileInput){
        fileInput.setAttribute('name', 'qqfile');
        var id = 'qq-upload-handler-iframe' + qq.getUniqueId();       
        
        this._inputs[id] = fileInput;
        
        // remove file input from DOM
        if (fileInput.parentNode){
            qq.remove(fileInput);
        }
                
        return id;
    },
    getName: function(id){
        // get input value and remove path to normalize
        return this._inputs[id].value.replace(/.*(\/|\\)/, "");
    },    
    _cancel: function(id){
        this._options.onCancel(id, this.getName(id));
        
        delete this._inputs[id];        

        var iframe = document.getElementById(id);
        if (iframe){
            // to cancel request set src to something else
            // we use src="javascript:false;" because it doesn't
            // trigger ie6 prompt on https
            iframe.setAttribute('src', 'javascript:false;');

            qq.remove(iframe);
        }
    },     
    _upload: function(id, params){                        
        var input = this._inputs[id];
        
        if (!input){
            throw new Error('file with passed id was not added, or already uploaded or cancelled');
        }                

        var fileName = this.getName(id);
                
        var iframe = this._createIframe(id);
        var form = this._createForm(iframe, params);
        form.appendChild(input);

        var self = this;
        this._attachLoadEvent(iframe, function(){                                 
            self.log('iframe loaded');
            
            var response = self._getIframeContentJSON(iframe);

            self._options.onComplete(id, fileName, response);
            self._dequeue(id);
            
            delete self._inputs[id];
            // timeout added to fix busy state in FF3.6
            setTimeout(function(){
                qq.remove(iframe);
            }, 1);
        });

        form.submit();        
        qq.remove(form);        
        
        return id;
    }, 
    _attachLoadEvent: function(iframe, callback){
        qq.attach(iframe, 'load', function(){
            // when we remove iframe from dom
            // the request stops, but in IE load
            // event fires
            if (!iframe.parentNode){
                return;
            }

            // fixing Opera 10.53
            if (iframe.contentDocument &&
                iframe.contentDocument.body &&
                iframe.contentDocument.body.innerHTML == "false"){
                // In Opera event is fired second time
                // when body.innerHTML changed from false
                // to server response approx. after 1 sec
                // when we upload file with iframe
                return;
            }

            callback();
        });
    },
    /**
     * Returns json object received by iframe from server.
     */
    _getIframeContentJSON: function(iframe){
        // iframe.contentWindow.document - for IE<7
        var doc = iframe.contentDocument ? iframe.contentDocument: iframe.contentWindow.document,
            response;
        
        this.log("converting iframe's innerHTML to JSON");
        this.log("innerHTML = " + doc.body.innerHTML);
                        
        try {
            response = eval("(" + doc.body.innerHTML + ")");
        } catch(err){
            response = {};
        }        

        return response;
    },
    /**
     * Creates iframe with unique name
     */
    _createIframe: function(id){
        // We can't use following code as the name attribute
        // won't be properly registered in IE6, and new window
        // on form submit will open
        // var iframe = document.createElement('iframe');
        // iframe.setAttribute('name', id);

        var iframe = qq.toElement('<iframe src="javascript:false;" name="' + id + '" />');
        // src="javascript:false;" removes ie6 prompt on https

        iframe.setAttribute('id', id);

        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        return iframe;
    },
    /**
     * Creates form, that will be submitted to iframe
     */
    _createForm: function(iframe, params){
        // We can't use the following code in IE6
        // var form = document.createElement('form');
        // form.setAttribute('method', 'post');
        // form.setAttribute('enctype', 'multipart/form-data');
        // Because in this case file won't be attached to request
        var form = qq.toElement('<form method="post" enctype="multipart/form-data"></form>');

        var queryString = qq.obj2url(params, this._options.action);

        form.setAttribute('action', queryString);
        form.setAttribute('target', iframe.name);
        form.style.display = 'none';
        document.body.appendChild(form);

        return form;
    }
});

/**
 * Class for uploading files using xhr
 * @inherits qq.UploadHandlerAbstract
 */
qq.UploadHandlerXhr = function(o){
    qq.UploadHandlerAbstract.apply(this, arguments);

    this._files = [];
    this._xhrs = [];
    
    // current loaded size in bytes for each file 
    this._loaded = [];
};

// static method
qq.UploadHandlerXhr.isSupported = function(){
    var input = document.createElement('input');
    input.type = 'file';        
    
    return (
        'multiple' in input &&
        typeof File != "undefined" &&
        typeof (new XMLHttpRequest()).upload != "undefined" );       
};

// @inherits qq.UploadHandlerAbstract
qq.extend(qq.UploadHandlerXhr.prototype, qq.UploadHandlerAbstract.prototype)

qq.extend(qq.UploadHandlerXhr.prototype, {
    /**
     * Adds file to the queue
     * Returns id to use with upload, cancel
     **/    
    add: function(file){
        if (!(file instanceof File)){
            throw new Error('Passed obj in not a File (in qq.UploadHandlerXhr)');
        }
                
        return this._files.push(file) - 1;        
    },
    getName: function(id){        
        var file = this._files[id];
        // fix missing name in Safari 4
        return file.fileName != null ? file.fileName : file.name;       
    },
    getSize: function(id){
        var file = this._files[id];
        return file.fileSize != null ? file.fileSize : file.size;
    },    
    /**
     * Returns uploaded bytes for file identified by id 
     */    
    getLoaded: function(id){
        return this._loaded[id] || 0; 
    },
    /**
     * Sends the file identified by id and additional query params to the server
     * @param {Object} params name-value string pairs
     */    
    _upload: function(id, params){
        var file = this._files[id],
            name = this.getName(id),
            size = this.getSize(id);
                
        this._loaded[id] = 0;
                                
        var xhr = this._xhrs[id] = new XMLHttpRequest();
        var self = this;
                                        
        xhr.upload.onprogress = function(e){
            if (e.lengthComputable){
                self._loaded[id] = e.loaded;
                self._options.onProgress(id, name, e.loaded, e.total);
            }
        };

        xhr.onreadystatechange = function(){            
            if (xhr.readyState == 4){
                self._onComplete(id, xhr);                    
            }
        };

        // build query string
        params = params || {};
        params['qqfile'] = name;
        var queryString = qq.obj2url(params, this._options.action);

        xhr.open("POST", queryString, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.setRequestHeader("X-File-Name", encodeURIComponent(name));
        xhr.setRequestHeader("Content-Type", "application/octet-stream");
        xhr.send(file);
    },
    _onComplete: function(id, xhr){
        // the request was aborted/cancelled
        if (!this._files[id]) return;
        
        var name = this.getName(id);
        var size = this.getSize(id);
        
        this._options.onProgress(id, name, size, size);
                
        if (xhr.status == 200){
            this.log("xhr - server response received");
            this.log("responseText = " + xhr.responseText);
                        
            var response;
                    
            try {
                response = eval("(" + xhr.responseText + ")");
            } catch(err){
                response = {};
            }
            
            this._options.onComplete(id, name, response);
                        
        } else {                   
            this._options.onComplete(id, name, {});
        }
                
        this._files[id] = null;
        this._xhrs[id] = null;    
        this._dequeue(id);                    
    },
    _cancel: function(id){
        this._options.onCancel(id, this.getName(id));
        
        this._files[id] = null;
        
        if (this._xhrs[id]){
            this._xhrs[id].abort();
            this._xhrs[id] = null;                                   
        }
    }
});
(function(e,t){"use strict";var n=6,o=4,i="asc",r="desc",l="_ng_field_",a="_ng_depth_",s="_ng_hidden_",c="_ng_column_",g=/CUSTOM_FILTERS/g,d=/COL_FIELD/g,u=/DISPLAY_CELL_TEMPLATE/g,f=/EDITABLE_CELL_TEMPLATE/g,h=/<.+>/;e.ngGrid={},e.ngGrid.i18n={},angular.module("ngGrid.services",[]);var p=angular.module("ngGrid.directives",[]),m=angular.module("ngGrid.filters",[]);angular.module("ngGrid",["ngGrid.services","ngGrid.directives","ngGrid.filters"]);var v=function(e,t,o,i){if(void 0===e.selectionProvider.selectedItems)return!0;var r,l=o.which||o.keyCode,a=!1,s=!1,c=void 0===e.selectionProvider.lastClickedRow?1:e.selectionProvider.lastClickedRow.rowIndex,g=e.columns.filter(function(e){return e.visible}),d=e.columns.filter(function(e){return e.pinned});if(e.col&&(r=g.indexOf(e.col)),37!==l&&38!==l&&39!==l&&40!==l&&9!==l&&13!==l)return!0;if(e.enableCellSelection){9===l&&o.preventDefault();var u=e.showSelectionCheckbox?1===e.col.index:0===e.col.index,f=1===e.$index||0===e.$index,h=e.$index===e.renderedColumns.length-1||e.$index===e.renderedColumns.length-2,p=g.indexOf(e.col)===g.length-1,m=d.indexOf(e.col)===d.length-1;if(37===l||9===l&&o.shiftKey){var v=0;u||(r-=1),f?u&&9===l&&o.shiftKey?(v=i.$canvas.width(),r=g.length-1,s=!0):v=i.$viewport.scrollLeft()-e.col.width:d.length>0&&(v=i.$viewport.scrollLeft()-g[r].width),i.$viewport.scrollLeft(v)}else(39===l||9===l&&!o.shiftKey)&&(h?p&&9===l&&!o.shiftKey?(i.$viewport.scrollLeft(0),r=e.showSelectionCheckbox?1:0,a=!0):i.$viewport.scrollLeft(i.$viewport.scrollLeft()+e.col.width):m&&i.$viewport.scrollLeft(0),p||(r+=1))}var w;w=e.configGroups.length>0?i.rowFactory.parsedData.filter(function(e){return!e.isAggRow}):i.filteredRows;var C=0;if(0!==c&&(38===l||13===l&&o.shiftKey||9===l&&o.shiftKey&&s)?C=-1:c!==w.length-1&&(40===l||13===l&&!o.shiftKey||9===l&&a)&&(C=1),C){var b=w[c+C];b.beforeSelectionChange(b,o)&&(b.continueSelection(o),e.$emit("ngGridEventDigestGridParent"),e.selectionProvider.lastClickedRow.renderedRowIndex>=e.renderedRows.length-n-2?i.$viewport.scrollTop(i.$viewport.scrollTop()+e.rowHeight):n+2>=e.selectionProvider.lastClickedRow.renderedRowIndex&&i.$viewport.scrollTop(i.$viewport.scrollTop()-e.rowHeight))}return e.enableCellSelection&&setTimeout(function(){e.domAccessProvider.focusCellElement(e,e.renderedColumns.indexOf(g[r]))},3),!1};String.prototype.trim||(String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")}),Array.prototype.indexOf||(Array.prototype.indexOf=function(e){var t=this.length>>>0,n=Number(arguments[1])||0;for(n=0>n?Math.ceil(n):Math.floor(n),0>n&&(n+=t);t>n;n++)if(n in this&&this[n]===e)return n;return-1}),Array.prototype.filter||(Array.prototype.filter=function(e){var t=Object(this),n=t.length>>>0;if("function"!=typeof e)throw new TypeError;for(var o=[],i=arguments[1],r=0;n>r;r++)if(r in t){var l=t[r];e.call(i,l,r,t)&&o.push(l)}return o}),m.filter("checkmark",function(){return function(e){return e?"✔":"✘"}}),m.filter("ngColumns",function(){return function(e){return e.filter(function(e){return!e.isAggCol})}}),angular.module("ngGrid.services").factory("$domUtilityService",["$utilityService",function(e){var n={},o={},i=function(){var e=t("<div></div>");e.appendTo("body"),e.height(100).width(100).css("position","absolute").css("overflow","scroll"),e.append('<div style="height: 400px; width: 400px;"></div>'),n.ScrollH=e.height()-e[0].clientHeight,n.ScrollW=e.width()-e[0].clientWidth,e.empty(),e.attr("style",""),e.append('<span style="font-family: Verdana, Helvetica, Sans-Serif; font-size: 14px;"><strong>M</strong></span>'),n.LetterW=e.children().first().width(),e.remove()};return n.eventStorage={},n.AssignGridContainers=function(e,o,i){i.$root=t(o),i.$topPanel=i.$root.find(".ngTopPanel"),i.$groupPanel=i.$root.find(".ngGroupPanel"),i.$headerContainer=i.$topPanel.find(".ngHeaderContainer"),e.$headerContainer=i.$headerContainer,i.$headerScroller=i.$topPanel.find(".ngHeaderScroller"),i.$headers=i.$headerScroller.children(),i.$viewport=i.$root.find(".ngViewport"),i.$canvas=i.$viewport.find(".ngCanvas"),i.$footerPanel=i.$root.find(".ngFooterPanel"),e.$watch(function(){return i.$viewport.scrollLeft()},function(e){return i.$headerContainer.scrollLeft(e)}),n.UpdateGridLayout(e,i)},n.getRealWidth=function(e){var n=0,o={visibility:"hidden",display:"block"},i=e.parents().andSelf().not(":visible");return t.swap(i[0],o,function(){n=e.outerWidth()}),n},n.UpdateGridLayout=function(e,t){var o=t.$viewport.scrollTop();t.elementDims.rootMaxW=t.$root.width(),t.$root.is(":hidden")&&(t.elementDims.rootMaxW=n.getRealWidth(t.$root)),t.elementDims.rootMaxH=t.$root.height(),t.refreshDomSizes(),e.adjustScrollTop(o,!0)},n.numberOfGrids=0,n.BuildStyles=function(o,i,r){var l,a=i.config.rowHeight,s=i.$styleSheet,c=i.gridId,g=o.columns,d=0;s||(s=t("#"+c),s[0]||(s=t("<style id='"+c+"' type='text/css' rel='stylesheet' />").appendTo(i.$root))),s.empty();var u=o.totalRowWidth();l="."+c+" .ngCanvas { width: "+u+"px; }"+"."+c+" .ngRow { width: "+u+"px; }"+"."+c+" .ngCanvas { width: "+u+"px; }"+"."+c+" .ngHeaderScroller { width: "+(u+n.ScrollH)+"px}";for(var f=0;g.length>f;f++){var h=g[f];h.visible!==!1&&(l+="."+c+" .col"+f+" { width: "+h.width+"px; left: "+d+"px; height: "+a+"px }"+"."+c+" .colt"+f+" { width: "+h.width+"px; }",d+=h.width)}e.isIe?s[0].styleSheet.cssText=l:s[0].appendChild(document.createTextNode(l)),i.$styleSheet=s,o.adjustScrollLeft(i.$viewport.scrollLeft()),r&&n.digest(o)},n.setColLeft=function(t,n,i){if(i.$styleSheet){var r=o[t.index];r||(r=o[t.index]=RegExp(".col"+t.index+" { width: [0-9]+px; left: [0-9]+px"));var l=i.$styleSheet.html(),a=l.replace(r,".col"+t.index+" { width: "+t.width+"px; left: "+n+"px");e.isIe?setTimeout(function(){i.$styleSheet.html(a)}):i.$styleSheet.html(a)}},n.setColLeft.immediate=1,n.RebuildGrid=function(e,t){n.UpdateGridLayout(e,t),(null==t.config.maintainColumnRatios||t.config.maintainColumnRatios)&&t.configureColumnWidths(),e.adjustScrollLeft(t.$viewport.scrollLeft()),n.BuildStyles(e,t,!0)},n.digest=function(e){e.$root.$$phase||e.$digest()},n.ScrollH=17,n.ScrollW=17,n.LetterW=10,i(),n}]),angular.module("ngGrid.services").factory("$sortService",["$parse",function(e){var t={};return t.colSortFnCache={},t.guessSortFn=function(e){var n=typeof e;switch(n){case"number":return t.sortNumber;case"boolean":return t.sortBool;case"string":return e.match(/^[-+]?[£$¤]?[\d,.]+%?$/)?t.sortNumberStr:t.sortAlpha;default:return"[object Date]"===Object.prototype.toString.call(e)?t.sortDate:t.basicSort}},t.basicSort=function(e,t){return e===t?0:t>e?-1:1},t.sortNumber=function(e,t){return e-t},t.sortNumberStr=function(e,t){var n,o,i=!1,r=!1;return n=parseFloat(e.replace(/[^0-9.-]/g,"")),isNaN(n)&&(i=!0),o=parseFloat(t.replace(/[^0-9.-]/g,"")),isNaN(o)&&(r=!0),i&&r?0:i?1:r?-1:n-o},t.sortAlpha=function(e,t){var n=e.toLowerCase(),o=t.toLowerCase();return n===o?0:o>n?-1:1},t.sortDate=function(e,t){var n=e.getTime(),o=t.getTime();return n===o?0:o>n?-1:1},t.sortBool=function(e,t){return e&&t?0:e||t?e?1:-1:0},t.sortData=function(n,o){if(o&&n){var r,l,a=n.fields.length,s=n.fields,c=o.slice(0);o.sort(function(o,g){for(var d,u=0,f=0;0===u&&a>f;){r=n.columns[f],l=n.directions[f],d=t.getSortFn(r,c);var h=e(s[f])(o),p=e(s[f])(g);!h&&0!==h||!p&&0!==p?p||h?h?p||(u=-1):u=1:u=0:u=d(h,p),f++}return l===i?u:0-u})}},t.Sort=function(e,n){t.isSorting||(t.isSorting=!0,t.sortData(e,n),t.isSorting=!1)},t.getSortFn=function(n,o){var i,r;if(t.colSortFnCache[n.field])i=t.colSortFnCache[n.field];else if(void 0!==n.sortingAlgorithm)i=n.sortingAlgorithm,t.colSortFnCache[n.field]=n.sortingAlgorithm;else{if(r=o[0],!r)return i;i=t.guessSortFn(e(n.field)(r)),i?t.colSortFnCache[n.field]=i:i=t.sortAlpha}return i},t}]),angular.module("ngGrid.services").factory("$utilityService",["$parse",function(n){var o=/function (.{1,})\(/,i={visualLength:function(e){var n=document.getElementById("testDataLength");return n||(n=document.createElement("SPAN"),n.id="testDataLength",n.style.visibility="hidden",document.body.appendChild(n)),t(n).css("font",t(e).css("font")),t(n).css("font-size",t(e).css("font-size")),t(n).css("font-family",t(e).css("font-family")),n.innerHTML=t(e).text(),n.offsetWidth},forIn:function(e,t){for(var n in e)e.hasOwnProperty(n)&&t(e[n],n)},evalProperty:function(e,t){return n(t)(e)},endsWith:function(e,t){return e&&t&&"string"==typeof e?-1!==e.indexOf(t,e.length-t.length):!1},isNullOrUndefined:function(e){return void 0===e||null===e?!0:!1},getElementsByClassName:function(e){for(var t=[],n=RegExp("\\b"+e+"\\b"),o=document.getElementsByTagName("*"),i=0;o.length>i;i++){var r=o[i].className;n.test(r)&&t.push(o[i])}return t},newId:function(){var e=(new Date).getTime();return function(){return e+=1}}(),seti18n:function(t,n){var o=e.ngGrid.i18n[n];for(var i in o)t.i18n[i]=o[i]},getInstanceType:function(e){var t=o.exec(""+e.constructor);if(t&&t.length>1){var n=t[1].replace(/^\s+|\s+$/g,"");return n}return""},ieVersion:function(){var e=3,t=document.createElement("div"),n=t.getElementsByTagName("i");do t.innerHTML="<!--[if gt IE "+ ++e+"]><i></i><![endif]-->";while(n[0]);return e>4?e:void 0}()};return t.extend(i,{isIe:function(){return void 0!==i.ieVersion}()}),i}]);var w=function(e,t,n,o){this.rowIndex=0,this.offsetTop=this.rowIndex*n,this.entity=e,this.label=e.gLabel,this.field=e.gField,this.depth=e.gDepth,this.parent=e.parent,this.children=e.children,this.aggChildren=e.aggChildren,this.aggIndex=e.aggIndex,this.collapsed=o,this.groupInitState=o,this.rowFactory=t,this.rowHeight=n,this.isAggRow=!0,this.offsetLeft=25*e.gDepth,this.aggLabelFilter=e.aggLabelFilter};w.prototype.toggleExpand=function(){this.collapsed=this.collapsed?!1:!0,this.orig&&(this.orig.collapsed=this.collapsed),this.notifyChildren()},w.prototype.setExpand=function(e){this.collapsed=e,this.notifyChildren()},w.prototype.notifyChildren=function(){for(var e=Math.max(this.rowFactory.aggCache.length,this.children.length),t=0;e>t;t++)if(this.aggChildren[t]&&(this.aggChildren[t].entity[s]=this.collapsed,this.collapsed&&this.aggChildren[t].setExpand(this.collapsed)),this.children[t]&&(this.children[t][s]=this.collapsed),t>this.aggIndex&&this.rowFactory.aggCache[t]){var n=this.rowFactory.aggCache[t],o=30*this.children.length;n.offsetTop=this.collapsed?n.offsetTop-o:n.offsetTop+o}this.rowFactory.renderedChange()},w.prototype.aggClass=function(){return this.collapsed?"ngAggArrowCollapsed":"ngAggArrowExpanded"},w.prototype.totalChildren=function(){if(this.aggChildren.length>0){var e=0,t=function(n){n.aggChildren.length>0?angular.forEach(n.aggChildren,function(e){t(e)}):e+=n.children.length};return t(this),e}return this.children.length},w.prototype.copy=function(){var e=new w(this.entity,this.rowFactory,this.rowHeight,this.groupInitState);return e.orig=this,e};var C=function(e,n,o,l,a,s){var c=this,d=e.colDef,u=500,f=0,p=null;c.colDef=e.colDef,c.width=d.width,c.groupIndex=0,c.isGroupedBy=!1,c.minWidth=d.minWidth?d.minWidth:50,c.maxWidth=d.maxWidth?d.maxWidth:9e3,c.enableCellEdit=void 0!==d.enableCellEdit?d.enableCellEdit:e.enableCellEdit||e.enableCellEditOnFocus,c.headerRowHeight=e.headerRowHeight,c.displayName=void 0===d.displayName?d.field:d.displayName,c.index=e.index,c.isAggCol=e.isAggCol,c.cellClass=d.cellClass,c.sortPriority=void 0,c.cellFilter=d.cellFilter?d.cellFilter:"",c.field=d.field,c.aggLabelFilter=d.cellFilter||d.aggLabelFilter,c.visible=s.isNullOrUndefined(d.visible)||d.visible,c.sortable=!1,c.resizable=!1,c.pinnable=!1,c.pinned=e.enablePinning&&d.pinned,c.originalIndex=null==e.originalIndex?c.index:e.originalIndex,c.groupable=s.isNullOrUndefined(d.groupable)||d.groupable,e.enableSort&&(c.sortable=s.isNullOrUndefined(d.sortable)||d.sortable),e.enableResize&&(c.resizable=s.isNullOrUndefined(d.resizable)||d.resizable),e.enablePinning&&(c.pinnable=s.isNullOrUndefined(d.pinnable)||d.pinnable),c.sortDirection=void 0,c.sortingAlgorithm=d.sortFn,c.headerClass=d.headerClass,c.cursor=c.sortable?"pointer":"default",c.headerCellTemplate=d.headerCellTemplate||a.get("headerCellTemplate.html"),c.cellTemplate=d.cellTemplate||a.get("cellTemplate.html").replace(g,c.cellFilter?"|"+c.cellFilter:""),c.enableCellEdit&&(c.cellEditTemplate=a.get("cellEditTemplate.html"),c.editableCellTemplate=d.editableCellTemplate||a.get("editableCellTemplate.html")),d.cellTemplate&&!h.test(d.cellTemplate)&&(c.cellTemplate=t.ajax({type:"GET",url:d.cellTemplate,async:!1}).responseText),c.enableCellEdit&&d.editableCellTemplate&&!h.test(d.editableCellTemplate)&&(c.editableCellTemplate=t.ajax({type:"GET",url:d.editableCellTemplate,async:!1}).responseText),d.headerCellTemplate&&!h.test(d.headerCellTemplate)&&(c.headerCellTemplate=t.ajax({type:"GET",url:d.headerCellTemplate,async:!1}).responseText),c.colIndex=function(){var e=c.pinned?"pinned ":"";return e+="col"+c.index+" colt"+c.index,c.cellClass&&(e+=" "+c.cellClass),e},c.groupedByClass=function(){return c.isGroupedBy?"ngGroupedByIcon":"ngGroupIcon"},c.toggleVisible=function(){c.visible=!c.visible},c.showSortButtonUp=function(){return c.sortable?c.sortDirection===r:c.sortable},c.showSortButtonDown=function(){return c.sortable?c.sortDirection===i:c.sortable},c.noSortVisible=function(){return!c.sortDirection},c.sort=function(t){if(!c.sortable)return!0;var n=c.sortDirection===i?r:i;return c.sortDirection=n,e.sortCallback(c,t),!1},c.gripClick=function(){f++,1===f?p=setTimeout(function(){f=0},u):(clearTimeout(p),e.resizeOnDataCallback(c),f=0)},c.gripOnMouseDown=function(e){return n.isColumnResizing=!0,e.ctrlKey&&!c.pinned?(c.toggleVisible(),l.BuildStyles(n,o),!0):(e.target.parentElement.style.cursor="col-resize",c.startMousePosition=e.clientX,c.origWidth=c.width,t(document).mousemove(c.onMouseMove),t(document).mouseup(c.gripOnMouseUp),!1)},c.onMouseMove=function(e){var t=e.clientX-c.startMousePosition,i=t+c.origWidth;return c.width=c.minWidth>i?c.minWidth:i>c.maxWidth?c.maxWidth:i,n.hasUserChangedGridColumnWidths=!0,l.BuildStyles(n,o),!1},c.gripOnMouseUp=function(e){return t(document).off("mousemove",c.onMouseMove),t(document).off("mouseup",c.gripOnMouseUp),e.target.parentElement.style.cursor="default",l.digest(n),n.isColumnResizing=!1,!1},c.copy=function(){var t=new C(e,n,o,l,a);return t.isClone=!0,t.orig=c,t},c.setVars=function(e){c.orig=e,c.width=e.width,c.groupIndex=e.groupIndex,c.isGroupedBy=e.isGroupedBy,c.displayName=e.displayName,c.index=e.index,c.isAggCol=e.isAggCol,c.cellClass=e.cellClass,c.cellFilter=e.cellFilter,c.field=e.field,c.aggLabelFilter=e.aggLabelFilter,c.visible=e.visible,c.sortable=e.sortable,c.resizable=e.resizable,c.pinnable=e.pinnable,c.pinned=e.pinned,c.originalIndex=e.originalIndex,c.sortDirection=e.sortDirection,c.sortingAlgorithm=e.sortingAlgorithm,c.headerClass=e.headerClass,c.headerCellTemplate=e.headerCellTemplate,c.cellTemplate=e.cellTemplate,c.cellEditTemplate=e.cellEditTemplate}},b=function(e){this.outerHeight=null,this.outerWidth=null,t.extend(this,e)},S=function(e){this.previousColumn=null,this.grid=e};S.prototype.changeUserSelect=function(e,t){e.css({"-webkit-touch-callout":t,"-webkit-user-select":t,"-khtml-user-select":t,"-moz-user-select":"none"===t?"-moz-none":t,"-ms-user-select":t,"user-select":t})},S.prototype.focusCellElement=function(e,t){if(e.selectionProvider.lastClickedRow){var n=void 0!==t?t:this.previousColumn,o=e.selectionProvider.lastClickedRow.clone?e.selectionProvider.lastClickedRow.clone.elm:e.selectionProvider.lastClickedRow.elm;if(void 0!==n&&o){var i=angular.element(o[0].children).filter(function(){return 8!==this.nodeType}),r=Math.max(Math.min(e.renderedColumns.length-1,n),0);this.grid.config.showSelectionCheckbox&&angular.element(i[r]).scope()&&0===angular.element(i[r]).scope().col.index&&(r=1),i[r]&&i[r].children[1].children[0].focus(),this.previousColumn=n}}},S.prototype.selectionHandlers=function(e,t){var n=!1,o=this;t.bind("keydown",function(i){if(16===i.keyCode)return o.changeUserSelect(t,"none",i),!0;if(!n){n=!0;var r=v(e,t,i,o.grid);return n=!1,r}return!0}),t.bind("keyup",function(e){return 16===e.keyCode&&o.changeUserSelect(t,"text",e),!0})};var x=function(n,o,i,r){var l=this;l.colToMove=void 0,l.groupToMove=void 0,l.assignEvents=function(){n.config.jqueryUIDraggable&&!n.config.enablePinning?n.$groupPanel.droppable({addClasses:!1,drop:function(e){l.onGroupDrop(e)}}):(n.$groupPanel.on("mousedown",l.onGroupMouseDown).on("dragover",l.dragOver).on("drop",l.onGroupDrop),n.$headerScroller.on("mousedown",l.onHeaderMouseDown).on("dragover",l.dragOver),n.config.enableColumnReordering&&!n.config.enablePinning&&n.$headerScroller.on("drop",l.onHeaderDrop)),o.$watch("renderedColumns",function(){r(l.setDraggables)})},l.dragStart=function(e){e.dataTransfer.setData("text","")},l.dragOver=function(e){e.preventDefault()},l.setDraggables=function(){if(n.config.jqueryUIDraggable)n.$root.find(".ngHeaderSortColumn").draggable({helper:"clone",appendTo:"body",stack:"div",addClasses:!1,start:function(e){l.onHeaderMouseDown(e)}}).droppable({drop:function(e){l.onHeaderDrop(e)}});else{var e=n.$root.find(".ngHeaderSortColumn");angular.forEach(e,function(e){e.className&&-1!==e.className.indexOf("ngHeaderSortColumn")&&(e.setAttribute("draggable","true"),e.addEventListener&&e.addEventListener("dragstart",l.dragStart))}),-1!==navigator.userAgent.indexOf("MSIE")&&n.$root.find(".ngHeaderSortColumn").bind("selectstart",function(){return this.dragDrop(),!1})}},l.onGroupMouseDown=function(e){var o=t(e.target);if("ngRemoveGroup"!==o[0].className){var i=angular.element(o).scope();i&&(n.config.jqueryUIDraggable||(o.attr("draggable","true"),this.addEventListener&&this.addEventListener("dragstart",l.dragStart),-1!==navigator.userAgent.indexOf("MSIE")&&o.bind("selectstart",function(){return this.dragDrop(),!1})),l.groupToMove={header:o,groupName:i.group,index:i.$index})}else l.groupToMove=void 0},l.onGroupDrop=function(e){e.stopPropagation();var i,r;l.groupToMove?(i=t(e.target).closest(".ngGroupElement"),"ngGroupPanel"===i.context.className?(o.configGroups.splice(l.groupToMove.index,1),o.configGroups.push(l.groupToMove.groupName)):(r=angular.element(i).scope(),r&&l.groupToMove.index!==r.$index&&(o.configGroups.splice(l.groupToMove.index,1),o.configGroups.splice(r.$index,0,l.groupToMove.groupName))),l.groupToMove=void 0,n.fixGroupIndexes()):l.colToMove&&(-1===o.configGroups.indexOf(l.colToMove.col)&&(i=t(e.target).closest(".ngGroupElement"),"ngGroupPanel"===i.context.className||"ngGroupPanelDescription ng-binding"===i.context.className?o.groupBy(l.colToMove.col):(r=angular.element(i).scope(),r&&o.removeGroup(r.$index))),l.colToMove=void 0),o.$$phase||o.$apply()},l.onHeaderMouseDown=function(e){var n=t(e.target).closest(".ngHeaderSortColumn"),o=angular.element(n).scope();o&&(l.colToMove={header:n,col:o.col})},l.onHeaderDrop=function(e){if(l.colToMove&&!l.colToMove.col.pinned){var r=t(e.target).closest(".ngHeaderSortColumn"),a=angular.element(r).scope();if(a){if(l.colToMove.col===a.col)return;o.columns.splice(l.colToMove.col.index,1),o.columns.splice(a.col.index,0,l.colToMove.col),n.fixColumnIndexes(),l.colToMove=void 0,i.digest(o)}}},l.assignGridEventHandlers=function(){-1===n.config.tabIndex?(n.$viewport.attr("tabIndex",i.numberOfGrids),i.numberOfGrids++):n.$viewport.attr("tabIndex",n.config.tabIndex);var r;t(e).resize(function(){clearTimeout(r),r=setTimeout(function(){i.RebuildGrid(o,n)},100)});var l;t(n.$root.parent()).on("resize",function(){clearTimeout(l),l=setTimeout(function(){i.RebuildGrid(o,n)},100)})},l.assignGridEventHandlers(),l.assignEvents()},y=function(e,t){e.maxRows=function(){var n=Math.max(e.totalServerItems,t.data.length);return n},e.multiSelect=t.config.enableRowSelection&&t.config.multiSelect,e.selectedItemCount=t.selectedItemCount,e.maxPages=function(){return Math.ceil(e.maxRows()/e.pagingOptions.pageSize)},e.pageForward=function(){var t=e.pagingOptions.currentPage;e.totalServerItems>0?e.pagingOptions.currentPage=Math.min(t+1,e.maxPages()):e.pagingOptions.currentPage++},e.pageBackward=function(){var t=e.pagingOptions.currentPage;e.pagingOptions.currentPage=Math.max(t-1,1)},e.pageToFirst=function(){e.pagingOptions.currentPage=1},e.pageToLast=function(){var t=e.maxPages();e.pagingOptions.currentPage=t},e.cantPageForward=function(){var n=e.pagingOptions.currentPage,o=e.maxPages();return e.totalServerItems>0?n>=o:1>t.data.length},e.cantPageToLast=function(){return e.totalServerItems>0?e.cantPageForward():!0},e.cantPageBackward=function(){var t=e.pagingOptions.currentPage;return 1>=t}},T=function(i,r,l,a,c,g,d,u,f,p,m){var v={aggregateTemplate:void 0,afterSelectionChange:function(){},beforeSelectionChange:function(){return!0},checkboxCellTemplate:void 0,checkboxHeaderTemplate:void 0,columnDefs:void 0,data:[],dataUpdated:function(){},enableCellEdit:!1,enableCellEditOnFocus:!1,enableCellSelection:!1,enableColumnResize:!1,enableColumnReordering:!1,enableColumnHeavyVirt:!1,enablePaging:!1,enablePinning:!1,enableRowSelection:!0,enableSorting:!0,enableHighlighting:!1,excludeProperties:[],filterOptions:{filterText:"",useExternalFilter:!1},footerRowHeight:55,footerTemplate:void 0,groups:[],groupsCollapsedByDefault:!0,headerRowHeight:30,headerRowTemplate:void 0,jqueryUIDraggable:!1,jqueryUITheme:!1,keepLastSelected:!0,maintainColumnRatios:void 0,menuTemplate:void 0,multiSelect:!0,pagingOptions:{pageSizes:[250,500,1e3],pageSize:250,currentPage:1},pinSelectionCheckbox:!1,plugins:[],primaryKey:void 0,rowHeight:30,rowTemplate:void 0,selectedItems:[],selectWithCheckboxOnly:!1,showColumnMenu:!1,showFilter:!1,showFooter:!1,showGroupPanel:!1,showSelectionCheckbox:!1,sortInfo:{fields:[],columns:[],directions:[]},tabIndex:-1,totalServerItems:0,useExternalSorting:!1,i18n:"en",virtualizationThreshold:50},w=this;w.maxCanvasHt=0,w.config=t.extend(v,e.ngGrid.config,r),w.config.showSelectionCheckbox=w.config.showSelectionCheckbox&&w.config.enableColumnHeavyVirt===!1,w.config.enablePinning=w.config.enablePinning&&w.config.enableColumnHeavyVirt===!1,w.config.selectWithCheckboxOnly=w.config.selectWithCheckboxOnly&&w.config.showSelectionCheckbox!==!1,w.config.pinSelectionCheckbox=w.config.enablePinning,"string"==typeof r.columnDefs&&(w.config.columnDefs=i.$eval(r.columnDefs)),w.rowCache=[],w.rowMap=[],w.gridId="ng"+d.newId(),w.$root=null,w.$groupPanel=null,w.$topPanel=null,w.$headerContainer=null,w.$headerScroller=null,w.$headers=null,w.$viewport=null,w.$canvas=null,w.rootDim=w.config.gridDim,w.data=[],w.lateBindColumns=!1,w.filteredRows=[],w.initTemplates=function(){var e=["rowTemplate","aggregateTemplate","headerRowTemplate","checkboxCellTemplate","checkboxHeaderTemplate","menuTemplate","footerTemplate"],t=[];return angular.forEach(e,function(e){t.push(w.getTemplate(e))}),m.all(t)},w.getTemplate=function(e){var t=w.config[e],n=w.gridId+e+".html",o=m.defer();if(t&&!h.test(t))p.get(t,{cache:g}).success(function(e){g.put(n,e),o.resolve()}).error(function(){o.reject("Could not load template: "+t)});else if(t)g.put(n,t),o.resolve();else{var i=e+".html";g.put(n,g.get(i)),o.resolve()}return o.promise},"object"==typeof w.config.data&&(w.data=w.config.data),w.calcMaxCanvasHeight=function(){var e;return e=w.config.groups.length>0?w.rowFactory.parsedData.filter(function(e){return!e[s]}).length*w.config.rowHeight:w.filteredRows.length*w.config.rowHeight},w.elementDims={scrollW:0,scrollH:0,rowIndexCellW:25,rowSelectedCellW:25,rootMaxW:0,rootMaxH:0},w.setRenderedRows=function(e){i.renderedRows.length=e.length;for(var t=0;e.length>t;t++)!i.renderedRows[t]||e[t].isAggRow||i.renderedRows[t].isAggRow?(i.renderedRows[t]=e[t].copy(),i.renderedRows[t].collapsed=e[t].collapsed,e[t].isAggRow||i.renderedRows[t].setVars(e[t])):i.renderedRows[t].setVars(e[t]),i.renderedRows[t].rowIndex=e[t].rowIndex,i.renderedRows[t].offsetTop=e[t].offsetTop,i.renderedRows[t].selected=e[t].selected,e[t].renderedRowIndex=t;w.refreshDomSizes(),i.$emit("ngGridEventRows",e)},w.minRowsToRender=function(){var e=i.viewportDimHeight()||1;return Math.floor(e/w.config.rowHeight)},w.refreshDomSizes=function(){var e=new b;e.outerWidth=w.elementDims.rootMaxW,e.outerHeight=w.elementDims.rootMaxH,w.rootDim=e,w.maxCanvasHt=w.calcMaxCanvasHeight()},w.buildColumnDefsFromData=function(){w.config.columnDefs=[];var e=w.data[0];return e?(d.forIn(e,function(e,t){-1===w.config.excludeProperties.indexOf(t)&&w.config.columnDefs.push({field:t})}),void 0):(w.lateBoundColumns=!0,void 0)},w.buildColumns=function(){var e=w.config.columnDefs,t=[];if(e||(w.buildColumnDefsFromData(),e=w.config.columnDefs),w.config.showSelectionCheckbox&&t.push(new C({colDef:{field:"✔",width:w.elementDims.rowSelectedCellW,sortable:!1,resizable:!1,groupable:!1,headerCellTemplate:g.get(i.gridId+"checkboxHeaderTemplate.html"),cellTemplate:g.get(i.gridId+"checkboxCellTemplate.html"),pinned:w.config.pinSelectionCheckbox},index:0,headerRowHeight:w.config.headerRowHeight,sortCallback:w.sortData,resizeOnDataCallback:w.resizeOnData,enableResize:w.config.enableColumnResize,enableSort:w.config.enableSorting,enablePinning:w.config.enablePinning},i,w,a,g,d)),e.length>0){var n=w.config.showSelectionCheckbox?1:0,o=i.configGroups.length;i.configGroups.length=0,angular.forEach(e,function(e,r){r+=n;var l=new C({colDef:e,index:r+o,originalIndex:r,headerRowHeight:w.config.headerRowHeight,sortCallback:w.sortData,resizeOnDataCallback:w.resizeOnData,enableResize:w.config.enableColumnResize,enableSort:w.config.enableSorting,enablePinning:w.config.enablePinning,enableCellEdit:w.config.enableCellEdit||w.config.enableCellEditOnFocus},i,w,a,g,d),s=w.config.groups.indexOf(e.field);-1!==s&&(l.isGroupedBy=!0,i.configGroups.splice(s,0,l),l.groupIndex=i.configGroups.length),t.push(l)}),i.columns=t,w.config.groups.length>0&&w.rowFactory.getGrouping(w.config.groups)}},w.configureColumnWidths=function(){var e=[],t=[],n=0,o=0,r={};if(angular.forEach(i.columns,function(e,t){if(!d.isNullOrUndefined(e.originalIndex)){var n=e.originalIndex;w.config.showSelectionCheckbox&&(0===e.originalIndex&&e.visible&&(o+=25),n--),r[n]=t}}),angular.forEach(w.config.columnDefs,function(l,a){var s=i.columns[r[a]];l.index=a;var c,g=!1;if(d.isNullOrUndefined(l.width)?l.width="*":(g=isNaN(l.width)?d.endsWith(l.width,"%"):!1,c=g?l.width:parseInt(l.width,10)),isNaN(c)&&!i.hasUserChangedGridColumnWidths){if(c=l.width,"auto"===c){s.width=s.minWidth,o+=s.width;var u=s;return i.$on("ngGridEventData",function(){w.resizeOnData(u)}),void 0}if(-1!==c.indexOf("*"))return s.visible!==!1&&(n+=c.length),e.push(l),void 0;if(g)return t.push(l),void 0;throw'unable to parse column width, use percentage ("10%","20%", etc...) or "*" to use remaining width of grid'}s.visible!==!1&&(o+=s.width=parseInt(s.width,10))}),t.length>0){w.config.maintainColumnRatios=w.config.maintainColumnRatios!==!1;var l=0,s=0;angular.forEach(t,function(e){var t=i.columns[r[e.index]],n=e.width,o=parseInt(n.slice(0,-1),10)/100;l+=o,t.visible||(s+=o)});var c=l-s;angular.forEach(t,function(e){var t=i.columns[r[e.index]],n=e.width,a=parseInt(n.slice(0,-1),10)/100;a/=s>0?c:l;var g=w.rootDim.outerWidth*l;t.width=Math.floor(g*a),o+=t.width})}if(e.length>0){w.config.maintainColumnRatios=w.config.maintainColumnRatios!==!1;var g=w.rootDim.outerWidth-o;w.maxCanvasHt>i.viewportDimHeight()&&(g-=a.ScrollW);var u=Math.floor(g/n);angular.forEach(e,function(t,n){var l=i.columns[r[t.index]];l.width=u*t.width.length,l.visible!==!1&&(o+=l.width);var s=n===e.length-1;if(s&&w.rootDim.outerWidth>o){var c=w.rootDim.outerWidth-o;w.maxCanvasHt>i.viewportDimHeight()&&(c-=a.ScrollW),l.width+=c}})}},w.init=function(){return w.initTemplates().then(function(){i.selectionProvider=new D(w,i,f),i.domAccessProvider=new S(w),w.rowFactory=new R(w,i,a,g,d),w.searchProvider=new $(i,w,c),w.styleProvider=new L(i,w),i.$watch("configGroups",function(e){var t=[];angular.forEach(e,function(e){t.push(e.field||e)}),w.config.groups=t,w.rowFactory.filteredRowsChanged(),i.$emit("ngGridEventGroups",e)},!0),i.$watch("columns",function(e){i.isColumnResizing||a.RebuildGrid(i,w),i.$emit("ngGridEventColumns",e)},!0),i.$watch(function(){return r.i18n},function(e){d.seti18n(i,e)}),w.maxCanvasHt=w.calcMaxCanvasHeight(),w.config.sortInfo.fields&&w.config.sortInfo.fields.length>0&&i.$watch(function(){return w.config.sortInfo},function(){l.isSorting||(w.sortColumnsInit(),i.$emit("ngGridEventSorted",w.config.sortInfo))},!0)})},w.resizeOnData=function(e){var n=e.minWidth,o=d.getElementsByClassName("col"+e.index);angular.forEach(o,function(e,o){var i;if(0===o){var r=t(e).find(".ngHeaderText");i=d.visualLength(r)+10}else{var l=t(e).find(".ngCellText");i=d.visualLength(l)+10}i>n&&(n=i)}),e.width=e.longest=Math.min(e.maxWidth,n+7),a.BuildStyles(i,w,!0)},w.lastSortedColumns=[],w.sortData=function(e,n){if(n&&n.shiftKey&&w.config.sortInfo){var o=w.config.sortInfo.columns.indexOf(e);-1===o?(1===w.config.sortInfo.columns.length&&(w.config.sortInfo.columns[0].sortPriority=1),w.config.sortInfo.columns.push(e),e.sortPriority=w.config.sortInfo.columns.length,w.config.sortInfo.fields.push(e.field),w.config.sortInfo.directions.push(e.sortDirection),w.lastSortedColumns.push(e)):w.config.sortInfo.directions[o]=e.sortDirection}else{var r=t.isArray(e);w.config.sortInfo.columns.length=0,w.config.sortInfo.fields.length=0,w.config.sortInfo.directions.length=0;var l=function(e){w.config.sortInfo.columns.push(e),w.config.sortInfo.fields.push(e.field),w.config.sortInfo.directions.push(e.sortDirection),w.lastSortedColumns.push(e)};r?(w.clearSortingData(),angular.forEach(e,function(e,t){e.sortPriority=t+1,l(e)})):(w.clearSortingData(e),e.sortPriority=void 0,l(e))}w.sortActual(),w.searchProvider.evalFilter(),i.$emit("ngGridEventSorted",w.config.sortInfo)},w.sortColumnsInit=function(){w.config.sortInfo.columns?w.config.sortInfo.columns.length=0:w.config.sortInfo.columns=[],angular.forEach(i.columns,function(e){var t=w.config.sortInfo.fields.indexOf(e.field);-1!==t&&(e.sortDirection=w.config.sortInfo.directions[t]||"asc",w.config.sortInfo.columns[t]=e)}),angular.forEach(w.config.sortInfo.columns,function(e){w.sortData(e)})},w.sortActual=function(){if(!w.config.useExternalSorting){var e=w.data.slice(0);angular.forEach(e,function(e,t){var n=w.rowMap[t];if(void 0!==n){var o=w.rowCache[n];void 0!==o&&(e.preSortSelected=o.selected,e.preSortIndex=t)}}),l.Sort(w.config.sortInfo,e),angular.forEach(e,function(e,t){w.rowCache[t].entity=e,w.rowCache[t].selected=e.preSortSelected,w.rowMap[e.preSortIndex]=t,delete e.preSortSelected,delete e.preSortIndex})}},w.clearSortingData=function(e){e?(angular.forEach(w.lastSortedColumns,function(t){e.index!==t.index&&(t.sortDirection="",t.sortPriority=null)}),w.lastSortedColumns[0]=e,w.lastSortedColumns.length=1):(angular.forEach(w.lastSortedColumns,function(e){e.sortDirection="",e.sortPriority=null}),w.lastSortedColumns=[])},w.fixColumnIndexes=function(){for(var e=0;i.columns.length>e;e++)i.columns[e].index=e},w.fixGroupIndexes=function(){angular.forEach(i.configGroups,function(e,t){e.groupIndex=t+1})},i.elementsNeedMeasuring=!0,i.columns=[],i.renderedRows=[],i.renderedColumns=[],i.headerRow=null,i.rowHeight=w.config.rowHeight,i.jqueryUITheme=w.config.jqueryUITheme,i.showSelectionCheckbox=w.config.showSelectionCheckbox,i.enableCellSelection=w.config.enableCellSelection,i.enableCellEditOnFocus=w.config.enableCellEditOnFocus,i.footer=null,i.selectedItems=w.config.selectedItems,i.multiSelect=w.config.multiSelect,i.showFooter=w.config.showFooter,i.footerRowHeight=i.showFooter?w.config.footerRowHeight:0,i.showColumnMenu=w.config.showColumnMenu,i.showMenu=!1,i.configGroups=[],i.gridId=w.gridId,i.enablePaging=w.config.enablePaging,i.pagingOptions=w.config.pagingOptions,i.i18n={},d.seti18n(i,w.config.i18n),i.adjustScrollLeft=function(e){for(var t=0,n=0,o=i.columns.length,r=[],l=!w.config.enableColumnHeavyVirt,s=0,c=function(e){l?r.push(e):i.renderedColumns[s]?i.renderedColumns[s].setVars(e):i.renderedColumns[s]=e.copy(),s++},g=0;o>g;g++){var d=i.columns[g];if(d.visible!==!1){var u=d.width+t;if(d.pinned){c(d);var f=g>0?e+n:e;a.setColLeft(d,f,w),n+=d.width}else u>=e&&e+w.rootDim.outerWidth>=t&&c(d);t+=d.width}}l&&(i.renderedColumns=r)},w.prevScrollTop=0,w.prevScrollIndex=0,i.adjustScrollTop=function(e,t){if(w.prevScrollTop!==e||t){e>0&&w.$viewport[0].scrollHeight-e<=w.$viewport.outerHeight()&&i.$emit("ngGridEventScroll");
var r,l=Math.floor(e/w.config.rowHeight);if(w.filteredRows.length>w.config.virtualizationThreshold){if(e>w.prevScrollTop&&w.prevScrollIndex+o>l)return;if(w.prevScrollTop>e&&l>w.prevScrollIndex-o)return;r=new P(Math.max(0,l-n),l+w.minRowsToRender()+n)}else{var a=i.configGroups.length>0?w.rowFactory.parsedData.length:w.data.length;r=new P(0,Math.max(a,w.minRowsToRender()+n))}w.prevScrollTop=e,w.rowFactory.UpdateViewableRange(r),w.prevScrollIndex=l}},i.toggleShowMenu=function(){i.showMenu=!i.showMenu},i.toggleSelectAll=function(e,t){i.selectionProvider.toggleSelectAll(e,!1,t)},i.totalFilteredItemsLength=function(){return w.filteredRows.length},i.showGroupPanel=function(){return w.config.showGroupPanel},i.topPanelHeight=function(){return w.config.showGroupPanel===!0?w.config.headerRowHeight+32:w.config.headerRowHeight},i.viewportDimHeight=function(){return Math.max(0,w.rootDim.outerHeight-i.topPanelHeight()-i.footerRowHeight-2)},i.groupBy=function(e){if(!(1>w.data.length)&&e.groupable&&e.field){e.sortDirection||e.sort({shiftKey:i.configGroups.length>0?!0:!1});var t=i.configGroups.indexOf(e);-1===t?(e.isGroupedBy=!0,i.configGroups.push(e),e.groupIndex=i.configGroups.length):i.removeGroup(t),w.$viewport.scrollTop(0),a.digest(i)}},i.removeGroup=function(e){var t=i.columns.filter(function(t){return t.groupIndex===e+1})[0];t.isGroupedBy=!1,t.groupIndex=0,i.columns[e].isAggCol&&(i.columns.splice(e,1),i.configGroups.splice(e,1),w.fixGroupIndexes()),0===i.configGroups.length&&(w.fixColumnIndexes(),a.digest(i)),i.adjustScrollLeft(0)},i.togglePin=function(e){for(var t=e.index,n=0,o=0;i.columns.length>o&&i.columns[o].pinned;o++)n++;e.pinned&&(n=Math.max(e.originalIndex,n-1)),e.pinned=!e.pinned,i.columns.splice(t,1),i.columns.splice(n,0,e),w.fixColumnIndexes(),a.BuildStyles(i,w,!0),w.$viewport.scrollLeft(w.$viewport.scrollLeft()-e.width)},i.totalRowWidth=function(){for(var e=0,t=i.columns,n=0;t.length>n;n++)t[n].visible!==!1&&(e+=t[n].width);return e},i.headerScrollerDim=function(){var e=i.viewportDimHeight(),t=w.maxCanvasHt,n=t>e,o=new b;return o.autoFitHeight=!0,o.outerWidth=i.totalRowWidth(),n?o.outerWidth+=w.elementDims.scrollW:w.elementDims.scrollH>=t-e&&(o.outerWidth+=w.elementDims.scrollW),o}},P=function(e,t){this.topRow=e,this.bottomRow=t},I=function(e,t,n,o,i){this.entity=e,this.config=t,this.selectionProvider=n,this.rowIndex=o,this.utils=i,this.selected=n.getSelection(e),this.cursor=this.config.enableRowSelection?"pointer":"default",this.beforeSelectionChange=t.beforeSelectionChangeCallback,this.afterSelectionChange=t.afterSelectionChangeCallback,this.offsetTop=this.rowIndex*t.rowHeight,this.rowDisplayIndex=0};I.prototype.setSelection=function(e){this.selectionProvider.setSelection(this,e),this.selectionProvider.lastClickedRow=this},I.prototype.continueSelection=function(e){this.selectionProvider.ChangeSelection(this,e)},I.prototype.ensureEntity=function(e){this.entity!==e&&(this.entity=e,this.selected=this.selectionProvider.getSelection(this.entity))},I.prototype.toggleSelected=function(e){if(!this.config.enableRowSelection&&!this.config.enableCellSelection)return!0;var t=e.target||e;return"checkbox"===t.type&&"ngSelectionCell ng-scope"!==t.parentElement.className?!0:this.config.selectWithCheckboxOnly&&"checkbox"!==t.type?(this.selectionProvider.lastClickedRow=this,!0):(this.beforeSelectionChange(this,e)&&this.continueSelection(e),!1)},I.prototype.alternatingRowClass=function(){var e=0===this.rowIndex%2,t={ngRow:!0,selected:this.selected,even:e,odd:!e,"ui-state-default":this.config.jqueryUITheme&&e,"ui-state-active":this.config.jqueryUITheme&&!e};return t},I.prototype.getProperty=function(e){return this.utils.evalProperty(this.entity,e)},I.prototype.copy=function(){return this.clone=new I(this.entity,this.config,this.selectionProvider,this.rowIndex,this.utils),this.clone.isClone=!0,this.clone.elm=this.elm,this.clone.orig=this,this.clone},I.prototype.setVars=function(e){e.clone=this,this.entity=e.entity,this.selected=e.selected,this.orig=e};var R=function(e,t,o,i,r){var g=this;g.aggCache={},g.parentCache=[],g.dataChanged=!0,g.parsedData=[],g.rowConfig={},g.selectionProvider=t.selectionProvider,g.rowHeight=30,g.numberOfAggregates=0,g.groupedData=void 0,g.rowHeight=e.config.rowHeight,g.rowConfig={enableRowSelection:e.config.enableRowSelection,rowClasses:e.config.rowClasses,selectedItems:t.selectedItems,selectWithCheckboxOnly:e.config.selectWithCheckboxOnly,beforeSelectionChangeCallback:e.config.beforeSelectionChange,afterSelectionChangeCallback:e.config.afterSelectionChange,jqueryUITheme:e.config.jqueryUITheme,enableCellSelection:e.config.enableCellSelection,rowHeight:e.config.rowHeight},g.renderedRange=new P(0,e.minRowsToRender()+n),g.buildEntityRow=function(e,t){return new I(e,g.rowConfig,g.selectionProvider,t,r)},g.buildAggregateRow=function(t,n){var o=g.aggCache[t.aggIndex];return o||(o=new w(t,g,g.rowConfig.rowHeight,e.config.groupsCollapsedByDefault),g.aggCache[t.aggIndex]=o),o.rowIndex=n,o.offsetTop=n*g.rowConfig.rowHeight,o},g.UpdateViewableRange=function(e){g.renderedRange=e,g.renderedChange()},g.filteredRowsChanged=function(){e.lateBoundColumns&&e.filteredRows.length>0&&(e.config.columnDefs=void 0,e.buildColumns(),e.lateBoundColumns=!1,t.$evalAsync(function(){t.adjustScrollLeft(0)})),g.dataChanged=!0,e.config.groups.length>0&&g.getGrouping(e.config.groups),g.UpdateViewableRange(g.renderedRange)},g.renderedChange=function(){if(!g.groupedData||1>e.config.groups.length)return g.renderedChangeNoGroups(),e.refreshDomSizes(),void 0;g.wasGrouped=!0,g.parentCache=[];var t=0,n=g.parsedData.filter(function(e){return e.isAggRow?e.parent&&e.parent.collapsed?!1:!0:(e[s]||(e.rowIndex=t++),!e[s])});g.totalRows=n.length;for(var o=[],i=g.renderedRange.topRow;g.renderedRange.bottomRow>i;i++)n[i]&&(n[i].offsetTop=i*e.config.rowHeight,o.push(n[i]));e.setRenderedRows(o)},g.renderedChangeNoGroups=function(){for(var t=[],n=g.renderedRange.topRow;g.renderedRange.bottomRow>n;n++)e.filteredRows[n]&&(e.filteredRows[n].rowIndex=n,e.filteredRows[n].offsetTop=n*e.config.rowHeight,t.push(e.filteredRows[n]));e.setRenderedRows(t)},g.fixRowCache=function(){var t=e.data.length,n=t-e.rowCache.length;if(0>n)e.rowCache.length=e.rowMap.length=t;else for(var o=e.rowCache.length;t>o;o++)e.rowCache[o]=e.rowFactory.buildEntityRow(e.data[o],o)},g.parseGroupData=function(e){if(e.values)for(var t=0;e.values.length>t;t++)g.parentCache[g.parentCache.length-1].children.push(e.values[t]),g.parsedData.push(e.values[t]);else for(var n in e)if(n!==l&&n!==a&&n!==c&&e.hasOwnProperty(n)){var o=g.buildAggregateRow({gField:e[l],gLabel:n,gDepth:e[a],isAggRow:!0,_ng_hidden_:!1,children:[],aggChildren:[],aggIndex:g.numberOfAggregates,aggLabelFilter:e[c].aggLabelFilter},0);g.numberOfAggregates++,o.parent=g.parentCache[o.depth-1],o.parent&&(o.parent.collapsed=!1,o.parent.aggChildren.push(o)),g.parsedData.push(o),g.parentCache[o.depth]=o,g.parseGroupData(e[n])}},g.getGrouping=function(n){function d(e,t){return e.filter(function(e){return e.field===t})}g.aggCache=[],g.numberOfAggregates=0,g.groupedData={};for(var u=e.filteredRows,f=n.length,h=t.columns,p=0;u.length>p;p++){var m=u[p].entity;if(!m)return;u[p][s]=e.config.groupsCollapsedByDefault;for(var v=g.groupedData,w=0;n.length>w;w++){var b=n[w],S=d(h,b)[0],x=r.evalProperty(m,b);x=x?""+x:"null",v[x]||(v[x]={}),v[l]||(v[l]=b),v[a]||(v[a]=w),v[c]||(v[c]=S),v=v[x]}v.values||(v.values=[]),v.values.push(u[p])}if(h.length>0)for(var y=0;n.length>y;y++)!h[y].isAggCol&&f>=y&&h.splice(0,0,new C({colDef:{field:"",width:25,sortable:!1,resizable:!1,headerCellTemplate:'<div class="ngAggHeader"></div>',pinned:e.config.pinSelectionCheckbox},enablePinning:e.config.enablePinning,isAggCol:!0,headerRowHeight:e.config.headerRowHeight},t,e,o,i,r));e.fixColumnIndexes(),t.adjustScrollLeft(0),g.parsedData.length=0,g.parseGroupData(g.groupedData),g.fixRowCache()},e.config.groups.length>0&&e.filteredRows.length>0&&g.getGrouping(e.config.groups)},$=function(e,n,o){var i=this,r=[];i.extFilter=n.config.filterOptions.useExternalFilter,e.showFilter=n.config.showFilter,e.filterText="",i.fieldMap={};var l=function(e,t,n){var i;for(var r in t)if(t.hasOwnProperty(r)){var a=n[r.toLowerCase()];if(!a)continue;var s=t[r];if("object"==typeof s)return l(e,s,a);var c=null,g=null;if(a&&a.cellFilter&&(g=a.cellFilter.split(":"),c=o(g[0])),null!==s&&void 0!==s){if("function"==typeof c){var d=""+c(s,g[1]);i=e.regex.test(d)}else i=e.regex.test(""+s);if(i)return!0}}return!1},a=function(e,t){var n,r=i.fieldMap[e.columnDisplay];if(!r)return!1;var l=r.cellFilter.split(":"),a=r.cellFilter?o(l[0]):null,s=t[e.column]||t[r.field.split(".")[0]];if(null===s||void 0===s)return!1;if("function"==typeof a){var g=""+a("object"==typeof s?c(s,r.field):s,l[1]);n=e.regex.test(g)}else n=e.regex.test("object"==typeof s?""+c(s,r.field):""+s);return n?!0:!1},s=function(e){for(var t=0,n=r.length;n>t;t++){var o,s=r[t];if(o=s.column?a(s,e):l(s,e,i.fieldMap),!o)return!1}return!0};i.evalFilter=function(){n.filteredRows=0===r.length?n.rowCache:n.rowCache.filter(function(e){return s(e.entity)});for(var e=0;n.filteredRows.length>e;e++)n.filteredRows[e].rowIndex=e;n.rowFactory.filteredRowsChanged()};var c=function(e,t){if("object"!=typeof e||"string"!=typeof t)return e;var n=t.split("."),o=e;if(n.length>1){for(var i=1,r=n.length;r>i;i++)if(o=o[n[i]],!o)return e;return o}return e},g=function(e,t){try{return RegExp(e,t)}catch(n){return RegExp(e.replace(/(\^|\$|\(|\)|<|>|\[|\]|\{|\}|\\|\||\.|\*|\+|\?)/g,"\\$1"))}},d=function(e){r=[];var n;if(n=t.trim(e))for(var o=n.split(";"),i=0;o.length>i;i++){var l=o[i].split(":");if(l.length>1){var a=t.trim(l[0]),s=t.trim(l[1]);a&&s&&r.push({column:a,columnDisplay:a.replace(/\s+/g,"").toLowerCase(),regex:g(s,"i")})}else{var c=t.trim(l[0]);c&&r.push({column:"",regex:g(c,"i")})}}};i.extFilter||e.$watch("columns",function(e){for(var t=0;e.length>t;t++){var n=e[t];if(n.field)if(n.field.match(/\./g)){for(var o=n.field.split("."),r=i.fieldMap,l=0;o.length-1>l;l++)r[o[l]]=r[o[l]]||{},r=r[o[l]];r[o[o.length-1]]=n}else i.fieldMap[n.field.toLowerCase()]=n;n.displayName&&(i.fieldMap[n.displayName.toLowerCase().replace(/\s+/g,"")]=n)}}),e.$watch(function(){return n.config.filterOptions.filterText},function(t){e.filterText=t}),e.$watch("filterText",function(t){i.extFilter||(e.$emit("ngGridEventFilter",t),d(t),i.evalFilter())})},D=function(e,t,n){var o=this;o.multi=e.config.multiSelect,o.selectedItems=e.config.selectedItems,o.selectedIndex=e.config.selectedIndex,o.lastClickedRow=void 0,o.ignoreSelectedItemChanges=!1,o.pKeyParser=n(e.config.primaryKey),o.ChangeSelection=function(n,i){var r=i.which||i.keyCode,l=40===r||38===r;if(i&&i.shiftKey&&!i.keyCode&&o.multi&&e.config.enableRowSelection){if(o.lastClickedRow){var a;a=t.configGroups.length>0?e.rowFactory.parsedData.filter(function(e){return!e.isAggRow}):e.filteredRows;var s=n.rowIndex,c=o.lastClickedRowIndex;if(s===c)return!1;c>s?(s^=c,c=s^c,s^=c,s--):c++;for(var g=[];s>=c;c++)g.push(a[c]);if(g[g.length-1].beforeSelectionChange(g,i)){for(var d=0;g.length>d;d++){var u=g[d],f=u.selected;u.selected=!f,u.clone&&(u.clone.selected=u.selected);var h=o.selectedItems.indexOf(u.entity);-1===h?o.selectedItems.push(u.entity):o.selectedItems.splice(h,1)}g[g.length-1].afterSelectionChange(g,i)}return o.lastClickedRow=n,o.lastClickedRowIndex=n.rowIndex,!0}}else o.multi?(!i.keyCode||l&&!e.config.selectWithCheckboxOnly)&&o.setSelection(n,!n.selected):o.lastClickedRow===n?o.setSelection(o.lastClickedRow,e.config.keepLastSelected?!0:!n.selected):(o.lastClickedRow&&o.setSelection(o.lastClickedRow,!1),o.setSelection(n,!n.selected));return o.lastClickedRow=n,o.lastClickedRowIndex=n.rowIndex,!0},o.getSelection=function(t){var n=!1;if(e.config.primaryKey){var i=o.pKeyParser(t);angular.forEach(o.selectedItems,function(e){i===o.pKeyParser(e)&&(n=!0)})}else n=-1!==o.selectedItems.indexOf(t);return n},o.setSelection=function(t,n){if(e.config.enableRowSelection){if(n)-1===o.selectedItems.indexOf(t.entity)&&(!o.multi&&o.selectedItems.length>0&&o.toggleSelectAll(!1,!0),o.selectedItems.push(t.entity));else{var i=o.selectedItems.indexOf(t.entity);-1!==i&&o.selectedItems.splice(i,1)}t.selected=n,t.orig&&(t.orig.selected=n),t.clone&&(t.clone.selected=n),t.afterSelectionChange(t)}},o.toggleSelectAll=function(t,n,i){var r=i?e.filteredRows:e.rowCache;if(n||e.config.beforeSelectionChange(r,t)){var l=o.selectedItems.length;l>0&&(o.selectedItems.length=0);for(var a=0;r.length>a;a++)r[a].selected=t,r[a].clone&&(r[a].clone.selected=t),t&&o.selectedItems.push(r[a].entity);n||e.config.afterSelectionChange(r,t)}}},L=function(e,t){e.headerCellStyle=function(e){return{height:e.headerRowHeight+"px"}},e.rowStyle=function(t){var n={top:t.offsetTop+"px",height:e.rowHeight+"px"};return t.isAggRow&&(n.left=t.offsetLeft),n},e.canvasStyle=function(){return{height:t.maxCanvasHt+"px"}},e.headerScrollerStyle=function(){return{height:t.config.headerRowHeight+"px"}},e.topPanelStyle=function(){return{width:t.rootDim.outerWidth+"px",height:e.topPanelHeight()+"px"}},e.headerStyle=function(){return{width:t.rootDim.outerWidth+"px",height:t.config.headerRowHeight+"px"}},e.groupPanelStyle=function(){return{width:t.rootDim.outerWidth+"px",height:"32px"}},e.viewportStyle=function(){return{width:t.rootDim.outerWidth+"px",height:e.viewportDimHeight()+"px"}},e.footerStyle=function(){return{width:t.rootDim.outerWidth+"px",height:e.footerRowHeight+"px"}}};p.directive("ngCellHasFocus",["$domUtilityService",function(e){var t=function(t){t.isFocused=!0,e.digest(t),t.$broadcast("ngGridEventStartCellEdit"),t.$on("ngGridEventEndCellEdit",function(){t.isFocused=!1,e.digest(t)})};return function(e,n){var o=!1,i=!1;e.editCell=function(){e.enableCellEditOnFocus||setTimeout(function(){t(e,n)},0)},n.bind("mousedown",function(){return e.enableCellEditOnFocus?i=!0:n.focus(),!0}),n.bind("click",function(o){e.enableCellEditOnFocus&&(o.preventDefault(),i=!1,t(e,n))}),n.bind("focus",function(){return o=!0,e.enableCellEditOnFocus&&!i&&t(e,n),!0}),n.bind("blur",function(){return o=!1,!0}),n.bind("keydown",function(i){return e.enableCellEditOnFocus||(o&&37!==i.keyCode&&38!==i.keyCode&&39!==i.keyCode&&40!==i.keyCode&&9!==i.keyCode&&!i.shiftKey&&13!==i.keyCode&&t(e,n),o&&i.shiftKey&&i.keyCode>=65&&90>=i.keyCode&&t(e,n),27===i.keyCode&&n.focus()),!0})}}]),p.directive("ngCellText",function(){return function(e,t){t.bind("mouseover",function(e){e.preventDefault(),t.css({cursor:"text"})}),t.bind("mouseleave",function(e){e.preventDefault(),t.css({cursor:"default"})})}}),p.directive("ngCell",["$compile","$domUtilityService",function(e,t){var n={scope:!1,compile:function(){return{pre:function(t,n){var o,i=t.col.cellTemplate.replace(d,"row.entity."+t.col.field);t.col.enableCellEdit?(o=t.col.cellEditTemplate,o=o.replace(u,i),o=o.replace(f,t.col.editableCellTemplate.replace(d,"row.entity."+t.col.field))):o=i;var r=e(o)(t);t.enableCellSelection&&-1===r[0].className.indexOf("ngSelectionCell")&&(r[0].setAttribute("tabindex",0),r.addClass("ngCellElement")),n.append(r)},post:function(e,n){e.enableCellSelection&&e.domAccessProvider.selectionHandlers(e,n),e.$on("ngGridEventDigestCell",function(){t.digest(e)})}}}};return n}]),p.directive("ngEditCellIf",[function(){return{transclude:"element",priority:1e3,terminal:!0,restrict:"A",compile:function(e,t,n){return function(e,t,o){var i,r;e.$watch(o.ngEditCellIf,function(o){i&&(i.remove(),i=void 0),r&&(r.$destroy(),r=void 0),o&&(r=e.$new(),n(r,function(e){i=e,t.after(e)}))})}}}}]),p.directive("ngGridFooter",["$compile","$templateCache",function(e,t){var n={scope:!1,compile:function(){return{pre:function(n,o){0===o.children().length&&o.append(e(t.get(n.gridId+"footerTemplate.html"))(n))}}}};return n}]),p.directive("ngGridMenu",["$compile","$templateCache",function(e,t){var n={scope:!1,compile:function(){return{pre:function(n,o){0===o.children().length&&o.append(e(t.get(n.gridId+"menuTemplate.html"))(n))}}}};return n}]),p.directive("ngGrid",["$compile","$filter","$templateCache","$sortService","$domUtilityService","$utilityService","$timeout","$parse","$http","$q",function(e,n,o,i,r,l,a,s,c,g){var d={scope:!0,compile:function(){return{pre:function(d,u,f){var h=t(u),p=d.$eval(f.ngGrid);p.gridDim=new b({outerHeight:t(h).height(),outerWidth:t(h).width()});var m=new T(d,p,i,r,n,o,l,a,s,c,g);return m.init().then(function(){if("string"==typeof p.columnDefs?d.$parent.$watch(p.columnDefs,function(e){return e?(m.lateBoundColumns=!1,d.columns=[],m.config.columnDefs=e,m.buildColumns(),m.eventProvider.assignEvents(),r.RebuildGrid(d,m),void 0):(m.refreshDomSizes(),m.buildColumns(),void 0)},!0):m.buildColumns(),"string"==typeof p.totalServerItems?d.$parent.$watch(p.totalServerItems,function(e){d.totalServerItems=angular.isDefined(e)?e:0}):d.totalServerItems=0,"string"==typeof p.data){var n=function(e){m.data=t.extend([],e),m.rowFactory.fixRowCache(),angular.forEach(m.data,function(e,t){var n=m.rowMap[t]||t;m.rowCache[n]&&m.rowCache[n].ensureEntity(e),m.rowMap[n]=t}),m.searchProvider.evalFilter(),m.configureColumnWidths(),m.refreshDomSizes(),m.config.sortInfo.fields.length>0&&(m.sortColumnsInit(),d.$emit("ngGridEventSorted",m.config.sortInfo)),d.$emit("ngGridEventData",m.gridId)};d.$parent.$watch(p.data,n),d.$parent.$watch(p.data+".length",function(){n(d.$eval(p.data))})}return m.footerController=new y(d,m),u.addClass("ngGrid").addClass(""+m.gridId),p.enableHighlighting||u.addClass("unselectable"),p.jqueryUITheme&&u.addClass("ui-widget"),u.append(e(o.get("gridTemplate.html"))(d)),r.AssignGridContainers(d,u,m),m.eventProvider=new x(m,d,r,a),p.selectRow=function(e,t){m.rowCache[e]&&(m.rowCache[e].clone&&m.rowCache[e].clone.setSelection(t?!0:!1),m.rowCache[e].setSelection(t?!0:!1))},p.selectItem=function(e,t){p.selectRow(m.rowMap[e],t)},p.selectAll=function(e){d.toggleSelectAll(e)},p.selectVisible=function(e){d.toggleSelectAll(e,!0)},p.groupBy=function(e){if(e)d.groupBy(d.columns.filter(function(t){return t.field===e})[0]);else{var n=t.extend(!0,[],d.configGroups);angular.forEach(n,d.groupBy)}},p.sortBy=function(e){var t=d.columns.filter(function(t){return t.field===e})[0];t&&t.sort()},p.gridId=m.gridId,p.ngGrid=m,p.$gridScope=d,p.$gridServices={SortService:i,DomUtilityService:r,UtilityService:l},d.$on("ngGridEventDigestGrid",function(){r.digest(d.$parent)}),d.$on("ngGridEventDigestGridParent",function(){r.digest(d.$parent)}),d.$evalAsync(function(){d.adjustScrollLeft(0)}),angular.forEach(p.plugins,function(e){"function"==typeof e&&(e=new e),e.init(d.$new(),m,p.$gridServices),p.plugins[l.getInstanceType(e)]=e}),"function"==typeof p.init&&p.init(m,d),null})}}}};return d}]),p.directive("ngHeaderCell",["$compile",function(e){var t={scope:!1,compile:function(){return{pre:function(t,n){n.append(e(t.col.headerCellTemplate)(t))}}}};return t}]),p.directive("ngInput",[function(){return{require:"ngModel",link:function(e,t,n,o){var i,r=e.$watch("ngModel",function(){i=o.$modelValue,r()});t.bind("keydown",function(n){switch(n.keyCode){case 37:case 38:case 39:case 40:n.stopPropagation();break;case 27:e.$$phase||e.$apply(function(){o.$setViewValue(i),t.blur()});break;case 13:(e.enableCellEditOnFocus&&e.totalFilteredItemsLength()-1>e.row.rowIndex&&e.row.rowIndex>0||e.enableCellEdit)&&t.blur()}return!0}),t.bind("click",function(e){e.stopPropagation()}),t.bind("mousedown",function(e){e.stopPropagation()}),e.$on("ngGridEventStartCellEdit",function(){t.focus(),t.select()}),angular.element(t).bind("blur",function(){e.$emit("ngGridEventEndCellEdit")})}}}]),p.directive("ngRow",["$compile","$domUtilityService","$templateCache",function(e,t,n){var o={scope:!1,compile:function(){return{pre:function(o,i){if(o.row.elm=i,o.row.clone&&(o.row.clone.elm=i),o.row.isAggRow){var r=n.get(o.gridId+"aggregateTemplate.html");r=o.row.aggLabelFilter?r.replace(g,"| "+o.row.aggLabelFilter):r.replace(g,""),i.append(e(r)(o))}else i.append(e(n.get(o.gridId+"rowTemplate.html"))(o));o.$on("ngGridEventDigestRow",function(){t.digest(o)})}}}};return o}]),p.directive("ngViewport",[function(){return function(e,t){var n,o,i=0;t.bind("scroll",function(t){var r=t.target.scrollLeft,l=t.target.scrollTop;return e.$headerContainer&&e.$headerContainer.scrollLeft(r),e.adjustScrollLeft(r),e.adjustScrollTop(l),e.$root.$$phase||e.$digest(),o=r,i=l,n=!1,!0}),t.bind("mousewheel DOMMouseScroll",function(){return n=!0,t.focus&&t.focus(),!0}),e.enableCellSelection||e.domAccessProvider.selectionHandlers(e,t)}}]),e.ngGrid.i18n.da={ngAggregateLabel:"artikler",ngGroupPanelDescription:"Grupér rækker udfra en kolonne ved at trække dens overskift hertil.",ngSearchPlaceHolder:"Søg...",ngMenuText:"Vælg kolonner:",ngShowingItemsLabel:"Viste rækker:",ngTotalItemsLabel:"Rækker totalt:",ngSelectedItemsLabel:"Valgte rækker:",ngPageSizeLabel:"Side størrelse:",ngPagerFirstTitle:"Første side",ngPagerNextTitle:"Næste side",ngPagerPrevTitle:"Forrige side",ngPagerLastTitle:"Sidste side"},e.ngGrid.i18n.de={ngAggregateLabel:"artikel",ngGroupPanelDescription:"Ziehen Sie eine Spaltenüberschrift hier und legen Sie es der Gruppe nach dieser Spalte.",ngSearchPlaceHolder:"Suche...",ngMenuText:"Spalten auswählen:",ngShowingItemsLabel:"Zeige Artikel:",ngTotalItemsLabel:"Meiste Artikel:",ngSelectedItemsLabel:"Ausgewählte Artikel:",ngPageSizeLabel:"Größe Seite:",ngPagerFirstTitle:"Erste Page",ngPagerNextTitle:"Nächste Page",ngPagerPrevTitle:"Vorherige Page",ngPagerLastTitle:"Letzte Page"},e.ngGrid.i18n.en={ngAggregateLabel:"items",ngGroupPanelDescription:"Drag a column header here and drop it to group by that column.",ngSearchPlaceHolder:"Search...",ngMenuText:"Choose Columns:",ngShowingItemsLabel:"Showing Items:",ngTotalItemsLabel:"Total Items:",ngSelectedItemsLabel:"Selected Items:",ngPageSizeLabel:"Page Size:",ngPagerFirstTitle:"First Page",ngPagerNextTitle:"Next Page",ngPagerPrevTitle:"Previous Page",ngPagerLastTitle:"Last Page"},e.ngGrid.i18n.es={ngAggregateLabel:"Artículos",ngGroupPanelDescription:"Arrastre un encabezado de columna aquí y soltarlo para agrupar por esa columna.",ngSearchPlaceHolder:"Buscar...",ngMenuText:"Elegir columnas:",ngShowingItemsLabel:"Artículos Mostrando:",ngTotalItemsLabel:"Artículos Totales:",ngSelectedItemsLabel:"Artículos Seleccionados:",ngPageSizeLabel:"Tamaño de Página:",ngPagerFirstTitle:"Primera Página",ngPagerNextTitle:"Página Siguiente",ngPagerPrevTitle:"Página Anterior",ngPagerLastTitle:"Última Página"},e.ngGrid.i18n.fr={ngAggregateLabel:"articles",ngGroupPanelDescription:"Faites glisser un en-tête de colonne ici et déposez-le vers un groupe par cette colonne.",ngSearchPlaceHolder:"Recherche...",ngMenuText:"Choisir des colonnes:",ngShowingItemsLabel:"Articles Affichage des:",ngTotalItemsLabel:"Nombre total d'articles:",ngSelectedItemsLabel:"Éléments Articles:",ngPageSizeLabel:"Taille de page:",ngPagerFirstTitle:"Première page",ngPagerNextTitle:"Page Suivante",ngPagerPrevTitle:"Page précédente",ngPagerLastTitle:"Dernière page"},e.ngGrid.i18n["pt-br"]={ngAggregateLabel:"items",ngGroupPanelDescription:"Arraste e solte uma coluna aqui para agrupar por essa coluna",ngSearchPlaceHolder:"Procurar...",ngMenuText:"Selecione as colunas:",ngShowingItemsLabel:"Mostrando os Items:",ngTotalItemsLabel:"Total de Items:",ngSelectedItemsLabel:"Items Selecionados:",ngPageSizeLabel:"Tamanho da Página:",ngPagerFirstTitle:"Primeira Página",ngPagerNextTitle:"Próxima Página",ngPagerPrevTitle:"Página Anterior",ngPagerLastTitle:"Última Página"},e.ngGrid.i18n["zh-cn"]={ngAggregateLabel:"条目",ngGroupPanelDescription:"拖曳表头到此处以进行分组",ngSearchPlaceHolder:"搜索...",ngMenuText:"数据分组与选择列：",ngShowingItemsLabel:"当前显示条目：",ngTotalItemsLabel:"条目总数：",ngSelectedItemsLabel:"选中条目：",ngPageSizeLabel:"每页显示数：",ngPagerFirstTitle:"回到首页",ngPagerNextTitle:"下一页",ngPagerPrevTitle:"上一页",ngPagerLastTitle:"前往尾页"},e.ngGrid.i18n["zh-tw"]={ngAggregateLabel:"筆",ngGroupPanelDescription:"拖拉表頭到此處以進行分組",ngSearchPlaceHolder:"搜尋...",ngMenuText:"選擇欄位：",ngShowingItemsLabel:"目前顯示筆數：",ngTotalItemsLabel:"總筆數：",ngSelectedItemsLabel:"選取筆數：",ngPageSizeLabel:"每頁顯示：",ngPagerFirstTitle:"第一頁",ngPagerNextTitle:"下一頁",ngPagerPrevTitle:"上一頁",ngPagerLastTitle:"最後頁"},angular.module("ngGrid").run(["$templateCache",function(e){e.put("aggregateTemplate.html",'<div ng-click="row.toggleExpand()" ng-style="rowStyle(row)" class="ngAggregate">    <span class="ngAggregateText">{{row.label CUSTOM_FILTERS}} ({{row.totalChildren()}} {{AggItemsLabel}})</span>    <div class="{{row.aggClass()}}"></div></div>'),e.put("cellEditTemplate.html",'<div ng-cell-has-focus ng-dblclick="editCell()">	<div ng-edit-cell-if="!isFocused">			DISPLAY_CELL_TEMPLATE	</div>	<div ng-edit-cell-if="isFocused">		EDITABLE_CELL_TEMPLATE	</div></div>'),e.put("cellTemplate.html",'<div class="ngCellText" ng-class="col.colIndex()"><span ng-cell-text>{{COL_FIELD CUSTOM_FILTERS}}</span></div>'),e.put("checkboxCellTemplate.html",'<div class="ngSelectionCell"><input tabindex="-1" class="ngSelectionCheckbox" type="checkbox" ng-checked="row.selected" /></div>'),e.put("checkboxHeaderTemplate.html",'<input class="ngSelectionHeader" type="checkbox" ng-show="multiSelect" ng-model="allSelected" ng-change="toggleSelectAll(allSelected, true)"/>'),e.put("editableCellTemplate.html",'<input ng-class="\'colt\' + col.index" ng-input="COL_FIELD" ng-model="COL_FIELD" />'),e.put("footerTemplate.html",'<div ng-show="showFooter" class="ngFooterPanel" ng-class="{\'ui-widget-content\': jqueryUITheme, \'ui-corner-bottom\': jqueryUITheme}" ng-style="footerStyle()">    <div class="ngTotalSelectContainer" >        <div class="ngFooterTotalItems" ng-class="{\'ngNoMultiSelect\': !multiSelect}" >            <span class="ngLabel">{{i18n.ngTotalItemsLabel}} {{maxRows()}}</span><span ng-show="filterText.length > 0" class="ngLabel">({{i18n.ngShowingItemsLabel}} {{totalFilteredItemsLength()}})</span>        </div>        <div class="ngFooterSelectedItems" ng-show="multiSelect">            <span class="ngLabel">{{i18n.ngSelectedItemsLabel}} {{selectedItems.length}}</span>        </div>    </div>    <div class="ngPagerContainer" style="float: right; margin-top: 10px;" ng-show="enablePaging" ng-class="{\'ngNoMultiSelect\': !multiSelect}">        <div style="float:left; margin-right: 10px;" class="ngRowCountPicker">            <span style="float: left; margin-top: 3px;" class="ngLabel">{{i18n.ngPageSizeLabel}}</span>            <select style="float: left;height: 27px; width: 100px" ng-model="pagingOptions.pageSize" >                <option ng-repeat="size in pagingOptions.pageSizes">{{size}}</option>            </select>        </div>        <div style="float:left; margin-right: 10px; line-height:25px;" class="ngPagerControl" style="float: left; min-width: 135px;">            <button class="ngPagerButton" ng-click="pageToFirst()" ng-disabled="cantPageBackward()" title="{{i18n.ngPagerFirstTitle}}"><div class="ngPagerFirstTriangle"><div class="ngPagerFirstBar"></div></div></button>            <button class="ngPagerButton" ng-click="pageBackward()" ng-disabled="cantPageBackward()" title="{{i18n.ngPagerPrevTitle}}"><div class="ngPagerFirstTriangle ngPagerPrevTriangle"></div></button>            <input class="ngPagerCurrent" min="1" max="{{maxPages()}}" type="number" style="width:50px; height: 24px; margin-top: 1px; padding: 0 4px;" ng-model="pagingOptions.currentPage"/>            <button class="ngPagerButton" ng-click="pageForward()" ng-disabled="cantPageForward()" title="{{i18n.ngPagerNextTitle}}"><div class="ngPagerLastTriangle ngPagerNextTriangle"></div></button>            <button class="ngPagerButton" ng-click="pageToLast()" ng-disabled="cantPageToLast()" title="{{i18n.ngPagerLastTitle}}"><div class="ngPagerLastTriangle"><div class="ngPagerLastBar"></div></div></button>        </div>    </div></div>'),e.put("gridTemplate.html",'<div class="ngTopPanel" ng-class="{\'ui-widget-header\':jqueryUITheme, \'ui-corner-top\': jqueryUITheme}" ng-style="topPanelStyle()">    <div class="ngGroupPanel" ng-show="showGroupPanel()" ng-style="groupPanelStyle()">        <div class="ngGroupPanelDescription" ng-show="configGroups.length == 0">{{i18n.ngGroupPanelDescription}}</div>        <ul ng-show="configGroups.length > 0" class="ngGroupList">            <li class="ngGroupItem" ng-repeat="group in configGroups">                <span class="ngGroupElement">                    <span class="ngGroupName">{{group.displayName}}                        <span ng-click="removeGroup($index)" class="ngRemoveGroup">x</span>                    </span>                    <span ng-hide="$last" class="ngGroupArrow"></span>                </span>            </li>        </ul>    </div>    <div class="ngHeaderContainer" ng-style="headerStyle()">        <div class="ngHeaderScroller" ng-style="headerScrollerStyle()" ng-include="gridId + \'headerRowTemplate.html\'"></div>    </div>    <div ng-grid-menu></div></div><div class="ngViewport" unselectable="on" ng-viewport ng-class="{\'ui-widget-content\': jqueryUITheme}" ng-style="viewportStyle()">    <div class="ngCanvas" ng-style="canvasStyle()">        <div ng-style="rowStyle(row)" ng-repeat="row in renderedRows" ng-click="row.toggleSelected($event)" ng-class="row.alternatingRowClass()" ng-row></div>    </div></div><div ng-grid-footer></div>'),e.put("headerCellTemplate.html",'<div class="ngHeaderSortColumn {{col.headerClass}}" ng-style="{\'cursor\': col.cursor}" ng-class="{ \'ngSorted\': !noSortVisible }">    <div ng-click="col.sort($event)" ng-class="\'colt\' + col.index" class="ngHeaderText">{{col.displayName}}</div>    <div class="ngSortButtonDown" ng-show="col.showSortButtonDown()"></div>    <div class="ngSortButtonUp" ng-show="col.showSortButtonUp()"></div>    <div class="ngSortPriority">{{col.sortPriority}}</div>    <div ng-class="{ ngPinnedIcon: col.pinned, ngUnPinnedIcon: !col.pinned }" ng-click="togglePin(col)" ng-show="col.pinnable"></div></div><div ng-show="col.resizable" class="ngHeaderGrip" ng-click="col.gripClick($event)" ng-mousedown="col.gripOnMouseDown($event)"></div>'),e.put("headerRowTemplate.html",'<div ng-style="{ height: col.headerRowHeight }" ng-repeat="col in renderedColumns" ng-class="col.colIndex()" class="ngHeaderCell">	<div class="ngVerticalBar" ng-style="{height: col.headerRowHeight}" ng-class="{ ngVerticalBarVisible: !$last }">&nbsp;</div>	<div ng-header-cell></div></div>'),e.put("menuTemplate.html",'<div ng-show="showColumnMenu || showFilter"  class="ngHeaderButton" ng-click="toggleShowMenu()">    <div class="ngHeaderButtonArrow"></div></div><div ng-show="showMenu" class="ngColMenu">    <div ng-show="showFilter">        <input placeholder="{{i18n.ngSearchPlaceHolder}}" type="text" ng-model="filterText"/>    </div>    <div ng-show="showColumnMenu">        <span class="ngMenuText">{{i18n.ngMenuText}}</span>        <ul class="ngColList">            <li class="ngColListItem" ng-repeat="col in columns | ngColumns">                <label><input ng-disabled="col.pinned" type="checkbox" class="ngColListCheckbox" ng-model="col.visible"/>{{col.displayName}}</label>				<a title="Group By" ng-class="col.groupedByClass()" ng-show="col.groupable && col.visible" ng-click="groupBy(col)"></a>				<span class="ngGroupingNumber" ng-show="col.groupIndex > 0">{{col.groupIndex}}</span>                      </li>        </ul>    </div></div>'),e.put("rowTemplate.html",'<div ng-style="{ \'cursor\': row.cursor }" ng-repeat="col in renderedColumns" ng-class="col.colIndex()" class="ngCell {{col.cellClass}}">	<div class="ngVerticalBar" ng-style="{height: rowHeight}" ng-class="{ ngVerticalBarVisible: !$last }">&nbsp;</div>	<div ng-cell></div></div>')}])})(window,jQuery);