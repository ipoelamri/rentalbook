<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        //cek apakah login valid
        if (Auth::attempt($credentials)) {
            //cek apakah status active
            if (Auth::user()->status != 'active') {

                Auth::logout();
                $request->session()->invalidate(); // Menghapus semua data sesi
                $request->session()->regenerateToken(); // Mengganti CSRF token untuk keamanan tambahan
                Session::flash('status', 'failed');
                Session::flash('message', 'your account is not active please contact admin');
                return redirect()->route('login');
            }

            $request->session()->regenerate();

            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            if (Auth::user()->role_id == 2) {
                return redirect('/profile');
            }
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Username or password is incorrect');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Menghapus semua data sesi
        $request->session()->regenerateToken(); // Mengganti CSRF token untuk keamanan tambahan

        return redirect('/');
    }

    public function registering(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone' => 'required|max:255',
            'addres' => 'required',
        ]);


        $user = User::create($request->all());
        Session::flash('status', 'Succes');
        Session::flash('message', 'Register succes, pleade waiting admin to approve your account');
        return redirect('/');
    }
}
