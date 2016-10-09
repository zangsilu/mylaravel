<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    public function index(){

        $data = Links::orderBy('links_order','desc')->get();

        return view('admin.links.index',compact('data'));

    }

    //GET admin/linksgory/{linksgory}
    public function show()
    {

    }
    //GET admin/links/create 添加友链页面显示
    public function create()
    {
        return view('admin.links.add');
    }

    //POST admin/links 处理添加友链数据
    public function store()
    {
        //排除掉_token字段,创建干净的数据(数据name与表字段名完全相同且个数相同)
        if ($input = Input::except('_token')) {
            //验证规则;
            $rules = [
                'links_name' => 'required',
                'links_url' => 'required',
//                'password'=>'required|between:6,20|confirmed',
            ];
            //错误提示信息;
            $message = [
                'links_name.required' => '友链名称不能为空!',
                'links_url.required' => '友链地址不能为空!',
            ];
            //表单验证;
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {

                //插入数据库(直接使用create()填充数据,注意:数据name与表字段名必须完全相同且个数一致);
                $re = Links::create($input);
                if($re){
                    return redirect('admin/links');
                }else{
                    return back()->withErrors('errors','对不起!数据添加失败!');
                }

            } else {

//                dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }
    }

//GET admin/links/{links}/edit
    public function edit($links_id)
    {
        //取出当前要修改的分类信息;
        $links_info=Links::find($links_id);

        return view('admin.links.edit',compact('links_info','links_info'));
    }

    //PUT|PATCH admin/links/{links}
    public function update($links_id)
    {
        //剔除不需要的字段;
        $input=Input::except('_token','_method');
        //更新数据;
        $re=Links::where('links_id',$links_id)->update($input);

        if($re !== false){
            return redirect('admin/links');
        }else{
            return back()->with('errors','系统错误,请稍后再试!');
        }

    }

    //DELETE admin/links_id/{links_id}
    public function destroy($links_id)
    {

            $re = Links::where('links_id',$links_id)->delete();
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
            $links=Links::find($input['links_id']);
            $links->links_order=$input['links_order'];
            $re=$links->update();
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
