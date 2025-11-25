@extends('layouts.admin')

@section('title', 'Create User')
@section('header', 'Create New User')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="mb-0">Create New User</h5>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-3 form-check form-switch">
                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1">
                <label class="form-check-label" for="is_admin">Admin User</label>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>
</div>
@endsection
