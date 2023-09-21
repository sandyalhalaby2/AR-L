<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::orderBy('created_at', 'DESC')->get();

        return view('courses.index', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        Course::create($request->all());

        return redirect()->route('courses')->with('success', 'Course added successfully');
    }

    public function show( $id)
    {
        $course = Course::findOrFail($id);

        return view('courses.show', compact('course'));
    }

    public function edit( $id)
    {
        $course = Course::findOrFail($id);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request,  $id)
    {
        $course = Course::findOrFail($id);

        $course->update($request->all());

        return redirect()->route('courses')->with('success', 'Course updated successfully');
    }

    public function destroy( $id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        return redirect()->route('courses')->with('success', 'Course deleted successfully');
    }
}
