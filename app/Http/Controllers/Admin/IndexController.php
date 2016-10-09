<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    //后台首页;
    public function index()
    {
       return view('admin.index');
    }

    //后台欢迎页;
    public function info()
    {
        return view('admin.info');
    }

    //后台修改密码页;
    public function pass()
    {
        if($input=Input::all()){
            //验证规则;
            $rules=[
                'password_o'=>'required',
                'password'=>'required|between:6,20|confirmed',
            ];
            //错误提示信息;
            $message=[
                'password_o.required'=>'原密码不能为空!',
                'password.required'=>'新密码不能为空!',
                'password.between'=>'新密码必须6到20位!',
                'password.confirmed'=>'2次新密码输入不一致!',
            ];
            //表单验证;
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){

                //数据格式符合要求,验证原密码正式性;
                $user=User::first();
                //比对密码;
                if($input['password_o'] == Crypt::decrypt($user->password)){
                    //输入的原密码与数据库里原密码一致;
                    $user->password = Crypt::encrypt($input['password']);
                    //更新数据库;
                    $user->update();
                    //跳转页面;
                    return back()->with('errors','密码修改成功!');
                }else{

                    return back()->with('errors','原密码错误!');
                }



            }else{

//                dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');

        }
    }

}
