<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>博客</title>
<?php $baseUrl=Wave::app()->request->baseUrl;?>
<link type="text/css" rel="stylesheet" href="<?=$baseUrl?>/resouce/css/pure-min.css"/>
<link type="text/css" rel="stylesheet" href="<?=$baseUrl?>/resouce/css/public.css"/>
<link type="text/css" rel="stylesheet" href="<?=$baseUrl?>/resouce/css/admin.css"/>
<script type="text/javascript" src="<?=$baseUrl?>/resouce/js/jquery-1.4.3.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#wel-name").mouseover(function(){
        $(".info").css({"display":"block"});
    })
    $("#info").mouseover(function(){
        $(".info").css({"display":"block"});
    })
    $("#info").mouseout(function(){
        $(".info").css({"display":"none"});
    })
})
</script>
</head>
<body>
<div id="layout" class="pure-g-r">
    <div id="menu" class="pure-u">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="<?=Wave::app()->homeUrl?>">博客后台</a>
            <ul>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/articles'?>">文章</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/categories'?>">分类</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/tags'?>">标签</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/multimedias'?>">多媒体</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/links'?>">链接</a>
                </li>
                <li class="">
                    <a href="<?=Wave::app()->homeUrl.'/pages'?>">页面</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/comments'?>">评论</a>
                </li>
                <li class="menu-item-divided">
                    <a href="<?=Wave::app()->homeUrl.'/exterior'?>">外观</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/plugs'?>">插件</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/users'?>">用户</a>
                </li>
                <li class=" ">
                    <a href="<?=Wave::app()->homeUrl.'/setup'?>">设置</a>
                </li>
            </ul>
        </div>
    </div>
    <div id="main">
        <div class="header clearfix">
            <div class="welcome right">
                <a href="" id="wel-name">欢迎光临：xpmozong</a>
                <div class="info clearfix" id="info">
                    <div class="avatar left">
                        <img src="<?=Wave::app()->request->baseUrl?>/resouce/images/default.jpg">
                    </div>
                    <div class="inmenu left pure-menu pure-menu-open">
                        <ul>
                            <li class=" ">
                                <a href="">编辑我的个人资料</a>
                            </li>
                            <li class=" ">
                                <a href="<?=Wave::app()->homeUrl.'/site/logout'?>">登出</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php echo $content;?>
        </div>
    </div>
</div>
</body>
</html>