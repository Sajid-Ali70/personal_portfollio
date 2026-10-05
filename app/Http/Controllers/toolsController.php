<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class toolsController extends Controller
{
    public function tools(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.home.tools', compact('meta_tag'));
    }
    public function validate_card(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.card_validate', compact('meta_tag'));
    }

    public function word_count(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.word_count', compact('meta_tag'));
    }

    public function mb_to_kb(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.MB_to_KB_calculator', compact('meta_tag'));
    }

    public function cron_decode(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.cron_convert', compact('meta_tag'));
    }

    public function uuid_generator(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.uuid_generator', compact('meta_tag'));
    }

    public function DA_checker(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.DA_checker', compact('meta_tag'));
    }

    public function timestamp_converter(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.timestamp_convert', compact('meta_tag'));
    }

    public function ocr(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.OCR', compact('meta_tag'));
    }

    public function keyword_density_checker(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.keyword_density_checker', compact('meta_tag'));
    }

    public function meta_tag_analyzer(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.meta_tag_analyzer', compact('meta_tag'));
    }

    public function checkDA(Request $request)
    {
        $domains = $request->domains;

        $results = [];

        foreach ($domains as $domain) {

            $response = Http::post('https://lsapi.seomoz.com/v2/url_metrics', [
                'targets' => [$domain],
            ], [
                'Authorization' => 'Bearer YOUR_MOZ_API_KEY',
            ]);

            $data = $response->json();

            $results[] = [
                'domain' => $domain,
                'da' => $data['results'][0]['domain_authority'] ?? 'N/A',
            ];
        }

        return response()->json($results);
    }
}
