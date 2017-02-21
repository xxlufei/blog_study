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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="front/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="front/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="front/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="front/images/ico/apple-touch-icon-57-precomposed.png">
    <style>
        .auto-height{
            position:relative;
            padding-top:25px;
            padding-bottom:56.25%;
            height:0;
            border: 1px solid red;
        }

        *{margin:0;padding:0;list-style-type:none;}
        a,img{border:0;}
        /* side */
        .side{position:fixed;width:54px;height:275px;right:0;top:366px;z-index:100;}
        .side ul li{width:54px;height:54px;float:left;position:relative;border-bottom:1px solid #444;}
        .side ul li .sidebox{position:absolute;width:54px;height:54px;top:0;right:0;transition:all 0.3s;background:#000;opacity:0.8;filter:Alpha(opacity=80);color:#fff;font:14px/54px "微软雅黑";overflow:hidden;}
        .side ul li .sidetop{width:54px;height:54px;line-height:54px;display:inline-block;background:#000;opacity:0.8;filter:Alpha(opacity=80);transition:all 0.3s;}
        .side ul li .sidetop:hover{background:#ae1c1c;opacity:1;filter:Alpha(opacity=100);}
        .side ul li img{float:left;}
        /* side end */
    </style>
</head><!--/head-->
<body>
<div class="side">
    <ul>
        <li alt="点击这里给我发消息" title="点击这里给我发消息"><a href="http://wpa.qq.com/msgrd?v=3&uin={{ $qq_service }}&site=qq&menu=yes" ><div class="sidebox"><img src="front/images/ico/side_icon04.png" >QQ客服</div></a></li>
        <li style="border:none;"><a href="javascript:goTop();" class="sidetop"><img src="front/images/ico/side_icon05.png"></a></li>
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
            <h2>{{ $site_title }}</h2>
            <p class="lead">{{ $site_intro }}</p>
        </div>

        <div class="blog">
            <div class="row">
                 <div class="col-md-8">
                    <div class="blog-item">
                        <div class="row">
                            @if(!empty($file_list))
                            @foreach( $file_list as $file)
                            <div class="col-xs-12 col-sm-2 text-center">
                                <div class="entry-meta">
                                    <span id="publish_date">{{ $file->file_name }}</span>
                                    <span><i class="fa fa-user"></i><a href="javascript:void(0)">  {{ $file->object_name }}</a></span>
                                    <span><i class="fa fa-comment"></i><a href="javascript:void(0)"> {{ date('Y-m-d', $file->create_at) }}</a></span>
                                    @if($file->file_type == 0)
                                        <span><i class="fa fa-heart"></i><a href="javascript:void(0)">视频</a></span>
                                    @elseif($file->file_type == 1)
                                        <span><i class="fa fa-heart"></i><a href="javascript:void(0)">PDF</a></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-10 blog-content">
                                @if(is_file($file->path))
                                @if($file->file_type == 0)
                                <video id="example_video_1" class="video-js vjs-default-skin col-lg-12 auto-height vjs-big-play-centered" controls preload="none"
                                       poster="http://video-js.zencoder.com/oceans-clip.png"
                                       data-setup="{}">
                                    <source src="{{ $file->path }}" type='video/mp4' />
                                    <track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>
                                    <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track>
                                </video>
                                @else
                                    <a class="media" href="{{ $file->path }}">PDF File</a>
                                @endif
                                @else
                                    <a class="video-js vjs-default-skin col-lg-12 auto-height vjs-big-play-centered" href="#">　　　文件已失效,请联系老师及时更新!</a>
                                @endif
                            </div>
                            @endforeach
                                @endif
                        </div>    
                    </div><!--/.blog-item-->

                     @include('page');
                </div><!--/.col-md-8-->

                <aside class="col-md-4">
                    {{--<div class="widget search">
                        <form  action="/search">
                                <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
                        </form>
                    </div><!--/.search-->--}}
                    <div class="widget categories">
                        <h3>学科资料库</h3>
                        @foreach($objects as $object)
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="blog_category">
                                        <li><a href="/download?object_id={{ $object->object_id }}">{{ $object->object_name }} <span class="badge">{{ $object->num }}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div><!--/.categories-->
    				<div class="widget categories">
                        <h2>最新留言</h2>
                        <div class="row">
                            <div class="col-sm-12">
                                @foreach($messages as $message)
                                <div class="single_comments">
                                    @if(is_file($message->avatar))
                                        <img style="margin-left: 20px;width: 64px;height:64px" src="{{ $message->avatar}}" alt=""  />
                                    @else
                                        <img style="margin-left: 20px" src="front/images/blog/avatar3.png" alt=""  />
                                    @endif
                                    <p>{{ $message->content }} </p>
                                    <div class="entry-meta small muted">
                                        <span>By <a href="#">{{ $message->name }}</a></span> <span>On <a href="#">{{ date('Y-m-d H:i:s', $message->create_at) }}</a></span>
                                    </div>
                                    @if(mb_strlen($message->content) < 60)
                                        <br/>
                                    @endif
                                </div>
                                @endforeach
                                <a class="btn btn-primary readmore" style="float:right" href="/messages">查看更多 <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>                     
                    </div><!--/.recent comments-->
                     


    			</aside>  
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->



@include('footer');



<!--侧边栏-->
<script>
    $(function(){
        $(".side ul li").hover(function(){
            $(this).find(".sidebox").stop().animate({"width":"124px"},200).css({"opacity":"1","filter":"Alpha(opacity=100)","background":"#ae1c1c"})
        },function(){
            $(this).find(".sidebox").stop().animate({"width":"54px"},200).css({"opacity":"0.8","filter":"Alpha(opacity=80)","background":"#000"})
        });
        //pdf
        $('a.media').media({width:$('.blog-content').width()});
    });
    //回到顶部函数
    function goTop(){
        $('html,body').animate({'scrollTop':0},300);
    }
</script>
<!--侧边栏end-->

</body>
</html>