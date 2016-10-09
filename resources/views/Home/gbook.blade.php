@extends('layout.home')
@section('content')
  <link href="{{asset('resources/views/Home/css/about.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">


  <article class="aboutcon">
    <h1 class="t_nav"><span>青春如同一首歌，它的内涵就是让你用如火的精力唱出它的生命。</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/gbook')}}" class="n2">留言板</a></h1>
    <div class="about left">
      <h2>Gbook</h2>
     {{-- <ul>
        <p>张世路，男，一个90后站长！</p>
        <p>
          走过的路长了，遇见的人多了，经历的事杂了。不经意间发现，人生最曼妙的风景是内心的淡定与从容，头脑的睿智与清醒。人生最奢侈的拥有是一颗不老的童心，一个生生不息的信念，一个健康的身体，一个永远牵手的爱人。一个自由的心态，一份喜欢的工作，一份安稳的睡眠，一份享受生活的美好心情。
        </p>
      </ul>--}}
      {{--评论功能--}}
      <div style="margin: 20px 20px 0px 0px;">
        <div class="ds-thread" data-thread-key="5201314" data-title="简简单单の博客 - 留言板" data-url="{{url('/gbook')}}"></div>
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
      <div class="about_c">
        <p>网名：<span>DanceSmile</span> | <span>简简单单</span></p>
        <p>姓名：张世路 </p>
        <p>Q Q：532817108 </p>
        <p>籍贯：江西省—上饶市</p>
        <p>现居：上海市</p>
        <p>职业：PHP工程师、前端工程师</p>
        <p>副业：<a href="https://shop65186345.taobao.com" target="_blank" class="blog_link">我的漂亮衣裳服饰店</a></p>
        <p>喜欢的书：《红与黑》《红楼梦》</p>
        <p>喜欢的音乐：《burning》《just one last dance》《相思引》</p>
        {{--<p><a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=HHh9cn95b3F1cHVye1xtbTJ-c3E" ><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_22.png" alt="杨青个人博客网站"></a></p>--}}

      </div>
    </aside>
  </article>


@endsection