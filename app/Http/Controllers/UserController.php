<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where([['role_id', 2], ['status', 'active']])->get();
        return view('users', ['users_list' => $users]);
    }

    public function profile()
    {
        return view('profile');
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('users');
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-edit', ['user' => $user]);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'username' => 'required',
            'phone' => 'unique:users',
            'status' => 'required',
        ]);
        $user = User::where('slug', $slug)->first();

        $user->update($request->all());

        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes update category');
        return redirect('/users');
    }

    public function detail(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-detail', ['user' => $user]);
    }

    public function updateStatus(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->first(); // Temukan user berdasarkan ID

        // Validasi input (jika hanya "active" dan "inactive" yang diizinkan)
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        // Update status
        $user->status = $request->input('status');
        $user->save();

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect('/user-detail/' . $slug)->with('status', 'success')->with('message', 'Status user berhasil diubah');
    }

    public function inactive()
    {
        $users = User::where([
            ['role_id', 2],
            ['status', 'inactive']
        ])->get();

        return view('user-inactive', ['users_list' => $users]);
    }
}
