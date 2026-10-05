<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class calculatorController extends Controller
{
    public function calculator(Request $request){
        $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();                
        return view('frontend.tools.calculator', compact('meta_tag'));
    }
    public function age_calculator(Request $request){
        $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();   
        return view('frontend.tools.age_calculator', compact('meta_tag'));
    }
    public function percentage_calculator(Request $request){
        $tools_slug=$request->segment(2);
        $meta_tag = DB::table('tools_seo')->where('page_slug', $tools_slug)->first();   
        return view('frontend.tools.percentage_calculator', compact('meta_tag'));
    }
}
