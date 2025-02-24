<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rentLog;
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
        $user = auth()->user();
        // Jika ingin menggunakan halaman khusus untuk user yang sedang login
        return view('profile', ['user' => $user]);
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
            'phone' => 'required|regex:/^[0-9]+$/',
            'addres' => 'required',
        ]);
        $user = User::where('slug', $slug)->first();

        $user->update($request->all());

        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes update category');
        return redirect('/profile')->with('status', 'success')->with('message', 'Status user berhasil diubah');
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
    public function dashboard()
    {
        $rentLog = auth()->user()->rentLogs;
        $user = auth()->user();

        // Hitung jumlah buku yang masih dipinjam dan sudah dikembalikan
        $borrowedBooks = $user->rentLogs()->where('status', 'On Process')->count();
        $borrowedReady = $user->rentLogs()->where('status', 'Ready')->count();
        $returnedBooks = $user->rentLogs()->where('status', 'Completed')->count();

        // Ambil status peminjaman terakhir
        $latestLoan = $user->rentLogs()->latest()->first();
        $loanStatus = $latestLoan ? $latestLoan->status : 'No Loan Records';

        return view('dashboard-client', ['rentLogs' => $rentLog], compact('user', 'borrowedBooks', 'returnedBooks', 'borrowedReady'));
    }
}
