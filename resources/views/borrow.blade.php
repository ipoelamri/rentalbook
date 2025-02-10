@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Borrow Book</h2>

        <div class="card">
            <div class="card-body">
                <h4>{{ $book->title }}</h4>
                <p><strong>Author:</strong> {{ $book->author }}</p>

                <form action="{{ route('borrow.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <label for="return_date">Select Return Date (Max 7 Days):</label>
                    <input type="date" id="return_date" name="return_date" class="form-control" required
                        max="{{ now()->addDays(7)->format('Y-m-d') }}">

                    <button type="submit" class="btn btn-primary mt-3">Confirm Borrow</button>
                </form>
            </div>
        </div>
    </div>
@endsection
