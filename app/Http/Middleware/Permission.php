<?php

namespace App\Http\Middleware;

use App\PermissionModel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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

		if(in_array($module,['login','logout','home']))
			return $next($request);

		if(Auth::check()){
			$user = Auth::user();
			Log::info(Route::currentRouteName());
			if(PermissionModel::hasPermission($user->type,Route::currentRouteName())){
				return $next($request);
			}else {
				return PermissionModel::redirect($user->type);
			}
		}else
			return $next($request);
	}
}
