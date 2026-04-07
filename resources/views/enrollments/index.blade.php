@extends('layouts.master')

@section('title', 'Danh sách học viên')

@section('subtitle', 'Khóa học: ' . $course->name)

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Thêm đăng ký</a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại khóa học</a>
        </div>
        <div class="text-end">
            <span class="badge bg-info">Tổng học viên: {{ $enrollments->count() }}</span>
        </div>
    </div>

    <x-table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tên học viên</th>
                <th>Email</th>
                <th>Thời gian đăng ký</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td>{{ $enrollment->student->name }}</td>
                    <td>{{ $enrollment->student->email }}</td>
                    <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Chưa có học viên đăng ký cho khóa học này.</td>
                </tr>
            @endforelse
        </tbody>
    </x-table>
@endsection
