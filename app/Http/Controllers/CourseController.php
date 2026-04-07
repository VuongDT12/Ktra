<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with(['lessons', 'enrollments'])
            ->withCount(['lessons', 'enrollments'])
            ->when($request->filled('search'), fn ($query) => $query->where('name', 'like', '%'.$request->search.'%'))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('price_min') || $request->filled('price_max'), fn ($query) => $query->priceBetween($request->price_min, $request->price_max))
            ->when($request->filled('sort'), function ($query) use ($request) {
                return match ($request->sort) {
                    'price_asc' => $query->orderBy('price', 'asc'),
                    'price_desc' => $query->orderBy('price', 'desc'),
                    'students_asc' => $query->orderBy('enrollments_count', 'asc'),
                    'students_desc' => $query->orderBy('enrollments_count', 'desc'),
                    'created_asc' => $query->orderBy('created_at', 'asc'),
                    default => $query->orderBy('created_at', 'desc'),
                };
            })
            ->paginate(10)
            ->withQueryString();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'_'.Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/courses'), $filename);
            $data['image'] = 'uploads/courses/'.$filename;
        }

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Khóa học đã được tạo thành công.');
    }

    public function show(Course $course)
    {
        $course->load(['lessons', 'enrollments.student']);

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'_'.Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/courses'), $filename);
            $data['image'] = 'uploads/courses/'.$filename;
        }

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Khóa học đã được cập nhật.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Khóa học đã được xóa mềm.');
    }

    public function trashed()
    {
        $courses = Course::onlyTrashed()->withCount(['lessons', 'enrollments'])->paginate(10);

        return view('courses.trashed', compact('courses'));
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('courses.index')->with('success', 'Khóa học đã được khôi phục.');
    }
}
