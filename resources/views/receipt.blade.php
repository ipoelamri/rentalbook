@extends('layouts.mainlayout')

@section('title', 'Receipt')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="mb-0">Borrowing Receipt</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h4>Borrowing Code: <strong>{{ $rentLog->rent_code }}</strong></h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Book:</strong> {{ $rentLog->book->title }}
                            </li>
                            <li class="list-group-item">
                                <strong>Borrow Date:</strong> {{ $rentLog->rent_date }}
                            </li>
                            <li class="list-group-item">
                                <strong>Return Date:</strong> {{ $rentLog->return_date }}
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                <span class="badge bg-warning text-dark">{{ $rentLog->status }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center text-muted">
                        Terima kasih telah meminjam buku. Selamat membaca!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
