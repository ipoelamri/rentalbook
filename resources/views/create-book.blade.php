@extends('layouts.mainlayout')

@section('title', 'Create Book')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <h1>create books</h1>

    <div class="mt-5 w-100 d-flex flex-column align-items-center">

        <form action="create-book" method="POST" class="w-50" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            @csrf
            <div class="mb-3">
                <div class = "mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title"
                        name="title" placeholder="book title" required>
                </div>
                <div class = "mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control  @error('code') is-invalid @enderror" id="code"
                        name="book_code" placeholder="book code" required>
                </div>
                <div class = "mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control  @error('image') is-invalid @enderror" id="image"
                        name="image" placeholder="book image">
                </div>
                <div class = "mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select select-multiple" name="categories[]" id="category" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection
