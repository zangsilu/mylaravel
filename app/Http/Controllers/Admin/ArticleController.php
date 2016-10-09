<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //文章控制器;

    //GET admin/article
    public function index()
    {

        $data=DB::table('article')->join('category','article.cate_id','=','category.cate_id')->orderBy('article.art_id','desc')->paginate(10);
        return view('admin.article.index',compact('data'));

    }

    //GET admin/article/create 添加文章;
    public function create()
    {
        $categorys=Category::orderBy('cate_order','asc')->get();
        $cates=Category::getTree($categorys);


        return view('admin.article.add',compact('cates'));
    }

    //POST admin/article 处理添加文章
    public function store()
    {
        //排除掉_token字段,创建干净的数据(数据name与表字段名完全相同且个数相同)
        if ($input = Input::except('_token')) {
            //验证规则;
            $rules = [
                'art_title' => 'required',
                'art_content' => 'required',
            ];
            //错误提示信息;
            $message = [
                'art_title.required' => '文章标题不能为空!',
                'art_content.required' => '文章内容不能为空!',
            ];
            //表单验证;
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {

                $input['art_time']=time();

                //插入数据库(直接使用create()填充数据,注意:数据name与表字段名必须完全相同且个数一致);
                $re = Article::create($input);
                if($re){
                    return redirect('admin/article');
                }else{
                    return back()->withErrors('errors','对不起!数据添加失败!');
                }

            } else {

//                dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }
    }

    //GET admin/article/{art_id}/edit
    public function edit($art_id)
    {
        $categorys=Category::orderBy('cate_order','asc')->get();
        $cates = Category::getTree($categorys);
        $data = Article::find($art_id);

        return view('admin.article.edit',compact('data','cates'));

    }

    //PUT|PATCH admin/article/{art_id}
    public function update($art_id)
    {

        $input = Input::except('_token','_method');

        $re = Article::where('art_id',$art_id)->update($input);

        if($re !== false){
            return redirect('admin/article');
        }else{
            return back()->with('errors','系统错误,请稍后再试!');
        }
    }

    //DELETE admin/article/{article}
    public function destroy($art_id)
    {
        //删除图片
        $res = Article::find($art_id);
        if(!empty($res->art_thumb))
           unlink(base_path().'/'.$res->art_thumb);

        $re = Article::where('art_id',$art_id)->delete();
        if($re){
            return $data=array('status'=>0,'msg'=>'恭喜您,删除成功!');
        }else{
            return $data=array('status'=>1,'msg'=>'对不起,删除失败!');
        }
    }

}
