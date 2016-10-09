<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    public $timestamps=true;
    protected $table='links';
    protected $primaryKey='links_id';
    protected $guarded=[];//表示:允许所有字段提交,不进行如何排除;
}
