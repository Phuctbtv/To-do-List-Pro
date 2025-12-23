@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')
@section('page-subtitle', 'System Overview & Analytics')

@section('content')
<div class="row g-4">
    <!-- Stat Cards -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift" style="border-radius: 15px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Total Users</h6>
                        <h2 class="mb-0 text-primary">{{ $stats['total_users'] }}</h2>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> 
                            {{ $stats['new_users_today'] }} new today
                        </small>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-people text-primary" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift" style="border-radius: 15px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Total Tasks</h6>
                        <h2 class="mb-0 text-success">{{ $stats['total_tasks'] }}</h2>
                        <small class="text-success">
                            <i class="bi bi-check-circle"></i> 
                            {{ $stats['completed_tasks'] }} completed
                        </small>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-list-task text-success" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift" style="border-radius: 15px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">In Progress</h6>
                        <h2 class="mb-0 text-warning">{{ $stats['in_progress_tasks'] }}</h2>
                        <small class="text-warning">
                            <i class="bi bi-clock-history"></i> Active tasks
                        </small>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-clock text-warning" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm hover-lift" style="border-radius: 15px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2">Not Started</h6>
                        <h2 class="mb-0 text-info">{{ $stats['not_started_tasks'] }}</h2>
                        <small class="text-info">
                            <i class="bi bi-hourglass"></i> Pending tasks
                        </small>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-hourglass-split text-info" style="font-size: 1.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables -->
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pb-0" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0">Recent Tasks</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_tasks as $task)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($task->title, 25) }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px;">
                                            {{ strtoupper(substr($task->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span>{{ $task->user->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            App\Models\Task::NOT_STARTED => 'secondary',
                                            App\Models\Task::IN_PROGRESS => 'warning', 
                                            App\Models\Task::COMPLETED => 'success'
                                        ];
                                        $statusLabels = [
                                            App\Models\Task::NOT_STARTED => 'Not Started',
                                            App\Models\Task::IN_PROGRESS => 'In Progress',
                                            App\Models\Task::COMPLETED => 'Completed'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$task->status] ?? 'secondary' }} p-2">
                                        {{ $statusLabels[$task->status] ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td>
                                    @if($task->due_date)
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    @else
                                        <span class="text-muted">No due date</span>
                                    @endif
                                </td>
                                <td>{{ $task->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                    No tasks found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-xl-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pb-0" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0">Recent Users</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Joined</th>
                                <th>Tasks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 35px; height: 35px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            <div class="small text-muted">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->created_at->format('M d') }}</span>
                                    <div class="small">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-primary p-2">{{ $user->tasks_count ?? 0 }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No users found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px;">
            <div class="card-body">
                <h6 class="card-title text-muted mb-3">Quick Stats</h6>
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <h3 class="text-primary">{{ $stats['total_admins'] }}</h3>
                        <small class="text-muted">Admins</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-success">{{ $stats['total_tasks'] > 0 ? round(($stats['completed_tasks'] / $stats['total_tasks']) * 100, 1) : 0 }}%</h3>
                        <small class="text-muted">Completion Rate</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection