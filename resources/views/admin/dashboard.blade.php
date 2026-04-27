@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Projects</h5>
                    <h2>{{ $stats['total_projects'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Skills</h5>
                    <h2>{{ $stats['total_skills'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Unread Messages</h5>
                    <h2>{{ $stats['unread_messages'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Messages</h5>
                    <h2>{{ $stats['total_messages'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Projects</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse($recent_projects as $project)
                        <a href="{{ route('projects.edit', $project) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $project->title }}</strong>
                                <small class="text-muted">{{ $project->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                        @empty
                        <p class="text-muted">No projects yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Messages</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse($recent_messages as $message)
                        <a href="{{ route('messages.show', $message) }}" class="list-group-item list-group-item-action {{ !$message->is_read ? 'active' : '' }}">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $message->name }}</strong>
                                <small>{{ $message->created_at->diffForHumans() }}</small>
                            </div>
                            <small>{{ Str::limit($message->message, 50) }}</small>
                        </a>
                        @empty
                        <p class="text-muted">No messages yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
