<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Exercise\StoreExerciseRequest;
use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ExerciseController extends Controller
{

    public function store(StoreExerciseRequest $request)
    {
        try {
            $exercise = Exercise::create($request->all());
            return response()->json([
                'status' => true,
                'exercise' => $exercise,
                'message' => 'Exercise Created Successfully'
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
            $exercise = Exercise::findOrFail($id);
            $exercise->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Exercise updated successfully',
                'exercise' => $exercise
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
            $exercise = Exercise::findOrFail($id);
            $exercise->delete();
            return response()->json([
                'status' => true,
                'message' => 'Exercise deleted successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

}
