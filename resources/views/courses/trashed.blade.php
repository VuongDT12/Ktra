@extends('layouts.master')

@section('title', 'Khóa học đã xóa')

@section('content')
    <div class="mb-4">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    <x-table>
        <thead>
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số bài học</th>
                <th>Số học viên</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ number_format($course->price, 2) }} VNĐ</td>
                    <td>{{ $course->lessons_count }}</td>
                    <td>{{ $course->enrollments_count }}</td>
                    <td>
                        <form action="{{ route('courses.restore', $course->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            <button class="btn btn-sm btn-success">Khôi phục</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có khóa học đã xóa.</td>
                </tr>
            @endforelse
        </tbody>
    </x-table>

    <div class="mt-3">
        {{ $courses->links() }}
    </div>
@endsection
