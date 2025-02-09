@extends('layouts.mainlayout')

@section('title', 'Edit Category')

@section('content')

    <h1>Edit Category</h1>

    <div class="mt-5 w-100 d-flex flex-column align-items-center">

        <form action="/category-edit/{{ $category->slug }}" method="POST" class="w-50">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name"
                    value = "{{ $category->name }}" placeholder="category name" required>

            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
@endsection
