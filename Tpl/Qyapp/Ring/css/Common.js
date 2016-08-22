/*=========================
* 全站通用Javascript
=========================*/


//根据url后的参数，指定key，获取值，传入格式为Key1=Value1&Key2=Value2 ，前面不带问号
function SplitKeyValue(s, key) {
    var sValue = ("?" + s).match(new RegExp("[\?\&]" + key + "=([^\&]*)(\&?)", "i"))
    return sValue ? sValue[1] : sValue
}

//在targetEl前插入newEl DOM对象
function insertAfter(newEl, targetEl) {
    var parentEl = targetEl.parentNode;

    if (parentEl.lastChild == targetEl) {
        parentEl.appendChild(newEl);
    } else {
        parentEl.insertBefore(newEl, targetEl.nextSibling);
    }
}


//获取URL中指定参数的值，如果url参数不存在会返回null，如果参数存在但无值会返回""
function Request(item) {
    var sValue = location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)", "i"))
    return sValue ? sValue[1] : sValue
}


//根据radio的name获取选中radio的值value
function getRadioBoxValue(radioName) {
    var obj = document.getElementsByName(radioName);
    for (i = 0; i < obj.length; i++) {

        if (obj[i].checked) {
            return obj[i].value;
        }
    }
    return "undefined";
}


//获取checkbox值
function getCheckedValue(radioObj) {
    if (!radioObj)
        return "";
    var radioLength = radioObj.length;
    if (radioLength == undefined)
        if (radioObj.checked)
            return radioObj.value;
        else
            return "";
    for (var i = 0; i < radioLength; i++) {
        if (radioObj[i].checked) {
            return radioObj[i].value;
        }
    }
    return "";
}


//显示和隐藏指定ID行
function ShowHideRow(id, showIDPrefix, hideIDPrefix) {
    document.getElementById(hideIDPrefix + id).style.display = "none";
    document.getElementById(showIDPrefix + id).style.display = "";
}

//显示和隐藏ID容器
function ShowHideObject(id, isShow) {
    if (isShow)
        document.getElementById(id).style.display = "";
    else
        document.getElementById(id).style.display = "none";
}



//隐藏或显示指定ID对象
function ShowHideSwitch(id) {
    if (document.getElementById(id).style.display == "none")
    { document.getElementById(id).style.display = ""; }
    else
    { document.getElementById(id).style.display = "none"; }
}


//加入收藏
function AddFavorite(title, url) {
    if (document.all) {
        window.external.addFavorite(url, title);
    }
    else if (window.sidebar) {
        window.sidebar.addPanel(title, url, "");
    }
}

//普通打开窗口
function OpenWindow(url, type) {
    switch (type) {
        case 1: //_top窗口
            window.open(url, "_top");
            break;
        case 2: //_self窗口
            window.open(url, "_self");
            break;
        case 3: //_blank窗口
            window.open(url, "_blank");
            break;
    }
}




//判断是否为url
function IsUrl(urlString) {
    regExp = /(http[s]?|ftp):\/\/[^\/\.\,\s\'\"\;]+?\.[^\,\s\'\"\;]+?[\w\/]$/i;
    if (urlString.match(regExp)) return true;
    else return false;
}



//从用逗号分隔的组合字符串中移除指定字符串
function RemoveStringFromStringCombination(s, deleteS) {
    var tempArray = s.split(",");
    var outArray = new Array();
    var j = 0;

    for (var i = 0; i < tempArray.length; i++) {
        if (tempArray[i] != deleteS) {
            outArray[j] = tempArray[i];
            j++;
        }
    }

    return outArray.join(",");
}



//检查指定字符串是否存在于用逗号分隔的组合字符串
function CheckIsStringExistsInStringCombination(s, checkS) {
    var tempArray = s.split(",");
    var result = false;

    for (var i = 0; i < tempArray.length; i++) {
        if (tempArray[i] == checkS) {
            result = true;
        }
    }
    return result;
}

//日期间隔
function dateDiff(interval, date1, date2) {
    var objInterval = { 'D': 1000 * 60 * 60 * 24, 'H': 1000 * 60 * 60, 'M': 1000 * 60, 'S': 1000, 'T': 1 };
    interval = interval.toUpperCase();
    var dt1 = Date.parse(date1.replace(/-/g, '/'));
    var dt2 = Date.parse(date2.replace(/-/g, '/'));
    try {
        return Math.round((dt2 - dt1) / eval('(objInterval.' + interval + ')'));
    }
    catch (e) {
        return e.message;
    }
}

//返回今天年-月-日
function getTodayDate() {
    var myDate = new Date();
    return myDate.getFullYear().toString() + "-" + (myDate.getMonth() + 1).toString() + "-" + myDate.getDate().toString();
}

//生成伪Guid，不带横线，32位
function GenerateSimGuid() {
    var guid = "";
    for (var i = 1; i <= 32; i++) {
        var n = Math.floor(Math.random() * 16.0).toString(16);
        guid += n;
        //if((i==8)||(i==12)||(i==16)||(i==20))
        //  guid += "-";
    }
    return guid;
}

//切断文本
//s 原始文本
//lengthLimit 限制长度
//suffix 超过长度时使用的后缀
function CutText(s, lengthLimit, suffix) {
    if (s == "") {
        return "";
    }
    if (s.length > lengthLimit) {
        return s.substring(0, lengthLimit) + suffix;
    }
    else {
        return s;
    }
}

//去除最后一个字符
function CutLastChar(s) {
    if (s == "") {
        return "";
    }
    return s.substring(0, s.length - 1)
}

//解析为绝对路径，支持~标记，需要先引用含全局变量定义的js文件
function ResolveUrl(s) {
    return s.replace("~", GLOBAL_RootPath);
}

//删除左右两端的空格 
function trim(str) {
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
//删除左边的空格 
function ltrim(str) {
    return str.replace(/(^\s*)/g, "");
}
//删除右边的空格 
function rtrim(str) {
    return str.replace(/(\s*$)/g, "");
}

//跳转到锚点
function JumpToAnchor(anchorName) {
    location = "#" + anchorName;
}


//秒转换为时分秒
function SecondsTohhmmss(seconds) {
    var hh;
    var mm;
    var ss;
    //传入的时间为空或小于0
    if (seconds == null || seconds < 0) {
        return;
    }
    //得到小时
    hh = seconds / 3600 | 0;
    seconds = parseInt(seconds) - hh * 3600;
    if (parseInt(hh) < 10) {
        hh = "0" + hh;
    }
    //得到分
    mm = seconds / 60 | 0;
    //得到秒
    ss = parseInt(seconds) - mm * 60;
    if (parseInt(mm) < 10) {
        mm = "0" + mm;
    }
    if (ss < 10) {
        ss = "0" + ss;
    }
    return hh + ":" + mm + ":" + ss;
}






//预读图片，来自dreamweaver
//多个图片用逗号分隔
function PreloadImages() {
    var d = document; if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();
        var i, j = d.MM_p.length, a = PreloadImages.arguments; for (i = 0; i < a.length; i++)
            if (a[i].indexOf("#") != 0) { d.MM_p[j] = new Image; d.MM_p[j++].src = a[i]; }
    }
}



function AddDays(str, value) {
    var d = new Date(str.replace(/-/g, "/"));
    d.setDate(d.getDate() + value);
    return (d.getFullYear() + "-" + (1 + d.getMonth()) + "-" + d.getDate());
}


//复制到剪贴板
function CopyText(v) {
    if (document.all) {
        window.clipboardData.setData('text', v);
        MessageModalPopup("已将网址成功复制到剪贴板！", "info");
    } else {
        MessageModalPopup("您的浏览器不支持剪贴板操作，请手动复制以下内容：<textarea style='margin-top:12px;height:60px;width:100%;'>" + v + "</textarea>", "info");
    }
}




//显示IP来源
function ShowIPLocation(ip, selector) {
    $(function () {
        if (ip == "127.0.0.1" || ip == "::1") {
            $(selector).html('本地IP');
            return;
        }
        var url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=" + ip;
        $.ajax({
            type: "GET",
            url: url,
            timeout: 15000,
            dataType: "script",
            success: function () {
                if (remote_ip_info != undefined && remote_ip_info.ret == '1') {
                    var country = remote_ip_info.country;
                    var province = remote_ip_info.province;
                    var city = remote_ip_info.city;
                    var isp = remote_ip_info.isp;
                    var ipLocation = "";
                    if (country != "")
                        ipLocation += country;
                    if (province != "")
                        ipLocation += " - " + province;
                    if (city != "")
                        ipLocation += " - " + city;
                    if (isp != "")
                        ipLocation += " （" + isp + "）";

                    $(selector).text(ipLocation);
                }
            },
            error: function () { $(selector).html('抱歉，暂时无法查询，请稍后再试。'); }
        });
    });
}


//radio取值
function GetRadioValue(RadioName) {
    var obj;
    obj = document.getElementsByName(RadioName);
    if (obj != null) {
        var i;
        for (i = 0; i < obj.length; i++) {
            if (obj[i].checked) {
                return obj[i].value;
            }
        }
    }
    return null;
}

//checkbox或radio取值（两种都通用，如果是checkbox有多个选择，会用逗号分隔）
function GetCheckedValue(CheckboxName) {
    var obj;
    obj = document.getElementsByName(CheckboxName);
    var rt = "";
    if (obj != null) {
        var i;
        for (i = 0; i < obj.length; i++) {
            if (obj[i].checked) {
                rt = rt + obj[i].value + ","
            }
        }
    }
    if (rt != "") {
        rt = rt.substr(rt, rt.length - 1);
    }
    return rt;
}

//htmlEncode
function htmlEncode(str) {
    var s = "";
    if (str.length == 0) return "";
    s = str.replace(/&/g, "&amp;");
    s = s.replace(/</g, "&lt;");
    s = s.replace(/>/g, "&gt;");
    s = s.replace(/\'/g, "&#39;");
    s = s.replace(/\"/g, "&quot;");
    return s;
}

//检查指定字符串是否存在于用逗号分隔的组合字符串
function CheckIsStringExistsInStringCombination(s, checkS) {
    var tempArray = s.split(",");
    var result = false;

    for (var i = 0; i < tempArray.length; i++) {
        if (tempArray[i] == checkS) {
            result = true;
        }
    }
    return result;
}

//光标处插入文本
//$(文本域选择器).insertContent("插入的内容");
//$(文本域选择器).insertContent("插入的内容"，数值); //根据数值选中插入文本内容两边的边界, 数值: 0是表示插入文字全部选择，-1表示插入文字两边各少选中一个字符。
//在光标位置插入内容, 并选中
(function ($) {
    $.fn.extend({
        insertContent: function (myValue, t) {
            var $t = $(this)[0];
            if (document.selection) { //ie
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
                sel.moveStart('character', -l);
                var wee = sel.text.length;
                if (arguments.length == 2) {
                    var l = $t.value.length;
                    sel.moveEnd("character", wee + t);
                    t <= 0 ? sel.moveStart("character", wee - 2 * t - myValue.length) : sel.moveStart("character", wee - t - myValue.length);

                    sel.select();
                }
            } else if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
                if (arguments.length == 2) {
                    $t.setSelectionRange(startPos - t, $t.selectionEnd + t);
                    this.focus();
                }
            }
            else {
                this.value += myValue;
                this.focus();
            }
        }
    })
})(jQuery);



