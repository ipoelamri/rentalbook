@extends('layouts.mainlayout')

@section('title', 'Edit User')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Edit Profile</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="/user-edit/{{ $user->slug }}" method="POST">
                            @csrf
                            @method('put')

                            {{-- Username --}}
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ $user->username }}"
                                    placeholder="Enter username" required>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ $user->phone }}"
                                    placeholder="Enter phone number" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="mb-3">
                                <label for="addres" class="form-label">Address</label>
                                <input type="text" class="form-control @error('addres') is-invalid @enderror"
                                    id="addres" name="addres" value="{{ $user->addres }}" placeholder="Enter address"
                                    required>
                                @error('addres')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
