<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah ada query pencarian
        $search = $request->input('search');

        // Ambil buku yang sesuai dengan pencarian (jika ada) dan paginate
        $books = Book::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('categories', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        })->paginate(8); // Mengatur pagination per 12 buku per halaman

        return view('index', compact('books'));
    }
}
