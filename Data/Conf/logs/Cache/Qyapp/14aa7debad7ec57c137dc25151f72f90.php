<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>请假</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta content=" " name="Keywords">
<meta content="" name="Description">
<link href="./Tpl/Qyapp/Workflow/css/m.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Workflow/css/cate24_0.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Workflow/css/index.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/css/indexss.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Workflow/css/m2265.css">
<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Leave/css/act_inf.css">


<script src="./Tpl/assets/admin/pages/scripts/form-samples.js"></script>
<script src="./Tpl/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>


</head>

<body id="cate12" style="background-color:#fff;" >
<div id="content" style=" width:100%;"> 
<div class="softload"> 
<ul>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><a href="<?php echo U('wap_holiday_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$list['id']));?>"> 
                                <li class="media" style=" border-bottom:1px dashed #b3b3b3;overflow:hidden;position:relative" id="<?php echo ($vo["id"]); ?>">
                                    <div class="media-status" style="position: absolute;right: 12px;top: 29px;">
                                    <img src="./Tpl/Qyapp/Leave/images/iconfont-zhankaijiantou.png" width="20px" height="20px">
                                        <!-- <?php if($list['status'] == 0): ?><span style=" color:#F33;">待审核</span><?php endif; ?>
                                        <?php if($list['status'] == 1): ?><span style=" color:#F33;">已审核</span><?php endif; ?>
                                        <?php if($list['status'] == 2): ?><span style=" color:#F33;">驳回</span><?php endif; ?> -->
                                    </div>                              
                                    <div class="media-body">
                                        <div style="float:left;margin:8px 10px 0 6px;width: 40px;height: 40px;border-radius: 100% !important;overflow:hidden">
                                        <img width="40px" height="40px" src="<?php echo ($user["pic"]); ?>" alt="" />
                                        </div>
                                        <div class="media-heading" style="float:left;line-height:20px;">
                                            <span style="color:#666;">
                                            <?php echo ($user["name"]); ?>
                                                
                                            </span>
                                        </br>
                                            <span style="font-size:13px;">职务:&nbsp;&nbsp;<?php echo ($user["position"]); ?></span>
                                        <br>
                                            <span style="font-size:13px;">类型:&nbsp;&nbsp;<?php echo ($list["typename"]); ?></span>
                                        </div>
                                    </div>
                                  
                                </li>
                                </a><?php endforeach; endif; else: echo "" ;endif; ?>	
</ul> 
</div> 
<br><br>
</div> 
<div id="frame" >
<div id="menu">
    <ul>
        <li>
            <div class="menu_li">我的审核</div>
            <span>
                <img src="./Tpl/Qyapp/Task/images/navbg2.png" width="90%" />
                <div class="sec_nav">
                    <a href="<?php echo U('wap_wait_check',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],status=>0));?>">审核中</a>
                    <a href="<?php echo U('wap_wait_check',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],status=>1));?>">已审核</a>
                </div>
            </span>
        </li>
        <li>
            <div class="menu_li border">我的假单</div>
            <span>
                <img src="./Tpl/Qyapp/Task/images/navbg2.png" width="90%">
                <div class="sec_nav">
                    <a href="<?php echo U('wap_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],status=>0));?>">审核中</a>
                    <a href="<?php echo U('wap_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],status=>1));?>">已审核</a>
                </div>
            </span>
        </li>       
        <li>
            <a href="<?php echo U('wap_holiday',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
            <div class="menu_li">请假</div>
            <span>
                
                <div class="sec_nav">
                    
                </div>
            </span>
            </a>
        </li>
    </ul>
</div>
<style>
#menu{position:fixed;bottom:0px;width:100%;height:44px;line-height:44px;z-index:999; background-color:#fff; border-top:1px solid #CCC;}
#menu ul{margin:0 auto;list-style-type:none;width:100%;height:100%; padding-left:0px;}
#menu ul li{float:left;width:33.3%;height:100%;text-align:center;position:relative;font-size:14px; background-color:#fff;}
#menu .border{ border-left:1px solid #ccc; border-right:1px solid #ccc;}
.sec_nav{ margin-left:7px;}
#menu ul li .menu_li{position:absolute;top:0px;left:0px;z-index:20;width:100%;height:100%;color:#454545;}
#menu ul li .img_front{position:absolute;top:0px;left:0px;z-index:30;width:100%;height:100%;}
#menu ul li .img_front img{width:100%;height:100%;}
#menu ul li span{position:absolute;bottom:-300px;left:50%;width:104px;margin-left:-52px;height:auto;text-align:center;z-index:-1;}
#menu ul li span div{position:absolute;top:0px;left:0px;}
#menu ul li span a{float:left;width:100%;height:40px;line-height:40px;color:#454545;text-decoration:none;}
.bg_li{
    background:url(./Tpl/Qyapp/Task/images/iconfont-right-thin.png) no-repeat 96% 50% / 20px #F6FCF6;
}
.footer_front{position:fixed;width:100%;height:100%;top:0px;left:0px;z-index:888;display:none;}
#bd_lr{
  border-left: 1px solid #ccc;
  border-right: 1px solid #ccc;
}
a{

text-decoration:none;

}
</style>
</div>	
<script type="text/javascript">
    window.onload = function(){
    $('#menu ul li').each(function(j){
        $('#menu ul li').eq(j).removeClass("on");
        $('#menu ul li span').eq(j).animate({bottom:-$('#menu ul li span').eq(j).height()},100);
    });
}

$('#menu ul li').each(function(i){
    $(this).click(function(){
        if($(this).attr("class")!="on"){
            $('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
            $('#menu ul .on').removeClass("on");
            $(this).addClass("on");
            $('#menu ul li span').eq(i).animate({bottom:50},200);
            $('.footer_front').show();
        }else{
            $('#menu ul li span').eq(i).animate({bottom:-$('#menu ul li span').eq(i).height()},200);
            $(this).removeClass("on");
            $('.footer_front').hide();
        }
    });
});
</script>
</body>