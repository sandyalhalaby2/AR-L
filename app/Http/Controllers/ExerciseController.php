<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;

use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\URL;

class ExerciseController extends Controller
{
    public function search(Request $request)
    {
        $query = Exercise::query();
        if ($request->has('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }
        $exercises= $query->get();
        return view('exercises.allExercises', compact('exercises'));
    }

    public function index()
    {
        $exercises = Exercise::orderBy('created_at', 'DESC')->get();
        return view('exercises.allExercises', compact('exercises'));
    }

    public function lesson_exercise($id)
    {
        $exercises = Exercise::where('lesson_id' , $id)->orderBy('created_at', 'DESC')->get();

        return view('exercises.index', compact(['exercises' , 'id']));
    }

    public function create($id)
    {
        return view('exercises.create' , compact('id'));
    }

    public function store(Request $request , $lesson_id)
    {
        $imagePath = null;
        $audioPath = null;

        if ($request->hasFile('image_link')) {
//            $image = $request->file('image_link');
//            $imagePath = $image->store('images', 'public'); // Store in public disk, under 'images' directory
                $image = $request->file('image_link');

                //Get FileName with extension
                $filenameWithExt = $image->getClientOriginalName();

                //Get FileName without Extension
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                //Get Extension
                $Extension = $image->getClientOriginalExtension();

                //New_File_Name
                $NewfileName = $filename . '_' . time() . '_.' . $Extension;

                //Upload Image
                $imagePath = $image->storeAs('images', $NewfileName, 'public');
        }

        // Handle the audio upload
        if ($request->hasFile('audio_link')) {
            $audio = $request->file('audio_link');
            //Get FileName with extension
            $filenameWithExt = $audio->getClientOriginalName();

            //Get FileName without Extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get Extension
            $Extension = $audio->getClientOriginalExtension();

            //New_File_Name
            $NewfileName = $filename . '_' . time() . '_.' . $Extension;

            $audioPath = $audio->storeAs('images', $NewfileName, 'public');
        }

        Exercise::create([
            'type' => $request['type'] ,
            'content' => $request['content'],
            'lesson_id'=> $lesson_id ,
            'image_link' => URL::asset('storage/' . $imagePath),
            'audio_link' => $audioPath
        ]);

        return $this->lesson_exercise($lesson_id);
    }

    public function show($id)
    {
        $exercise = Exercise::findOrFail($id);

        return view('exercises.show', compact('exercise'));
    }

    public function edit($id)
    {
        $exercise = Exercise::findOrFail($id);

        return view('exercises.edit', compact('exercise'));
    }

    public function update(Request $request,  $id)
    {
        $exercise = Exercise::findOrFail($id);

        $exercise->update($request->all());

        return redirect()->route('exercises', ['id' => $exercise->lesson_id])->with('success', 'Lesson updated successfully');
    }

    public function destroy( $id)
    {
        $exercise = Exercise::findOrFail($id);
        $lesson_id = $exercise->lesson_id ;
        $exercise->delete();

        return $this->lesson_exercise($lesson_id);
    }
}
