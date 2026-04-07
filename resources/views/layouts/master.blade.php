<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý khóa học')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #343a40; }
        .sidebar a { color: #ddd; text-decoration: none; }
        .sidebar a.active, .sidebar a:hover { color: #fff; }
        .content { padding: 1.5rem; }
        .card-border { border-color: #e3e6f0; }
        .table-wrap { overflow-x: auto; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            <a class="d-block mb-4 text-white fs-4 text-decoration-none" href="{{ route('dashboard') }}">Quản lý khóa học</a>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Bảng điều khiển</a>
                <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">Quản lý khóa học</a>
                <a class="nav-link {{ request()->routeIs('lessons.*') ? 'active' : '' }}" href="{{ route('lessons.index') }}">Quản lý bài học</a>
                <a class="nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}" href="{{ route('enrollments.create') }}">Đăng ký</a>
            </nav>
        </div>
        <div class="col-md-10 content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">@yield('title', 'Quản lý khóa học')</h1>
                    @hasSection('subtitle')
                        <p class="text-secondary mb-0">@yield('subtitle')</p>
                    @endif
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Bảng điều khiển</a>
                </div>
            </div>
            @include('components.alert')
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
