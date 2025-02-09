@extends('layouts.mainlayout')

@section('title', 'Categories')

@section('content')


    <div class="container mb-5">
        <div class = "text-center mb-5">
            <h1 class =  "text-primary display-4 fw-bold">list category</h1>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-end py-3">

                <a href="create-category" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i>Add New Category
                </a>
            </div>


            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class = "table-responsive">
                    <table class ="table table-striped table-bordered align-middle" id="categoriesTable">
                        <thead class ="bg-primary text-white">
                            <tr>
                                <th class ="text-center">No.</th>
                                <th class ="text-center">Name</th>
                                <th class ="text-center">Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($categories_list as $item)
                                <tr>
                                    <td class = "text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    {{-- <td class = "d-flex gap-2">


                                        <a href="/category-edit/{{ $item->slug }}" class="btn btn-primary">Edit</a>
                                        <form action="/category-delete/{{ $item->slug }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('confirm delete?')"
                                                class="btn btn-danger">Delete</button>
                                        </form>

                                    </td> --}}
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="/category-edit/{{ $item->slug }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="/category-delete/{{ $item->slug }}"
                                                class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $item->id }}">
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
                                                <form action="/category-delete/{{ $item->slug }}" method="POST">
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#categoriesTable').DataTable({
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
                        search: "Search Categories:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ categories",
                        infoEmpty: "No categories available",
                        emptyTable: "No data available",
                    }
                });
            });
        </script>

    @endsection
