<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function book()
    {
        $Books = book::all();

        return view('books', ['books_list' => $Books]);
    }

    public function create()
    {
        $categories = category::all();
        return view('create-book', ['categories' => $categories]);
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|unique:books|max:255',
            'book_code' => 'required|unique:books|max:255',
        ]);
        $newName = null;
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $book = book::create(
            $request->all()
        );
        $book->categories()->sync($request->categories);
        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes create book');
        return redirect('/books');
    }

    public function edit($slug)
    {

        $book = book::where('slug', $slug)->first();
        $categories = category::all();
        return view('book-edit', ['book' => $book, 'categories' => $categories]);
    }

    public function destroy($slug)
    {
        // Mencari buku berdasarkan slug
        $book = Book::where('slug', $slug)->first();

        // Menghapus kategori yang terkait dengan buku
        $book->categories()->detach();

        // Menghapus buku
        $book->delete();
        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes delete book');
        return redirect('/books');
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:books,title,' . $slug . ',slug',

        ]);

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }


        $book = book::where('slug', $slug)->first();
        if ($book->cover) {
            Storage::delete('cover/' . $book->cover);
        }
        $book->update(
            $request->all()
        );

        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }
        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes update book');
        return redirect('/books');
    }
}
