<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //后台登入权限控制中间件;
        if(empty(session('user'))){
            return redirect('admin/login');
        }

        return $next($request);
    }
}
