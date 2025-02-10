@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <h2>Borrowing Receipt</h2>
        <div class="card">
            <div class="card-body">
                <h4>Borrowing Code: <strong>{{ $rentLog->rent_code }}</strong></h4>
                <p><strong>Book:</strong> {{ $rentLog->book->title }}</p>
                <p><strong>Borrow Date:</strong> {{ $rentLog->rent_date }}</p>
                <p><strong>Return Date:</strong> {{ $rentLog->return_date }}</p>
                <p><strong>Status:</strong> <span class="badge bg-warning">{{ $rentLog->status }}</span></p>
            </div>
        </div>
    </div>
@endsection
