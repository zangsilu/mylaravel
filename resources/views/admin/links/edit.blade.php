@extends('layout.admin')
        @section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">友链管理</a> &raquo; 修改友链
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增友链</a>
            <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部友链</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/links').'/'.$links_info['links_id']}}" method="post">
        {{method_field('put')}}
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>友链名称：</th>
                <td>
                    <input type="text" value="{{$links_info['links_name']}}" name="links_name">
                </td>
            </tr>
            <tr>
                <th>友链标题：</th>
                <td>
                    <input type="text" class="lg" value="{{$links_info['links_title']}}" name="links_title">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>友链地址：</th>
                <td>
                    <input type="text" class="lg" value="{{$links_info['links_url']}}" name="links_url">
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" name="links_order" value="{{$links_info['links_order']}}" maxlength="5" value="0" style="width:50px;">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection()

