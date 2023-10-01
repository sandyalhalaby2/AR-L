<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\SubSkill;
use Illuminate\Http\Request;

class SubSkillController extends Controller
{

    public function Skill_SubSkill($id)
    {
        $sub_skills = SubSkill::where('skill_id' , $id)->orderBy('created_at')->get();

        return view('sub_skills.index', compact(['sub_skills' , 'id']));


    }
    public function create($id)
    {
        return view('sub_skills.create' , compact('id'));
    }

    public function store(Request $request , $skill_id)
    {
        SubSkill::create([
            'name' => $request['name'] ,
            'description' => $request['description'] ,
            'skill_id'=> $skill_id,
        ]);

        return $this->Skill_SubSkill($skill_id);
    }

    public function show($id)
    {
        $sub_skill = SubSkill::findOrFail($id);

        return view('sub_skills.show', compact('sub_skill'));
    }

    public function edit($id)
    {
        $sub_skill = SubSkill::findOrFail($id);

        return view('sub_skills.edit', compact('sub_skill'));
    }

    public function update(Request $request,  $id)
    {
        $sub_skill = SubSkill::findOrFail($id);

        $sub_skill->update($request->all());

        return redirect()->route('sub_skills', ['id' => $sub_skill->skill_id])->with('success', 'SubSkill updated successfully');
    }

    public function destroy( $id)
    {
        $sub_skill = SubSkill::findOrFail($id);
        $skill_id = $sub_skill->skill_id ;
        $sub_skill->delete();

        return $this->Skill_SubSkill($skill_id);
    }


}
