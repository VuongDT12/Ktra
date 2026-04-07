<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;

class EnrollmentController extends Controller
{
    public function create()
    {
        $courses = Course::orderBy('name')->get();

        return view('enrollments.create', compact('courses'));
    }

    public function store(EnrollmentRequest $request)
    {
        $data = $request->validated();

        $student = Student::firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name']]
        );

        if ($student->courses()->where('course_id', $data['course_id'])->exists()) {
            return back()->with('warning', 'Học viên đã đăng ký khóa học này trước đó.');
        }

        Enrollment::create([
            'course_id' => $data['course_id'],
            'student_id' => $student->id,
        ]);

        return redirect()->route('enrollments.index', $data['course_id'])->with('success', 'Đăng ký học viên thành công.');
    }

    public function index(Course $course)
    {
        $enrollments = Enrollment::with('student')
            ->where('course_id', $course->id)
            ->get();

        return view('enrollments.index', compact('course', 'enrollments'));
    }
}
