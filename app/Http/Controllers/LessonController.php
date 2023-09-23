<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{

    public function search(Request $request)
    {
        $query = Lesson::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $lessons = $query->get();
        return view('lessons.allLessons', compact('lessons'));
    }

    public function index()
    {
        $lessons = Lesson::orderBy('created_at', 'DESC')->get();

        return view('lessons.allLessons', compact('lessons'));
    }

    public function course_lesson($id)
    {
            $lessons = Lesson::where('course_id' , $id)->orderBy('created_at')->get();

            return view('lessons.index', compact(['lessons' , 'id']));
    }

    public function create($id)
    {
        return view('lessons.create' , compact('id'));
    }

    public function store(Request $request , $course_id)
    {
        Lesson::create([
            'name' => $request['name'] ,
            'content' => $request['content'] ,
            'course_id'=> $course_id,
//            'order' => $request['order']
        ]);

        return $this->course_lesson($course_id);
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);

        return view('lessons.show', compact('lesson'));
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);

        return view('lessons.edit', compact('lesson'));
    }

    public function update(Request $request,  $id)
    {
        $lesson = Lesson::findOrFail($id);

        $lesson->update($request->all());

        return redirect()->route('lessons', ['id' => $lesson->course_id])->with('success', 'Lesson updated successfully');
    }

    public function destroy( $id)
    {
        $lesson = Lesson::findOrFail($id);
        $course_id = $lesson->course_id ;
        $lesson->delete();

        return $this->course_lesson($course_id);
    }

}
