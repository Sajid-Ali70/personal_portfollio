<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use DB;

class BackgroundRemover extends Controller
{
    public function background_remover(Request $request){
        $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();
        return view('frontend.tools.background_remover', compact('meta_tag'));
    }
    public function background_remover_process(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image', // Max 4MB
        ]);

        // Get uploaded file
        $file = $request->file('image');

        // Save temporarily for API upload
        $tempPath = $file->getRealPath();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $apiKey = 'nWFcWNam3fqBBwRAFgQTey1T'; // Replace with your actual Remove.bg API key

        // Send image to Remove.bg API
        $response = Http::withHeaders([
            'X-Api-Key' => $apiKey,
        ])->attach(
            'image_file', file_get_contents($tempPath), $file->getClientOriginalName()
        )->post('https://api.remove.bg/v1.0/removebg', [
            'size' => 'auto',
        ]);

        // Check for successful response
        if ($response->successful()) {
            $uniqueFileName = 'processed-' . uniqid() . '.png';
            $uploadPath = public_path('uploads/remove_bg_img/' . $uniqueFileName);

            // Ensure the uploads folder exists
            if (!is_dir(public_path('uploads/remove_bg_img'))) {
                mkdir(public_path('uploads/remove_bg_img'), 0755, true);
            }

            // Save processed image
            file_put_contents($uploadPath, $response->body());

            return redirect()->to(url()->previous() . '?image=' . $uniqueFileName);
        } else {
            // Handle error response
            return back()->with('error', 'Failed to process the image. Please try again.');
        }
    }
}
