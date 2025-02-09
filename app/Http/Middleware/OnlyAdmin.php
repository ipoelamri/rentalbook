<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah terautentikasi


        // Memeriksa apakah pengguna adalah admin
        if (Auth::user()->role_id != 1) {
            // Jika bukan admin, arahkan ke halaman yang sesuai
            return redirect('books'); // Misalnya, bisa ke profile atau halaman lain
        }

        return $next($request); // Melanjutkan permintaan jika pengguna adalah admin
    }
}
