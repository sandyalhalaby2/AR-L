<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPassword\ResetPasswordRequest;
use App\Http\Requests\Image\ImageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    /**
     * Retrieve the profile of the currently authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        try
        {
            // Get the ID of the currently authenticated user
            $id = Auth::id();
            // Find the user by ID
            $user = User::find($id);

            // Return the user data as JSON
            return response()->json([
                'user' => $user
            ]);

        } catch (\Exception $exception)
        {
            // Handle exceptions and return error message as JSON
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve the profile of a user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function GetUser($id)
    {
        try {
            // Find the user by ID
            $user = User::find($id);
            if ($user)
            {
                // Return the user data as JSON
                return response()->json([
                    'user' => $user
                ], 201);
            } else {
                // Return error message if user does not exist
                return response()->json([
                    'message' => 'User Not Exist'
                ]);
            }
        } catch (\Exception $exception)
        {
            // Handle exceptions and return error message as JSON
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Insert an image for the currently authenticated user.
     *
     * @param  \App\Http\Requests\Image\ImageRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function User_insert_image(ImageRequest $request)
    {
        try
        {
            // Get the ID of the currently authenticated user
            $user_id = Auth::id();
            // Find the user by ID
            $user = \App\Models\User::find($user_id);
            $Image = new ImageController();

            // If the user has an image, delete it from storage
            if ($user['image'] != null)
            {
                $Image->delete_image_from_Storage($user['image']);
            }

            // Store the new user image and get the path
            $path = $Image->store_image_User($request);

            // Update the user's image in the database
            $user->update(['image' => URL::asset('storage/' . $path)]);

            // Return success message as JSON
            return response()->json([
                'status' => true,
                'message' => 'Image are inserted Successfully',
            ]);

        } catch(\Exception $exception)
        {
            // Handle exceptions and return error message as JSON
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Update the profile of the currently authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();
            // Update the user data
            $user->update($request->all());

            // Return success message and updated user data as JSON
            return response()->json([
                'status' => true,
                'message' => 'User has been Updated Successfully',
                'user' => $user
            ]);

        } catch (\Exception $exception)
        {
            // Handle exceptions and return error message as JSON
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Delete the profile of the currently authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        try
        {
            // Get the currently authenticated user
            $user = Auth::user();
            // Delete the user
            $user->delete();
            $reg = new RegisterController();

            // Log the user out
            $reg->LogOut();

            // Return success message as JSON
            return response()->json([
                'status' => true,
                'message' => 'User has been deleted successfully'
            ]);

        } catch (\Exception $exception)
        {
            // Handle exceptions and return error message as JSON
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Reset the password of the currently authenticated user.
     *
     * @param  \App\Http\Requests\ForgotPassword\ResetPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'password is incorrect.'], 422);
        }

        // Update the user's password
        $user->updatePassword($request->new_password);

        // Return success message as JSON
        return response()->json(['message' => 'Password has been updated.']);
    }
}
