<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\OtpVerify\generateRequest;
use App\Http\Requests\Register\LogInRequest;
use App\Http\Requests\Register\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// RegisterController handles the registration, login, and logout functionality for mobile users.
class RegisterController extends Controller
{
    // SignUp function handles the user registration process.
    public function SignUp(SignUpRequest $request)
    {
        try {
            // Create a new user with the provided details.
            $User = \App\Models\MobileUser::create([
                'user_name' => $request['user_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'phone_number' => $request['phone_number']
            ]);

            // If a phone number is provided, generate and send an OTP.
            if($request['phone_number'])
            {
                $otpGenerator = new AuthOtpController();
                $otpRequest = new generateRequest([
                    'phone_number' => $request['phone_number'],
                ]);
                $otpGenerator->generate($otpRequest);
            }

            // Generate an API token for the registered user.
            $token = $User->createToken('API TOKEN')->plainTextToken;

            // Return a JSON response with user details and token.
            return response()->json([
                'status' => true,
                'user' => $User,
                'token' => $token
            ]);

        } catch(\Exception $exception) {
            // Handle exceptions and return an error message.
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    // LogIn function handles the user login process.
    public function LogIn(LogInRequest $request)
    {
        try {
            // Validate the provided email and password.
            $credentials = $request->only('email', 'password');
            if (!Auth::guard('mobile')->attempt($credentials))
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Data'
                ]);
            else
            {
                // Retrieve the user details.
                $User = \App\Models\MobileUser::where('email', $request['email'])->first();

                // Generate an API token for the logged-in user.
                $token = $User->createToken('API TOKEN')->plainTextToken;

                // Return a JSON response with user details and token.
                return response()->json([
                    'status'=> true,
                    'user' => $User,
                    'token' => $token,
                ]);
            }
        } catch(\Exception $exception) {
            // Handle exceptions and return an error message.
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    // LogOut function handles the user logout process.
    public function LogOut()
    {
        try {
            // Delete the user's tokens, effectively logging them out.
            Auth::user()->tokens()->delete();

            // Return a JSON response indicating successful logout.
            return response()->json([
                "status" => true,
                "message" => "LogOut Successfully"
            ]);

        } catch(\Exception $exception) {
            // Handle exceptions and return an error message.
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
