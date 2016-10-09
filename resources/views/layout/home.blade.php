<!doctype html>
<html>
<head>
    <meta charset="utf-8">
<meta name="360-site-verification" content="82aabe2ca5ea9bfa245cee1b4027462c" />
<meta name="baidu_union_verify" content="bcd53a1d9eaf97590c26f9c3324b4e13">
<link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon" />
<script type="text/javascript" src="{{asset('resources/views/admin/style/js/jquery.js')}}"></script>
    <title>{{$title or config('web.web_title')}} - {{config('web.seo_title')}}</title>
    <meta name="keywords" content="{{$keys or config('web.web_keys')}}" />
    <meta name="description" content="{{$description or config('web.web_description')}}" />
    <link href="{{asset('resources/views/Home/css/base.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/Home/js/modernizr.js')}}"></script>
    <![endif]-->
    <!-- 百度统计 -->
    {!! config('web.baidu_count') !!}
    <!--百度推送-->
    {!! config('web.web_tuisong_to_baidu') !!}
   <!--360推送-->
    {!! config('web.web_360_tuisong') !!}
    <!-- 音乐播放器 -->
    {!! config('web.web_music') !!}
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k =>$v)
        <a href="{{$v->navs_url}}"><span>{{$v->navs_name}}</span><span class="en">{{$v->navs_alias}}</span></a>
        @endforeach
    </nav>
    </nav>
</header>

@yield('content')

<footer>
    <p style="padding:20px 0px;">
        <span style="float: left;margin-right: 10px;margin-left: 30%;">{!! config('web.web_copyright') !!}</span>
        <span>{!! config('web.youmeng_count') !!}</span>
    </p>
</footer>
<script src="{{asset('resources/views/Home/js/silder.js')}}"></script>
<script type="text/javascript">
    $(function(){
        setTimeout(function(){
            $('.ds-powered-by').html('<span style="color: #ff6600;cursor: pointer;">Powered by 简简单单</span>')
        },500);


        $(document).on('click','.ds-post-button',function(){
            setTimeout(function(){
                $('.ds-dialog-footer').html('<span style="color: #ff6600;">Powered by 简简单单</span>')
            },100)
        })
        $(document).on('click','.ds-powered-by span',function(){
            alert('点我干嘛?o(╯□╰)o')
        })


    })

</script>
</body>
</html>
