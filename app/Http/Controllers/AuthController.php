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
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('auth/register');
    }

    /**
     * Validate and save a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerSave(Request $request)
    {
        // Validate the request data
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        // Create a new user record in the database
        User::create([
            'user_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'admin'
        ]);

        // Redirect to the login route
        return redirect()->route('login');
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('auth/login');
    }

    /**
     * Validate and perform a login action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loginAction(Request $request)
    {
        // Validate the request data
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        // Regenerate the session
        $request->session()->regenerate();

        // Redirect to the dashboard route
        return redirect()->route('dashboard');
    }

    /**
     * Perform a logout action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout the user
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Redirect to the homepage
        return redirect('/');
    }

    /**
     * Display the profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function update(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();
        // Update the user data
        $user->user_name = $validatedData['name'];
        $user->phone_number = $validatedData['phone'];
        $user->save();

        // Return the profile view
        return view('profile');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGoogleCallback()
    {
        // Get the user data from Google
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists in the database
        $user = MobileUser::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Create a new user record
            $user = MobileUser::create([
                'user_name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId()
            ]);
        }

        // Generate a bearer token for the user
        $token = $user->createToken('api')->plainTextToken;

        // Return the token to the user
        return response()->json(['token' => $token]);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Facebook and log them in.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleFacebookCallback()
    {
        // Get the user data from Facebook
        $googleUser = Socialite::driver('facebook')->user();

        // Check if the user already exists in the database
        $user = MobileUser::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Create a new user record
            $user = MobileUser::create([
                'user_name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
            ]);
        }

        // Generate a bearer token for the user
        $token = $user->createToken('api')->plainTextToken;

        // Return the token to the user
        return response()->json(['token' => $token]);
    }
}
