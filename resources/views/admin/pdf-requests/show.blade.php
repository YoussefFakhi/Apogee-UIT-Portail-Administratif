@extends('layouts.admin')

@section('title', 'PDF Request Details')
@section('header', 'PDF Request Details')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="mb-0">Request Details</h5>
    </div>
    <div class="admin-card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">User</label>
                    <p class="mb-0">{{ $request->user->name }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Request Type</label>
                    <p class="mb-0">{{ $request->description }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Date</label>
                    <p class="mb-0">{{ $request->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Status</label>
                    <p class="mb-0">
                        <span class="badge bg-{{ $request->status === 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label text-muted">Request Data</label>
            <div class="bg-light p-3 rounded">
                <pre class="mb-0">{{ json_encode($request->data, JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.pdf-requests.index') }}" class="btn btn-secondary">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
