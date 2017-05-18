<?php

namespace App\Http\Middleware;

use Closure;
//php artisan make:middleware LoginMiddleware 创建中间件命令
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
		 
		if(!session('uid')){
			return redirect('/login');
			
		}
        return $next($request);
    }
}
