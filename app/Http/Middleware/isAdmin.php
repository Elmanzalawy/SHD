<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use User;

class isAdmin
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
        //first check if user is authenticated (not guest)
        if(!Auth::check()){
            return redirect('/login');
        }
        $user = Auth::user();
        if($user->privilege==="admin"){
            return $next($request);
        }
        else{
            return redirect('index')->with('error','Unauthorized user.');
        }
    }
}
