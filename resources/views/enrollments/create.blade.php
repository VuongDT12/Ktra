@extends('layouts.master')

@section('title', 'Đăng ký học viên')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Chọn khóa học</label>
                    <select class="form-select" name="course_id" required>
                        <option value="">--- Chọn khóa học ---</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }} ({{ number_format($course->price, 2) }} VNĐ)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên học viên</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <button class="btn btn-primary">Đăng ký</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
