@extends('layouts.mainlayout')
@section('title', 'Home')

@section('content')

    <main>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="text-center mb-5">
            <h1 class="text-primary display-4 fw-bold">List of Books</h1>

            <p class="text-dark display-6 fw-bold">Perpustakaan Digital By Muhammad Saiful Amri</p>
        </div>

        <!-- Form Pencarian -->
        <div class="container mb-4">
            <form method="GET" action="{{ url('/') }}">
                <div class="input-group rounded shadow-sm">
                    <input type="text" class="form-control border-end-0" name="search" value="{{ request()->search }}"
                        placeholder="Search for books or categories">
                    <button class="btn btn-outline-secondary border-start-0" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Menampilkan Buku -->
        <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($books as $item)
                    <div class="col">
                        <div class="card h-100 shadow-lg border-0 rounded-3">
                            <!-- Menampilkan gambar dari kolom cover -->
                            <img src="{{ asset('storage/cover/' . $item->cover) }}" class="card-img-top rounded-3 p-4"
                                alt="{{ $item->title }}" style="max-height: 300px; max-width: 300px;  object-fit: cover;">


                            <div class="card-body">
                                <div class="clearfix mb-3">
                                    <div class="d-flex flex-wrap">
                                        @foreach ($item->categories as $category)
                                            @php
                                                $selectColor = [
                                                    'novel' => 'primary',
                                                    'comedy' => 'success',
                                                    'fiction' => 'danger',
                                                    'manga' => 'warning',
                                                    'Education' => 'info',
                                                    'Romance' => 'secondary',
                                                    'Horror' => 'dark',
                                                    'comic' => 'warning',
                                                ];
                                                $selectColor = $selectColor[$category->name] ?? 'primary';
                                            @endphp

                                            <span
                                                class="badge rounded-pill bg-{{ $selectColor }} mx-1 py-1">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    @php
                                        $statusColor = $item->status == 'In Stock' ? 'success' : 'danger';
                                    @endphp

                                    <span class="badge  bg-{{ $statusColor }} position-absolute top-0 end-0 m-2 py-2 px-3">
                                        {{ $item->status }}
                                    </span>
                                </div>

                                <h5 class="card-title">{{ $item->title }}</h5>
                                <div class="text-center my-4">
                                    <a href="/borrow/{{ $item->id }}" class="btn btn-primary">Borrow Now</a></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $books->appends(['search' => request()->search])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>

@endsection
