<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $uid = Session::get('uid');
        $current_role = Session::get('role');

        $db = app('firebase.firestore')->database();
        $collection = $db->collection('users')->document($uid)->snapshot();

        if (!$uid && !$collection) {
            return redirect('login');
        }

        if (in_array($current_role, $roles)) {
            return $next($request);
        }

        return redirect()->route('unauthorized');
    }
}
