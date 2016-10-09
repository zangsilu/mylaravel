@extends('layout.admin')
        @section('content')
        <!--面包屑站点配置 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/configgory')}}">站点配置管理</a> &raquo; 站点配置列表
</div>
<!--面包屑站点配置 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷站点配置 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增站点配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部站点配置</a>
            </div>
        </div>
        <!--快捷站点配置 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%"><input type="checkbox" name=""></th>
                    <th class="tc">排序</th>
                    <th class="tc">ID</th>
                    <th>站点配置标题</th>
                    <th>站点配置名称</th>
                    <th>配置属性值</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $k=>$v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,'{{$v->config_id}}')" name="ord[]" value="{{$v->config_order}}">
                        </td>
                        <td class="tc">{{$v->config_id}}</td>
                        <td>{{$v->config_title}}</td>
                        <td>{{$v->config_name}}</td>
                        <td id="content">{!! $v->_html !!}</td>
                        <td>{{$v->created_at}}</td>
                        <td>
                            <a href="{{url('admin/config/'.$v->config_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="config_delete({{$v->config_id}})">删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>


            {{--<div class="page_nav">
                <div>
                    <a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a>
                    <a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
                    <span class="current">8</span>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>
                    <a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a>
                    <a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a>
                    <span class="rows">{{count($data)}} 条记录</span>
                </div>
            </div>--}}



            {{--<div class="page_list">
                <ul>
                    <li class="disabled"><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>--}}


        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->



<script type="text/javascript">

    /**
     * 修改配置项排序
    */
    function changeOrder(obj,config_id){
        $.ajax({
            'type':'get',
            'url':'{{url('admin/config/changeOrder')}}',
            'data':{
                '_token':'{{csrf_token()}}',
                'config_id':config_id,
                'config_order':obj.value,
            },
            'dataType':'json',
            success:function(data){
                if(data.status == 0){
                    layer.msg(data.msg, {icon: 6});
                    location.href=location.href;
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            }

        })
    }

    /**
     * 删除配置项
     * @param config_id
     */
    function config_delete(config_id){
        layer.msg('确定删除吗？', {
            btn: ['删除', '取消']
            ,yes: function(){
                $.ajax({
                    'type':'post',
                    'url':'{{url("admin/config/")}}/'+config_id,
                    'data':{
                        '_method':'delete',
                        '_token':'{{csrf_token()}}',
                    },
                    'dataType':'json',
                    success:function(data){
                        if(data.status == 0){
                            layer.msg(data.msg, {icon: 6});
                            location.href = location.href;
                        }else{
                            layer.msg(data.msg, {icon: 5});
                        }
                    }
                })
            }
        });
    }

    /**
     * 修改配置项内容
     */
    $(function(){
        $('#content input,textarea').change(function(){
            var config_id = $(this).attr('config_id');
            var config_content = $(this).val();
            $.ajax({
                'type':'get',
                'url':'{{url('admin/config/changeContent')}}',
                'data':{
                    '_token':'{{csrf_token()}}',
                    'config_id':config_id,
                    'config_content':config_content
                },
                'dataType':'json',
                success:function(data){
                    if(data.status == 0){
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                }
            })
        })
    })

</script>

@endsection