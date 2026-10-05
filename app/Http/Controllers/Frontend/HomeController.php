<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use DB;

class HomeController extends Controller
{
    public function index() {        
        $randomposts = Post::with('category')
                        ->where('status', true)
                        ->inRandomOrder()
                        ->take(2)
                        ->get();        
        $featuredposts = Post::with(["category", "user"])->where("status", true)->where("is_featured", true)->orderBy("id", "DESC")->limit(10)->get();
        $categories = Category::where("status", true)->orderBy("title", "ASC")->limit(10)->get();
        $services = DB::table('services')->get();        
        $teams = DB::table('teams')->get();        
        // return view("frontend.home.home", compact("randomposts", "featuredposts", "categories", "teams","services"));
        return redirect('/login');
    }
    public function services() {        
        $services = DB::table('services')->get();        
        return view("frontend.home.services", compact("services",));
    }
    public function blog() {
        $tags = DB::table('tags')->get();
        $recentposts = Post::with("category")->where("status", true)->orderBy("id", "DESC")->paginate(10);
        $featuredposts = Post::with(["category", "user"])->where("status", true)->where("is_featured", true)->orderBy("id", "DESC")->limit(10)->get();
        $categories = Category::where("status", true)->orderBy("title", "ASC")->limit(10)->get();
        return view("frontend.page.blog", compact("recentposts", "tags", "featuredposts", "categories"));
    }
    public function test(){
        return view('frontend.post.home');
    }
}
