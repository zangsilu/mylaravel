<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{

    //GET admin/category
    public function index()
    {

        $categorys=Category::orderBy('cate_order','asc')->get();
        $data=Category::getTree($categorys);

        return view('admin.category.index')->with('data',$data);

    }




    //GET admin/category/create 添加分类页面显示
    public function create()
    {
        //取出顶级分类;
        $cates=Category::where('cate_pid',0)->get();
        return view('admin.category.add')->with('cates',$cates);
    }
    //POST admin/category 处理添加分类数据
    public function store()
    {
            //排除掉_token字段,创建干净的数据(数据name与表字段名完全相同且个数相同)
        if ($input = Input::except('_token')) {
            //验证规则;
            $rules = [
                'cate_name' => 'required',
//                'password'=>'required|between:6,20|confirmed',
            ];
            //错误提示信息;
            $message = [
                'cate_name.required' => '分类名称不能为空!',
            ];
            //表单验证;
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {

                //插入数据库(直接使用create()填充数据,注意:数据name与表字段名必须完全相同且个数一致);
                $re = Category::create($input);
                if($re){
                    return redirect('admin/category');
                }else{
                    return back()->withErrors('errors','对不起!数据添加失败!');
                }

            } else {

//                dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }
    }
    //GET admin/category/{category}/edit
    public function edit($cate_id)
    {
        //取出所有顶级分类;
        $cates=Category::where('cate_pid',0)->get();
        //取出当前要修改的分类信息;
        $cate_info=Category::find($cate_id);

        return view('admin.category.edit',compact('cates','cate_info'));


    }
    //PUT|PATCH admin/category/{category}
    public function update($cate_id)
    {

        //剔除不需要的字段;
        $input=Input::except('_token','_method');
        //更新数据;
        $re=Category::where('cate_id',$cate_id)->update($input);

        if($re !== false){
            return redirect('admin/category');
        }else{
            return back()->with('errors','系统错误,请稍后再试!');
        }

    }
    //GET admin/category/{category}
    public function show()
    {

    }

    //DELETE admin/category/{category}
    public function destroy($cate_id)
    {

        //判断该分类是否有子分类,如果有子分类,禁止删除;
        $re = Category::where('cate_pid',$cate_id)->get();

        if($re->count() == 0){
            $re = Category::where('cate_id',$cate_id)->delete();
            if($re){
                return $data=array('status'=>0,'msg'=>'恭喜您,删除成功!');
            }else{
                return $data=array('status'=>1,'msg'=>'对不起,删除失败!');
            }
        }else{
            return $data=array('status'=>3,'msg'=>'对不起,该分类下含有子分类,请先删除子分类!');
        }
    }


    //ajax改变分类列表排序;
    public function changeOrder()
    {
       if($input=Input::all()){
           $cate=Category::find($input['cate_id']);
           $cate->cate_order=$input['cate_order'];
           $re=$cate->update();
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
