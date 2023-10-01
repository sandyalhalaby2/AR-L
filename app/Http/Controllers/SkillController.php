<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{

    public function search(Request $request)
    {
        $query = Skill::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $skills = $query->get();
        return view('skills.allSkills', compact('skills'));
    }

    public function index()
    {
        $skills = Skill::orderBy('created_at', 'DESC')->get();

        return view('skills.allSkills', compact('skills'));
    }

    public function level_skill($id)
    {
            $skills = Skill::where('level_id' , $id)->orderBy('created_at')->get();

            return view('skills.index', compact(['skills' , 'id']));
    }


}
