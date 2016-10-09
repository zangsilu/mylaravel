@extends('layout.home')
@section('content')
  <link href="{{asset('resources/views/Home/css/new.css')}}" rel="stylesheet">
  <article class="blogs">
    <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>
        @foreach($cate_data as $k=>$v)
        &nbsp;&gt;&nbsp;<a href="{{url('/list/'.$v['cate_id'])}}">{{$v['cate_name']}}</a>
       @endforeach
      </span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/list/'.$data->cate_id)}}" class="n2">{{$data->cate_name}}</a></h1>
    <div class="index_about">
      <h2 class="c_titile">{{$data->art_title}}</h2>
      <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$data->art_time)}}</span><span>编辑：{{$data->art_editor}}</span><span>查看次数：{{$data->art_view}}</span></p>
      <ul class="infos">
<div id="art_content">

        {!! $data->art_content !!}
</div>
      </ul>
      <div class="keybq">
        <p><span>关键字词</span>：{{$data->art_tag}}</p>

      </div>
      <div class="ad"> </div>
      <div class="nextinfo">
        <p>上一篇：
            @if($art_data['prev'])
            <a href="{{url('/art/'.$art_data['prev']['art_id'])}}">{{$art_data['prev']['art_title']}}</a>
            @else
                <span>没有了</span>
            @endif
        </p>
        <p>下一篇：
            @if($art_data['next'])
                <a href="{{url('/art/'.$art_data['next']['art_id'])}}">{{$art_data['next']['art_title']}}</a>
            @else
                <span>没有了</span>
            @endif
        </p>
      </div>
      <div class="otherlink">
        <h2>相关文章</h2>
        <ul>
            @foreach($art_news as $k=>$v)
                <li><a href="{{url('/art/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
            @endforeach
        </ul>
      </div>
        {{--评论功能--}}
        <div style="margin: 20px 20px 0px 0px;">
            <div class="ds-thread" data-thread-key="{{$data->art_id}}" data-title="{{$data->art_title}}" data-url="{{url('/art/'.$data->art_id)}}"></div>
            <script type="text/javascript">
                var duoshuoQuery = {short_name:"blog-pl39"};
                (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0]
                    || document.getElementsByTagName('body')[0]).appendChild(ds);
                })();
            </script>
        </div>

    </div>
    <aside class="right">
      <!-- Baidu Button BEGIN -->
      <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
      <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
      <script type="text/javascript" id="bdshell_js"></script>
      <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
      </script>
      <!-- Baidu Button END -->
      <div class="blank"></div>
      <div class="news">
        <h3>
          <p>栏目<span>最新</span></p>
        </h3>
        <ul class="rank">
          @foreach($art_news as $k=>$v)
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
        <h3>
          <p>最近访客</p>
        </h3>
            {{--最近访客--}}
            {!! config('web.web_fangke') !!}
      </div>
    </aside>
  </article>
@endsection
