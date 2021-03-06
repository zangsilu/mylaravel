<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        //取出所有导航,并共享给所有模板文件
         View::share('navs',Navs::orderBy('navs_order','asc')->get());

    }
}
