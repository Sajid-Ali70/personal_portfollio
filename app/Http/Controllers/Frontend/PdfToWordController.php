<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;

class PdfToWordController extends Controller
{
    public function pdf_file(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.pdf_file_uploader', compact('meta_tag'));
    }

    public function convertPdfToWord(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:20000', // Max file size 10MB
        ]);

        // Retrieve the file
        $file = $request->file('pdf');
        $originalFileName = $file->getClientOriginalName();
        $fileBaseName = pathinfo($originalFileName, PATHINFO_FILENAME);

        // Define new paths
        $pdfUploadPath = public_path('uploads/pdf_upload/');
        $wordUploadPath = public_path('uploads/word_converted/');

        // Create directories if they don't exist
        if (! File::exists($pdfUploadPath)) {
            File::makeDirectory($pdfUploadPath, 0755, true);
        }

        if (! File::exists($wordUploadPath)) {
            File::makeDirectory($wordUploadPath, 0755, true);
        }

        // Move the uploaded PDF to the public/uploads/pdf/ folder
        $pdfFullPath = $pdfUploadPath.$originalFileName;
        $file->move($pdfUploadPath, $originalFileName);

        // Call the Cloudmersive API to convert PDF to Word
        $client = new \GuzzleHttp\Client;
        $apiKey = 'c2e292a9-f2a6-4463-98b2-3a3200232651';
        $url = 'https://api.cloudmersive.com/convert/pdf/to/docx';

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Apikey' => $apiKey,
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($pdfFullPath, 'r'),
                        'filename' => $originalFileName,
                    ],
                ],
            ]);

            // Save the converted Word file
            $wordFileContent = $response->getBody()->getContents();
            $wordFileName = $fileBaseName.'.docx';
            $wordFileFullPath = $wordUploadPath.$wordFileName;

            file_put_contents($wordFileFullPath, $wordFileContent);

            return redirect()->to(url()->previous().'?pdf='.$wordFileName);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Conversion failed: '.$e->getMessage(),
            ], 500);
        }
    }

    public function word_file(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.word_file_uploader', compact('meta_tag'));
    }

    public function convertwordtopdf(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'pdf' => 'required|mimes:docx|max:20000', // Max file size 10MB
        ]);

        // Retrieve the file
        $file = $request->file('pdf');
        $originalFileName = $file->getClientOriginalName();
        $fileBaseName = pathinfo($originalFileName, PATHINFO_FILENAME);

        // Define new paths
        $docxUploadPath = public_path('uploads/docx_upload/');
        $pdfUploadPath = public_path('uploads/pdf_converted/');

        // Create directories if they don't exist
        if (! File::exists($docxUploadPath)) {
            File::makeDirectory($docxUploadPath, 0755, true);
        }

        if (! File::exists($pdfUploadPath)) {
            File::makeDirectory($pdfUploadPath, 0755, true);
        }

        // Move the uploaded PDF to the public/uploads/pdf/ folder
        $docxFullPath = $docxUploadPath.$originalFileName;
        $file->move($docxUploadPath, $originalFileName);

        // Call the Cloudmersive API to convert PDF to Word
        $client = new \GuzzleHttp\Client;
        $apiKey = 'c2e292a9-f2a6-4463-98b2-3a3200232651';
        $url = 'https://api.cloudmersive.com/convert/docx/to/pdf';

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Apikey' => $apiKey,
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($pdfFullPath, 'r'),
                        'filename' => $originalFileName,
                    ],
                ],
            ]);

            // Save the converted Word file
            $pdfFileContent = $response->getBody()->getContents();
            $pdfFileName = $fileBaseName.'.pdf';
            $pdfFileFullPath = $pdfUploadPath.$pdfFileName;

            file_put_contents($pdfFileFullPath, $pdfFileContent);

            return redirect()->to(url()->previous().'?docx='.$pdfFileName);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Conversion failed: '.$e->getMessage(),
            ], 500);
        }
    }
}
