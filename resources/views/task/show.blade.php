@extends('task.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📄 Chi tiết công việc</h5>
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-secondary">⬅ Quay lại</a>
            </div>
            <div class="card-body">
                <h4 class="fw-bold mb-3">{{$task->title}}</h4>
                <p class="text-muted"><strong>Mô tả:</strong></p>
                <p>{{$task->description ?? 'Chưa có mô tả'}}</p>
                <p><strong>Hạn chót:</strong> <span class="badge bg-danger">{{$task->due_date}}</span></p>
                <p><strong>Trạng thái:</strong> 
                 @switch($task->status)
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
                    </p>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('tasks.edit',$task->id) }}" class="btn btn-warning me-2">✏️ Sửa</a>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                            Xóa
                        </button>
                        <!-- Modal xác nhận xóa - thêm sau mỗi </tr> -->
                    <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Xác nhận xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa công việc <strong>"{{ $task->title }}"</strong>?</p>
                                    <p class="text-danger">Hành động này không thể hoàn tác!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
