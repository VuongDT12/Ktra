# 🎓 MINI PROJECT – QUẢN LÝ KHÓA HỌC (COURSE MANAGEMENT SYSTEM)

[![Laravel](https://img.shields.io/badge/Laravel-13.0-red?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-blue?logo=php)](https://www.php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple?logo=bootstrap)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

## 📖 Mô tả dự án

Hệ thống **Quản lý Khóa Học (Course Management System)** là một ứng dụng web đầy đủ được xây dựng bằng **Laravel 13.0** và **PHP 8.3**, cho phép quản lý toàn bộ quy trình kinh doanh khóa học trực tuyến. Dự án cung cấp giao diện thân thiện, tính năng mạnh mẽ và được tối ưu hóa hiệu suất cao.

## ✨ Tính năng chính

### 📚 Quản lý Khóa học (CRUD)
- ✅ **Tạo khóa học**: Thêm khóa học mới với tên, giá, mô tả, ảnh đại diện
- ✅ **Xem chi tiết**: Hiển thị toàn bộ thông tin bao gồm bài học, học viên
- ✅ **Cập nhật**: Sửa thông tin khóa học
- ✅ **Xóa mềm**: Xóa khóa học với khả năng khôi phục (Soft Delete)
- ✅ **Restore**: Khôi phục khóa học đã xóa
- ✅ **Upload ảnh**: Tải lên ảnh đại diện với xử lý tự động

### 🎯 Quản lý Bài học
- Thêm bài học cho khóa học với tiêu đề, nội dung, video URL
- Chỉnh sửa, xóa bài học
- Sắp xếp theo thứ tự (order)

### 📝 Quản lý Đăng ký học
- Đăng ký học viên vào khóa học
- Xem danh sách học viên theo từng khóa
- Thống kê số học viên

### 📊 Dashboard - Thống kê
- **Tổng số khóa học** đang có
- **Tổng số học viên** 
- **Tổng doanh thu** từ các khóa học
- **Khóa học HOT nhất** (có học viên nhiều nhất)
- **Doanh thu chi tiết** từng khóa học

### 🔍 Tìm kiếm & Lọc
- **Tìm kiếm**: Theo tên khóa học (LIKE query)
- **Lọc**: Theo trạng thái (Draft/Published)
- **Khoảng giá**: Lọc theo min-max price
- **Sắp xếp**: Giá, số học viên, ngày tạo (ASC/DESC)
- **Phân trang**: 10 item/trang, giữ query string

## 🏗️ Kiến trúc & Mô hình Dữ liệu

### Quan hệ Entities (ERD)

```
COURSES (1:N) LESSONS
COURSES (1:N) ENROLLMENTS (N:1) STUDENTS
USERS (1:N) COURSES
```

**Chi tiết:**
- **Courses ↔ Lessons**: 1:N - Một khóa học có nhiều bài học
- **Courses ↔ Enrollments**: 1:N - Một khóa học có nhiều đơn đăng ký
- **Students ↔ Enrollments**: 1:N - Một học viên có nhiều đơn đăng ký
- **Courses ↔ Students**: N:M - Qua bảng pivot `enrollments`
- **Soft Deletes**: Khóa học có `deleted_at` column

### Cấu trúc Folder

```
course-manager/
├── app/Http/
│   ├── Controllers/
│   │   ├── CourseController.php         ← CRUD Khóa học
│   │   ├── LessonController.php         ← CRUD Bài học
│   │   ├── EnrollmentController.php     ← CRUD Đăng ký
│   │   └── DashboardController.php      ← Thống kê
│   └── Requests/
│       ├── CourseRequest.php            ← Validation
│       ├── LessonRequest.php
│       └── EnrollmentRequest.php
├── app/Models/
│   ├── Course.php
│   ├── Lesson.php
│   ├── Student.php
│   ├── Enrollment.php
│   └── User.php
├── database/migrations/                 ← Tạo bảng
├── resources/views/
│   ├── dashboard.blade.php
│   ├── courses/                         ← CRUD views
│   ├── lessons/
│   ├── enrollments/
│   └── layouts/app.blade.php
└── routes/web.php                       ← Routes
```

## 🛠️ Công nghệ sử dụng

| Công nghệ | Phiên bản | Mục đích |
|-----------|----------|---------|
| **Laravel** | 13.0 | Framework backend |
| **PHP** | 8.3+ | Ngôn ngữ lập trình |
| **MySQL** / SQLite | 8.0+ | Cơ sở dữ liệu |
| **Bootstrap** | 5.3.2 | Frontend UI |
| **Blade** | - | Template engine |
| **Eloquent ORM** | - | Database layer |
| **Vite** | - | Build tool |

## ⚙️ Yêu cầu hệ thống

- **PHP** ≥ 8.3
- **Composer** (Package manager cho PHP)
- **Node.js** & **npm** (cho Vite - build tool)
- **MySQL** hoặc **MariaDB** (hoặc SQLite)
- **Laravel CLI** (tùy chọn)

## 🚀 Cài đặt & Chạy ứng dụng

### 1. Clone Repository
```bash
git clone https://github.com/VuongDT12/Ktra.git
cd course-manager
```

### 2. Cài đặt Dependencies
```bash
# PHP dependencies
composer install

# Node dependencies
npm install
```

### 3. Setup Environment
```bash
# Copy file .env
cp .env.example .env

# Generate key
php artisan key:generate
```

### 4. Database Setup
```bash
# Run migrations & seed
php artisan migrate:fresh --seed
```

### 5. Build Frontend
```bash
npm run dev    # Development mode
npm run build  # Production build
```

### 6. Start Server
```bash
php artisan serve
# Hoặc nếu dùng Laragon/WAMP/XAMPP, chỉ cần truy cập: http://localhost/course-manager
```

Truy cập ứng dụng tại: **http://localhost:8000**

## 📚 Tài liệu Chi tiết

Dự án bao gồm 3 file tài liệu toàn diện:

1. **[DOCUMENTATION.md](DOCUMENTATION.md)** - Tài liệu đầy đủ
   - Mô tả chức năng bài toán
   - Sơ đồ ERD
   - Phác thảo giao diện
   - Giải thích code chính (Relationships, Validation, Optimization)
   - Cảnh báo kỹ thuật

2. **[ERD_DIAGRAM.html](ERD_DIAGRAM.html)** - Sơ đồ quan hệ dữ liệu
   - Mermaid ERD diagram tương tác
   - Chi tiết các bảng & cột
   - Mô tả thông tin ràng buộc

3. **[SCREENSHOTS.html](SCREENSHOTS.html)** - Wireframe & Mockup giao diện
   - Mockup Dashboard
   - Danh sách Khóa học
   - Chi tiết Khóa học
   - Form Tạo/Sửa khóa học
   - Danh sách tính năng

## 🎯 Giải thích Code Chính

### 1. **Relationships (Quan hệ Dữ liệu)**

#### Model Student
```php
class Student extends Model {
    // Học viên có nhiều đăng ký
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
    
    // Học viên có nhiều khóa học
    public function courses() {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}
```

#### Model Course
```php
class Course extends Model {
    use SoftDeletes;
    
    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
    
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
}
```

### 2. **Validation (Xác thực Dữ liệu)**

```php
class CourseRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}
```

### 3. **Query Optimization (Tối ưu hóa)**

```php
// Eager loading + Count aggregation + Conditional filters
$courses = Course::with(['lessons', 'enrollments'])
    ->withCount(['lessons', 'enrollments'])
    ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%'.$request->search.'%'))
    ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
    ->when($request->filled('sort'), function ($q) use ($request) {
        return match ($request->sort) {
            'price_asc' => $q->orderBy('price', 'asc'),
            'price_desc' => $q->orderBy('price', 'desc'),
            default => $q->orderBy('created_at', 'desc'),
        };
    })
    ->paginate(10)
    ->withQueryString();
```

**Kỹ thuật:**
- ✅ **Eager Loading**: Tránh N+1 query problem
- ✅ **Aggregation**: Count trong query chính
- ✅ **Conditional Queries**: Chỉ thêm WHERE khi cần
- ✅ **Match Expression**: Sắp xếp linh hoạt

## 📊 Dữ liệu Mẫu

Khi chạy `migrate:fresh --seed`, hệ thống tạo:
- **6 khóa học** (4 published, 2 draft)
- **15 học viên** 
- **40+ đơn đăng ký**
- **12-15 bài học** mỗi khóa

## 🔐 Tính năng Bảo mật

- ✅ **Form Request Validation**: Server-side validation
- ✅ **Soft Deletes**: Xóa dữ liệu an toàn
- ✅ **Password Hashing**: Mật khẩu được mã hóa
- ✅ **CSRF Protection**: Bảo vệ form

## 🚀 Cải tiến Tương lai

- [ ] **Authentication**: Đăng nhập/đăng ký tài khoản
- [ ] **Authorization**: Phân quyền (Admin/Teacher/Student)
- [ ] **Payment Integration**: Thanh toán (VNPay, Stripe)
- [ ] **Email Notifications**: Gửi email xác nhận
- [ ] **API REST**: Endpoints cho mobile app
- [ ] **Advanced Search**: Elasticsearch integration
- [ ] **User Ratings**: Đánh giá khóa học

## 📝 Lưu ý Kỹ thuật

### Hiệu suất
- Tất cả queries đã được tối ưu với eager loading
- Sử dụng aggregation (`withCount`) để tránh query thêm
- Phân trang để giảm dung lượng dữ liệu

### Code Quality
- Tuân theo chuẩn Laravel best practices
- Validation rõ ràng trong FormRequest
- Models có quan hệ definitions
- Controllers sạch, logic ở Models

### Database
- Soft deletes cho khóa học
- Foreign keys có constraint
- Migrations rõ ràng
- Timestamps tự động

## 🤝 Đóng góp

Chào mừng các pull requests! Vui lòng:
1. Fork repository
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## 📄 License

Dự án này được cấp phép dưới [MIT License](LICENSE)

## 👨‍💻 Tác giả

**Vương Duy Tùng** (VuongDT12)
- GitHub: [@VuongDT12](https://github.com/VuongDT12)
- Email: duytung@email.com

## 📞 Liên hệ & Hỗ trợ

Có câu hỏi hoặc cần hỗ trợ? mở [GitHub Issues](https://github.com/VuongDT12/Ktra/issues)

---

**📅 Tạo:** April 8, 2026  
**⭐ Version:** 1.0  
**📚 Status:** ✅ Hoàn thành

## 🚀 Cài đặt & Chạy

1. **Clone repository**:
   ```bash
   git clone <repository-url>
   cd course-manager
   ```

2. **Cài đặt dependencies PHP**:
   ```bash
   composer install
   ```

3. **Cài đặt dependencies JS**:
   ```bash
   npm install
   ```

4. **Cấu hình môi trường**:
   - Copy `.env.example` thành `.env`
   - Cập nhật thông tin database trong `.env`

5. **Tạo database & chạy migrations**:
   ```bash
   php artisan migrate
   ```

6. **Seed dữ liệu mẫu (tùy chọn)**:
   ```bash
   php artisan db:seed
   ```

7. **Build assets**:
   ```bash
   npm run build
   ```

8. **Chạy server**:
   ```bash
   php artisan serve
   ```

9. **Truy cập**: Mở http://localhost:8000

## 📁 Cấu trúc dự án

```
course-manager/
├── app/
│   ├── Http/Controllers/          # Controllers
│   ├── Models/                    # Eloquent Models
│   └── Http/Requests/             # Form Requests
├── database/
│   ├── migrations/                # Database migrations
│   └── seeders/                   # Database seeders
├── public/                        # Public assets
├── resources/
│   ├── views/                     # Blade templates
│   └── css/js/                    # Frontend assets
├── routes/
│   └── web.php                    # Routes
└── README.md
```

## 🛠️ Công nghệ sử dụng

- **Backend**: Laravel 13.0 (PHP 8.3)
- **Frontend**: Bootstrap 5.3.2, Blade templates
- **Database**: MySQL (Eloquent ORM)
- **Authentication**: Laravel Breeze (nếu có)
- **File Upload**: Laravel Storage
- **Build Tool**: Vite

## 📋 Hướng dẫn sử dụng

### Quản lý khóa học
- Truy cập `/courses` để xem danh sách khóa học
- Nhấn "Xem" để xem chi tiết khóa học cùng danh sách học viên đăng ký và tổng số học viên
- Tạo khóa học mới với thông tin chi tiết và upload ảnh
- Sửa/xóa khóa học, khôi phục từ thùng rác

### Quản lý bài học
- Truy cập `/lessons` để xem tất cả bài học
- Chọn khóa học khi tạo bài học mới
- Sắp xếp bài học theo thứ tự

### Đăng ký học viên
- Truy cập `/enrollments/create` để đăng ký học viên vào khóa học
- Xem danh sách đăng ký tại `/enrollments`

### Dashboard
- Truy cập `/` để xem thống kê tổng quan

## 🔍 Tìm kiếm & lọc
- Sử dụng thanh tìm kiếm để tìm khóa học theo tên
- Lọc theo trạng thái: Bản nháp / Đã xuất bản
- Sắp xếp theo giá hoặc ngày tạo

## 📊 Thống kê
- Tổng số khóa học, học viên, doanh thu
- Khóa học có nhiều học viên nhất

## 🚧 Hạn chế
- Chưa có authentication (đăng nhập/đăng ký)
- Chưa có phân quyền (admin/user)
- Dữ liệu mẫu chưa đầy đủ
- Chưa tối ưu hóa performance cho dữ liệu lớn

## 🔮 Phát triển thêm
- Thêm authentication với Laravel Breeze
- Phân quyền admin/user
- API RESTful
- Email notifications
- Payment integration
- Video streaming cho bài học

## 📜 Giấy phép

Dự án này được phát hành theo **MIT License**.

## 👨‍💻 Tác giả

[Your Name] - Mini Project for Course Management System

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
