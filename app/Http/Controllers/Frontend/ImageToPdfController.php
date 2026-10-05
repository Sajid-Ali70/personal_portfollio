<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF; // If you're using barryvdh/laravel-dompdf
use Illuminate\Support\Facades\Storage;
use DB;

class ImageToPdfController extends Controller
{
    public function index(Request $request)
    {
         $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();
        return view('frontend.tools.convert', compact('meta_tag'));
    }

    public function convert(Request $request)
{
    // Validate the uploaded image
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    // Get uploaded image
    $file = $request->file('image');
    $imageName = 'img_' . time() . '.' . $file->getClientOriginalExtension();
    $uploadPath = public_path('uploads/pdf_convert_img/' . $imageName);

    // Ensure the uploads folder exists
    if (!is_dir(public_path('uploads/pdf_convert_img'))) {
        mkdir(public_path('uploads/pdf_convert_img'), 0755, true);
    }

    // Move the image to the public uploads folder
    $file->move(public_path('uploads/pdf_convert_img'), $imageName);

    // Generate the PDF from a view
    $pdf = PDF::loadView('frontend.tools.pdf_view', [
        'imagePath' => $uploadPath
    ]);

    // Set the PDF name and path
    $pdfName = 'converted_' . time() . '.pdf';
    $pdfSavePath = public_path('uploads/pdf_files/' . $pdfName);

    // Ensure the PDF folder exists
    if (!is_dir(public_path('uploads/pdf_files'))) {
        mkdir(public_path('uploads/pdf_files'), 0755, true);
    }

    // Save the PDF to public folder
    $pdf->save($pdfSavePath);

    // Redirect back with PDF link as query param (like background remover)
    return redirect()->to(url()->previous() . '?pdf=' . $pdfName);
}


}

