@extends('layouts.master')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <x-card title="Tổng số khóa học" subtitle="Khóa học đang quản lý">
                <h2 class="mb-0">{{ $totalCourses }}</h2>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card title="Tổng số học viên" subtitle="Đăng ký học">
                <h2 class="mb-0">{{ $totalStudents }}</h2>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card title="Tổng doanh thu" subtitle="Dựa trên đăng ký">
                <h2 class="mb-0">{{ number_format($totalRevenue, 2) }} VNĐ</h2>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card title="Khóa học hot nhất" subtitle="Nhiều học viên nhất">
                <h2 class="mb-0">{{ $topCourse?->name ?? 'Chưa có' }}</h2>
                <p class="mb-0 text-muted">{{ $topCourse?->enrollments_count ?? 0 }} học viên</p>
            </x-card>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <x-card title="5 khóa học mới nhất">
                <ul class="list-group list-group-flush">
                    @forelse($newCourses as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $course->name }}
                            <span class="text-muted small">{{ $course->created_at->format('d/m/Y') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item">Không có khóa học mới.</li>
                    @endforelse
                </ul>
            </x-card>
        </div>
        <div class="col-lg-6">
            <x-card title="Doanh thu theo khóa học">
                <div class="table-wrap">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Khóa học</th>
                                <th>Học viên</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($revenueByCourse as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['students'] }}</td>
                                    <td>{{ number_format($item['revenue'], 2) }} VNĐ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
@endsection
