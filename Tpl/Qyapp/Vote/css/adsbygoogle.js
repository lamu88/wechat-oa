(function(){var n=this,aa=function(a){var b=typeof a;if("object"==b)if(a){if(a instanceof Array)return"array";if(a instanceof Object)return b;var c=Object.prototype.toString.call(a);if("[object Window]"==c)return"object";if("[object Array]"==c||"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("splice"))return"array";if("[object Function]"==c||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("call"))return"function"}else return"null";
else if("function"==b&&"undefined"==typeof a.call)return"object";return b},ba=function(a,b,c){return a.call.apply(a.bind,arguments)},ca=function(a,b,c){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var c=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(c,d);return a.apply(b,c)}}return function(){return a.apply(b,arguments)}},q=function(a,b,c){q=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?
ba:ca;return q.apply(null,arguments)};var t=(new Date).getTime();var da=function(){},v=function(a,b,c){switch(typeof b){case "string":ea(b,c);break;case "number":c.push(isFinite(b)&&!isNaN(b)?b:"null");break;case "boolean":c.push(b);break;case "undefined":c.push("null");break;case "object":if(null==b){c.push("null");break}if(b instanceof Array){var d=b.length;c.push("[");for(var e="",g=0;g<d;g++)c.push(e),v(a,b[g],c),e=",";c.push("]");break}c.push("{");d="";for(e in b)b.hasOwnProperty(e)&&(g=b[e],"function"!=typeof g&&(c.push(d),ea(e,c),c.push(":"),v(a,g,c),d=
","));c.push("}");break;case "function":break;default:throw Error("Unknown type: "+typeof b);}},w={'"':'\\"',"\\":"\\\\","/":"\\/","\b":"\\b","\f":"\\f","\n":"\\n","\r":"\\r","\t":"\\t","\x0B":"\\u000b"},fa=/\uffff/.test("\uffff")?/[\\\"\x00-\x1f\x7f-\uffff]/g:/[\\\"\x00-\x1f\x7f-\xff]/g,ea=function(a,b){b.push('"');b.push(a.replace(fa,function(a){if(a in w)return w[a];var b=a.charCodeAt(0),e="\\u";16>b?e+="000":256>b?e+="00":4096>b&&(e+="0");return w[a]=e+b.toString(16)}));b.push('"')};var ga=/&/g,ha=/</g,ia=/>/g,ja=/"/g,ka=/'/g,la=/\x00/g,A={"\x00":"\\0","\b":"\\b","\f":"\\f","\n":"\\n","\r":"\\r","\t":"\\t","\x0B":"\\x0B",'"':'\\"',"\\":"\\\\"},B={"'":"\\'"};var D=function(a){D[" "](a);return a};D[" "]=function(){};var E=function(a){try{var b;if(b=!!a&&null!=a.location.href)t:{try{D(a.foo);b=!0;break t}catch(c){}b=!1}return b}catch(d){return!1}},F=function(a,b){if(!(1E-4>Math.random())){var c=Math.random();if(c<b){try{var d=new Uint16Array(1);window.crypto.getRandomValues(d);c=d[0]/65536}catch(e){c=Math.random()}return a[Math.floor(c*a.length)]}}return null};var ma=function(a){var b=a.toString();a.name&&-1==b.indexOf(a.name)&&(b+=": "+a.name);a.message&&-1==b.indexOf(a.message)&&(b+=": "+a.message);if(a.stack){a=a.stack;var c=b;try{-1==a.indexOf(c)&&(a=c+"\n"+a);for(var d;a!=d;)d=a,a=a.replace(/((https?:\/..*\/)[^\/:]*:\d+(?:.|\n)*)\2/,"$1");b=a.replace(/\n */g,"\n")}catch(e){b=c}}return b};var na=document,G=window;var H=function(a,b){for(var c in a)Object.prototype.hasOwnProperty.call(a,c)&&b.call(null,a[c],c,a)},I=function(a){return!!a&&"function"==typeof a&&!!a.call},oa=function(a,b){if(!(2>arguments.length))for(var c=1,d=arguments.length;c<d;++c)a.push(arguments[c])},J=function(a,b){return F(a,b)},pa=function(a){a.google_unique_id?++a.google_unique_id:a.google_unique_id=1},K=function(a){a=a.google_unique_id;return"number"==typeof a?a:0},qa=function(a){var b=a.length;if(0==b)return 0;for(var c=305419896,
d=0;d<b;d++)c^=(c<<5)+(c>>2)+a.charCodeAt(d)&4294967295;return 0<c?c:4294967296+c},L=function(a,b){return b.getComputedStyle?b.getComputedStyle(a,null):a.currentStyle},ra=/(^| )adsbygoogle($| )/;var sa={google_analytics_domain_name:!0,google_analytics_uacct:!0},ta=function(a){a.google_page_url&&(a.google_page_url=String(a.google_page_url));var b=[];H(a,function(a,d){if(null!=a){var e;try{var g=[];v(new da,a,g);e=g.join("")}catch(h){}e&&oa(b,d,"=",e,";")}});return b.join("")};var M=function(a){a=parseFloat(a);return isNaN(a)||1<a||0>a?0:a},N=function(a,b){return/^true$/.test(a)?!0:/^false$/.test(a)?!1:b},ua=/^([\w-]+\.)*([\w-]{2,})(\:[0-9]+)?$/,va=function(a,b){if(!a)return b;var c=a.match(ua);return c?c[0]:b};var wa=M("0.15"),xa=M("0.01"),ya=M("0.01"),za=M("0.05"),Aa=M("0.01"),Ba=M("0.05"),Ca=M("0.01"),Da=M("0.001"),Ea=M("0.2"),Fa=N("true",!0),Ga=M("0.05"),
Ha=parseInt("100",10),Ia=isNaN(Ha)?100:Ha;var Ja=N("false",!1);var Ka=!!window.google_async_iframe_id,La=function(a,b,c){var d=["<iframe"],e;for(e in a)a.hasOwnProperty(e)&&oa(d,e+"="+a[e]);d.push('style="left:0;position:absolute;top:0;"');d.push("></iframe>");a=a.id;b="border:none;height:"+c+"px;margin:0;padding:0;position:relative;visibility:visible;width:"+b+"px;background-color:transparent";return['<ins id="',a+"_expand",'" style="display:inline-table;',b,'"><ins id="',a+"_anchor",'" style="display:block;',b,'">',d.join(" "),"</ins></ins>"].join("")};var O=!0,Ma={},Pa=function(a,b,c,d){var e=Na,g,h=O;try{g=b()}catch(f){try{var k=ma(f);b="";f.fileName&&(b=f.fileName);var l=-1;f.lineNumber&&(l=f.lineNumber);h=e(a,k,b,l,c)}catch(m){try{var C=ma(m);a="";m.fileName&&(a=m.fileName);c=-1;m.lineNumber&&(c=m.lineNumber);Na("pAR",C,a,c,void 0,void 0)}catch(y){Oa({context:"mRE",msg:y.toString()+"\n"+(y.stack||"")},void 0)}}if(!h)throw f;}finally{if(d)try{d()}catch(z){}}return g},Na=function(a,b,c,d,e,g){var h={};if(e)try{e(h)}catch(f){}h.context=a;h.msg=
b.substring(0,512);c&&(h.file=c);0<d&&(h.line=d.toString());h.url=na.URL.substring(0,512);h.ref=na.referrer.substring(0,512);Qa(h);Oa(h,g);return O},Oa=function(a,b){try{if(Math.random()<(b||.01)){var c="/pagead/gen_204?id=jserror"+Ra(a),d="http"+("http:"==G.location.protocol?"":"s")+"://pagead2.googlesyndication.com"+c,c=d=d.substring(0,2E3);G.google_image_requests||(G.google_image_requests=[]);var e=G.document.createElement("img");e.src=c;G.google_image_requests.push(e)}}catch(g){}},Qa=function(a){var b=
a||{};H(Ma,function(a,d){b[d]=G[a]})},Sa=function(a,b){return function(){var c=arguments;return Pa(a,function(){return b.apply(void 0,c)},void 0,void 0)}},P=function(a,b){return Sa(a,b)},Ra=function(a){var b="";H(a,function(a,d){if(0===a||a)b+="&"+d+"="+("function"==typeof encodeURIComponent?encodeURIComponent(a):escape(a))});return b};var Q=null,Ta=function(){if(!Q){for(var a=window,b=a,c=0;a!=a.parent;)if(a=a.parent,c++,E(a))b=a;else break;Q=b}return Q};var Ua=function(a){a=a.document;return("CSS1Compat"==a.compatMode?a.documentElement:a.body).clientHeight},R=function(a){a=a.document;return("CSS1Compat"==a.compatMode?a.documentElement:a.body).clientWidth};var S={"120x90":!0,"160x90":!0,"180x90":!0,"200x90":!0,"468x15":!0,"728x15":!0};var T=/^([0-9.]+)px$/,Va=/^([0-9.]+)$/,Wa=function(a){return(a=T.exec(a))?Number(a[1]):null},Xa=function(a){return(a=Wa(a))?Math.round(a):null},U=function(a,b,c){for(var d=0;d<c.length;d++){var e="google_ad_"+c[d];if(!b.hasOwnProperty(e)){var g=Xa(a[c[d]]);null!=g&&(b[e]=g)}}};var Ya={rectangle:1,horizontal:2,vertical:4},Za=[{width:970,height:90,format:2},{width:728,height:90,format:2},{width:468,height:60,format:2},{width:336,height:280,format:1},{width:320,height:50,format:2},{width:300,height:600,format:4},{width:300,height:250,format:1},{width:250,height:250,format:1},{width:234,height:60,format:2},{width:200,height:200,format:1},{width:180,height:150,format:1},{width:160,height:600,format:4},{width:125,height:125,format:1},{width:120,height:600,format:4},{width:120,
height:240,format:4}],$a=function(a,b){return b.width-a.width||b.height-a.height},ab=function(a,b){var c=Math.min(Ua(b),16*R(b)/9),d=b.document.documentElement.getBoundingClientRect(),e=a.getBoundingClientRect();return(d&&e?e.top-d.top:0)<c-100};O=!N("false",!1);Ma={client:"google_ad_client",format:"google_ad_format",slotname:"google_ad_slot",output:"google_ad_output",ad_type:"google_ad_type",async_oa:"google_async_for_oa_experiment",dimpr:"google_always_use_delayed_impressions_experiment",peri:"google_top_experiment",pse:"google_pstate_expt"};var bb=function(a,b,c){c||(c=Ja?"https":"http");return[c,"://",a,b].join("")};var V=null;var W=function(a){this.j=a;a.google_iframe_oncopy||(a.google_iframe_oncopy={handlers:{},upd:q(this.u,this)});this.r=a.google_iframe_oncopy},cb;var X="var i=this.id,s=window.google_iframe_oncopy,H=s&&s.handlers,h=H&&H[i],w=this.contentWindow,d;try{d=w.document}catch(e){}if(h&&d&&(!d.body||!d.body.firstChild)){if(h.call){setTimeout(h,0)}else if(h.match){try{h=s.upd(h,i)}catch(e){}w.location.replace(h)}}";
/[\x00&<>"']/.test(X)&&(-1!=X.indexOf("&")&&(X=X.replace(ga,"&amp;")),-1!=X.indexOf("<")&&(X=X.replace(ha,"&lt;")),-1!=X.indexOf(">")&&(X=X.replace(ia,"&gt;")),-1!=X.indexOf('"')&&(X=X.replace(ja,"&quot;")),-1!=X.indexOf("'")&&(X=X.replace(ka,"&#39;")),-1!=X.indexOf("\x00")&&(X=X.replace(la,"&#0;")));cb=X;W.prototype.set=function(a,b){this.r.handlers[a]=b;this.j.addEventListener&&this.j.addEventListener("load",q(this.s,this,a),!1)};
W.prototype.s=function(a){a=this.j.document.getElementById(a);try{var b=a.contentWindow.document;if(a.onload&&b&&(!b.body||!b.body.firstChild))a.onload()}catch(c){}};W.prototype.u=function(a,b){var c=db("rx",a),d;t:{if(a&&(d=a.match("dt=([^&]+)"))&&2==d.length){d=d[1];break t}d=""}d=(new Date).getTime()-d;c=c.replace(/&dtd=(\d+|M)/,"&dtd="+(1E4>d?d+"":"M"));this.set(b,c);return c};var db=function(a,b){var c=new RegExp("\\b"+a+"=(\\d+)"),d=c.exec(b);d&&(b=b.replace(c,a+"="+(+d[1]+1||1)));return b};var Y;t:{var eb=n.navigator;if(eb){var fb=eb.userAgent;if(fb){Y=fb;break t}}Y=""};var gb=-1!=Y.indexOf("Opera")||-1!=Y.indexOf("OPR"),hb=-1!=Y.indexOf("Trident")||-1!=Y.indexOf("MSIE"),ib=-1!=Y.indexOf("Gecko")&&-1==Y.toLowerCase().indexOf("webkit")&&!(-1!=Y.indexOf("Trident")||-1!=Y.indexOf("MSIE")),jb=-1!=Y.toLowerCase().indexOf("webkit");
(function(){var a="",b;if(gb&&n.opera)return a=n.opera.version,"function"==aa(a)?a():a;ib?b=/rv\:([^\);]+)(\)|;)/:hb?b=/\b(?:MSIE|rv)[: ]([^\);]+)(\)|;)/:jb&&(b=/WebKit\/(\S+)/);b&&(a=(a=b.exec(Y))?a[1]:"");return hb&&(b=(b=n.document)?b.documentMode:void 0,b>parseFloat(a))?String(b):a})();var Z,$=function(a){this.k=[];this.j=a||window;this.i=0;this.l=null;this.m=0},kb=function(a,b){this.t=a;this.q=b};$.prototype.w=function(a,b){0!=this.i||0!=this.k.length||b&&b!=window?this.p(a,b):(this.i=2,this.o(new kb(a,window)))};$.prototype.p=function(a,b){this.k.push(new kb(a,b||this.j));lb(this)};$.prototype.A=function(a){this.i=1;if(a){var b=P("sjr::timeout",q(this.n,this,!0));this.l=this.j.setTimeout(b,a)}};
$.prototype.n=function(a){a&&++this.m;1==this.i&&(null!=this.l&&(this.j.clearTimeout(this.l),this.l=null),this.i=0);lb(this)};$.prototype.B=function(){return!(!window||!Array)};$.prototype.C=function(){return this.m};$.prototype.nq=$.prototype.w;$.prototype.nqa=$.prototype.p;$.prototype.al=$.prototype.A;$.prototype.rl=$.prototype.n;$.prototype.sz=$.prototype.B;$.prototype.tc=$.prototype.C;var lb=function(a){var b=P("sjr::tryrun",q(a.v,a));a.j.setTimeout(b,0)};
$.prototype.v=function(){if(0==this.i&&this.k.length){var a=this.k.shift();this.i=2;var b=P("sjr::run",q(this.o,this,a));a.q.setTimeout(b,0);lb(this)}};$.prototype.o=function(a){this.i=0;a.t()};
var mb=function(a){try{return a.sz()}catch(b){return!1}},nb=function(a){return!!a&&("object"==typeof a||"function"==typeof a)&&mb(a)&&I(a.nq)&&I(a.nqa)&&I(a.al)&&I(a.rl)},ob=function(){if(Z&&mb(Z))return Z;var a=Ta(),b=a.google_jobrunner;return nb(b)?Z=b:a.google_jobrunner=Z=new $(a)},pb=function(a,b){ob().nq(a,b)},qb=function(a,b){ob().nqa(a,b)};var rb=Ka?1==K(G):!K(G),sb=function(){var a=D("script"),b;b=va("","pagead2.googlesyndication.com");return["<",a,' src="',bb(b,"/pagead/js/r20141106/r20141103/show_ads_impl.js",""),'"></',a,">"].join("")},tb=function(a,b,c,d){return function(){var e=!1;d&&ob().al(3E4);var g=a.document.getElementById(b);g&&!E(g.contentWindow)&&3==
a.google_top_js_status&&(a.google_top_js_status=6);try{if(E(a.document.getElementById(b).contentWindow)){var h=a.document.getElementById(b).contentWindow,f=h.document;f.body&&f.body.firstChild||(f.open(),h.google_async_iframe_close=!0,f.write(c))}else{var k=a.document.getElementById(b).contentWindow,l;g=c;g=String(g);if(g.quote)l=g.quote();else{h=['"'];for(f=0;f<g.length;f++){var m=g.charAt(f),C=m.charCodeAt(0),y=f+1,z;if(!(z=A[m])){var p;if(31<C&&127>C)p=m;else{var s=m;if(s in B)p=B[s];else if(s in
A)p=B[s]=A[s];else{var u=s,r=s.charCodeAt(0);if(31<r&&127>r)u=s;else{if(256>r){if(u="\\x",16>r||256<r)u+="0"}else u="\\u",4096>r&&(u+="0");u+=r.toString(16).toUpperCase()}p=B[s]=u}}z=p}h[y]=z}h.push('"');l=h.join("")}k.location.replace("javascript:"+l)}e=!0}catch(x){k=Ta().google_jobrunner,nb(k)&&k.rl()}e&&(e=db("google_async_rrc",c),(new W(a)).set(b,tb(a,b,e,!1)))}},ub=function(a){var b=["<iframe"];H(a,function(a,d){null!=a&&b.push(" "+d+'="'+a+'"')});b.push("></iframe>");return b.join("")},vb=function(a,
b,c,d){d=d?'"':"";var e=d+"0"+d;a.width=d+b+d;a.height=d+c+d;a.frameborder=e;a.marginwidth=e;a.marginheight=e;a.vspace=e;a.hspace=e;a.allowtransparency=d+"true"+d;a.scrolling=d+"no"+d;a.allowfullscreen=d+"true"+d},xb=function(a,b,c){wb(a,b,c,function(a,b,g){a=a.document;for(var h=b.id,f=0;!h||a.getElementById(h);)h="aswift_"+f++;b.id=h;b.name=h;h=Number(g.google_ad_width);f=Number(g.google_ad_height);16==g.google_reactive_ad_format?(g=a.createElement("div"),g.innerHTML=La(b,h,f),c.appendChild(g.firstChild)):
c.innerHTML=La(b,h,f);return b.id})},wb=function(a,b,c,d){var e=D("script"),g={};vb(g,b.google_ad_width,b.google_ad_height,!0);g.onload='"'+cb+'"';d=d(a,g,b);var g=b.google_override_format||!S[b.google_ad_width+"x"+b.google_ad_height]&&"aa"==b.google_loader_used?J(["c","e"],Ea):null,h=b.google_ad_output,f=b.google_ad_format;f||"html"!=h&&null!=h||(f=b.google_ad_width+"x"+b.google_ad_height,"e"==g&&(f+="_as"));h=!b.google_ad_slot||b.google_override_format||!S[b.google_ad_width+"x"+b.google_ad_height]&&
"aa"==b.google_loader_used;f=f&&h?f.toLowerCase():"";b.google_ad_format=f;for(var f=[b.google_ad_slot,b.google_ad_format,b.google_ad_type,b.google_ad_width,b.google_ad_height],h=[],k=0,l=c;l&&25>k;l=l.parentNode,++k)h.push(9!=l.nodeType&&l.id||"");(h=h.join())&&f.push(h);b.google_ad_unit_key=qa(f.join(":")).toString();f=a.google_adk2_experiment=a.google_adk2_experiment||J(["C","E"],Da)||"N";if("E"==f){f=[];for(h=0;c&&25>h;++h){k=(k=9!=c.nodeType&&c.id)?"/"+k:"";t:{var m=c.parentElement,l=c.nodeName.toLowerCase();
if(m)for(var m=m.childNodes,C=0,y=0;y<m.length;++y){var z=m[y];if(z.nodeName&&z.nodeName.toLowerCase()==l){if(c==z){l="."+C;break t}++C}}l=""}f.push((c.nodeName&&c.nodeName.toLowerCase())+k+l);c=c.parentElement}c=f.join()+":";f=a;h=[];if(f)try{for(var p=f.parent,k=0;p&&p!=f&&25>k;++k){for(var s=p.frames,l=0;l<s.length;++l)if(f==s[l]){h.push(l);break}f=p;p=f.parent}}catch(u){}b.google_ad_unit_key_2=qa(c+h.join()).toString()}else"C"==f&&(b.google_ad_unit_key_2="ctrl");b=ta(b);var r;if(p=rb){if(!V)i:{s=
[G.top];p=[];for(c=0;f=s[c++];){p.push(f);try{if(f.frames)for(var x=f.frames.length,h=0;h<x&&1024>s.length;++h)s.push(f.frames[h])}catch(Jb){}}for(x=0;x<p.length;x++)try{if(r=p[x].frames.google_esf){V=r;break i}}catch(Kb){}V=null}p=!V}p?(r={},vb(r,0,0,!1),r.style="display:none",r.id="google_esf",r.name="google_esf",r.src=bb(va("","googleads.g.doubleclick.net"),"/pagead/html/r20141106/r20141103/zrt_lookup.html"),
r=ub(r)):r="";x=(new Date).getTime();p=a.google_top_experiment;if(s=a.google_async_for_oa_experiment)a.google_async_for_oa_experiment=void 0;c=a.google_always_use_delayed_impressions_experiment;f=a.google_auto_width_experiment;h=a.google_floating_ads_js_experiment;g=["<!doctype html><html><body>",r,"<",e,">",b,"google_show_ads_impl=true;google_unique_id=",a.google_unique_id,';google_async_iframe_id="',d,'";google_start_time=',t,";",p?'google_top_experiment="'+p+'";':"",s?'google_async_for_oa_experiment="'+
s+'";':"",c?'google_always_use_delayed_impressions_experiment="'+c+'";':"",g?'google_append_as_for_format_override="'+g+'";':"",f?'google_auto_width_experiment="'+f+'";':"",h?'google_floating_ads_js_experiment="'+h+'";':"","google_bpp=",x>t?x-t:1,";google_async_rrc=0;</",e,">",sb(),"</body></html>"].join("");(a.document.getElementById(d)?pb:qb)(tb(a,d,g,!0))},yb=function(){if(void 0===window.google_auto_width_experiment){var a=["C","E"],b=xa;window.google_auto_width_experiment=F(a,b);if(window.google_auto_width_experiment)return window.google_auto_width_experiment;
b=ya;a=["CI","EI"];window.google_auto_width_experiment=F(a,b);return window.google_auto_width_experiment}return""},zb=Math.floor(1E6*Math.random()),Ab=function(a){for(var b=a.data.split("\n"),c={},d=0;d<b.length;d++){var e=b[d].indexOf("=");-1!=e&&(c[b[d].substr(0,e)]=b[d].substr(e+1))}b=c[3];if(c[1]==zb&&(window.google_top_js_status=4,a.source==top&&0==b.indexOf(a.origin)&&(window.google_top_values=c,window.google_top_js_status=5),window.google_top_js_callbacks)){for(a=0;a<window.google_top_js_callbacks.length;a++)window.google_top_js_callbacks[a]();
window.google_top_js_callbacks.length=0}},Bb=function(a,b){var c=navigator;if(Fa&&a&&b&&c){var d=a.document,c=d.createElement("script"),e;(e=b)?(e=e.toLowerCase())&&"ca-"!=e.substring(0,3)&&(e="ca-"+e):e="";c.async=!0;c.type="text/javascript";c.src=bb("www.gstatic.com","/pub-config/"+e+".js");d=d.getElementsByTagName("script")[0];d.parentNode.insertBefore(c,d)}};var Cb=function(a){return ra.test(a.className)&&"done"!=a.getAttribute("data-adsbygoogle-status")},Eb=function(a,b,c){pa(c);Db(a,b,c);var d=L(a,c);if(!d||"none"!=d.display||"on"==b.google_adtest||0<b.google_reactive_ad_format){1==K(c)&&Bb(c,b.google_ad_client);H(sa,function(a,d){b[d]=b[d]||c[d]});b.google_loader_used="aa";if((d=b.google_ad_output)&&"html"!=d)throw Error("No support for google_ad_output="+d);Pa("aa::main",function(){xb(c,b,a)})}else c.document.createComment&&a.appendChild(c.document.createComment("No ad requested because of display:none on the adsbygoogle tag"))},
Db=function(a,b,c){for(var d=a.attributes,e=d.length,g=0;g<e;g++){var h=d[g];if(/data-/.test(h.nodeName)){var f=h.nodeName.replace("data","google").replace(/-/g,"_");b.hasOwnProperty(f)||(h=h.nodeValue,"google_reactive_ad_format"==f&&(h=+h,h=isNaN(h)?null:h),null===h||(b[f]=h))}}if(b.google_enable_content_recommendations&&1==b.google_reactive_ad_format)b.google_ad_width=R(c),void 0===window.google_floating_ads_js_experiment&&(window.google_floating_ads_js_experiment=J(["4091000","4091001"],Ga)),"4091001"==
window.google_floating_ads_js_experiment?b.google_ad_height=Ia:b.google_ad_height=50,a.style.display="none";else if(1==b.google_reactive_ad_format)b.google_ad_width=320,b.google_ad_height=50,a.style.display="none";else if(8==b.google_reactive_ad_format)b.google_ad_width=R(c),b.google_ad_height=Ua(c),a.style.display="none";else if(d=b.google_ad_format,"auto"==d||/^((^|,) *(horizontal|vertical|rectangle) *)+$/.test(d)){void 0===b.google_responsive_optimization_experiment&&(e=488>R(window),d=320==R(window),
g=["C320","E320"],(g=e?F(g,za):null)||(g=J(["CMATF","EMATF","EMATF100"],Ba),f="horizontal"==b.google_ad_format,g=g&&!f&&e&&ab(a,c)?g:null),(e=g)||(e=["IC","IEA","IEB"],g=a.offsetWidth,e=d&&300<=g&&320>g?F(e,Ca):null),b.google_responsive_optimization_experiment=e||J(["SC","SE"],Aa)||"-");var d=a.offsetWidth,e=b.google_ad_format,k;if("auto"==e)k=R(c),k=Math.min(1200,k),k=.25>=d/k?4:3;else{g=0;for(k in Ya)-1!=e.indexOf(k)&&(g|=Ya[k]);k=g}b&&(b.google_responsive_formats=k);t:{g=Za.sort($a);for(f=0;f<
g.length;f++){var h=g[f],l;if(l=g[f].width<=d&&h.format&k)if(l=h,b&&a){var m=b.google_responsive_optimization_experiment;l=("EMATF"==m||"EMATF100"==m||"IC"==m||"IEA"==m||"IEB"==m)&&488>R(c)&&ab(a,c)?250>l.height:!0}else l=!0;if(l){k=h;break t}}k=null}f=k;if(!f)throw Error("Cannot find a responsive size for a container of width="+d+"px and data-ad-format="+e);k=b.google_responsive_optimization_experiment;("C320"==k||"E320"==k?320==f.width&&50==f.height:"IC"!=k&&"IEA"!=k&&"IEB"!=k||234==f.width&&60==
f.height)||(b.google_responsive_optimization_experiment=void 0);k=b.google_responsive_optimization_experiment;e="SE"==k?f.width:300<d&&300<f.height?f.width:1200<d?1200:Math.round(d);g="E320"!=k&&"EMATF100"!=k||320!=f.width||50!=f.height?f.height:100;if(f=234==f.width&&60==f.height&&"IEA"==k||"IEB"==k){f=R(c);if(!(d=!(320==f&&300<=d&&320>d)))i:{d=a;for(h=0;10>h&&d.parentElement;h++){d=d.parentElement;l=L(d,c);if(!l)break;l=l.overflowX||l.overflow;if("hidden"==l||"scroll"==l||"auto"==l)break;if(d.clientWidth>=
f){d=!1;break i}}d=!0}d?f=!1:(c=L(a,c),d=a.getBoundingClientRect(),c&&d?(d=d.left,0>=d?f=!1:(f-=d+a.offsetWidth,"rtl"!=c.direction?(c=Wa(c.marginLeft)||0,a.style.marginLeft=c-d+"px"):(c=Wa(c.marginRight)||0,a.style.marginRight=c-f+"px"),f=!0)):f=!1)}f&&(e=320,g="IEA"==k?50:100);b.google_ad_width=e;b.google_ad_height=g;a.style.height=b.google_ad_height+"px";b.google_ad_resizable=!0;delete b.google_ad_format;b.google_loader_features_used=128}else!Va.test(b.google_ad_width)&&!T.test(a.style.width)||
!Va.test(b.google_ad_height)&&!T.test(a.style.height)?(c=L(a,c),a.style.width=c.width,a.style.height=c.height,U(c,b,["width","height"]),b.google_loader_features_used=256):"E"==yb()||Fb(c)?(k="CI"!=c.google_auto_width_experiment,d=a.style,U(d,b,["height"]),e=a.style.width,a.style.width="100%",g=a.offsetWidth,a.style.width=e,e=g,g=Xa(d.width),f=Xa(d.height),!f||!g||50>f||120>e||S[g+"x"+f]?(U(d,b,["width"]),a=!1):(e=Math.min(1200,e),300<f&&(e=Math.min(300,e)),e<=g?(U(d,b,["width"]),a=!1):(k?(b.google_ad_width=
e,b.google_original_width=g,a.style.width=e+"px"):(b.google_ad_width=g,b.google_available_width=e),a=!0)),!a&&Fb(c)&&(c.google_auto_width_experiment=null)):U(a.style,b,["width","height"])},Fb=function(a){a=a.google_auto_width_experiment;return"EI"==a||"CI"==a},Gb=function(a){for(var b=document.getElementsByTagName("ins"),c=0,d=b[c];c<b.length;d=b[++c])if(Cb(d)&&(!a||d.id==a))return d;return null},Hb=function(a){var b=a.element;a=a.params||{};if(b){if(!Cb(b)&&(b=b.id&&Gb(b.id),!b))throw Error("adsbygoogle: 'element' has already been filled.");
if(!("innerHTML"in b))throw Error("adsbygoogle.push(): 'element' is not a good DOM element.");}else if(b=Gb(),!b)throw Error("adsbygoogle.push(): All ins elements in the DOM with class=adsbygoogle already have ads in them.");var c=window;b.setAttribute("data-adsbygoogle-status","done");Eb(b,a,c)},Ib=function(){if(!window.google_top_experiment&&!window.google_top_js_status){var a=window;if(2!==(a.top==a?0:E(a.top)?1:2))window.google_top_js_status=0;else if(top.postMessage){var b;try{b=G.top.frames.google_top_static_frame?
!0:!1}catch(c){b=!1}if(b){if(window.google_top_experiment=J(["jp_c","jp_zl","jp_wfpmr","jp_zlt","jp_wnt"],wa),"jp_c"!==window.google_top_experiment){a=window;a.addEventListener?a.addEventListener("message",Ab,!1):a.attachEvent&&a.attachEvent("onmessage",Ab);window.google_top_js_status=3;a={0:"google_loc_request",1:zb};b=[];for(var d in a)b.push(d+"="+a[d]);top.postMessage(b.join("\n"),"*")}}else window.google_top_js_status=2}else window.google_top_js_status=1}if((d=window.adsbygoogle)&&d.shift)for(b=
20;(a=d.shift())&&0<b--;)try{Hb(a)}catch(e){throw window.setTimeout(Ib,0),e;}window.adsbygoogle={push:Hb}};Ib();})();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         