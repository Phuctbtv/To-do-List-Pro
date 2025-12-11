@extends('task.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">✏️ Sửa công việc</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên công việc <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                               id="title" placeholder="Nhập tên công việc..." 
                               value="{{ old('title', $task->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" id="description" rows="3" 
                                  placeholder="Nhập mô tả chi tiết...">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Hạn chót</label>
                        <input type="date" name="due_date" 
                               class="form-control @error('due_date') is-invalid @enderror" 
                               id="due_date" value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">
                        @error('due_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="0" {{ old('status', $task->status) == '0' ? 'selected' : '' }}>Chưa làm</option>
                            <option value="1" {{ old('status', $task->status) == '1' ? 'selected' : '' }}>Đang làm</option>
                            <option value="2" {{ old('status', $task->status) == '2' ? 'selected' : '' }}>Hoàn thành</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
                        <button type="submit" class="btn btn-success">✔ Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection