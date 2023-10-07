<?php

namespace App\Http\Controllers;

use App\Models\SubSkill;
use Illuminate\Http\Request;

class SubSkillController extends Controller
{
    /**
     * Display a listing of sub-skills related to a specific skill.
     *
     * @param  int  $id  The ID of the skill
     * @return \Illuminate\View\View
     */
    public function Skill_SubSkill($id)
    {
        // Retrieve sub-skills related to the given skill ID, ordered by their creation date
        $sub_skills = SubSkill::where('skill_id', $id)->orderBy('created_at')->get();

        // Return the view for displaying sub-skills and pass the sub-skills data and skill ID to the view
        return view('sub_skills.index', compact(['sub_skills', 'id']));
    }

    /**
     * Show the form for creating a new sub-skill.
     *
     * @param  int  $id  The ID of the skill
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        // Return the view for creating a new sub-skill and pass the skill ID to the view
        return view('sub_skills.create', compact('id'));
    }

    /**
     * Store a newly created sub-skill in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $skill_id  The ID of the related skill
     * @return \Illuminate\View\View
     */
    public function store(Request $request, $skill_id)
    {
        // Create a new sub-skill using the request data and associate it with the given skill ID
        SubSkill::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'skill_id'=> $skill_id,
        ]);

        // Redirect to the listing of sub-skills related to the skill
        return $this->Skill_SubSkill($skill_id);
    }

    /**
     * Display the specified sub-skill.
     *
     * @param  int  $id  The ID of the sub-skill
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Retrieve the sub-skill by ID or fail if not found
        $sub_skill = SubSkill::findOrFail($id);

        // Return the view for displaying the sub-skill and pass the sub-skill data to the view
        return view('sub_skills.show', compact('sub_skill'));
    }

    /**
     * Show the form for editing the specified sub-skill.
     *
     * @param  int  $id  The ID of the sub-skill
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the sub-skill by ID or fail if not found
        $sub_skill = SubSkill::findOrFail($id);

        // Return the view for editing the sub-skill and pass the sub-skill data to the view
        return view('sub_skills.edit', compact('sub_skill'));
    }

    /**
     * Update the specified sub-skill in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  The ID of the sub-skill
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Retrieve the sub-skill by ID or fail if not found
        $sub_skill = SubSkill::findOrFail($id);

        // Update the sub-skill with the request data
        $sub_skill->update($request->all());

        // Redirect to the sub-skills listing with a success message
        return redirect()->route('sub_skills', ['id' => $sub_skill->skill_id])->with('success', 'SubSkill updated successfully');
    }

    /**
     * Remove the specified sub-skill from storage.
     *
     * @param  int  $id  The ID of the sub-skill
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        // Retrieve the sub-skill by ID or fail if not found
        $sub_skill = SubSkill::findOrFail($id);
        // Store the related skill ID for redirection after deletion
        $skill_id = $sub_skill->skill_id;
        // Delete the sub-skill
        $sub_skill->delete();

        // Redirect to the listing of sub-skills related to the skill
        return $this->Skill_SubSkill($skill_id);
    }
}
