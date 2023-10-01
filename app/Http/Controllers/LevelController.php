<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{

    public function index()
    {
        $level = Level::orderBy('created_at', 'DESC')->get();

        return view('levels.index', compact('level'));
    }


}
