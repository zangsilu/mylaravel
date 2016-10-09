﻿@extends('layout.home')
@section('content')
  <link href="{{asset('resources/views/Home/css/index.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">

  <div class="banner">
    <section class="box">
      <ul class="texts">
        <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
        <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
        <p>加了锁的青春，不会再因谁而推开心门。</p>
      </ul>
      <div class="avatar"><a href="#"><span>简简单单の博客</span></a> </div>
    </section>
  </div>
  <div class="template">
    <div class="box">
      <h3>
        <p><span>站长</span>推荐 Recommend</p>
      </h3>
      <ul>
        @foreach($hot as $k => $v)
        <li><a href="{{url('art/'.$v->art_id)}}"  target="_blank"><img alt="{{$v->art_title}}"  src="{{url($v->art_thumb)}}"></a><span>{{$v->art_title}}</span></li>
        @endforeach
      </ul>
    </div>
  </div>
  <article>
    <h2 class="title_tj">
      <p>文章<span>推荐</span></p>
    </h2>
    <div class="bloglist left">
        @foreach($art as $k=>$v)
      <h3>{{$v->art_title}}</h3>
      <figure><a href="{{url('art/'.$v->art_id)}}" ><img alt="{{$v->art_title}}" src="{{url($v->art_thumb)}}"></a></figure>
      <ul>
        <p>{{$v->art_description}}</p>
        <a title="/" href="{{url('art/'.$v->art_id)}}"  class="readmore">阅读全文>></a>
      </ul>
      <p class="dateview"><span>{{date('Y-m-d',$v->art_time)}}</span><span>作者：{{$v->art_editor}}</span></p>
        @endforeach

        <div class="page_list">
            {!! $art->links() !!}
        </div>
        <style>
            .page_list ul{width:auto;}
            .page_list ul .active{color:indianred;}
            .page_list span{padding: 6px 12px;}
        </style>
    </div>
    <aside class="right">
      <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
      <div class="news">
        <h3>
          <p>最新<span>文章</span></p>
        </h3>
        <ul class="rank">
            @foreach($new as $K=>$v)
          <li><a href="{{'art/'.$v->art_id}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
            @endforeach
        </ul>
        <h3 class="ph">
          <p>点击<span>排行</span></p>
        </h3>
        <ul class="paih">
            @foreach($top as $K=>$v)
                <li><a href="{{'art/'.$v->art_id}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
            @endforeach
        </ul>
        <h3 class="links">
          <p>友情<span>链接</span></p>
        </h3>
        <ul class="website">
            @foreach($links as $K=>$v)
          <li><a href="{{$v->links_url}}" target="_blank">{{$v->links_name}}</a></li>
            @endforeach
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
