@extends('layouts.master')

@section('title', 'Quản lý bài học')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('lessons.create') }}" class="btn btn-primary">Thêm bài học</a>
        </div>
    </div>

    <x-table>
        <thead>
            <tr>
                <th>#</th>
                <th>Khóa học</th>
                <th>Tiêu đề</th>
                <th>URL video</th>
                <th>Thứ tự</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->id }}</td>
                    <td>{{ $lesson->course->name }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ $lesson->video_url ?: 'Không có' }}</td>
                    <td>{{ $lesson->order }}</td>
                    <td>
                        <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Xóa bài học này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Chưa có bài học nào.</td>
                </tr>
            @endforelse
        </tbody>
    </x-table>

    {{ $lessons->links() }}
@endsection
