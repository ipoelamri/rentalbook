@extends('layouts.mainlayout')

@section('title', 'User Detail')

@section('content')
    <section class="vh-100 ">
        <div class="container py-5 h-100">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="text-center mb-5">
                <h1 class="text-primary display-4 fw-bold">Detail Profile</h1>

            </div>

            <div class="row d-flex justify-content-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3 shadow-lg" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                    alt="Avatar" class="img-fluid my-5" style="width: 80px;" />

                                <h5 class = "text-primary">{{ $user->username }}</h5>
                                <p class = "text-muted">User</p>
                                <i class="far fa-edit"></i>
                                <form method="POST" action="/user-updatestatus/{{ $user->slug }}">
                                    @csrf
                                    @method('PUT') {{-- Metode PUT --}}
                                    <input type="hidden" name="status"
                                        value="{{ $user->status == 'active' ? 'inactive' : 'active' }}">
                                    <button type="submit"
                                        class="btn btn-sm mb-4 btn-outline-{{ $user->status == 'active' ? 'danger' : 'success' }} ">
                                        <i class="bi bi-pencil"></i>
                                        {{ $user->status == 'active' ? 'Set Inactive' : 'Set Active' }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Adress</h6>
                                            <p class="text-muted">{{ $user->addres }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted">{{ $user->phone }}</p>
                                        </div>
                                    </div>
                                    <h6>Status</h6>
                                    <hr class="mt-0 ">
                                    <div class="row pt-1 d-flex justify-content-center align-items-center">
                                        <div class="col-8 mb-3 ">
                                            <p
                                                class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }} w-100 text-center py-2">
                                                {{ ucfirst($user->status) }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
