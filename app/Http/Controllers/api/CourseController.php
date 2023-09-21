<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(StoreCourseRequest $request)
    {
        try
        {
            $course = Course::create($request->all());
            return response()->json([
                'status'=> true ,
                'course' => $course ,
                'message' => 'Course Created Successfully'
            ]);
        }catch (\Exception $exception)
        {
            return response()->json([
                'status' => false ,
                'message' => $exception->getMessage()
            ]) ;
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $course = Course::findOrFail($id);
            $course->update($request->all());
            return response()->json([
                'status' => true ,
                'message'=> 'course updated successfully' ,
                'course' => $course
            ]) ;
        }catch (ModelNotFoundException $ex)
        {
            return response()->json([
                'status' => false ,
                'message' => $ex->getMessage()
            ]) ;
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
            return response()->json([
                'status' => true,
                'message' => 'course deleted successfully'
            ]);
        }catch (ModelNotFoundException $ex)
        {
            return response()->json([
                'status' => false ,
                'message' => $ex->getMessage()
            ]) ;
        }
    }

}
