@extends('layouts.mainlayout')
@section('title', 'Dashboard')

@section('content')

    <h1 class="text-center">Welcome, <span class="text-primary font-bold">{{ Auth::user()->username }}</span>!</h1>

    <div class="row mt-5">
        <a href="books" class="col-lg-4" style="text-decoration: none;">
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
        <a href="categories" class="col-lg-4" style="text-decoration: none;">
            <div class="card-data categories">
                <div class="row">
                    <div class="col-6"><i class="bi bi-tags-fill"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="card-desc">CATEGORIES</div>
                        <div class="card-qty">{{ $category_count }}</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="users" class="col-lg-4" style="text-decoration: none;">
            <div class="card-data users">
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
        <h3 class="text-secondary">Rental Log</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">No.</th>
                        <th scope="col">Borrow Code</th>
                        <th scope="col">Book</th>
                        <th scope="col">User</th>
                        <th scope="col">Rent Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentLogs as $index => $log)
                        <tr class="text-center align-middle">
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $log->rent_code }}</strong></td>
                            <td>{{ $log->book->title }}</td>
                            <td>{{ $log->user->username }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->rent_date)->format('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->return_date)->format('d F Y') }}</td>
                            <td>
                                <span
                                    class="badge 
                                    @if ($log->status == 'On Process') bg-warning text-dark 
                                    @elseif ($log->status == 'Completed') bg-success 
                                    @elseif ($log->status == 'Ready') bg-danger 
                                    @elseif ($log->status == 'Done') bg-info text-dark
                                    @else bg-secondary @endif">
                                    {{ $log->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
