<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    public $timestamps=true;
    protected $table='navs';
    protected $primaryKey='navs_id';
    protected $guarded=[];//表示:允许所有字段提交,不进行如何排除;
}
