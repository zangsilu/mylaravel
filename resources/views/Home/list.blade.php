@extends('layout.home')
@section('content')
    <link href="{{asset('resources/views/Home/css/style.css')}}" rel="stylesheet">
    <article class="blogs">
        <h1 class="t_nav"><span>{{$cate->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/list/'.$cate->cate_id)}}" class="n2">{{$cate->cate_name}}</a></h1>
        <div class="newblog left">
            @foreach($art as $k=>$v)
            <h2>{{$v->art_title}}</h2>
            <p class="dateview"><span>发布时间：{{date('Y-m-d',$v->art_time)}}</span><span>作者：{{$v->art_editor}}</span><span>分类：[<a href="{{url('/list/'.$v->cate_id)}}">{{$v->cate_name}}</a>]</span></p>
            <figure><a href="{{url('/art/'.$v->art_id)}}"><img alt="张世路的博客,张世路の博客,简简单单的の博客,{{$v->art_title}}"  src="{{url('/'.$v->art_thumb)}}"></a></figure>
            <ul class="nlist">
                <p>{{$v->art_description}}</p>
                <a  title="阅读全文" href="{{url('/art/'.$v->art_id)}}"  class="readmore">阅读全文>></a>
            </ul>
            <div class="line"></div>
            @endforeach
            <div class="blank"></div>
            <div class="page">
                {!! $art->links() !!}
            </div>
        </div>
        <aside class="right">
            <div class="rnav">
                <ul>
                    @foreach($cate_brother as $k=>$v)
                    <li class="rnav{{$k+1}}"><a href="{{url('/list/'.$v->cate_id)}}" >{{$v->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="news">
                <h3>
                    <p>最新<span>文章</span></p>
                </h3>
                <ul class="rank">
                    @foreach($art_new as $k=>$v)
                    <li><a href="{{url('/art/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
                    @endforeach
                </ul>
                <h3 class="ph">
                    <p>点击<span>排行</span></p>
                </h3>
                <ul class="paih">
                    @foreach($art_view as $k=>$v)
                        <li><a href="{{url('/art/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="visitors">
                <h3><p>文章分享</p></h3>
                <ul>

                </ul>
            </div>
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
        </aside>
    </article>
@endsection
