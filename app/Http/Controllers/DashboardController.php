<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bookcount = book::count();
        $categorycount = category::count();
        $usercount = User::count();
        return view('dashboard', ['book_count' => $bookcount, 'category_count' => $categorycount, 'user_count' => $usercount]);
    }
}
