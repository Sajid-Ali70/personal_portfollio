<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use DB;
use Intervention\Image\Drivers\Gd\Driver; // 👈 use GD driver

class ImageCompressController extends Controller
{
    public function image_compress(Request $request)
    { 
        $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();
        return view('frontend.tools.image_compress', compact('meta_tag'));
    }

    public function image_compress_process(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
    ]);

    $image = $request->file('image');
    $filename = time() . '.' . $image->getClientOriginalExtension();

    // ✅ Correct way to create ImageManager in v3
    $manager = new ImageManager(new Driver());

    // Compress the image
    $compressedImage = $manager->read($image->getPathname())
        ->resize(800, null)
        ->toJpeg(75);

    // ✅ Make sure the folder exists
    $folderPath = public_path('uploads/compressed_img');
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0755, true);
    }

    // ✅ Save the image in the correct path
    $path = $folderPath . '/' . $filename;
    file_put_contents($path, $compressedImage->toString());

    // Optional: return only the relative path for better frontend handling
    $relativePath = 'uploads/compressed_img/' . $filename;

    return redirect()->to(url()->previous() . '?image=' . $relativePath);
}

}
