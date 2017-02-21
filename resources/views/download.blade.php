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
    <style>
        .auto-height {
            position: relative;
            padding-top: 25px;
            padding-bottom: 56.25%;
            height: 0;
            border: 1px solid red;
        }

        * {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        a, img {
            border: 0;
        }

        /* side */
        .side {
            position: fixed;
            width: 54px;
            height: 275px;
            right: 0;
            top: 366px;
            z-index: 100;
        }

        .side ul li {
            width: 54px;
            height: 54px;
            float: left;
            position: relative;
            border-bottom: 1px solid #444;
        }

        .side ul li .sidebox {
            position: absolute;
            width: 54px;
            height: 54px;
            top: 0;
            right: 0;
            transition: all 0.3s;
            background: #000;
            opacity: 0.8;
            filter: Alpha(opacity=80);
            color: #fff;
            font: 14px/54px "微软雅黑";
            overflow: hidden;
        }

        .side ul li .sidetop {
            width: 54px;
            height: 54px;
            line-height: 54px;
            display: inline-block;
            background: #000;
            opacity: 0.8;
            filter: Alpha(opacity=80);
            transition: all 0.3s;
        }

        .side ul li .sidetop:hover {
            background: #ae1c1c;
            opacity: 1;
            filter: Alpha(opacity=100);
        }

        .side ul li img {
            float: left;
        }

        /* side end */
    </style>
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
                    <li><a href="/">首页</a></li>
                    <li><a href="/messages">留言板</a></li>
                    <li><a href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq_service }}&site=qq&menu=yes">在线交流</a></li>
                    <li><a href="/download">资料下载</a></li>
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

<section id="blog" class="container">
    <div class="center">
        <h2>{{ $down_title }}</h2>
        <p class="lead">{{ $site_intro }}</p>
    </div>

    <div class="blog">
        <div class="row">
            <table class="table table-striped table-bordered" style="margin-left: 15px;">
                <thead>
                <th width="30%">课件名称</th>
                <th width="20%">课件类型</th>
                <th width="30%">所属科目</th>
                <th width="20%">下载</th>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <div class="single_comments">

                        <tr>
                            <td>{{ $file->file_name }}</td>
                            @if($file->file_type == 2)
                                <td class="text-danger">WORD</td>
                            @elseif($file->file_type == 3)
                                <td class="text-success">PPT</td>
                            @endif
                            <td>{{ $file->object_name }}</td>
                            <td>
                                @if(!is_file($file->path))
                                    <i style="color: red">文件已失效,请联系老师更新</i>
                                @else
                                <a href="{{ $file->path }}" class="text-success">点击下载</a>
                                @endif
                            </td>
                        </tr>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>

        <ul class="pagination pagination-lg">
            @if($current != 1)
                <li><a href="download?current={{$current - 1}}@if($object_id)&object_id={{ $object_id }}@endif">上一页</a>
                </li>
            @endif
            @if($file_total_page > 10)
                @if($current < 10)
                    @for($i=1; $i <= 10; $i++)
                        @if($i == $current)
                            <li class="active"><a href="#">{{ $i }}</a></li>
                        @else
                            <li>
                                <a href="download?current={{$i}}@if($object_id)&object_id={{ $object_id }}@endif">{{$i}}</a>
                            </li>
                        @endif

                    @endfor
                @else
                    @for($i=$current - 9; $i <= $current; $i++)
                        @if($i == $current)
                            <li class="active"><a href="#">{{ $i }}</a></li>
                        @else
                            <li>
                                <a href="download?current={{$i}}@if($object_id)&object_id={{ $object_id }}@endif">{{$i}}</a>
                            </li>
                        @endif

                    @endfor
                @endif
            @else
                @for($i=1; $i <= $file_total_page; $i++)
                    @if($i == $current)
                        <li class="active"><a href="#">{{ $i }}</a></li>
                    @else
                        <li><a href="download?current={{$i}}@if($object_id)&object_id={{ $object_id }}@endif">{{$i}}</a>
                        </li>
                    @endif

                @endfor
            @endif
            @if($current != $file_total_page)
                <li><a href="download?current={{$current + 1}}@if($object_id)&object_id={{ $object_id }}@endif">下一页</a>
                </li>
            @endif
            <li><a href="javascript:void(0)">共 {{ $file_total_page }} 页</a></li>
        </ul><!--/.pagination-->
    </div><!--/.col-md-8-->


</section><!--/#blog-->
@include('footer');
<!--侧边栏-->
<script>
    $(function () {
        $(".side ul li").hover(function () {
            $(this).find(".sidebox").stop().animate({"width": "124px"}, 200).css({
                "opacity": "1",
                "filter": "Alpha(opacity=100)",
                "background": "#ae1c1c"
            })
        }, function () {
            $(this).find(".sidebox").stop().animate({"width": "54px"}, 200).css({
                "opacity": "0.8",
                "filter": "Alpha(opacity=80)",
                "background": "#000"
            })
        });
        //pdf
        $('a.media').media({width: $('.blog-content').width()});
    });
    //回到顶部函数
    function goTop() {
        $('html,body').animate({'scrollTop': 0}, 300);
    }
</script>

</body>
</html>