@extends('layouts.master')

@section('title', 'Sửa khóa học')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Tên khóa học</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $course->price) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh khóa học</label>
                    <input type="file" name="image" class="form-control">
                    @if($course->image)
                        <div class="mt-2">
                            <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class="img-fluid rounded" style="max-height: 120px;">
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="draft" {{ old('status', $course->status) === 'draft' ? 'selected' : '' }}>Bản nháp</option>
                        <option value="published" {{ old('status', $course->status) === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                    </select>
                </div>
                <button class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
