@extends('layouts.mainlayout')
@section('title', 'Borrow')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Borrow Book</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            {{-- Menampilkan image cover buku jika ada --}}
                            <img src="{{ asset('storage/cover/' . $book->cover) }}" class="card-img-top rounded-3 p-4"
                                alt="{{ $book->title }}" style="max-height: 300px; max-width: 300px;  object-fit: cover;">
                            <h4 class="font-weight-bold">{{ $book->title }}</h4>
                            <p class="text-muted"><strong>Author:</strong> {{ $book->author }}</p>
                        </div>

                        <form action="{{ route('borrow.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">

                            <div class="mb-3">
                                <label for="return_date" class="form-label">Select Return Date (Max 7 Days):</label>
                                <input type="date" id="return_date" name="return_date" class="form-control" required
                                    max="{{ now()->addDays(7)->format('Y-m-d') }}">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-book"></i> Confirm Borrow
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        Please return the book on time to avoid penalties.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
