<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use App\Models\Exercise;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = MobileUser::orderBy('created_at', 'DESC')->get();

        return view('user.index', compact('users'));
    }

    public function block($id)
    {
        $user= MobileUser::find($id) ;
        if($user->permission == 'blocked')
        {
            $user->permission = 'normal' ;
            $user->save() ;
        }else{
            $user->permission = 'blocked' ;
            $user->save() ;
        }
        return redirect()->route('users');

    }
    public function search(Request $request)
    {
        $query = MobileUser::query();
        if ($request->has('search')) {
            $query->where('user_name', 'like', '%' . $request->search . '%');
        }
        $users= $query->get();
        return view('user.index', compact('users'));
    }
}
