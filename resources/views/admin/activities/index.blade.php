@extends('layouts.admin')

@section('title', 'Activities Log')
@section('header', 'Activities Log')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h5 class="mb-0">Activities Log</h5>
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->user->name }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection
