<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        $totalRevenue = Enrollment::join('courses', 'courses.id', '=', 'enrollments.course_id')
            ->sum(DB::raw('courses.price'));

        $topCourse = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->first();

        $newCourses = Course::latest()->take(5)->get();
        $revenueByCourse = Course::withCount('enrollments')->get()->map(function ($course) {
            return [
                'name' => $course->name,
                'revenue' => $course->price * $course->enrollments_count,
                'students' => $course->enrollments_count,
            ];
        });

        return view('dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue', 'topCourse', 'newCourses', 'revenueByCourse'));
    }
}
