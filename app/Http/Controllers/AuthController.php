<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'user_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'admin'
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }


    public function update(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
        $user = Auth::user() ;
        $user->user_name = $validatedData['name'];
        $user->phone_number = $validatedData['phone'];
        $user->save();
        return view('profile');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists in your database
        $user = MobileUser::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Create a new user record
            $user = MobileUser::create([
                'user_name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                // You can add more fields as per your user model
            ]);
        }

        // Generate a bearer token for the user
        $token = $user->createToken('api')->plainTextToken;

        // Return the token to the user or perform any desired redirect or response
        return response()->json(['token' => $token]);
    }
}
