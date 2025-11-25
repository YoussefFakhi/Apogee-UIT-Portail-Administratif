@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-body text-center">
                <h5 class="card-title text-muted">Total Users</h5>
                <h2 class="mb-0 text-primary">{{ $usersCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-body text-center">
                <h5 class="card-title text-muted">Total Activities</h5>
                <h2 class="mb-0 text-primary">{{ $activitiesCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-body text-center">
                <h5 class="card-title text-muted">PDF Requests</h5>
                <h2 class="mb-0 text-primary">{{ $pdfRequestsCount }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="mb-0">Recent Activities</h5>
    </div>
    <div class="admin-card-body">
        <div class="list-group list-group-flush">
            @foreach($recentActivities as $activity)
            <div class="list-group-item border-0 px-0 py-3">
                <div class="d-flex justify-content-between">
                    <span class="text-primary">{{ $activity->user->name }}</span>
                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-0">{{ $activity->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
