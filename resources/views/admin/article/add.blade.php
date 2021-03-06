@extends('layout.admin')
        @section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="{{url('admin/article')}}">文章管理</a> &raquo; 文章文章
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>文章管理</h3>
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
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/article')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>文章分类：</th>
                <td>
                    <select name="cate_id">
                        @foreach($cates as $k=>$v)
                        <option value="{{$v['cate_id']}}">{{str_repeat('┈┈',$v->level)}}{{$v['cate_name']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>文章标题：</th>
                <td>
                    <input type="text" class="lg" name="art_title">
                </td>
            </tr>
            <tr>
                <th>文章作者：</th>
                <td>
                    <input type="text" size="8" name="art_editor">
                </td>
            </tr>
            <tr>
                <th>缩略图：</th>
                <td>
                    <input type="text" size="30" name="art_thumb">
                    <script src="{{asset('resources/ORG/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="{{asset('resources/ORG/uploadify/uploadify.css')}}">
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText':'图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    '_token'     : '{{csrf_token()}}',
                                },
                                'swf'      : "{{asset('resources/ORG/uploadify/uploadify.swf')}}",
                                {{--'uploader' : "{{asset('resources/ORG/uploadify/uploadify.php')}}"--}}

                                /* 因为uplodify自带的上传处理文件安全性太低,所以使用我自己写的一个上传处理文件 */
                                'uploader' : "{{asset('admin/upload')}}",
                                'onUploadSuccess' : function(file,data,response) {

                                    $('input[name=art_thumb]').val(data);
                                    $('#art_thumb').attr({'src':'/'+data,'width':'100px','height':'70px'});
                                }
                            });
                        });
                    </script>
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                </td>
            </tr>
            <tr>
                <th></th>
                <td id="art_thumb_parent">
                    <img src="" id="art_thumb">
                </td>
            </tr>
            <tr>
                <th>关键词：</th>
                <td>
                    <textarea name="art_tag"></textarea>
                </td>
            </tr>
            <tr>
                <th>文章描述：</th>
                <td>
                    <textarea name="art_description"></textarea>
                </td>
            </tr>

            <tr>
                <th>文章内容：</th>
                <td>
                    <script type="text/javascript" charset="utf-8" src="{{asset('resources/ORG/ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('resources/ORG/ueditor/ueditor.all.min.js')}}"> </script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('resources/ORG/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script id="editor" name="art_content" type="text/plain" style="width:1024px;height:500px;"></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
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

