<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Lesson\StoreLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LessonController extends Controller
{

    public function store(StoreLessonRequest $request)
    {
        try {
            $lesson = Lesson::create($request->all());
            return response()->json([
                'status' => true,
                'lesson' => $lesson ,
                'message' => 'Lesson Created Successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Lesson updated successfully',
                'lesson' => $lesson
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();
            return response()->json([
                'status' => true,
                'message' => 'Lesson deleted successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

}
