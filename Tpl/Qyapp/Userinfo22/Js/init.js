/*! weimob_vshop_admin
*author:<a.b.c@hd3p.com> */
define("dist/frameset/init",["$","slimscroll","./nav","./letter","./template/letter.html","./template","dist/tips/init"],function(a){"use strict";var b=a("$");a("slimscroll"),a("./nav"),a("./letter"),window.msg=a("dist/tips/init"),navigator.userAgent.match(/iPad|iPod/i)&&(window.onorientationchange=function(){90!=window.orientation&&(b.cookie("onorientationchange")||(b.cookie("onorientationchange",www_version),alert("竖屏 可能导致部分功能无法使用 请切换到横屏模式")))});var c=b(document);c.on("click",'[data-toggle^="class"]',function(a){a&&a.preventDefault();var c,d,e,f,g,h=b(a.target);!h.data("toggle")&&(h=h.closest('[data-toggle^="class"]')),c=h.data().toggle,d=h.data("target")||h.attr("href"),c&&(e=c.split(":")[1])&&(f=e.split(",")),d&&(g=d.split(",")),g&&g.length&&b.each(g,function(a){"#"!=g[a]&&b(g[a]).toggleClass(f[a])}),h.toggleClass("active")}),b(function(){b("section.hidden-bsection").show(),b("#loading_done").add("div.pageload-overlay").removeClass("show").hide();var a=b(".ie11 .vbox").add(".ie .vbox");a.length>0&&(a.each(function(){b(this).height(b(this).parent().height())}),b(window).resize(function(){var c=b(window).height();a.each(function(){b(this).height(c-b(this).offset().top)})})),b(".no-touch .slim-scroll").each(function(){var a,c=b(this),d=c.data();c.slimScroll(d),b(window).resize(function(){clearTimeout(a),a=setTimeout(function(){c.slimScroll(d)},500)})}),window.bound_path&&window.msgbox.dialog({message:"您的账号暂未绑定微信企业号，为了避免对您的使用造成影响，请及时进行账号绑定。",title:"提示",buttons:{success:{label:"立即绑定",className:"btn-primary",callback:function(){b("#mainFrame").attr("src",window.bound_path)}},cancel:{label:"以后再说"}}})}),window.release&&!function(a){if(a){var b="%c给自己站在更大的舞台一个机会：http://www.weimob.com/site/jobs/";window.chrome?(a.log("%c","font-size:0;line-height:99px;padding:23px 90px;background:url(http://stc.weimob.com/img/www/index1/weimob-logo.png) no-repeat"),a.log(b,"color:#65bd77")):a.log(b.replace(/%c/g,""))}}(top.console);var d=b("#submit_but");d.length&&d.click(function(){var a=b("#feedback-text"),c=b("#feedback-input"),e=b("#feedback-checkcode"),f=b(this).data("path");return a.val()||c.val()||e.val()?(a.next("span.error").length&&a.next("span.error").remove(),c.next("span.error").length&&c.next("span.error").remove(),e.next("span.error").length&&e.next("span.error").remove(),a.val()?a.val()&&!c.val()&&e.val()?(!c.next("span.error").length&&b("<span class='error help-block'>请填写Email邮箱!</span>").insertAfter(c),!1):/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(c.val())?a.val()&&c.val()&&!e.val()?(!e.next("img").next("span.error").length&&b("<span class='error help-block'>请填写验证码!</span>").insertAfter(e.next("img")),!1):(e.next("img").next("span.error").length&&e.next("img").next("span.error").remove(),d.text("提交中..."),void b.post(f,{content:a.val(),email:c.val(),code:e.val()},function(f){b("#feedback").modal("hide"),0==f.status?(window.msg.info(f.message),a.val(""),c.val(""),e.val("")):(d.text("提交"),window.msg.error(f.message)),b("#feedback").find("img").trigger("click"),d.text("提交"),d.addClass("btn-primary")},"json")):(c.next("span.error").length&&c.next("span.error").remove(),b("<span class='error help-block js_error_email'>请填写正确的Email邮箱!</span>").insertAfter(c),!1):(!a.next("span.error").length&&b("<span class='error help-block'>请填写反馈建议!</span>").insertAfter(a),!1)):(!a.next("span.error").length&&b("<span class='error help-block'>请填写反馈建议!</span>").insertAfter(a),!c.next("span.error").length&&b("<span class='error help-block'>请填写Email邮箱!</span>").insertAfter(c),!e.next("img").next("span.error").length&&b("<span class='error help-block'>请填写验证码!</span>").insertAfter(e.next("img")),!1)})}),define("dist/frameset/nav",["$"],function(a){"use strict";var b=a("$"),c=b(document);c.on("click",".nav-primary a",function(a){var c,d=b(a.target);d.is("a")||(d=d.closest("a")),b(".nav-vertical").length||(c=d.parent().siblings(".active"),c&&c.find("> a").toggleClass("active")&&c.toggleClass("active").find("> ul:visible").slideUp(200),d.hasClass("active")&&d.next().slideUp(200)||d.next().slideDown(200),d.toggleClass("active").parent().toggleClass("active"),d.next().is("ul")&&a.preventDefault())})}),define("dist/frameset/letter",["$","dist/frameset/template"],function(a){"use strict";var b=a("$"),c=a("dist/frameset/template/letter.html"),d=a("dist/frameset/template"),e=function(a){var b,c,d,e,f,g={0:"周日",1:"周一",2:"周二",3:"周三",4:"周四"};return a?(c=new Date,b="object"==typeof a&&a.constructor===Date?a:new Date(a),d=(c-b)/1e3,60>d?"刚刚":3600>d?Math.floor(d/60)+"分钟前":10800>d?Math.floor(d/3600)+"小时前":(f={year:b.getFullYear(),month:b.getMonth()+1,date:b.getDate(),day:b.getDay(),hours:b.getHours()>=10?b.getHours():"0"+b.getHours().toString(),min:b.getMinutes()>=10?b.getMinutes():"0"+b.getMinutes().toString()},e={year:c.getFullYear(),month:c.getMonth()+1,date:c.getDate(),day:c.getDay()},f.date===e.date&&f.month===e.month&&f.year===e.year?"今天"+f.hours+":"+f.min:e.date-f.date===1&&172800>d?"昨天"+f.hours+":"+f.min:e.day-f.day>0&&604800>d?g[f.day]+f.hours+":"+f.min:f.year===e.year?f.month+"月"+f.date+"日":f.year+"年"+f.month+"月"+f.date+"日")):""};d.helper("transMsgTime",function(a){return e(1e3*parseInt(a))});var f=function(){b.ajax({type:"POST",url:window.letter_path,success:function(a){var e=d.compile(c)(a)+b("#js_msg_content_footer").html();b(".js_msg_content").html(e),a.count?b(".js_msg_count").fadeOut(0,function(){b(".js_msg_count").html(a.count),b(".js_msg_count").fadeIn(0)}):b(".js_msg_count").fadeOut(0),b(".js_msg_empty").toggle(a.items.length>0)},dataType:"json"}),setTimeout(f,3e3)};b(document).on("click",".js_msg_empty",function(){var a=b(this),c=a.data("path");c&&b.ajax(c,{type:"post",dataType:"json"}).done(function(a){0==a.status&&(b(".js_msg_count,.js_msg_hdead").hide(),b(".js_msg_content_items").html('<div class="wrapper">您目前没有新消息</div>'))}).fail(function(){window.msg.info("网络异常请重试")})}),window.letter_path&&f()}),define("dist/frameset/template/letter.html",[],'{{if count&&items.length>0}}\n<header class="panel-heading b-light bg-light js_msg_hdead">\n    <strong>你有 <span class="count js_msg_count">{{count}}</span>未读消息</strong>\n</header>\n{{/if}}\n<div class="list-group list-group-alt  animated fadeInRigh js_msg_content_items">\n{{if items&&items.length>0}}\n {{each items as value i}}\n\n<a href="{{value.url}}" class="media list-group-item" target="{{value.target}}">\n    <span class="pull-left thumb-sm text-center">\n        {{if value.type==\'1\'}}\n        <i class="iconfont icon-systeminfo icon-size40 text-success" title="系统"></i>\n        {{else if value.type==\'2\'}}\n        <i class="iconfont icon-officialinfo icon-size40 text-success" title="消息"></i>\n        {{else if value.type==\'3\'}}\n        <i class="iconfont icon-officialinfo icon-size40 text-success" title="关注"></i>\n        {{/if}}\n    </span>\n    <span class="media-body block m-b-none">\n        <span class="block">{{value.title}}</span>\n        <small class="text-muted">{{transMsgTime value.date}}</small>\n    </span>\n</a>\n{{/each}} {{else}}\n\n<div class="wrapper">您目前没有新消息</div>\n{{/if}}\n</div>'),!function(){function a(a){return a.replace(t,"").replace(u,",").replace(v,"").replace(w,"").replace(x,"").split(/^$|,+/)}function b(a){return"'"+a.replace(/('|\\)/g,"\\$1").replace(/\r/g,"\\r").replace(/\n/g,"\\n")+"'"}function c(c,d){function e(a){return m+=a.split(/\n/).length-1,k&&(a=a.replace(/[\n\r\t\s]+/g," ").replace(/<!--.*?-->/g,"")),a&&(a=s[1]+b(a)+s[2]+"\n"),a}function f(b){var c=m;if(j?b=j(b,d):g&&(b=b.replace(/\n/g,function(){return m++,"$line="+m+";"})),0===b.indexOf("=")){var e=l&&!/^=[=#]/.test(b);if(b=b.replace(/^=[=#]?|[\s;]*$/g,""),e){var f=b.replace(/\s*\([^\)]+\)/,"");n[f]||/^(include|print)$/.test(f)||(b="$escape("+b+")")}else b="$string("+b+")";b=s[1]+b+s[2]}return g&&(b="$line="+c+";"+b),r(a(b),function(a){if(a&&!p[a]){var b;b="print"===a?u:"include"===a?v:n[a]?"$utils."+a:o[a]?"$helpers."+a:"$data."+a,w+=a+"="+b+",",p[a]=!0}}),b+"\n"}var g=d.debug,h=d.openTag,i=d.closeTag,j=d.parser,k=d.compress,l=d.escape,m=1,p={$data:1,$filename:1,$utils:1,$helpers:1,$out:1,$line:1},q="".trim,s=q?["$out='';","$out+=",";","$out"]:["$out=[];","$out.push(",");","$out.join('')"],t=q?"$out+=text;return $out;":"$out.push(text);",u="function(){var text=''.concat.apply('',arguments);"+t+"}",v="function(filename,data){data=data||$data;var text=$utils.$include(filename,data,$filename);"+t+"}",w="'use strict';var $utils=this,$helpers=$utils.$helpers,"+(g?"$line=0,":""),x=s[0],y="return new String("+s[3]+");";r(c.split(h),function(a){a=a.split(i);var b=a[0],c=a[1];1===a.length?x+=e(b):(x+=f(b),c&&(x+=e(c)))});var z=w+x+y;g&&(z="try{"+z+"}catch(e){throw {filename:$filename,name:'Render Error',message:e.message,line:$line,source:"+b(c)+".split(/\\n/)[$line-1].replace(/^[\\s\\t]+/,'')};}");try{var A=new Function("$data","$filename",z);return A.prototype=n,A}catch(B){throw B.temp="function anonymous($data,$filename) {"+z+"}",B}}var d=function(a,b){return"string"==typeof b?q(b,{filename:a}):g(a,b)};d.version="3.0.0",d.config=function(a,b){e[a]=b};var e=d.defaults={openTag:"<%",closeTag:"%>",escape:!0,cache:!0,compress:!1,parser:null},f=d.cache={};d.render=function(a,b){return q(a,b)};var g=d.renderFile=function(a,b){var c=d.get(a)||p({filename:a,name:"Render Error",message:"Template not found"});return b?c(b):c};d.get=function(a){var b;if(f[a])b=f[a];else if("object"==typeof document){var c=document.getElementById(a);if(c){var d=(c.value||c.innerHTML).replace(/^\s*|\s*$/g,"");b=q(d,{filename:a})}}return b};var h=function(a,b){return"string"!=typeof a&&(b=typeof a,"number"===b?a+="":a="function"===b?h(a.call(a)):""),a},i={"<":"&#60;",">":"&#62;",'"':"&#34;","'":"&#39;","&":"&#38;"},j=function(a){return i[a]},k=function(a){return h(a).replace(/&(?![\w#]+;)|[<>"']/g,j)},l=Array.isArray||function(a){return"[object Array]"==={}.toString.call(a)},m=function(a,b){var c,d;if(l(a))for(c=0,d=a.length;d>c;c++)b.call(a,a[c],c,a);else for(c in a)b.call(a,a[c],c)},n=d.utils={$helpers:{},$include:g,$string:h,$escape:k,$each:m};d.helper=function(a,b){o[a]=b};var o=d.helpers=n.$helpers;d.onerror=function(a){var b="Template Error\n\n";for(var c in a)b+="<"+c+">\n"+a[c]+"\n\n";"object"==typeof console&&console.error(b)};var p=function(a){return d.onerror(a),function(){return"{Template Error}"}},q=d.compile=function(a,b){function d(c){try{return new i(c,h)+""}catch(d){return b.debug?p(d)():(b.debug=!0,q(a,b)(c))}}b=b||{};for(var g in e)void 0===b[g]&&(b[g]=e[g]);var h=b.filename;try{var i=c(a,b)}catch(j){return j.filename=h||"anonymous",j.name="Syntax Error",p(j)}return d.prototype=i.prototype,d.toString=function(){return i.toString()},h&&b.cache&&(f[h]=d),d},r=n.$each,s="break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined",t=/\/\*[\w\W]*?\*\/|\/\/[^\n]*\n|\/\/[^\n]*$|"(?:[^"\\]|\\[\w\W])*"|'(?:[^'\\]|\\[\w\W])*'|[\s\t\n]*\.[\s\t\n]*[$\w\.]+/g,u=/[^\w$]+/g,v=new RegExp(["\\b"+s.replace(/,/g,"\\b|\\b")+"\\b"].join("|"),"g"),w=/^\d[^,]*|,\d[^,]*/g,x=/^,+|,+$/g;e.openTag="{{",e.closeTag="}}";var y=function(a,b){var c=b.split(":"),d=c.shift(),e=c.join(":")||"";return e&&(e=", "+e),"$helpers."+d+"("+a+e+")"};e.parser=function(a,b){a=a.replace(/^\s/,"");var c=a.split(" "),e=c.shift(),f=c.join(" ");switch(e){case"if":a="if("+f+"){";break;case"else":c="if"===c.shift()?" if("+c.join(" ")+")":"",a="}else"+c+"{";break;case"/if":a="}";break;case"each":var g=c[0]||"$data",h=c[1]||"as",i=c[2]||"$value",j=c[3]||"$index",k=i+","+j;"as"!==h&&(g="[]"),a="$each("+g+",function("+k+"){";break;case"/each":a="});";break;case"echo":a="print("+f+");";break;case"print":case"include":a=e+"("+c.join(",")+");";break;default:if(-1!==f.indexOf("|")){var l=b.escape;0===a.indexOf("#")&&(a=a.substr(1),l=!1);for(var m=0,n=a.split("|"),o=n.length,p=l?"$escape":"$string",q=p+"("+n[m++]+")";o>m;m++)q=y(q,n[m]);a="=#"+q}else a=d.helpers[e]?"=#"+e+"("+c.join(",")+");":"="+a}return a},"function"==typeof define?define("dist/frameset/template",[],function(){return d}):"undefined"!=typeof exports?module.exports=d:this.template=d}();