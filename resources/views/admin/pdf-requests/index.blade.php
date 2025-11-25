@extends('layouts.admin')

@section('title', 'PDF Requests')
@section('header', 'PDF Generation Requests')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="mb-0">PDF Requests</h5>
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Request Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->description }}</td>
                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.pdf-requests.show', $request->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection
