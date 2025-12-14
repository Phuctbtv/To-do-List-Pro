@extends('task.layout')

@section('content')
<!-- Thêm phần hiển thị thông báo -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Thành công!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách công việc</h5>
        <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">+ Thêm Task</a>
    </div>
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Công việc</th>
                    <th>Hạn chót</th>
                    <th>Trạng thái</th>
                    <th>Thời gian tạo</th>
                     <th>Người tạo</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Demo static -->
                 @forelse($task as $tasks)
                  <tr>
                    <td>{{$tasks->id}}</td>
                    <td>{{$tasks->title}}</td>
                    <td>{{$tasks->due_date}}</td>
                    <!-- trạng thái -->
                    <td>
                     @switch($tasks->status)
                        @case(0)
                            <span class="badge bg-primary">Chưa làm</span>
                            @break
                        @case(1)
                            <span class="badge bg-warning">Đang làm</span>
                            @break
                        @case(2)
                            <span class="badge bg-success">Hoàn thành</span>
                            @break
                        @default
                            <span class="badge bg-primary">Chưa làm</span>
                            @break
                     @endswitch
                    </td>
                    <td>{{ $tasks->created_at->format('Y-m-d')}}</td>
                    <td>{{$tasks->user->name}}</td>
                    <td class="text-end">
                        <a href="{{ route('tasks.show',$tasks->id) }}" class="btn btn-sm btn-info text-white">Xem</a>
                        <a href="{{ route('tasks.edit', 1) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <!-- <button class="btn btn-sm btn-danger">Xóa</button> -->
                         <!-- Thành: -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $tasks->id }}">
                            Xóa
                        </button>
                        <!-- Modal xác nhận xóa - thêm sau mỗi </tr> -->
                    <div class="modal fade" id="deleteModal{{ $tasks->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $tasks->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $tasks->id }}">Xác nhận xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa công việc <strong>"{{ $tasks->title }}"</strong>?</p>
                                    <p class="text-danger">Hành động này không thể hoàn tác!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <form action="{{ route('tasks.destroy', $tasks->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" align="center">Hiện tại chưa có task nào</td>
                </tr>
                 @endforelse
               
            </tbody>
        </table>
        <!-- Hiển thị links phân trang -->
        <div class="d-flex justify-content-end">
             {{ $task->links('vendor.pagination.bootstrap-5') }}  
        </div>
    </div>
</div>
@endsection