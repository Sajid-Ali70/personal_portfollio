<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function index() {
        $sitesettings = SiteSetting::first();
        return view("dashboard.setting.site", compact("sitesettings"));
    }

    public function update(Request $request) {
        $validated = $request->validate([
            "site_title" => ["required", "string", "min:2", "max:255"],
            "email" => ["string", "min:2", "max:255"],
            "phone" => ["string", "max:13"],
            "introduction" => ["string", "min:2"],
            "about_description" => ["string", "min:2"],
            "script" => ["string", "min:2"],
            "tagline" => ["required", "string", "min:2", "max:255"],
            "description" => ["required", "string", "min:2"],
            "copyright_text" => ["required", "string", "min:2",],
            "enable_registration" => ["nullable", "integer"],            
            "logo_light" => ["nullable", "image"],
        ]);
        $sitesettings = SiteSetting::first();
        $sitesettings->site_title = $validated["site_title"];
        $sitesettings->site_email = $validated["email"];
        $sitesettings->site_phone = $validated["phone"];
        $sitesettings->site_introduction = $validated["introduction"];
        $sitesettings->about_description = $validated["about_description"];
        $sitesettings->script = $validated["script"];
        $sitesettings->tagline = $validated["tagline"];
        $sitesettings->description = $validated["description"];
        $sitesettings->copyright_text = $validated["copyright_text"];
        $sitesettings->enable_registration = Arr::has($validated, "enable_registration") ? "1" : "0";
        if (Arr::has($validated, "logo_dark")) {
            $image = $request->file("logo_dark");
            $imageName = "logo_dark_".Str::random(5).".".$image->extension();
            $image->move(public_path("uploads/logo"), $imageName);
            if (File::exists(public_path("uploads/logo/".$sitesettings->logo_dark))) {
                File::delete(public_path("uploads/logo/".$sitesettings->logo_dark));
            }
            $sitesettings->logo_dark = $imageName;
        }
        if (Arr::has($validated, "logo_light")) {
            $image = $request->file("logo_light");
            $imageName = "logo_light_".Str::random(5).".".$image->extension();
            $image->move(public_path("uploads/logo"), $imageName);
            if (File::exists(public_path("uploads/logo/".$sitesettings->logo_light))) {
                File::delete(public_path("uploads/logo/".$sitesettings->logo_light));
            }
            $sitesettings->logo_light = $imageName;
        }
        $sitesettings->save();
        return back()->with("success", "Site Settings updated!");
    }


     public function seo() {
        $sitesettings = SiteSetting::first();
        $seos = DB::table('tools_seo')->get();
        return view("dashboard.setting.tools.seo", compact("sitesettings", "seos"));
        // return 'hello';
    }
    public function postseo(Request $request)
    {
        $request->validate([
            'page_slug' => 'required|unique:tools_seo,page_slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        // Upload OG Image
        if ($request->hasFile('og_image')) {

            $image = $request->file('og_image');

            $imageName = time().'_'.Str::slug($request->page_slug).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/tools/og-images'), $imageName);
        }

        // Insert Data
        Db::table('tools_seo')->insert([
            'page_slug' => Str::slug($request->page_slug),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'tools_description' => $request->tool_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $imageName,
        ]);

        return redirect()
                ->back()
                ->with('success', 'SEO Added Successfully!');
    }
   public function updateseo(Request $request, $id)
    {
        $seo = DB::table('tools_seo')->where('id', $id)->first();

        $request->validate([
            'page_slug' => 'required|unique:tools_seo,page_slug,'.$seo->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $seo->og_image; // keep old image by default

        if ($request->hasFile('og_image')) {
            // Delete old image
            if ($seo->og_image && file_exists(public_path('uploads/seo/'.$seo->og_image))) {
                unlink(public_path('uploads/seo/'.$seo->og_image));
            }

            $image = $request->file('og_image');
            $imageName = time().'_'.Str::slug($request->page_slug).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/tools/og-images'), $imageName);
        }

        DB::table('tools_seo')->where('id', $id)->update([
            'page_slug' => Str::slug($request->page_slug),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'tools_description' => $request->tool_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $imageName,
        ]);

        return redirect()
            ->back()
            ->with('success', 'SEO updated successfully!');
    }

    public function destory($id){
        DB::table('tools_seo')->where('id', $id)->delete();
        return back()->with("success", "SEO record deleted!");        
    }

    public function banner(){
        $banners = DB::table('banners')->get();
        return view('dashboard.setting.banner.index', compact('banners'));
    }
    public function store_banner(Request $request)
    {

        $request->validate([
            'image' => 'required|image',
            'alt_text' => 'nullable|string|max:255'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/banners'), $imageName);

        DB::table('banners')->insert([
            'image' => $imageName,
            'alt_text' => $request->alt_text,          
        ]);

        return redirect()->back()->with('success', 'Banner Added Successfully');
    }


    public function delete_banner($id)
    {
        $banner = DB::table('banners')->where('id',$id)->first();

        if($banner){
            $path = public_path('uploads/banners/'.$banner->image);
            if(file_exists($path)){
                unlink($path);
            }

            DB::table('banners')->where('id',$id)->delete();
        }

        return redirect()->back()->with('success','Banner Deleted Successfully');
    }
}
