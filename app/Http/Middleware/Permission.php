<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Permission
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
		$uri= $request->getRequestUri();
		$uri_arr = explode('/',$uri);
		$module  = $uri_arr[1];

		if(Auth::check()){
			$user = Auth::user();
			if(in_array($module,['login','logout']))
				return $next($request);
			if($user->type == 1 && $module !== 'admin')
				return redirect()->route('admin.index');
			if($user->type == 0 && $module == 'admin'){
				return redirect()->route('home');
			}
		}

		return $next($request);
	}
}
