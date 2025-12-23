@extends('admin.layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details: ' . $user->name)
@section('page-subtitle', 'View user information and tasks')

@section('content')
<div class="row">
    <!-- User Info -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body text-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 80px; height: 80px; font-size: 2rem;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                
                <div class="row text-center mb-3">
                    <div class="col-6 border-end">
                        <h5 class="mb-0">{{ $user->tasks_count ?? 0 }}</h5>
                        <small class="text-muted">Total Tasks</small>
                    </div>
                    <div class="col-6">
                        <h5 class="mb-0">{{ $user->created_at->format('M d, Y') }}</h5>
                        <small class="text-muted">Joined</small>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100 mb-2" 
                                onclick="return confirm('Make this user an admin?')">
                            <i class="bi bi-shield-check me-1"></i> Make Admin
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Delete this user? All tasks will be deleted too.')">
                            <i class="bi bi-trash me-1"></i> Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- User Tasks -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">User Tasks</h5>
                <span class="badge bg-primary p-2">{{ $tasks->total() }} tasks</span>
            </div>
            <div class="card-body">
                @if($tasks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{ Str::limit($task->title, 30) }}</td>
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
                                        <span class="badge bg-{{ $statusColors[$task->status] ?? 'secondary' }}">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Phân trang Bootstrap 5 Style -->
                    @if($tasks->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination mb-0">
                                <!-- Previous Page Link -->
                                @if($tasks->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="bi bi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tasks->previousPageUrl() }}" aria-label="Previous">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                <!-- Page Numbers -->
                                @foreach(range(1, $tasks->lastPage()) as $i)
                                    @if($i == $tasks->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $i }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                <!-- Next Page Link -->
                                @if($tasks->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tasks->nextPageUrl() }}" aria-label="Next">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="bi bi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    @endif
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-list-task display-6 d-block mb-2"></i>
                        This user has no tasks yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Users
    </a>
</div>
@endsection