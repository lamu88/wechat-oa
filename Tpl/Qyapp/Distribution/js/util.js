/**
 * 适配renita屏幕，替换大图标
 */
function imgSwitch() {
    if(window.devicePixelRatio >= 2) {
      $('.figure img').each(
        function(i) {
          $(this).attr('src', $(this).attr('src').replace('.png', '@2x.png'));
        });
      $('#logo img').each(
        function(i) {
          $(this).attr('src', $(this).attr('src').replace('.png', '@2x.png'));
        });
    }
}

/**
 * 区分Android和iOS的产品
 */
function deviceSwitch() {
  if (/(iPhone|iPad|iPod|Mac|iOS)/i.test(navigator.userAgent)) {
    $('.ios').show();
  } else if (/(Android)/i.test(navigator.userAgent)){
    $('.android').show();
  } else {
    $('.android').show();
  }
}

/**
 * 获取url参数的值
 * @param  {String} param url参数
 * @return {String}
 */
function getQueryParam(param) {
    var result =  window.location.search.match(
        new RegExp("(\\?|&)" + param + "(\\[\\])?=([^&]*)")
    );

    return result ? result[3] : false;
}

/**
 * 根据不同的渠道更改页面的内容
 */
function channelSwitch() {
  var channel = getQueryParam('c');

  // 点卡卡套渠道号
  if (channel == '208801') {
    var lis = $('#appTray li');
    var len = lis.length;

    for (var i = 0; i < len; i++) {
      var li = lis[i];
      var id = li.id;

      if (id !== 'av' && id !== 'ps' && id != 'msi208801') {
        $(li).hide();
      }
    }

    $('header h6').hide();
    $('aside.more').hide();
    $('.description h4').hide();

    $('#ps h2').html('隐私保护');

    var q = getQueryParam('q');
    if (q === 'ps') {
      document.title = "隐私保护 – 网秦手机软件中心:手机安全,手机杀毒,手机卫士,通讯管家";
      $('.download h2').html('隐私保护');
    }
  } else {
    $('#appTray li#msi208801').hide();
  }

  // test
  $('#appTray li#msi208801').hide();
  if (getQueryParam('test') == 1) {
    $('#appTray li#msi208801').show();
  }
}

/**
 * En Share
 */
function shareEn(str){
  var t = document.title;
  var u = document.location.href;
  
  switch(str){
    case 'digg':
    var f = 'http://digg.com/submit?';
    var p = ['&url=', u, '&title=', encodeURIComponent(t)].join('');
    break;
    
    case 'delicious':
    var f = 'http://delicious.com/post?';
    var p = ['url=', u, '&title=', encodeURIComponent(t)].join('');
    break;
  }
  
  window.open([f, p].join(''));
}

/**
 * 卸载网秦安全弹出提示信息
 */
function unloadMsg() {
  var href = window.location.href;

  if (href.indexOf('unload') != -1) {
    var msg = {
      'en' : 'Thank you for using NQ Mobile Security.<br>'
                + 'You can send your feedback to: <a href="mailto:customersupport_40nq.com">customersupport@nq.com</a>.'
                + 'We appreciate your feedback and will do our best to improve the app!',
      'ar' : 'شكرًا لاستخدامك برنامج أمان الهاتف النقال NQ Mobile Security.'
    };

    var lang = getQueryParam('l');

    if (lang === 'en' || lang === 'ar') {
      $('.wrapper').addClass('en');
      $('.l-zh').addClass('hide');
      $('.l-en').removeClass('hide');

      $('.unload_msg').html(msg[lang]);
    }
  }
}
