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



    public function sub_skill_exercise($id)
    {
        $exercises = Exercise::where('sub_skill_id' , $id)->orderBy('created_at', 'DESC')->get();

        return view('exercises.index', compact(['exercises' , 'id']));
    }

    public function create($id)
    {
        return view('exercises.create' , compact('id'));
    }

    public function store(Request $request , $sub_skill_id)
    {
        $imagePath = null;
        $audioPath = null;

        if ($request->hasFile('image_link')) {
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

        if ($request->hasFile('audio_link')) {
            $audio = $request->file('audio_link');

            $filenameWithExt = $audio->getClientOriginalName();

            //Get FileName without Extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get Extension
            $Extension = $audio->getClientOriginalExtension();

            //New_File_Name
            $NewfileName = $filename . '_' . time() . '_.' . $Extension;

            $audioPath = $audio->storeAs('audios', $NewfileName, 'public');
        }

// Initialize base data
        $data = [
            'content' => $request['content'],
            'sub_skill_id' => $sub_skill_id,
            'xp' => $request['xp']
        ];

        if (!empty($imagePath)) {
            $data['image_link'] = URL::asset('storage/' . $imagePath);
        }

        if (!empty($audioPath)) {
            $data['audio_link'] = URL::asset('storage/' . $audioPath);
        }

        Exercise::create($data);

        return $this->sub_skill_exercise($sub_skill_id);
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

        return redirect()->route('exercises', ['id' => $exercise->sub_skill_id])->with('success', 'Skill updated successfully');
    }

    public function destroy( $id)
    {
        $exercise = Exercise::findOrFail($id);
        $sub_skill_id = $exercise->sub_skill_id ;
        $exercise->delete();

        return $this->sub_skill_exercise($sub_skill_id);
    }
}
