@extends('layouts.master')

@section('title', 'Thêm khóa học')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên khóa học</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh khóa học</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Bản nháp</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                    </select>
                </div>
                <button class="btn btn-primary">Lưu</button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
