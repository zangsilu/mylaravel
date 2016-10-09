<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    public function index(){

        $data = Config::orderBy('config_order','desc')->get();

       foreach($data as $k=>$v){
            switch ($v->config_type){
                case 'input':
                    $data[$k]['_html']="<input config_id='{$v->config_id}' class='lg' type='text' name='config_content' value='{$v['config_content']}'>";
                break;
                case 'textarea':
                $data[$k]['_html']="<textarea config_id='{$v->config_id}' class='lg' type='text' name='config_content'>{$v['config_content']}</textarea>";
                break;
                case 'radio':
//                    0|关闭,1|开启
                    $r=explode(',',$v->config_type_value);
                    $str='';
                    foreach($r as $m =>$n){
                        $rr=explode('|',$n);
                        $c=$rr[0]==$v->config_content?'checked':'';
                        $str.= "<label><input config_id='{$v->config_id}' type='radio' {$c} name='config_content' value='{$rr[0]}'>$rr[1]</label>";
                        $data[$k]['_html']=$str;
                    }
                break;
            }
       }


        return view('admin.config.index',compact('data'));

    }

    //GET admin/configgory/{configgory}
    public function show()
    {

    }
    //GET admin/config/create 添加站点配置页面显示
    public function create()
    {
        return view('admin.config.add');
    }

    //POST admin/config 处理添加站点配置数据
    public function store()
    {
        //排除掉_token字段,创建干净的数据(数据name与表字段名完全相同且个数相同)
        if ($input = Input::except('_token')) {
            //验证规则;
            $rules = [
                'config_name' => 'required',
                'config_title' => 'required',
//                'password'=>'required|between:6,20|confirmed',
            ];
            //错误提示信息;
            $message = [
                'config_name.required' => '站点配置名称不能为空!',
                'config_title.required' => '站点配置地址不能为空!',
            ];
            //表单验证;
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {

                //插入数据库(直接使用create()填充数据,注意:数据name与表字段名必须完全相同且个数一致);
                $re = Config::create($input);
                if($re){
                    return redirect('admin/config');
                }else{
                    return back()->withErrors('errors','对不起!数据添加失败!');
                }

            } else {

//                dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }
    }

//GET admin/config/{config}/edit
    public function edit($config_id)
    {
        //取出当前要修改的分类信息;
        $config_info=Config::find($config_id);

        return view('admin.config.edit',compact('config_info'));
    }

    //PUT|PATCH admin/config/{config}
    public function update($config_id)
    {
        //剔除不需要的字段;
        $input=Input::except('_token','_method');
        //更新数据;
        $re=Config::where('config_id',$config_id)->update($input);

        if($re !== false){
            //更新下配置文件里的内容;
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back()->with('errors','系统错误,请稍后再试!');
        }

    }

    //DELETE admin/config_id/{config_id}
    public function destroy($config_id)
    {

            $re = Config::where('config_id',$config_id)->delete();
            if($re){
                //更新下配置文件里的内容;
                $this->putFile();
                return $data=array('status'=>0,'msg'=>'恭喜您,删除成功!');
            }else{
                return $data=array('status'=>1,'msg'=>'对不起,删除失败!');
            }
    }

    //ajax改变分类列表排序;
    public function changeOrder()
    {
        if($input=Input::all()){
            $config=Config::find($input['config_id']);
            $config->config_order=$input['config_order'];
            $re=$config->update();
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
    
    /**
     * ajax 修改配置项内容
     */
    public function changeContent()
    {
        //接收数据;
        $input = Input::except('_token');

       //更新数据;
        $re = Config::where('config_id',$input['config_id'])->update(['config_content'=>$input['config_content']]);

       //返回数据;
        if($re == 1){
            //更新下配置文件里的内容;
            $this->putFile();
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

    /**
     * 将配置项写入/config/web.php(网站配置文件)
     */
    public function putFile()
    {
        //取出指定字段的数据;
        $input = Config::pluck('config_content','config_name')->all();//加"->all()"表示取纯净版数据;
        $config_str ="<?php return ".var_export($input,true).';';
        $config_path = base_path().'/config/web.php';
       //将配置项写入文件中;
        file_put_contents($config_path,$config_str);
    }
}
