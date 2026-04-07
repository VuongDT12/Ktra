# MINI PROJECT – QUẢN LÝ KHÓA HỌC (COURSE MANAGEMENT SYSTEM)

## 📖 Mô tả dự án

Đây là một hệ thống quản lý khóa học đơn giản được xây dựng bằng **Laravel 13.0** và **PHP 8.3**. Dự án cho phép quản lý khóa học, bài học, học viên và đăng ký học, với giao diện thân thiện và các tính năng cơ bản như tìm kiếm, lọc và thống kê.

## ✨ Tính năng chính

- **Quản lý khóa học**: Tạo, sửa, xóa, khôi phục khóa học (soft delete), upload ảnh đại diện, xem chi tiết khóa học
- **Quản lý bài học**: Thêm, sửa, xóa bài học cho từng khóa học, với nội dung, video và thứ tự
- **Quản lý đăng ký**: Đăng ký học viên vào khóa học, quản lý danh sách đăng ký theo từng khóa và hiển thị tổng số học viên
- **Dashboard**: Thống kê tổng số khóa học, học viên, doanh thu, khóa học hot nhất
- **Tìm kiếm & lọc**: Tìm kiếm khóa học theo tên, lọc theo trạng thái (draft/published), sắp xếp theo giá, ngày tạo
- **Phân trang**: Hiển thị danh sách với phân trang
- **Giao diện**: Sử dụng Bootstrap 5.3.2 cho responsive design

## 🏗️ Quan hệ dữ liệu

- **1 Khóa học → Nhiều Bài học**
- **1 Khóa học → Nhiều Đăng ký**
- **1 Học viên → Nhiều Đăng ký**
- **Khóa học ↔ Học viên = Nhiều-nhiều (qua bảng enrollments)**

## ⚙️ Yêu cầu hệ thống

- PHP ≥ 8.3
- Composer
- MySQL hoặc MariaDB
- Node.js & npm (cho Vite)
- Laravel 13.0

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
