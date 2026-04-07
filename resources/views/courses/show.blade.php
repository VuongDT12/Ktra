@extends('layouts.master')

@section('title', 'Chi tiết khóa học: ' . $course->name)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($course->image)
                                <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class="img-fluid rounded">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">Không có ảnh</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $course->name }}</h2>
                            <p class="text-muted">{{ $course->description }}</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <strong>Giá:</strong> {{ number_format($course->price, 0) }} VNĐ
                                </div>
                                <div class="col-sm-6">
                                    <strong>Trạng thái:</strong>
                                    <x-badge :status="$course->status" />
                                </div>
                                <div class="col-sm-6">
                                    <strong>Số bài học:</strong> {{ $course->lessons->count() }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Số học viên:</strong> {{ $course->enrollments->count() }}
                                </div>
                            </div>
                            <p class="mt-3"><strong>Ngày tạo:</strong> {{ $course->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách bài học</h5>
                </div>
                <div class="card-body">
                    @if($course->lessons->count() > 0)
                        <div class="list-group">
                            @foreach($course->lessons->sortBy('order') as $lesson)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $lesson->title }}</strong>
                                        @if($lesson->video_url)
                                            <br><small class="text-muted">Video: {{ $lesson->video_url }}</small>
                                        @endif
                                    </div>
                                    <span class="badge bg-secondary">Thứ tự: {{ $lesson->order }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Chưa có bài học nào.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách học viên đăng ký ({{ $course->enrollments->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($course->enrollments->count() > 0)
                        <div class="list-group">
                            @foreach($course->enrollments as $enrollment)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $enrollment->student->name }}</strong>
                                        <br><small class="text-muted">{{ $enrollment->student->email }}</small>
                                    </div>
                                    <small class="text-muted">{{ $enrollment->created_at->format('d/m/Y') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Chưa có học viên nào đăng ký.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Sửa khóa học</a>
        <a href="{{ route('lessons.create') }}?course_id={{ $course->id }}" class="btn btn-info">Thêm bài học</a>
    </div>
@endsection