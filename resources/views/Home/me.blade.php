@extends('layout.home')
@section('content')
  <link href="{{asset('resources/views/Home/css/about.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">


  <article class="aboutcon" style="background: url({{url('resources/views/Home/images/aboutphoto.jpg')}}) no-repeat 100% 100%;">
    <h1 class="t_nav"><span>像“草根”一样，紧贴着地面，低调的存在，冬去春来，枯荣无恙。</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('/me')}}" class="n2">关于我</a></h1>
    <div class="about left">
      <h2>Just about me</h2>
      <ul>
        <p>张世路，男，一个90后站长！</p>
        <p>
          走过的路长了，遇见的人多了，经历的事杂了。不经意间发现，人生最曼妙的风景是内心的淡定与从容，头脑的睿智与清醒。人生最奢侈的拥有是一颗不老的童心，一个生生不息的信念，一个健康的身体，一个永远牵手的爱人。一个自由的心态，一份喜欢的工作，一份安稳的睡眠，一份享受生活的美好心情。
        </p>
       <p>
只有启程才会到达理想和目的地，只有播种才会有收获。只有追求，才会品味堂堂正正的做人，只有保留一份单纯，才会多些人生的快乐！
</p>
<p>
让生活变好的金钥匙不在别人手里，放弃我们的怨恨和叹息，美好生活就垂手可得。我们主观上本想好好生活，可是客观上却没有好的生活，其原因是总想等待别人来改善生活，不要指望改变别人，要自己做生活的主人。
</p>
      </ul>
      <h2>About my blog</h2>
      <p>分发站：www.pl39.com 创建于2015年05月25日 </p>
      <p>博客站：blog.pl39.com 创建于2016年05月01日</p>
      <p>服务器：阿里云ECS服务器({{$_SERVER ['SERVER_SOFTWARE']}})</p>
      <p>程  序：PHP{{PHP_VERSION}}　Laravel5.2</p>


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
