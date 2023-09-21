<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    public function store_image_User(Request $request)
    {
        $image = $request->file('image');

        //Get FileName with extension
        $filenameWithExt = $image->getClientOriginalName();

        //Get FileName without Extension
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //Get Extension
        $Extension = $image->getClientOriginalExtension();

        //New_File_Name
        $NewfileName = $filename . '_' . time() . '_.' . $Extension;

        //Upload Image
        return $path = $image->storeAs('images', $NewfileName, 'public');
    }



    public function delete_image_from_Storage($image)
    {
        $url = $image;
        $base_url = "http://127.0.0.1:8000/storage";

        // Check if the URL contains the base URL
        if (strpos($url, $base_url) === 0) {
            $path = substr($url, strlen($base_url)); // Remove the base URL from the path
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path); // Delete the file
                return "Image deleted successfully.";
            } else {
                return "Image not found.";
            }
        } else {
            return "Invalid URL.";
        }
    }
}
