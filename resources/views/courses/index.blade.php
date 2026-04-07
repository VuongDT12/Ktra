@extends('layouts.master')

@section('title', 'Khóa học')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">Thêm khóa học</a>
            <a href="{{ route('courses.trashed') }}" class="btn btn-secondary">Khóa học đã xóa</a>
        </div>
        <form class="row gx-2 gy-2" method="GET" action="{{ route('courses.index') }}">
            <div class="col-auto">
                <input type="text" class="form-control" name="search" placeholder="Tên khóa học" value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <select class="form-select" name="status">
                    <option value="">Tất cả trạng thái</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                </select>
            </div>
            <div class="col-auto">
                <input type="number" step="0.01" class="form-control" name="price_min" placeholder="Giá từ" value="{{ request('price_min') }}">
            </div>
            <div class="col-auto">
                <input type="number" step="0.01" class="form-control" name="price_max" placeholder="Giá đến" value="{{ request('price_max') }}">
            </div>
            <div class="col-auto">
                <select class="form-select" name="sort">
                    <option value="created_desc" {{ request('sort') === 'created_desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="created_asc" {{ request('sort') === 'created_asc' ? 'selected' : '' }}>Cũ nhất</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    <option value="students_desc" {{ request('sort') === 'students_desc' ? 'selected' : '' }}>Học viên nhiều nhất</option>
                    <option value="students_asc" {{ request('sort') === 'students_asc' ? 'selected' : '' }}>Học viên ít nhất</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary">Lọc</button>
            </div>
        </form>
    </div>

    <x-table>
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Số bài học</th>
                <th>Số học viên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td style="width: 120px;">
                        @if($course->image)
                            <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class="img-fluid rounded" style="max-height: 60px;">
                        @else
                            <span class="text-muted">Chưa có</span>
                        @endif
                    </td>
                    <td>{{ $course->name }}</td>
                    <td>{{ number_format($course->price, 2) }} VNĐ</td>
                    <td><x-badge :status="$course->status" /></td>
                    <td>{{ $course->lessons_count }}</td>
                    <td>{{ $course->enrollments_count }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary">Xem</a>
                        <a href="{{ route('enrollments.index', $course) }}" class="btn btn-sm btn-info">Học viên</a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa khóa học này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Chưa có khóa học nào.</td>
                </tr>
            @endforelse
        </tbody>
    </x-table>

    <div class="mt-3">
        {{ $courses->links() }}
    </div>
@endsection
