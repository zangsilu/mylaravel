<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{
    /**
     * 首页
     */
    public function index()
    {
        //站长推荐(6篇)
        $hot = Article::orderBy('art_view','desc')->take(6)->get();

        //文章推荐(5篇分页)
        $art = Article::orderBy('art_time','desc')->where('cate_id','<>','22')->paginate(10);

        //最新文章(8篇)
        $new = Article::orderBy('art_time','desc')->take(8)->get();

        //点击排行(5篇)
        $top = Article::orderBy('art_view','desc')->take(5)->get();

        //友情链接(全部)
        $links = Links::all();


        return view('Home.index',compact('hot','art','new','top','links'));
    }

    /**
     * 列表页
     */
    public function artList($cate_id)
    {

        //累积点击排行(访问次数)
        Category::where('cate_id',$cate_id)->increment('cate_view',1);//字段累加1;

        //取出分类信息;
        $cate=Category::find($cate_id);

        //取出当前分类下的所有文章;
        $cate_child = Category::where('cate_pid',$cate_id)->pluck('cate_id')->all();

        if(empty($cate_child))
            $cate_child=[$cate_id];

        $art=Article::orderBy('article.art_time','desc')->whereIn('article.cate_id',$cate_child)->leftjoin('category','article.cate_id','=','category.cate_id')->paginate(10);

        //最新文章;
        $art_new = Article::orderBy('art_time','desc')->take(8)->get();

        //点击排行;
        $art_view = Article::orderBy('art_view','desc')->take(5)->get();

        //取出兄弟分类;
        if($cate->cate_pid == 0)
            $cate_brother=Category::where('cate_pid',$cate->cate_id)->take(4)->get();
        else
            $cate_brother=Category::where('cate_pid',$cate->cate_pid)->take(4)->get();

        //输出关键词和描述(用于seo)
        $title = $cate->cate_name;
        $keys = $cate->cate_keywords;
        $description = $cate->cate_description;

        return view('Home.list',compact('cate','title','keys','description','art','art_new','art_view','cate_brother'));
    }

    /**
     * 文章页
     */
    public function art($art_id)
    {

        //累积点击排行(访问次数)
        Article::where('art_id',$art_id)->increment('art_view',1);//字段累加1;

        //通过文章ID获取文章;
        $data = Article::find($art_id);

        //获取文章分类名称;
        $data['cate_name']=Category::where('cate_id',$data['cate_id'])->value('cate_name');

        //取出分类树(用于面包屑导航)
        $cate = Category::where('cate_id',$data['cate_id'])->first();//返回一维数组,get()返回二维数组;
        if($cate->cate_pid == 0) {
            $cate_data[] = array(
               'cate_name'=> $cate->cate_name,
               'cate_id'=> $cate->cate_id,
            );
        }else {
            $cate_data[] = array(
                'cate_name'=> Category::where('cate_id',$cate->cate_pid)->value('cate_name'),
                'cate_id'=> Category::where('cate_id',$cate->cate_pid)->value('cate_id'),
            );
            $cate_data[] = array(
                'cate_name'=> $cate->cate_name,
                'cate_id'=> $cate->cate_id,
            );
        }

        //栏目最新;
        $art_news=Article::orderBy('art_time','desc')->where('cate_id',$data->cate_id)->take(6)->get();

        //点击排行;
        $art_view=Article::orderBy('art_view','desc')->take(5)->get();

        //上一篇下一篇;
        $art_data['prev'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $art_data['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();

        //输出关键词和描述(用于seo)
        $title = $data->art_title;
        $keys = $data->art_tag;
        $description = $data->art_description;
        return view('Home.art',compact('data','cate_data','art_news','art_view','title','keys','description','art_data'));
    }

    /* 关于我 */
    public function me()
    {
        return view('Home.me');
    }

    /*  留言板 */
    public function gbook()
    {
        return view('Home.gbook');
    }

    /* 碎言碎语 */
    public function talk()
    {
        //取出碎言碎语(cate_id:22)
        $talk=Article::where('cate_id',22)->orderBy('art_time','desc')->paginate(20);

        return view('Home.talk',compact('talk'));
    }
    
    
}
