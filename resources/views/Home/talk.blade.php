@extends('layout.home')
@section('content')
  <link href="{{asset('resources/views/Home/css/mood.css')}}" rel="stylesheet">
  <link href="{{asset('resources/views/Home/css/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">


  <div class="moodlist">
    <h1 class="t_nav"><span>删删写写，回回忆忆，虽无法行云流水，却也可碎言碎语。</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/talk')}}" class="n2">碎言碎语</a></h1>
    <div class="bloglist">
      @foreach($talk as $k=>$v)
      <ul class="arrow_box">
        <div class="sy">
            {!! $v->art_content !!}

        </div>
        <span class="dateview">{{date('Y-m-d H:i:s',$v->art_time)}}</span>
      </ul>
        @endforeach
    </div>
    <div class="page" style="margin: 20px auto 20px auto;width: 300px;">
      {{$talk->links()}}
      </div>
  </div>
  <div id="tbox"> <a id="togbook" href="/e/tool/gbook/?bid=1"></a> <a id="gotop" href="javascript:void(0)"></a> </div>


@endsection