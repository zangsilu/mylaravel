@extends('layout.admin')
        @section('content')
        <!--面包屑站点配置 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">站点配置管理</a> &raquo; 添加站点配置
</div>
<!--面包屑站点配置 结束-->

<!--结果集标题与站点配置组件 开始-->
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
            <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>修改站点配置</a>
            <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部站点配置</a>
        </div>
    </div>
</div>
<!--结果集标题与站点配置组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/config/'.$config_info->config_id)}}" method="post">
        {{csrf_field()}}
        {{method_field('put')}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>标题：</th>
                <td>
                    <input type="text" value="{{$config_info['config_title']}}" name="config_title">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" value="{{$config_info['config_name']}}" class="lg" name="config_name">
                </td>
            </tr>
            <tr>
                <th>类型：</th>
                <td>
                    <label onclick="aa(this)"><input type="radio" class="lg" value="radio" @if($config_info['config_type']=='radio')checked @endif name="config_type">radio</label>
                    <label onclick="aa(this)"><input type="radio" class="lg" value="textarea" @if($config_info['config_type']=='textarea')checked @endif name="config_type">textarea</label>
                    <label onclick="aa(this)"><input  type="radio" class="lg" value="input" @if($config_info['config_type']=='input')checked @endif name="config_type">input</label>
                </td>
            </tr>
            <tr class="config_type_value">
                <th>类型值：</th>
                <td>
                    <p><input type="text" class="lg" value="{{$config_info['config_type_value']}}" name="config_type_value"></p>
                    <span>只有在"radio"类型时才需要填写 如:1|开启,0|关闭</span>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" name="config_order" maxlength="5" value="0" style="width:50px;">
                </td>
            </tr>
            <tr>
                <th>备注：</th>
                <td>
                    <textarea name="config_intro">{{$config_info['config_intro']}}</textarea>
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


<script type="text/javascript">
    if('{{$config_info['config_type']}}' == 'radio'){
        $('.config_type_value').show();
    }else{
        $('.config_type_value').hide();
    }

    function aa(obj){
        if($(obj).find('input').val()=='radio'){
            $('.config_type_value').show();
        }else{
            $('.config_type_value').hide();
        }
    }
</script>
@endsection()

