/*前台mobile版专用全局*/


//重写alert
window.alert = mobilePopupMessage;
function mobilePopupMessage(message) {
    try {
        $("#popupDialog p").text(message);
        $("#popupDialog").popup("open");
    } catch (e) {
        delete window.alert;
        alert(message);
        window.alert = mobilePopupMessage;
        //$(document).bind('pageshow', function () {
        //    $("#popupDialog p").text(message);
        //    $("#popupDialog").popup("open");
        //});
    }
}

