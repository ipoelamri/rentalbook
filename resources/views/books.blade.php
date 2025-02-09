{{-- @extends('layouts.mainlayout')

@section('title', 'Books')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <h1>List Book</h1>

    <div class="d-flex justify-content-end pb-2">
        <a href="create-book" class="btn btn-primary">Add Book</a>
    </div>



    @if (session('status'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class = "my-5 table-responsive">
        <table class ="table table-hover align-middle">
            <thead class ="bg-primary text-white ">
                <tr>
                    <th>No.</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Category</th>
                    {{-- <th>Cover</th> --}}
{{-- <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($books_list as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->book_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @foreach ($item->categories as $category)
                                <span class = "badge bg-warning ">{{ $category->name }}</span> <br>
                            @endforeach
                        </td>
                        <td>
                            <span
                                class = "badge bg-{{ $item->status == 'stock' ? 'success' : 'danger' }}">{{ $item->status }}</span>
                        </td>
                        <td class = "d-flex gap-2">
                            <a href="/book-edit/{{ $item->slug }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $item->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection --}}
@extends('layouts.mainlayout')

@section('title', 'Books')

@section('content')



    <div class="container mb-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="text-primary display-4 fw-bold">List of Books</h1>

        </div>

        <!-- Card Container -->
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-end py-3">

                <a href="create-book" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i>Add New Book
                </a>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- DataTable -->
                <div class="table-responsive">
                    <table id="booksTable" class="table table-striped table-bordered align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class = "text-center">Code</th>
                                <th class = "text-center">Title</th>
                                <th class = "text-center">Category</th>
                                <th class = "text-center">Status</th>
                                <th class = "text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books_list as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->book_code }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
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
                                            <span class="badge bg-{{ $selectColor }}">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class = "text-center">
                                        <span class=" badge bg-{{ $item->status == 'Stock' ? 'success' : 'danger' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="/book-edit/{{ $item->slug }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="/book-delete/{{ $item->slug }}" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Delete
                                                    Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the book
                                                <strong>{{ $item->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="/book-delete/{{ $item->slug }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No books found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable({
                paging: true,
                searching: true,
                responsive: true,
                columnDefs: [{
                        width: '50px',
                        targets: 0
                    } // Atur lebar kolom pertama (No.)
                ],
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Search Books:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ books",
                    infoEmpty: "No books available",
                    emptyTable: "No data available",
                }
            });
        });
    </script>
@endsection
