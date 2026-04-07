@extends('layouts.master')

@section('title', 'Thêm bài học')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('lessons.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Khóa học</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">Chọn khóa học</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">URL video</label>
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Thứ tự</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" required>
                </div>
                <button class="btn btn-primary">Lưu</button>
                <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
