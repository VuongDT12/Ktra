# 📚 COURSE MANAGEMENT SYSTEM - TÀI LIỆU CHI TIẾT

## 1. 📖 MÔ TẢ CHỨC NĂNG BÀI TOÁN

### Định nghĩa hệ thống
Hệ thống **Quản lý Khóa Học (Course Management System)** là một ứng dụng web cho phép quản lý toàn bộ quy trình kinh doanh khóa học trực tuyến, bao gồm:
- Quản lý danh mục khóa học
- Quản lý bài giảng trong từng khóa học
- Quản lý học viên và đăng ký học
- Thống kê và báo cáo doanh thu

### Các chức năng chính

#### 👤 **Quản lý Khóa Học**
- ✅ **Tạo khóa học (CREATE)**: Thêm khóa học mới với tên, giá, mô tả, ảnh đại diện
- ✅ **Xem danh sách (READ)**: Hiển thị tất cả khóa học với phân trang (10 items/trang)
- ✅ **Cập nhật (UPDATE)**: Sửa thông tin khóa học đã tạo
- ✅ **Xóa (DELETE)**: Xóa mềm (soft delete) để có thể khôi phục lại
- ✅ **Khôi phục**: Restore khóa học đã xóa mềm
- ✅ **Xóa bài học**: Quản lý các bài giảng của khóa học

#### 🎓 **Quản lý Bài Học**
- Thêm bài học cho từng khóa học
- Chỉnh sửa nội dung, video URL, thứ tự hiển thị
- Xóa bài học
- Sắp xếp theo thứ tự (order)

#### 📝 **Quản lý Đăng ký Học**
- Đăng ký học viên vào khóa học
- Xem danh sách học viên theo khóa học
- Thống kê số học viên mỗi khóa

#### 📊 **Dashboard - Thống kê**
- Tổng số khóa học hiện có
- Tổng số học viên đang học
- Tổng doanh thu từ các khóa học
- Khóa học HOT nhất (có học viên nhiều nhất)
- Doanh thu chi tiết theo từng khóa học

### Luồng hoạt động chính
```
[Quản trị viên] 
    ↓
[Tạo khóa học] → [Thêm bài học] → [Công bố khóa] 
    ↓
[Học viên đăng ký] 
    ↓
[Xem thống kê doanh thu]
    ↓
[Quản lý - Cập nhật hoặc xóa]
```

---

## 2. 📊 SƠ ĐỒ ERD (ENTITY RELATIONSHIP DIAGRAM)

### Mô tả quan hệ các bảng dữ liệu

```
┌─────────────────┐
│    COURSES      │
├─────────────────┤
│ id (PK)         │◄────────┐
│ name            │         │
│ slug (UNIQUE)   │         │
│ price           │         │ 1:N
│ description     │         │
│ image           │         │
│ status          │         │
│ deleted_at      │         │
│ created_at      │         │
│ updated_at      │         │
└─────────────────┘         │
        ▲                    │
        │1:N                 │
        │                    │
┌──────────────────┐    ┌─────────────────────┐
│    LESSONS       │    │   ENROLLMENTS       │
├──────────────────┤    ├─────────────────────┤
│ id (PK)          │    │ id (PK)             │
│ course_id (FK) ──┘    │ course_id (FK) ─────┤─┐
│ title            │    │ student_id (FK) ───┐│ │
│ content          │    │ created_at          │ │ │
│ video_url        │    │ updated_at          │ │ │
│ order            │    └─────────────────────┘ │ │
│ created_at       │                            │ │
│ updated_at       │                            │ │
└──────────────────┘                            │ │
                                                N │ 1
        ┌───────────────────────────────────────┘ │
        │                                         │
┌──────────────────┐                        ┌─────────────────┐
│    STUDENTS      │                        │      USERS      │
├──────────────────┤                        ├─────────────────┤
│ id (PK)          │                        │ id (PK)         │
│ name             │                        │ name            │
│ email (UNIQUE)   │                        │ email (UNIQUE)  │
│ created_at       │                        │ password        │
│ updated_at       │                        │ created_at      │
└──────────────────┘                        │ updated_at      │
                                            └─────────────────┘
```

### Giải thích quan hệ:

| Quan hệ | Mô tả |
|---------|-------|
| **Courses ↔ Lessons** | 1:N - Một khóa học có nhiều bài học |
| **Courses ↔ Enrollments** | 1:N - Một khóa học có nhiều đơn đăng ký |
| **Students ↔ Enrollments** | 1:N - Một học viên có nhiều đơn đăng ký |
| **Enrollments** | Bảng relationship (N:M) giữa Courses và Students |
| **SoftDeletes** | Khóa học có `deleted_at` - xóa mềm, không xóa hoàn toàn |

---

## 3. 🎨 PHÁC THẢO GIAO DIỆN

### 3.1 Trang Dashboard (Trang chủ)
```
┌─────────────────────────────────────────────────────┐
│  COURSE MANAGEMENT SYSTEM - DASHBOARD               │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ┌─────────────────┐  ┌─────────────────┐          │
│  │ 📚 Tổng khóa học│  │ 👥 Tổng học viên│          │
│  │     : 25        │  │      : 150      │          │
│  └─────────────────┘  └─────────────────┘          │
│                                                     │
│  ┌─────────────────┐  ┌─────────────────┐          │
│  │ 💰 Tổng doanh thu│  │ 🔥 Khóa HOT nhất│          │
│  │   : 50.000.000  │  │  : Python 101   │          │
│  └─────────────────┘  └─────────────────┘          │
│                                                     │
│  ┌────────────────────────────────────┐            │
│  │ 📊 DOANH THU THEO KHÓA HỌC         │            │
│  ├────────────────────────────────────┤            │
│  │ 1. Web Development  | 20.000.000   │            │
│  │ 2. Python 101       | 15.000.000   │            │
│  │ 3. Java Advanced    | 10.000.000   │            │
│  └────────────────────────────────────┘            │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### 3.2 Trang Danh sách Khóa Học
```
┌──────────────────────────────────────────────────────┐
│ 🎓 DANH SÁCH KHÓA HỌC                               │
├──────────────────────────────────────────────────────┤
│                                                      │
│  [🔍 Tìm kiếm...] [Lọc] [🆕 Thêm khóa học]         │
│                                                      │
│  ┌───────────────────────────────────────────────┐  │
│  │ [Khoá Học] [Giá] [Học viên] [Trạng thái]    │  │
│  ├───────────────────────────────────────────────┤  │
│  │ Web Development          5.000.000  │ 30  │Pub  │  │
│  │ [Chi tiết] [Sửa] [Xóa]              │      │    │  │
│  ├───────────────────────────────────────────────┤  │
│  │ Python 101               3.000.000  │ 25  │Pub  │  │
│  │ [Chi tiết] [Sửa] [Xóa]              │      │    │  │
│  ├───────────────────────────────────────────────┤  │
│  │ Java Advanced            7.000.000  │ 15  │Dr   │  │
│  │ [Chi tiết] [Sửa] [Xóa]              │      │    │  │
│  └───────────────────────────────────────────────┘  │
│                                                      │
│  [← Trang trước] [1] [2] [3] [Trang sau →]         │
│                                                      │
└──────────────────────────────────────────────────────┘
```

### 3.3 Trang Chi tiết Khóa Học
```
┌──────────────────────────────────────────────────────┐
│ 📖 CHI TIẾT KHÓA HỌC                                │
├──────────────────────────────────────────────────────┤
│                                                      │
│  [Ảnh khóa học]   | Tên: Web Development          │  │
│                   | Giá: 5.000.000 VND            │  │
│                   | Trạng thái: Published         │  │
│                   | Mô tả: Học lập trình web...   │  │
│                   |                               │  │
│                   | Học viên: 30 | Bài học: 12   │  │
│                   |                               │  │
│                   | [Sửa] [Xóa] [Quay lại]       │  │
│                                                      │
│  ┌─ DANH SÁCH BÀI HỌC ─────────────────────────┐   │
│  │ 1. Giới thiệu HTML        [Sửa] [Xóa]      │   │
│  │ 2. CSS cơ bản             [Sửa] [Xóa]      │   │
│  │ 3. JavaScript từ A-Z      [Sửa] [Xóa]      │   │
│  │ [+ Thêm bài học]                           │   │
│  └───────────────────────────────────────────────┘   │
│                                                      │
│  ┌─ DANH SÁCH HỌC VIÊN ─────────────────────────┐   │
│  │ 1. Nguyễn Văn A    | nguyen@mail.com       │   │
│  │ 2. Trần Thị B      | tran@mail.com         │   │
│  │ 3. Lê Văn C        | le@mail.com           │   │
│  │ ... (30 học viên)                          │   │
│  └───────────────────────────────────────────────┘   │
│                                                      │
└──────────────────────────────────────────────────────┘
```

### 3.4 Trang Tạo / Sửa Khóa Học
```
┌──────────────────────────────────────────────────────┐
│ ✏️ TẠO KHÓA HỌC MỚI                                 │
├──────────────────────────────────────────────────────┤
│                                                      │
│  [Form]                                              │
│  ├─ Tên khóa học *                                  │
│  │  [_____________________________________]         │
│  │                                                   │
│  ├─ Giá *                                           │
│  │  [________________] VND                          │
│  │                                                   │
│  ├─ Mô tả                                           │
│  │  [___________________________________            │
│  │   ___________________________________            │
│  │   ___________________________________]           │
│  │                                                   │
│  ├─ Ảnh đại diện                                    │
│  │  [Chọn ảnh]                                      │
│  │                                                   │
│  ├─ Trạng thái *                                    │
│  │  ◯ Draft  ◯ Published                           │
│  │                                                   │
│  │  [Lưu] [Hủy]                                    │
│  │                                                   │
└──────────────────────────────────────────────────────┘
```

---

## 4. 💻 GIẢI THÍCH CODE CHÍNH

### 4.1 **RELATIONSHIPS** (Quan hệ dữ liệu)

#### Model: Student
```php
<?php
class Student extends Model {
    // ✅ Học viên có nhiều đăng ký
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
    
    // ✅ Học viên có nhiều khóa học (qua bảng pivot)
    public function courses() {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}
```

**Giải thích:**
- `hasMany()`: Một học viên có thể đăng ký nhiều khóa học → Mỗi dòng trong `enrollments` là một đơn đăng ký
- `belongsToMany()`: Relationship N:M - sử dụng bảng `enrollments` làm bảng trung gian (pivot table)

---

#### Model: Enrollment
```php
<?php
class Enrollment extends Model {
    // ✅ Mỗi đơn đăng ký thuộc về 1 khóa học
    public function course() {
        return $this->belongsTo(Course::class);
    }
    
    // ✅ Mỗi đơn đăng ký thuộc về 1 học viên
    public function student() {
        return $this->belongsTo(Student::class);
    }
}
```

**Giải thích:**
- `belongsTo()`: Mỗi enrollment record có `course_id` và `student_id` - là khóa ngoại tham chiếu
- Bảng này là "cây cầu" nối giữa Courses và Students

---

#### Model: Course
```php
<?php
class Course extends Model {
    use SoftDeletes; // ✅ Cho phép xóa mềm
    
    // ✅ Một khóa học có nhiều bài học
    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
    
    // ✅ Một khóa học có nhiều đơn đăng ký
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
}
```

**Giải thích:**
- `hasMany()`: Một khóa học chứa nhiều bài học (1:N)
- `SoftDeletes`: Khi xóa, chỉ set `deleted_at` timestamp, không xóa hoàn toàn

---

### 4.2 **VALIDATION** (Xác thực dữ liệu)

#### CourseRequest.php
```php
<?php
class CourseRequest extends FormRequest {
    
    public function authorize(): bool {
        return true; // ✅ Ai cũng có quyền (có thể thêm logic người dùng)
    }
    
    public function rules(): array {
        return [
            // ✅ Tên khóa học: bắt buộc, string, tối đa 255 ký tự
            'name' => ['required', 'string', 'max:255'],
            
            // ✅ Giá: bắt buộc, số, tối thiểu 0.01
            'price' => ['required', 'numeric', 'min:0.01'],
            
            // ✅ Mô tả: không bắt buộc (nullable), là string
            'description' => ['nullable', 'string'],
            
            // ✅ Ảnh: không bắt buộc, phải là ảnh, tối đa 2MB
            'image' => ['nullable', 'image', 'max:2048'],
            
            // ✅ Trạng thái: bắt buộc, chỉ được "draft" hoặc "published"
            'status' => ['required', 'in:draft,published'],
        ];
    }
}
```

**Ý nghĩa các rule:**
| Rule | Ý nghĩa |
|------|---------|
| `required` | Bắt buộc phải có |
| `string` | Phải là chuỗi |
| `max:255` | Tối đa 255 ký tự |
| `numeric` | Phải là số |
| `min:0.01` | Giá trị tối thiểu |
| `nullable` | Có thể rỗng/null |
| `image` | Phải là file ảnh (jpg, png, gif, bmp) |
| `max:2048` | Kích thước tối đa 2048KB |
| `in:draft,published` | Chỉ có thể là một trong 2 giá trị |

---

### 4.3 **OPTIMIZATION** (Tối ưu hóa truy vấn)

#### Trong CourseController::index()

❌ **VÍ DỤ TỐI VẤU - N+1 Query Problem:**
```php
// ❌ BAD - Tạo 101 query nếu có 100 khóa học!
$courses = Course::all();
foreach ($courses as $course) {
    echo $course->enrollments()->count(); // 100 queries thêm
    echo $course->lessons()->count();     // 100 queries thêm
}
```

✅ **GIẢI PHÁP - Eager Loading:**
```php
// ✅ GOOD - Chỉ tạo 3 queries (1 courses + 1 lessons + 1 enrollments)
$courses = Course::with(['lessons', 'enrollments']) // Tải trước các relationships
    ->withCount(['lessons', 'enrollments']) // Thêm count luôn trong query
    ->paginate(10);
```

**Chi tiết code thực tế trong CourseController:**
```php
public function index(Request $request) {
    $courses = Course::with(['lessons', 'enrollments'])
        ->withCount(['lessons', 'enrollments'])
        
        // ✅ Tìm kiếm theo tên
        ->when($request->filled('search'), 
            fn ($query) => $query->where('name', 'like', '%'.$request->search.'%'))
        
        // ✅ Lọc theo trạng thái
        ->when($request->filled('status'), 
            fn ($query) => $query->where('status', $request->status))
        
        // ✅ Lọc theo khoảng giá
        ->when($request->filled('price_min') || $request->filled('price_max'), 
            fn ($query) => $query->priceBetween($request->price_min, $request->price_max))
        
        // ✅ Sắp xếp linh hoạt (match)
        ->when($request->filled('sort'), function ($query) use ($request) {
            return match ($request->sort) {
                'price_asc' => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                'students_asc' => $query->orderBy('enrollments_count', 'asc'),
                'students_desc' => $query->orderBy('enrollments_count', 'desc'),
                default => $query->orderBy('created_at', 'desc'),
            };
        })
        
        // ✅ Phân trang 10 item/trang + giữ query string
        ->paginate(10)
        ->withQueryString();

    return view('courses.index', compact('courses'));
}
```

**Các kỹ thuật Optimization:**

1. **Eager Loading** (`with()`)
   - Tải các relationships cùng lúc để tránh N+1 query problem
   - Thay vì query từng course → lessons từng cái

2. **Count Aggregation** (`withCount()`)
   - Tính số bài học, học viên trong query gốc
   - Không gọi thêm query riêng

3. **Conditional Query** (`when()`)
   - Chỉ thêm WHERE clause nếu user cung cấp filter
   - Tránh query thừa

4. **Match Expression** (`match()`)
   - Thay thế if-else dài dòng
   - Mã sạch, dễ đọc hơn

5. **Query String Preservation** (`withQueryString()`)
   - Giữ lại query string khi phân trang (search, filter không mất)

---

#### Trong Model Course - Slug Generation

```php
<?php
class Course extends Model {
    
    protected static function booted() {
        // ✅ Khi tạo course, tự động sinh slug nếu không có
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = static::generateUniqueSlug($course->name);
            }
        });
        
        // ✅ Khi update course, cập nhật slug nếu tên thay đổi
        static::updating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = static::generateUniqueSlug($course->name, $course->id);
            }
        });
    }
    
    protected static function generateUniqueSlug(string $name, ?int $exceptId = null): string {
        $slug = Str::slug($name); // "Web Development" → "web-development"
        $original = $slug;
        $count = 1;
        
        // ✅ Nếu slug đã tồn tại, thêm con số phía sau
        while (static::where('slug', $slug)
            ->when($exceptId !== null, fn ($query) => $query->where('id', '<>', $exceptId))
            ->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }
        
        return $slug;
    }
}
```

**Ý nghĩa:**
- **Slug**: Phiên bản URL-friendly của tên (`web-development` thay vì `Web Development`)
- **Unique**: Không được trùng lặp (nếu duplicate, thêm `-1`, `-2`, ...)
- **Observer Pattern**: Tự động sinh mà không cần gọi thêm logic trong controller

---

### 4.4 **DASHBOARD - Query Optimization**

```php
<?php
class DashboardController extends Controller {
    
    public function index() {
        // ✅ 1. Đơn giản - COUNT toàn bộ bảng
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        
        // ✅ 2. Tính tổng doanh thu = SUM(price * enrollment_count)
        //    Dùng JOIN để join courses vào enrollments rồi SUM
        $totalRevenue = Enrollment::join('courses', 'courses.id', '=', 'enrollments.course_id')
            ->sum(DB::raw('courses.price'));
        
        // ✅ 3. Tìm khóa học HOT (có nhiều học viên nhất)
        $topCourse = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->first();
        
        // ✅ 4. Lấy 5 khóa học mới nhất
        $newCourses = Course::latest()->take(5)->get();
        
        // ✅ 5. Tính doanh thu chi tiết từng khóa (map collection)
        $revenueByCourse = Course::withCount('enrollments')
            ->get()
            ->map(function ($course) {
                return [
                    'name' => $course->name,
                    'revenue' => $course->price * $course->enrollments_count,
                    'students' => $course->enrollments_count,
                ];
            });
        
        return view('dashboard', compact(
            'totalCourses', 
            'totalStudents', 
            'totalRevenue', 
            'topCourse', 
            'newCourses', 
            'revenueByCourse'
        ));
    }
}
```

---

## 5. ✨ CÁC TÍNH NĂNG NỔI BẬT

### 🔐 Soft Deletes
```php
// Xóa mềm - không mất dữ liệu
$course->delete(); // set deleted_at = now()

// Xem dữ liệu đã xóa
$trashedCourses = Course::onlyTrashed()->get();

// Khôi phục
$course->restore(); // set deleted_at = null

// Xóa hoàn toàn
$course->forceDelete();
```

### 🖼️ Upload Ảnh
```php
if ($request->hasFile('image')) {
    $image = $request->file('image');
    
    // Tạo tên file: timestamp + slug + extension
    $filename = time().'_'.Str::slug($name).'.'.$image->getClientOriginalExtension();
    
    // Lưu vào thư mục
    $image->move(public_path('uploads/courses'), $filename);
    
    // Lưu path vào database
    $data['image'] = 'uploads/courses/'.$filename;
}
```

### 🔍 Tìm kiếm & Lọc Linh hoạt
- Search: Tìm theo tên khóa học (LIKE)
- Filter: Lọc theo trạng thái (draft/published)
- Price Range: Lọc theo khoảng giá
- Sort: Sắp xếp theo giá, số học viên, ngày tạo

---

## 6. 🗄️ CẤU TRÚC FOLDER

```
course-manager/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CourseController.php      ← CRUD Khóa học
│   │   │   ├── LessonController.php      ← CRUD Bài học
│   │   │   ├── EnrollmentController.php  ← CRUD Đăng ký
│   │   │   └── DashboardController.php   ← Thống kê
│   │   └── Requests/
│   │       ├── CourseRequest.php         ← Validation Khóa học
│   │       ├── LessonRequest.php         ← Validation Bài học
│   │       └── EnrollmentRequest.php     ← Validation Đăng ký
│   └── Models/
│       ├── User.php                      ← Model User
│       ├── Course.php                    ← Model Khóa học
│       ├── Lesson.php                    ← Model Bài học
│       ├── Student.php                   ← Model Học viên
│       └── Enrollment.php                ← Model Đăng ký
├── database/
│   ├── migrations/                       ← Tạo bảng
│   ├── seeders/                          ← Seed dữ liệu
│   └── factories/                        ← Fake data
├── resources/
│   ├── views/
│   │   ├── dashboard.blade.php           ← Dashboard
│   │   ├── courses/                      ← Views khóa học
│   │   ├── lessons/                      ← Views bài học
│   │   ├── enrollments/                  ← Views đăng ký
│   │   └── layouts/                      ← Layout chung
│   ├── css/
│   ├── js/
│   └── images/
├── routes/
│   └── web.php                           ← Định tuyến
├── public/
│   └── uploads/courses/                  ← Lưu ảnh
└── storage/
    └── logs/                             ← File log
```

---

## 7. 🚀 CÔNG NGHỆ SỬ DỤNG

| Công nghệ | Phiên bản | Mục đích |
|-----------|----------|---------|
| **Laravel** | 13.0 | Framework backend |
| **PHP** | 8.3 | Ngôn ngữ lập trình |
| **MySQL** | 8.0+ | Cơ sở dữ liệu |
| **Bootstrap** | 5.3.2 | Frontend framework |
| **Blade** | - | Template engine |
| **Vite** | - | Build tool |

---

## 8. 📈 THỐNG KÊ DỊCH VỤ

### Giả lập dữ liệu:

**Database state:**
- 25 Khóa học (15 published, 10 draft)
- 150 Học viên
- 95 Đơn đăng ký
- Doanh thu: ~50.000.000 VND
- Khóa HOT: Python 101 (35 học viên)

---

## 9. 📝 GHI CHÚ KỸ THUẬT

### Chỉ số hiệu năng:
- **Query optimization**: N+1 problem được giải quyết bằng eager loading
- **Validation**: Server-side validation + yêu cầu FormRequest
- **Authorization**: (Có thể thêm trong tương lai)
- **Error handling**: (Có thể thêm xử lý lỗi chi tiết)

### Cải tiến tương lai:
- ✅ Thêm Authentication (đăng nhập/đăng ký)
- ✅ Phân quyền (Admin/Teacher/Student roles)
- ✅ Thanh toán (VNPay/Stripe integration)
- ✅ Email notification
- ✅ API endpoint (cho mobile app)
- ✅ Advanced search (Elasticsearch)

---

**Phiên bản tài liệu:** 1.0  
**Cập nhật lần cuối:** April 8, 2026  
**Người viết:** Development Team
