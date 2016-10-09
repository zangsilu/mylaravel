<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps=false;
    protected $table='category';
    protected $primaryKey='cate_id';
    protected $guarded=[];//表示:允许所有字段提交,不进行如何排除;

    static public function getTree($data){
        foreach($data as $k=>$v){
            if($v['cate_pid'] == 0){
                $level=0;
                $v['level']=$level;
                $arr[]=$v;
                foreach($data as $k2=>$v2){
                    if($v2['cate_pid'] == $v['cate_id']){
                        $v2['level']=++$level;
                        $arr[]=$v2;
                        $level--;
                    }
                }
            }
        }
        return $arr;
    }
}
