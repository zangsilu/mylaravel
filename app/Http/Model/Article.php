<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps=false;
    protected $table='article';
    protected $primaryKey='art_id';
    protected $guarded=[];//表示:允许所有字段提交,不进行如何排除;
}
