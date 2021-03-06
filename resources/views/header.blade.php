<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{$site_title}}</title>

    <!-- core CSS -->
    <link href="front/css/bootstrap.min.css" rel="stylesheet">
    <link href="front/css/font-awesome.min.css" rel="stylesheet">
    <link href="front/css/prettyPhoto.css" rel="stylesheet">
    <link href="front/css/animate.min.css" rel="stylesheet">
    <link href="front/css/main.css" rel="stylesheet">
    <link href="front/css/responsive.css" rel="stylesheet">
    <link href="front/css/video-js.min.css" rel="stylesheet">
    <link href="front/css/style.css" rel="stylesheet">
    <link href="front/css/self.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="front/js/html5shiv.js"></script>
    <script src="front/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="front/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="front/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="front/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="front/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="front/images/ico/apple-touch-icon-57-precomposed.png">

    <script src="front/js/jquery.js"></script>
    <script src="front/js/bootstrap.min.js"></script>
    <script src="front/js/jquery.prettyPhoto.js"></script>
    <script src="front/js/jquery.isotope.min.js"></script>
    <script src="front/js/main.js"></script>
    <script src="front/js/wow.min.js"></script>
    <script src="front/js/video.min.js"></script>
    <script src="front/js/jquery.media.js"></script>

</head><!--/head-->
<body>
<div class="side">
    <ul>
        <li alt="点击这里给我发消息" title="点击这里给我发消息"><a
                    href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq_service }}&site=qq&menu=yes">
                <div class="sidebox"><img src="front/images/ico/side_icon04.png">QQ客服</div>
            </a></li>
        <li style="border:none;"><a href="javascript:goTop();" class="sidetop"><img
                        src="front/images/ico/side_icon05.png"></a></li>
    </ul>
</div>
<header id="header">
    <nav class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="front/images/logo.png" alt="logo"></a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="\{{$root_url}}">首页</a></li>
                    <li><a href="messages">留言板</a></li>
                    <li><a href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq_service }}&site=qq&menu=yes">在线交流</a></li>
                    <li><a href="download">资料下载</a></li>
                    <li><a href="javascript:void(0)">　　　　　　　　　　　　　　　</a></li>
                    @if(!empty($user))
                        <li><a href="javascript:void(0)">欢迎{{ $user->name }}</a>|<a href="logout">注销</a></li>
                    @else
                        <li><a href="login">登录</a>|<a href="register">注册</a></li>
                    @endif
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->

</header><!--/header-->