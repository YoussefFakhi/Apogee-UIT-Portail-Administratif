@extends('layouts.admin')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="mb-0">Edit User</h5>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3 form-check form-switch">
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                <label class="form-check-label" for="is_admin">Admin User</label>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
