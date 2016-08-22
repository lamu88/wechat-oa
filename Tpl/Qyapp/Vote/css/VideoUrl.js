/*
生成视频播放代码
把视频网站播放页html网址转换为flash视频url
*/




//转换视频网站网址为Flash url
function VideoSiteHtmlToFlashUrl(_url) {

    var _id = '';
    var _new_url = '';

    if (_url == '') { return ''; }

    var _array = _url.split('/');

    if (_array.length <= 0) { return _url; }

			if (_url.indexOf('v.youku.com')>0){
				if (_url.indexOf('v_show/id')>0){
					_id = _array[_array.length-1].replace(/(id_)(.*)(.html)/gi , '$2');
					if (_id != ""){ _new_url = 'http://player.youku.com/player.php/sid/' + _id + '/v.swf'; }
				}
			}			

			if (_url.indexOf('v.ku6.com')>0){
				if (_url.indexOf('/show')>0){
					_id = _array[_array.length-1].replace(/(.*)(.html)/gi , '$1');
					if (_id != ""){ _new_url = "http://player.ku6.com/refer/" + _id + "/v.swf";}
				}
			}	

			if (_url.indexOf('www.tudou.com')>0){
				if (_url.indexOf('playindex.do')>0){
					var reg = /playindex\.do\?lid=([^\&]*)\&iid=([^\&]*)/i;
					var _temp_url = _array[_array.length-1];
					if (reg.exec(_temp_url)){
						_id = _temp_url.replace(/playindex\.do\?lid=([^\&]*)\&iid=([^\&]*)(.*)/gi , '$2');
						if (_id != ""){	_new_url = "http://www.tudou.com/player/skin/plu.swf?iid=" + _id;}
					}
				}
				else{
					if (_url.indexOf('programs/view/')>0){
						_id = _array[_array.length-2];
						if (_id != ""){	_new_url = "http://www.tudou.com/v/" + _id + "/v.swf";}
					}				
				}
			}

			if (_url.indexOf('www.56.com')>0){
				if (_url.indexOf('.html')>0){
					_id = _array[_array.length-1].replace(/(v_)(.*)(.html)/gi , '$2');
					_id = _id.replace(/(.*)(vid-)(.*)(.html)/gi , '$3');
					if (_id != ""){	_new_url = "http://player.56.com/v_" + _id + ".swf";}
				}
			}	

			if (_url.indexOf('video.sina.com.cn')>0){
				_id = _array[_array.length-1].replace(/(.*)(.html)/gi , '$1');
				_id = _id.replace("-","_");
				if (_id != ""){ _new_url = "http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=" + _id + "/s.swf";}
			}	

			if (_url.indexOf('joy.cn')>0){
				_id = _array[_array.length-1].replace(/(.*)(.htm)/gi , '$1');
				if (_id != ""){	_new_url = "http://client.joy.cn/flvplayer/" + _id + "_1_0_1.swf";}
			}	

			if (_url.indexOf('umiwi.com')>0){
				_id = _array[_array.length-1].replace('detail', '');
				if (_id != ""){	_new_url = "http://www.umiwi.com/video/" + _id + ".swf";}
			}

    if (_new_url != '') {
        return _new_url;
    } else {
        return '';
    }
}


//1 real文件网址
//2 mediaplayer文件网址
//3 flash文件网址
//4 html视频网站播放页
function GetVideoUrlType(_url) {

    if (_url == '' || _url == 'http://') { return 0; }

    var _array = _url.split('/');

    if (_array.length <= 0) { return 0; }

    //读取文件名，变成小写处理
    var _filename = _array[_array.length - 1].toLowerCase();

    if (_filename.indexOf('.rm') > 0) { return 1; }
    if (_filename.indexOf('.ra') > 0) { return 1; }
    if (_filename.indexOf('.ram') > 0) { return 1; }
    if (_filename.indexOf('.rmvb') > 0) { return 1; }
    if (_filename.indexOf('.avi') > 0) { return 2; }
    if (_filename.indexOf('.wmv') > 0) { return 2; }
    if (_filename.indexOf('.mpg') > 0) { return 2; }
    if (_filename.indexOf('.asf') > 0) { return 2; }
    if (_filename.indexOf('.swf') > 0) { return 3; }
    if (_filename.indexOf('.flv') > 0) { return 3; }

    _filename = VideoSiteHtmlToFlashUrl(_url);

    if (_filename == '') {
        return 0;
    }
    else {
        return 4;
    }
}

//返回播放器代码，如果源网址无法识别，返回""
function GetVideoPlayerCode(_url, _width, _height , _wmode , _allowScriptAccess) {
	var wmodeParam="";
	var wmodeEmbed="";
	var allowScriptAccessParam="";
	var allowScriptAccessEmbed="";
	
	if (_wmode!=undefined && _wmode!="") {
		wmodeParam="<param name=\"wmode\" value=\"" + _wmode + "\" />";
		wmodeEmbed="wmode=\"" + _wmode + "\"";
	}
	if (_allowScriptAccess!=undefined && _allowScriptAccess!="") {
		allowScriptAccessParam="<param name=\"allowScriptAccess\" value=\"" + _allowScriptAccess + "\" />";
		allowScriptAccessEmbed="allowScriptAccess=\"" + _allowScriptAccess + "\"";
	}
	
    var videoType = GetVideoUrlType(_url);
    var videoHtmlCode;
    switch (videoType) {
        case 0:
            return "";

        case 1: 	//RM格式
            return "<object classid=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" width=\"" + _width + "\" height=\"" + _height + "\"><param name=\"AUTOSTART\" value=\"0\"><param name=\"src\" value=\"" + _url + "\"><param name=\"CONSOLE\" value=\"Clip1\"><param name=\"CONTROLS\" value=\"imagewindow\"></object><br><object classid=\"CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA\" height=\"32\" width=\"" + _width + "\"><param name=\"AUTOSTART\" value=\"0\"><param name=\"SRC\" value=\"" + _url + "\"><param name=\"CONTROLS\" value=\"controlpanel\"><param name=\"CONSOLE\" value=\"Clip1\"></object>";
            

        case 2: 	//WM格式
            return "<object classid=\"clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95\" width=\"" + _width + "\" height=\"" + _height + "\"><param name=\"AUTOSTART\" value=\"0\"><param name=\"ShowStatusBar\" value=\"-1\"><param name=\"Filename\" value=\"" + _url + "\"><embed type=\"application/x-oleobject\" codebase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701\" flename=\"mp\" src=\"" + _url + "\" width=\"" + _width + "\" height=\"" + _height + "\"></embed></object>";
            

        case 3: //flash格式
            return "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0\" width=\"" + _width + "\" height=\"" + _height + "\"><param name=\"movie\" value=\"" + _url + "\" /><param name=\"quality\" value=\"high\" />" + wmodeParam + allowScriptAccessParam + "<embed src=\"" + _url + "\" quality=\"high\" " + wmodeEmbed + " " + allowScriptAccessEmbed + " pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"" + _width + "\" height=\"" + _height + "\"></embed></object>";
            

        case 4: //视频网站flash
            var flashUrl = VideoSiteHtmlToFlashUrl(_url);
            var flashHtmlCode = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0\"  width=\"" + _width + "\" height=\"" + _height + "\"><param name=\"movie\" value=\"" + flashUrl + "\" /><param name=\"quality\" value=\"high\" />" + wmodeParam + allowScriptAccessParam + "<embed src=\"" + flashUrl + "\" quality=\"high\" " + wmodeEmbed + " " + allowScriptAccessEmbed + " pluginspage=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"" + _width + "\" height=\"" + _height + "\"></embed></object>";
            return flashHtmlCode;
    }
}



//处理[MediaUrl]http://url[/MediaUrl]标签
function videoLabelFilter(sourceCode, width, height) {
    if (sourceCode == undefined || sourceCode=='') {
        return '';
    }
    var re = new RegExp(/\[MediaUrl\](.[^\[]*)\[\/MediaUrl\]/gi);
    var html = sourceCode.replace(re, function (all, $1) {
        return GetVideoPlayerCode($1, width, height);
    });
    return html;
}