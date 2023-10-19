<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\URL;

class ExerciseController extends Controller
{
    /**
     * Display a listing of exercises related to a specific sub-skill.
     *
     * @param  int  $id  The ID of the sub-skill
     * @return \Illuminate\View\View
     */
    public function sub_skill_exercise($id)
    {
        // Retrieve exercises related to the given sub-skill ID, ordered by their creation date in descending order
        $exercises = Exercise::where('sub_skill_id', $id)->orderBy('created_at', 'DESC')->get();

        // Return the view for displaying exercises and pass the exercises data and sub-skill ID to the view
        return view('exercises.index', compact(['exercises', 'id']));
    }

    /**
     * Show the form for creating a new exercise.
     *
     * @param  int  $id  The ID of the sub-skill
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        // Return the view for creating a new exercise and pass the sub-skill ID to the view
        return view('exercises.create', compact('id'));
    }

    /**
     * Store a newly created exercise in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $sub_skill_id  The ID of the related sub-skill
     * @return \Illuminate\View\View
     */
    public function store(Request $request, $sub_skill_id)
    {
        $imagePath = null;
        $audioPath = null;

        // Check if an image file is provided and process it
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

            // Upload Image
            $imagePath = $image->storeAs('images', $NewfileName, 'public');
        }

        // Check if an audio file is provided and process it
        if ($request->hasFile('audio_link')) {
            $audio = $request->file('audio_link');

            //Get FileName with extension
            $filenameWithExt = $image->getClientOriginalName();

            //Get FileName without Extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get Extension
            $Extension = $image->getClientOriginalExtension();

            //New_File_Name
            $NewfileName = $filename . '_' . time() . '_.' . $Extension;

            $audioPath = $audio->storeAs('audios', $NewfileName, 'public');
        }

        // Initialize base data for exercise creation
        $data = [
            'content' => $request['content'],
            'sub_skill_id' => $sub_skill_id,
            'xp' => $request['xp']
        ];

        // Add image and audio paths to the data if they are available
        if (!empty($imagePath)) {
            $data['image_link'] = URL::asset('storage/' . $imagePath);
        }

        if (!empty($audioPath)) {
            $data['audio_link'] = URL::asset('storage/' . $audioPath);
        }

        // Create a new exercise using the processed data
        Exercise::create($data);

        // Redirect to the listing of exercises related to the sub-skill
        return $this->sub_skill_exercise($sub_skill_id);
    }

    /**
     * Display the specified exercise.
     *
     * @param  int  $id  The ID of the exercise
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Retrieve the exercise by ID or fail if not found
        $exercise = Exercise::findOrFail($id);

        // Return the view for displaying the exercise and pass the exercise data to the view
        return view('exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified exercise.
     *
     * @param  int  $id  The ID of the exercise
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the exercise by ID or fail if not found
        $exercise = Exercise::findOrFail($id);

        // Return the view for editing the exercise and pass the exercise data to the view
        return view('exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified exercise in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  The ID of the exercise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Retrieve the exercise by ID or fail if not found
        $exercise = Exercise::findOrFail($id);

        // Update the exercise with the request data
        $exercise->update($request->all());

        // Redirect to the exercises listing with a success message
        return redirect()->route('exercises', ['id' => $exercise->sub_skill_id])->with('success', 'Skill updated successfully');
    }

    /**
     * Remove the specified exercise from storage.
     *
     * @param  int  $id  The ID of the exercise
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        // Retrieve the exercise by ID or fail if not found
        $exercise = Exercise::findOrFail($id);
        // Store the related sub-skill ID for redirection after deletion
        $sub_skill_id = $exercise->sub_skill_id;
        // Delete the exercise
        $exercise->delete();

        // Redirect to the listing of exercises related to the sub-skill
        return $this->sub_skill_exercise($sub_skill_id);
    }
}
