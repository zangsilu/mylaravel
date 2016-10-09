<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

//引入验证码类;
require_once 'resources/ORG/code/Code.class.php';

class LoginController extends CommonController
{

    //登入页;
    public function login()
    {
        //如果是表单提交过来;
        if($data=Input::all()){
            //验证验证码;
            $code = new \Code();
            if(strtoupper($data['code']) != $code->get()){
                return back()->with('msg','验证码错误!');

            }

            //验证用户名密码;
            $users = User::first();//获取表中用户信息;
            if($data['username'] != $users['username'] || $data['password'] != Crypt::decrypt($users['password'])){
                return back()->with('msg','用户名或密码错误!');
            }

            //登入成功,将用户信息存入session;
            session(['user'=>$users]);
            return redirect('admin/index');
        }
        return view('admin.login');
    }

    //生成验证码图片;
    public function code()
    {
        $code = new \Code();
        echo $code->make();
    }

    //获取验证码字符;
    public function getCode()
    {
        $code = new \Code();
        echo $code->get();
    }
    
    //获取crypt加密字符串;
    public function getEncrypt()
    {
        $str=123456;
        echo Crypt::encrypt($str);//加密;

        $str='eyJpdiI6Ik9ETGNtTFRwSFRicXJVeXBuWVRSWmc9PSIsInZhbHVlIjoibWdJcTdSUldVQmhyeXZyd0dib0ZkQT09IiwibWFjIjoiNDQ2MzNjY2EzMzI4ODhmYTE0ZjM2MDY2YTQyYTU2NmE0MDQ4NDYzY2YwNzJlMGU4MjY3ZTQzZTQxYzQ5YzMxNSJ9==';
        Crypt::decrypt($str);//解密;

    }

    //退出登入;
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
