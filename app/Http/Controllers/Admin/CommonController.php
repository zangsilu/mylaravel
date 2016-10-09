<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传处理;
    public function upload(){

        //获取上传的文件信息;
        $files=Input::file('Filedata');

        //判断文件是否真实存在;
        if($files->isValid()){

            //获取上传文件的后缀名称;
            $ext = $files ->getClientOriginalExtension();

            //重命名文件;
            $new_name=date('YmdHis').mt_rand(100,999).'.'.$ext;

            //移动文件到指定文件夹内;
            $files -> move(base_path().'/uploads/',$new_name);

            //返回文件名称到前台便于显示;
            return 'uploads/'.$new_name;

        }
    }
}
