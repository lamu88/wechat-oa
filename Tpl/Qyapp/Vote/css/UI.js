//jquery easyuimodal弹窗
function ModalPopup(url, width, height, title, modalID, isForceHideScrollBar) {
    $(function () {

        //禁止ie6
        if ($.browser.msie && ($.browser.version == "6.0") && !$.support.style) {
            alert("本功能无法兼容版本过旧的IE6浏览器，请换用其他高版本浏览器。");
            return false;
        }

        if (modalID == undefined) {
            modalID = GenerateSimGuid(); //需要引用common.js
        }

        var iframeID = modalID + '_Iframe';

        $("#" + modalID).remove();

        if ($("#" + modalID).length == 0) {
            var divStyle;
            if (isForceHideScrollBar != undefined && isForceHideScrollBar == true) {
                divStyle = "overflow:hidden;padding:15px;";
            }
            else {
                divStyle = "padding:15px;";
            }
            $("body").append($('<div style="' + divStyle + '" id="' + modalID + '"></div>'));
        }

        if ($("#" + modalID).html() == "") {
            var $iframe = $('<iframe onLoad="Private_IFrameHeight(\'' + iframeID + '\')" width="100%" id="' + iframeID + '" name="' + iframeID + '"  scrolling="no"  frameborder="0" marginwidth="0" marginheight="0"   src="' + url + '"></iframe>');
            $("#" + modalID).append($iframe);
        }

        $("#" + modalID).window({
            width: width,
            height: height,
            modal: true,
            closed: true,
            minimizable: false,
            collapsible: false,
            title: title
        });

        $("#" + modalID).window('open');
    });
}


//iframe自动高度，在函数ModalPopup中用到
function Private_IFrameHeight(iframeID) {
    var ifm = document.getElementById(iframeID);
    var subWeb = document.frames ? document.frames[iframeID].document : ifm.contentDocument;
    if (ifm != null && subWeb != null) {
        ifm.height = subWeb.body.scrollHeight + 15;
    }
}

//关闭easyui窗口
function CloseModal(modalID) {
    $(function () {
        $("#" + modalID).window('close');
    });
}

//type类型：error,info,warning
function MessageModalPopup(message, type) {
    var title = "";
    switch (type) {
        case 'warning':
            title = '警告信息';
            break;
        case 'info':
            title = '提示信息';
            break;
        case 'error':
            title = '错误信息';
            break;
    }
    $.messager.alert(title, message, type);

}


//ShowWarning
function ShowWarning(message) {
    MessageModalPopup(message, "warning");
}




//ShowNotify
function ShowNotify(message, timeout) {
    $(function () {
        var container = $("#nottys");
        if (!container.length) {
            container = $("<div>").appendTo($("<div id='nottys'>").appendTo(document.body));
        };
        $m = $("<h4>" + message + "</h4>");
        $('#nottys div').append($m);
        if (parseInt(timeout)) { window.setTimeout(function () { if ($("#nottys").length) { $("#nottys").remove(); } }, timeout); }
    });
}




//显示屏幕中央Loading，需Jquery支持
function ShowLoadingProgressAtScreenCenter(text) {
    var $ScreenCenterLoading = $("<div id='ScreenCenterLoading' class='ScreenCenterLoading'><span>" + text + "</span></div>");
    $("body").append($ScreenCenterLoading);

    var modalWidth = $ScreenCenterLoading.width();
    var windowWidth = $(window).width();
    var modalLeft = ((windowWidth / 2) - (modalWidth / 2)) + "px";

    $.blockUI.defaults.css = {
        padding: 0,
        margin: 0,
        top: '40%',
        left: modalLeft,
        textAlign: 'center',
        cursor: 'wait'
    };

    $.blockUI.defaults.overlayCSS = {
        backgroundColor: '#000',
        opacity: 0.6
    };

    $.blockUI.defaults.fadeOut = 0;
    $.blockUI.defaults.fadeIn = 0;

    $.blockUI({ message: $('#ScreenCenterLoading') });
}

//隐藏屏幕中央Loading，需Jquery支持
function ClearLoadingProgressAtScreenCenter() {
    $.unblockUI();
    $("#ScreenCenterLoading").remove();
}



