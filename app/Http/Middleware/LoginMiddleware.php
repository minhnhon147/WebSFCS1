<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginMiddleware
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
        if(Auth::check())
        {
            return $next($request);
        }
        else 
            return redirect('dang-nhap')->with('message_please_login', 'Vui lòng đăng nhập hoặc đăng kí mới để tiếp tục :D');;
    }
}
