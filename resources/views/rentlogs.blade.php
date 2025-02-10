@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <h2>Rent Logs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Borrow Code</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentLogs as $log)
                    <tr>
                        <td>{{ $log->rent_code }}</td>
                        <td>{{ $log->user->username }}</td>
                        <td>{{ $log->book->title }}</td>
                        <td>{{ $log->return_date }}</td>
                        <td><span class="badge bg-warning">{{ $log->status }}</span></td>
                        <td>
                            <form action="{{ route('admin.rentlogs.confirm', $log->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirm Ready</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
