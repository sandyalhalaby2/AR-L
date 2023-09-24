<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ForgotPassword\ResetPasswordRequest;
use App\Http\Requests\Image\ImageRequest;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{


    public function profile()
    {
        try
        {
            $id = Auth::id() ;
            $user = MobileUser::find($id) ;

            return response()->json([
                'user' => $user
            ]) ;

        } catch (\Exception $exception)
        {
            return response() -> json([
                'status' => false  ,
                'message' => $exception->getMessage() ,
            ] ) ;
        }
    }


    public function GetUser($id)
    {
        try {
            $user = MobileUser::find($id);
            if ($user)
            {
                return response()->json([
                    'user' => $user
                ], 201);
            }else {
                return \response()->json([
                    'message' => 'User Not Exist'
                ]);
            }
        }catch (\Exception $exception)
        {
            return response() -> json([
                'status' => false  ,
                'message' => $exception->getMessage() ,
            ] ) ;
        }
    }


    public function User_insert_image(ImageRequest $request)
    {

        try
        {
            $user_id = Auth::id() ;

            $user= \App\Models\MobileUser::find($user_id)  ;

            $Image = new ImageController() ;

            if ($user['image']!=null)
            {
                $Image->delete_image_from_Storage($user['image']) ;
            }

            $path = $Image->store_image_User($request) ;

            //create Object in Database
            $user->update(['profile_picture' => URL::asset('storage/' . $path)]);

            return response()->json([
                    'status' => true ,
                    'message' => 'Image are inserted Successfully' ,
                ]) ;

        } catch(\Exception $exception)
        {

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {

            $user = Auth::user();
            $user->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'User has been Updated Successfully' ,
                'user' => $user
            ]);

        }catch (\Exception $exception)
        {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        try
        {
                $user = Auth::user() ;
                $user->delete();
                $reg = new RegisterController() ;

                $reg->LogOut() ;

                return response()->json([
                    'status' => true,
                    'message' => 'User has been deleted successfully'
                ]);

        } catch (\Exception $exception)
        {
            return  response()->json([
                'status' => false ,
                'message' => $exception->getMessage()
            ]) ;
        }
    }


    public function resetPassword(ResetPasswordRequest $request)
    {

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'password is incorrect.'], 422);
        }

        $user->updatePassword($request->new_password);

        return response()->json(['message' => 'Password has been updated.']);
    }


}
