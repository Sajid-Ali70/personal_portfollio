<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class ImageCropController extends Controller
{
    public function showCropper(Request $request)
    {
         $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();
        return view('frontend.tools.image_cropper', compact('meta_tag'));
    }

    public function processCrop(Request $request)
    {
        if (!$request->hasFile('cropped_image')) {
            return response()->json(['error' => 'No image uploaded'], 400);
        }

        $image = $request->file('cropped_image');
        $filename = time() . '_cropped.jpg';

        $folder = public_path('uploads/cropped');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $path = $folder . '/' . $filename;
        $image->move($folder, $filename);

        return response()->json([
            'success' => true,
            'path' => asset('uploads/cropped/' . $filename)
        ]);
    }

}

