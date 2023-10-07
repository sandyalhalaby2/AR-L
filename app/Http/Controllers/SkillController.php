<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of all skills.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all skills from the database, ordered by their creation date in descending order
        $skills = Skill::orderBy('created_at', 'DESC')->get();

        // Return the view for displaying all skills and pass the skills data to the view
        return view('skills.allSkills', compact('skills'));
    }

    /**
     * Display a listing of skills based on their level.
     *
     * @param  int  $id  The ID of the skill level
     * @return \Illuminate\View\View
     */
    public function level_skill($id)
    {
        // Retrieve skills from the database that match the given level ID, ordered by their creation date
        $skills = Skill::where('level_id', $id)->orderBy('created_at')->get();

        // Return the view for displaying skills of a specific level and pass the skills data and level ID to the view
        return view('skills.index', compact(['skills', 'id']));
    }
}
