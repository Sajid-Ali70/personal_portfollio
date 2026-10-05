<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use DB;

class Encoder_DecoderController extends Controller
{
    public function encoder(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.encoder', compact('meta_tag'));
    }

    public function decoder(Request $request)
    {
        $tools_slug = $request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();

        return view('frontend.tools.decoder', compact('meta_tag'));
    }
}
