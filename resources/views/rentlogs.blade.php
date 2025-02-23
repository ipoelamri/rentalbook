@extends('layouts.mainlayout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h3 class="mb-0"><i class="fas fa-book"></i> Rent Logs</h3>
                    </div>
                    <div class="card-body">
                        <!-- Input Pencarian -->
                        <div class="mb-3">
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Search by Borrow Code...">
                        </div>

                        <!-- Tabel Rent Logs -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>Borrow Code</th>
                                        <th>User</th>
                                        <th>Book</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="rentLogsTable">
                                    @foreach ($rentLogs as $log)
                                        <tr class="text-center align-middle">
                                            <td class="borrow-code"><strong>{{ $log->rent_code }}</strong></td>
                                            <td>{{ $log->user->username }}</td>
                                            <td>{{ $log->book->title }}</td>
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
                                            <td>
                                                @if ($log->status == 'On Process')
                                                    <form action="{{ route('admin.rentlogs.confirm', $log->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check-circle"></i> Confirm
                                                        </button>
                                                    </form>
                                                @elseif ($log->status == 'Completed')
                                                    <button class="btn btn-sm btn-secondary" disabled>
                                                        <i class="fas fa-ban"></i> No Action
                                                    </button>
                                                @else
                                                    <form action="{{ route('admin.rentlogs.returned', $log->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        {{-- Jika perlu method PUT/PATCH, bisa tambahkan: --}}
                                                        {{-- @method('PUT') --}}
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-undo"></i> Returned
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center text-muted py-2">
                        <small>Pastikan semua peminjaman sudah terkonfirmasi dan dikembalikan dengan benar.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JavaScript untuk Pencarian -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll("#rentLogsTable tr");

            rows.forEach(row => {
                let borrowCode = row.querySelector('.borrow-code').textContent.toLowerCase();
                row.style.display = borrowCode.includes(searchValue) ? "" : "none";
            });
        });
    </script>
@endsection
