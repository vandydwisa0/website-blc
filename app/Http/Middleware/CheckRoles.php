<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoles
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $this->getAuthenticatedUser();
        dd($user);

        if (!$user) {
            // Pengguna belum terotentikasi, arahkan ke halaman login atau tampilkan halaman tidak diizinkan
            return redirect()->route('login');
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Peran pengguna tidak diizinkan, arahkan ke halaman tidak diizinkan atau tampilkan pesan kesalahan
        return redirect()->route('unauthorized');
    }

    protected function getAuthenticatedUser()
    {
        $firebaseAuth = app('firebase.auth');
        $firebaseUser = $firebaseAuth->getUser();

        if ($firebaseUser) {
            return (object) $firebaseUser->data();
        }

        return null;
    }
}
