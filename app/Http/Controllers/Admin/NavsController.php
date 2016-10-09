<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    public function index(){

        $data = Navs::orderBy('navs_order','asc')->get();

        return view('admin.navs.index',compact('data'));

    }

    //GET admin/navsgory/{navsgory}
    public function show()
    {

    }
    //GET admin/navs/create 添加导航页面显示
    public function create()
    {
        return view('admin.navs.add');
    }

    //POST admin/navs 处理添加导航数据
    public function store()
    {
        //排除掉_token字段,创建干净的数据(数据name与表字段名完全相同且个数相同)
        if ($input = Input::except('_token')) {
            //验证规则;
            $rules = [
                'navs_name' => 'required',
                'navs_url' => 'required',
//                'password'=>'required|between:6,20|confirmed',
            ];
            //错误提示信息;
            $message = [
                'navs_name.required' => '导航名称不能为空!',
                'navs_url.required' => '导航地址不能为空!',
            ];
            //表单验证;
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {

                //插入数据库(直接使用create()填充数据,注意:数据name与表字段名必须完全相同且个数一致);
                $re = Navs::create($input);
                if($re){
                    return redirect('admin/navs');
                }else{
                    return back()->withErrors('errors','对不起!数据添加失败!');
                }

            } else {

//                dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }
    }

//GET admin/navs/{navs}/edit
    public function edit($navs_id)
    {
        //取出当前要修改的分类信息;
        $navs_info=Navs::find($navs_id);

        return view('admin.navs.edit',compact('navs_info','navs_info'));
    }

    //PUT|PATCH admin/navs/{navs}
    public function update($navs_id)
    {
        //剔除不需要的字段;
        $input=Input::except('_token','_method');
        //更新数据;
        $re=Navs::where('navs_id',$navs_id)->update($input);

        if($re !== false){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','系统错误,请稍后再试!');
        }

    }

    //DELETE admin/navs_id/{navs_id}
    public function destroy($navs_id)
    {

            $re = Navs::where('navs_id',$navs_id)->delete();
            if($re){
                return $data=array('status'=>0,'msg'=>'恭喜您,删除成功!');
            }else{
                return $data=array('status'=>1,'msg'=>'对不起,删除失败!');
            }
    }

    //ajax改变分类列表排序;
    public function changeOrder()
    {
        if($input=Input::all()){
            $navs=Navs::find($input['navs_id']);
            $navs->navs_order=$input['navs_order'];
            $re=$navs->update();
            if($re == 1){
                $data=[
                    'status'=>0,
                    'msg'=>'修改成功!',
                ];
            }else{
                $data=[
                    'status'=>1,
                    'msg'=>'修改失败!',
                ];
            }
            return $data;
        }
    }
}
