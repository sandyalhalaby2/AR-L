<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpVerify\generateRequest;
use App\Http\Requests\OtpVerifyAccountRequest;
use App\Models\OtpVerificationCode;
use App\Models\User;
use Carbon\Carbon;

class AuthOtpController extends Controller
{

    public function generateOtp($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();

        # User Does not Have Any Existing OTP
        $verificationCode = OtpVerificationCode::where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();

        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        // Create a New OTP
        return OtpVerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(30)
        ]);
    }

    public function generate(generateRequest $request)
    {

        # Generate An OTP
        $verificationCode = $this->generateOtp($request->phone_number);

        return response()->json([
            'status' => true  ,
            'message' => "Your OTP To Login is - ".$verificationCode->otp
        ]) ;
    }

    public function OtpVerifyAccount(OtpVerifyAccountRequest $request)
    {
        #Validation Logic
        $verificationCode   = OtpVerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return response()->json([
                'status' => false ,
                'message' => 'Your OTP is not correct'
            ]) ;
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            $verificationCode->delete();
            return response()->json([
                'status' => false  ,
                'message' => 'Your OTP has been expired'
            ]) ;
        }

        $user = User::find($request['user_id']) ;
        $user->update(['email_verified_at' => now()]);
        $verificationCode->delete();

        return response()->json([
            'status' => true ,
            'message' => 'verified successfully'
        ]);
    }

}
