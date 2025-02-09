@extends('layouts.mainlayout')
@section('title', 'Dashboard')

@section('content')

    <h1 class = "text-center">Welcome,<span class="text-primary font-bold">{{ Auth::user()->username }}</span>!</h1>
    <div class="row mt-5">
        <a href = "books" class="col-lg-4" style="text-decoration: none;">
            <div class="card-data books">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journal"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">BOOKS</div>
                        <div class="card-qty">{{ $book_count }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="categories" class="col-lg-4">
            <div class="card-data categories" style="text-decoration: none;">
                <div class="row">
                    <div class="col-6"><i class="bi bi-tags-fill"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">CATEGORIES</div>
                        <div class="card-qty">{{ $category_count }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="users" class="col-lg-4">
            <div class="card-data users" style="text-decoration: none;">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people-fill"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">USERS</div>
                        <div class="card-qty">{{ $user_count }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="mt-5">
        <h3 class ="text-secondary">Rental Log</h3>
        <table class="table">
            <thead class ="table-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Book</th>
                    <th scope="col">User</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Tanggal diterima</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" style="text-align: center">Belum ada data</td>
                </tr>
    </div>

@endsection
