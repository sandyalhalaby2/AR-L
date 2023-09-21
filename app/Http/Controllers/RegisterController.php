<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpVerify\generateRequest;
use App\Http\Requests\Register\LogInRequest;
use App\Http\Requests\Register\SignUpRequest;
use App\Jobs\SendEmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function SignUp(SignUpRequest $request)
    {

        try {

            //store the user
            $User = \App\Models\User::create([
                'user_name' => $request['user_name'],

                'email' => $request['email'],

                'password' => Hash::make($request['password']),

                'phone_number' => $request['phone_number']
            ]);

            $otpGenerator = new AuthOtpController();
            $otpRequest = new generateRequest([
                'phone_number' => $request['phone_number'], // Assuming 'phone_number' is the mobile number field in your SignUpRequest
            ]);
            $otpGenerator->generate($otpRequest) ;

            $token = $User->createToken('API TOKEN')->plainTextToken ;

            return response()->json([
                'status' => true,
                'user' => $User,
                'token' => $token 
            ]);

        }catch(\Exception $exception)
        {
            return response()->json([
                'status' => false ,
                'message' => $exception->getMessage(),

            ]);
        }

    }

    public function LogIn(LogInRequest $request)
    {
        try
        {
            //Normal Email
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials))
                return response()->json([
                    'status' => false ,
                    'message' => 'Invalid Data'
                ]);
            else
            {

                $User = \App\Models\User::where('email' , $request['email'])->first() ;

                $token = $User->createToken('API TOKEN')->plainTextToken ;
                return response() ->json([
                    'status'=> true ,
                    'user' => $User,
                    'token' => $token ,
                ]) ;
            }
        }catch(\Exception $exception)
        {
            return response()->json([
                'status' => false ,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Logout .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function LogOut()
    {
        try
        {
            Auth::user()->tokens()->delete();

            return  response()->json([
                "status" => true ,
                "message" => "LogOut Successfully"
            ] ) ;

        }catch(\Exception $exception)
        {
            return response()->json([
                'status' => false ,
                'message' => $exception->getMessage()
            ]);
        }

    }

}
