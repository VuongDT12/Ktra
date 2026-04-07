<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('course')->orderBy('order')->paginate(10);

        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::all();

        return view('lessons.create', compact('courses'));
    }

    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());

        return redirect()->route('lessons.index')->with('success', 'Bài học đã được tạo.');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();

        return view('lessons.edit', compact('lesson', 'courses'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());

        return redirect()->route('lessons.index')->with('success', 'Bài học đã được cập nhật.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Bài học đã được xóa.');
    }
}
