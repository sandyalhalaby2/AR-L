<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use App\Models\MobileUser;

class UserController extends Controller
{
    /**
     * Display a listing of users, ordered by creation date in descending order.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all users, ordered by creation date in descending order
        $users = MobileUser::orderBy('created_at', 'DESC')->get();

        // Return the user index view with the users data
        return view('user.index', compact('users'));
    }

    /**
     * Block or unblock a user by changing their permission status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($id)
    {
        // Find the user by ID
        $user = MobileUser::find($id);

        // Toggle the user's permission status between 'blocked' and 'normal'
        if($user->permission == 'blocked')
        {
            $user->permission = 'normal';
        } else {
            $user->permission = 'blocked';
        }

        // Save the updated user data
        $user->save();

        // Redirect to the users route
        return redirect()->route('users');
    }

    /**
     * Search for users based on their username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // Create a query builder instance
        $query = MobileUser::query();

        // If a search term is provided, add a where clause to the query
        if ($request->has('search')) {
            $query->where('user_name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('phone_number', 'like', '%' . $request->search . '%');
        }

        // Execute the query and retrieve the results
        $users = $query->get();

        // Return the user index view with the search results
        return view('user.index', compact('users'));
    }
}
