@extends('layouts.mainlayout')

@section('title', 'Edit User')

@section('content')

    <h1>Edit User</h1>

    <div class="mt-5 w-100 d-flex flex-column align-items-center">

        <form action="/user-edit/{{ $user->slug }}" method="POST" class="w-50">
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username"
                    name="username" value = "{{ $user->username }}" placeholder="username" required>

            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone"
                    name="phone" value = "{{ $user->phone }}" placeholder="user phone" required>

            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
@endsection
