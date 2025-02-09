<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = category::all();
        return view('categories', ['categories_list' => $categories]);
    }

    public function create()
    {
        return view('create-category');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255|regex:/^[^0-9]*$/',
        ]);
        category::create(
            $request->all()
        );
        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes create category');
        return redirect('/categories');
    }
    public function edit($slug)
    {
        $category = category::where('slug', $slug)->first();
        return view('category-edit', ['category' => $category]);
    }
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255|regex:/^[^0-9]*$/',
        ]);
        $category = category::where('slug', $slug)->first();
        $category->slug = null;

        $category->update($request->all());
        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes update category');
        return redirect('/categories');
    }
    public function destroy($slug)
    {


        $category = category::where('slug', $slug)->first();
        $category->delete();
        Session::flash('status', 'Succes');
        Session::flash('message', 'Succes delete category');
        return redirect('/categories');
    }
}
