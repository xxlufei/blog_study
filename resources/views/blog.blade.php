@include('header');
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
                            @foreach( $file_list as $file)
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date">{{ $file->file_name }}</span>
                                        <span><i class="fa fa-user"></i><a
                                                    href="javascript:void(0)">  {{ $file->object_name }}</a></span>
                                        <span><i class="fa fa-comment"></i><a
                                                    href="javascript:void(0)"> {{ date('Y-m-d', $file->create_at) }}</a></span>
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
                                            <video id="example_video_1"
                                                   class="video-js vjs-default-skin col-lg-12 auto-height vjs-big-play-centered"
                                                   controls preload="none"
                                                   poster="http://video-js.zencoder.com/oceans-clip.png"
                                                   data-setup="{}">
                                                <source src="{{ $file->path }}" type='video/mp4'/>
                                                <track kind="captions" src="demo.captions.vtt" srclang="en"
                                                       label="English"></track>
                                                <track kind="subtitles" src="demo.captions.vtt" srclang="en"
                                                       label="English"></track>
                                            </video>
                                        @else
                                            <a class="media" href="{{ $file->path }}">PDF File</a>
                                        @endif
                                    @else
                                        <a class="video-js vjs-default-skin col-lg-12 auto-height vjs-big-play-centered"
                                           href="#">　　　文件已失效,请联系老师及时更新!</a>
                                    @endif
                                </div>
                            @endforeach
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
                                    <li>
                                        <a href="download?object_id={{ $object->object_id }}">{{ $object->object_name }}
                                            <span class="badge">{{ $object->num }}</span></a></li>
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
                                        <img style="margin-left: 20px;width: 64px;height:64px"
                                             src="{{ $message->avatar}}" alt=""/>
                                    @else
                                        <img style="margin-left: 20px" src="front/images/blog/avatar3.png" alt=""/>
                                    @endif
                                    <p>{{ $message->content }} </p>
                                    <div class="entry-meta small muted">
                                        <span>By <a href="#">{{ $message->name }}</a></span> <span>On <a
                                                    href="#">{{ date('Y-m-d H:i:s', $message->create_at) }}</a></span>
                                    </div>
                                    @if(mb_strlen($message->content) < 60)
                                        <br/>
                                    @endif
                                </div>
                            @endforeach
                            <a class="btn btn-primary readmore" style="float:right" href="messages">查看更多 <i
                                        class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div><!--/.recent comments-->


            </aside>
        </div><!--/.row-->
    </div>
</section><!--/#blog-->


@include('footer');


<script>
    $(function () {
        //pdf
        $('a.media').media({width: $('.blog-content').width()});
    });

</script>
