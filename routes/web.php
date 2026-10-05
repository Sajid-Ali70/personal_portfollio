<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\CommentController as DashboardCommentController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\PageController as DashboardPageController;
use App\Http\Controllers\Dashboard\DashboardServiceController;
use App\Http\Controllers\Dashboard\DashboardTeamController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\Dashboard\SocialMediaController;
use App\Http\Controllers\Dashboard\TagController as DashboardTagController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\TagController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/test", [HomeController::class, "test"])->name("test");
Route::name("frontend.")->group(function() {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::get("/blog", [HomeController::class, "blog"])->name("blog");
    Route::get("/services", [HomeController::class, "services"])->name("services");
    Route::get("/search", [SearchController::class, "index"])->name("search");
    Route::get("/post/{slug}", [PostController::class, "index"])->name("post");
    Route::post("/comment/{id}", [CommentController::class, "index"])->name("comment");
    Route::post("/comment-reply", [CommentController::class, "reply"])->name("comment.reply");
    Route::get("/category/{slug}", [CategoryController::class, "index"])->name("category");
    Route::get("/user/{username}", [UserController::class, "index"])->name("user");
    Route::get("/tag/{name}", [TagController::class, "index"])->name("tag");
    Route::get("/page/{slug}", [PageController::class, "index"])->name("page");
});

Route::name("auth.")->group(function() {
    Route::get("/signup", [SignupController::class, "index"])->name("signup");
    Route::post("/signup", [SignupController::class, "signup"])->name("signup.submit");
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::post("/login", [LoginController::class, "login"])->name("login.submit");
    Route::post("/logout", [LogoutController::class, "index"])->name("logout");
});

Route::name("dashboard.")->prefix("/dashboard")->middleware(["auth"])->group(function() {
    // dashboard home
    Route::get("/", [DashboardHomeController::class, "index"])->name("home");

    // vehicle scan route     
Route::prefix('vehicle-plates')->group(function () {
    Route::get('/', [App\Http\Controllers\VehiclePlateController::class, 'index'])->name('vehicle.plates.index');
    Route::post('/scan', [App\Http\Controllers\VehiclePlateController::class, 'scan'])->name('vehicle.plates.scan');
    Route::post('/store', [App\Http\Controllers\VehiclePlateController::class, 'store'])->name('vehicle.plates.store');
    Route::get('/list', [App\Http\Controllers\VehiclePlateController::class, 'list'])->name('vehicle.plates.list');
    Route::get('/recent', [App\Http\Controllers\VehiclePlateController::class, 'recentScans'])->name('vehicle.plates.recent');
    Route::get('/dashboard', [App\Http\Controllers\VehiclePlateController::class, 'dashboard'])->name('vehicle.plates.dashboard');
    Route::get('/{id}/edit', [App\Http\Controllers\VehiclePlateController::class, 'edit'])->name('vehicle.plates.edit');
    Route::put('/{id}', [App\Http\Controllers\VehiclePlateController::class, 'update'])->name('vehicle.plates.update');
    Route::delete('/{id}', [App\Http\Controllers\VehiclePlateController::class, 'destroy'])->name('vehicle.plates.destroy');
});

    // posts
    Route::prefix("/posts")->name("posts.")->controller(DashboardPostController::class)->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/{id}/featured", "featured")->name("featured");
        Route::get("/{id}/comment", "comment")->name("comment");
        Route::get("/trashed", "trashed")->name("trashed");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
    });
    Route::resource("/posts", DashboardPostController::class)->except(["show"]);

    // media
    Route::resource("/media", MediaController::class)->except(["show", "edit", "update"]);

    // comments
    Route::prefix("/comments")->name("comments.")->controller(DashboardCommentController::class)->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/trashed", "trashed")->name("trashed");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
    });
    Route::resource("/comments", DashboardCommentController::class)->only(["index", "show", "destroy"]);

    // categories
    Route::prefix("/categories")->name("categories.")->controller(DashboardCategoryController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/trashed", "trashed")->name("trashed");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
    });
    Route::resource("/categories", DashboardCategoryController::class)->middleware(["admin"]);

    //tags
    Route::prefix("/tags")->name("tags.")->controller(DashboardTagController::class)->middleware(["admin"])->group(function() {
        Route::get("/index", "index")->name("index");
        Route::delete("/{id}/destroy", "destroy")->name("destroy");
    });

    // users
    Route::prefix("/users")->name("users.")->controller(DashboardUserController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
    });
    Route::resource("/users", DashboardUserController::class)->middleware(["admin"]);

    // pages
    Route::prefix("/pages")->name("pages.")->controller(DashboardPageController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/trashed", "trashed")->name("trashed");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
    });
    Route::resource("/pages", DashboardPageController::class)->except(["show"])->middleware(["admin"]);

    // services
    Route::prefix("/services")->name("services.")->controller(DashboardServiceController::class)->middleware(["admin"])->group(function() {
        Route::get("/index", "index")->name("index");        
        Route::get("/create", "create")->name("create");        
        Route::post("/post", "store")->name("store");        
        Route::get("/edit/{id}", "edit")->name("edit");        
        Route::put("/update/{id}", "update")->name("update");        
        Route::delete("/delete/{id}", "destroy")->name("destroy");          
    });    

    // team
    Route::prefix("/team")->name("team.")->controller(DashboardTeamController::class)->middleware(["admin"])->group(function() {
        Route::get("/index", "index")->name("index");        
        Route::get("/create", "create")->name("create");        
        Route::post("/post", "store")->name("store");        
        Route::get("/edit/{id}", "edit")->name("edit");        
        Route::PUT("/update/{id}", "update")->name("update");        
        Route::delete("/delete/{id}", "destroy")->name("destroy");          
    });    

    // settings
    Route::prefix("/settings")->name("settings.")->middleware(["admin"])->group(function() {
        // site settings
        Route::get("/site-settings", [SiteSettingController::class, "index"])->name("site");
        Route::post("/site-settings", [SiteSettingController::class, "update"])->name("site.update");
        // profile update
        Route::get("/profile", [ProfileController::class, "index"])->withoutMiddleware(["admin"])->name("profile");
        Route::post("/profile", [ProfileController::class, "update"])->withoutMiddleware(["admin"])->name("profile.update");

        // banner setting
        Route::get("/banner", [SiteSettingController::class, "banner"])->withoutMiddleware(["admin"])->name("banner");
        Route::get("/banner/delete/{id}", [SiteSettingController::class, "delete_banner"])->withoutMiddleware(["admin"])->name("delete.banner");
        Route::post("/banner_store", [SiteSettingController::class, "store_banner"])->withoutMiddleware(["admin"])->name("banner.store");

        // Seo Management update
        Route::get("/tools/seo-management", [SiteSettingController::class, "seo"])->withoutMiddleware(["admin"])->name("tools.seo");
        Route::post("tools/seo-management/post", [SiteSettingController::class, "postseo"])->withoutMiddleware(["admin"])->name("tools.seo.post");
        Route::put("tools/seo-management/update/{id}", [SiteSettingController::class, "updateseo"])->withoutMiddleware(["admin"])->name("tools.seo.update");
        Route::get("tools/seo-management/status/{id}", [SiteSettingController::class, "status"])->withoutMiddleware(["admin"])->name("tools.seo.status");
        Route::delete("tools/seo-management/delete/{id}", [SiteSettingController::class, "destory"])->withoutMiddleware(["admin"])->name("tools.seo.delete");
        // password change
        Route::get("/change-password", [ProfileController::class, "password"])->withoutMiddleware(["admin"])->name("password");
        Route::post("/change-password", [ProfileController::class, "passwordUpdate"])->withoutMiddleware(["admin"])->name("password.update");
        // social media
        Route::get("/social-media", [SocialMediaController::class, "index"])->name("social.media");
        Route::post("/social-media", [SocialMediaController::class, "add"])->name("social.media.add");
        Route::get("/social-media/{id}/status", [SocialMediaController::class, "status"])->name("social.media.status");
        Route::delete("/social-media/{id}/delete", [SocialMediaController::class, "delete"])->name("social.media.delete");
        // site menu
        Route::get("/menus/header", [MenuController::class, "header"])->name("menus.header");
        Route::post("/menus/header", [MenuController::class, "headerUpdate"])->name("menus.header.update");
        Route::get("/menus/footer", [MenuController::class, "footer"])->name("menus.footer");
        Route::post("/menus/footer", [MenuController::class, "footerUpdate"])->name("menus.footer.update");
    });
});


// tools route start here

route::get('tools/online-calculator', [App\Http\Controllers\Frontend\calculatorController::class, "calculator"])->name("calculator");
route::get('tools/online-age-calcluator', [App\Http\Controllers\Frontend\calculatorController::class, "age_calculator"])->name("age.finder");
route::get('tools/online-percentage-calculator', [App\Http\Controllers\Frontend\calculatorController::class, "percentage_calculator"])->name("percentage_calculator");
route::get('tools/online-base64-encoder', [App\Http\Controllers\Frontend\Encoder_DecoderController::class, "encoder"])->name("encoder");
route::get('tools/online-base64-decoder', [App\Http\Controllers\Frontend\Encoder_DecoderController::class, "decoder"])->name("decoder");
route::get('tools/online-Image-background-remover', [App\Http\Controllers\Frontend\BackgroundRemover::class, "background_remover"])->name("remover");
route::post('/Image_background/remover', [App\Http\Controllers\Frontend\BackgroundRemover::class, "background_remover_process"])->name("image.process");
route::get('tools/online-Image-compress', [App\Http\Controllers\Frontend\ImageCompressController::class, "image_compress"])->name("compress");
route::post('/Image/compress', [App\Http\Controllers\Frontend\ImageCompressController::class, "image_compress_process"])->name("image.compress");

use App\Http\Controllers\Frontend\ImageCropController;

Route::get('tools/online-image-crop', [ImageCropController::class, 'showCropper'])->name('image.crop.show');
Route::post('/image-crop-process', [ImageCropController::class, 'processCrop'])->name('image.crop.process');



use App\Http\Controllers\Frontend\ImageToPdfController;

Route::get('tools/online-image-to-pdf', [ImageToPdfController::class, 'index'])->name('img.pdf');
Route::post('/image_to/pdf', [ImageToPdfController::class, 'convert'])->name('convert.image.pdf');

use App\Http\Controllers\Frontend\PdfToWordController;

Route::get('tools/online-convert-pdf-to-word', [PdfToWordController::class, 'pdf_file']);
Route::post('convert-pdf-to-word', [PdfToWordController::class, 'convertPdfToWord']);

Route::get('tools/online-convert-word-to-pdf', [PdfToWordController::class, 'word_file']);
Route::post('convert-word-to-pdf', [PdfToWordController::class, 'convertwordtopdf']);

use App\Http\Controllers\toolsController;

Route::get('tools/', [toolsController::class, 'tools']);
Route::get('tools/online-credit-card-validator', [toolsController::class, 'validate_card']);
Route::get('tools/online-word-count', [toolsController::class, 'word_count']);
Route::get('tools/online-mb-to-kb', [toolsController::class, 'mb_to_kb']);
Route::get('tools/online-cron-experssion-decode', [toolsController::class, 'cron_decode'])->name('cron.decode');
Route::get('tools/online-uuid-generator', [toolsController::class, 'uuid_generator'])->name('uuid.generator');
Route::get('tools/online-DA-checker', [toolsController::class, 'DA_checker'])->name('DA.checker');
Route::post('/check-da', [toolsController::class, 'checkDA']);
Route::get('tools/online-timestamp-converter', [toolsController::class, 'timestamp_converter'])->name('timestamp.converter');
Route::get('tools/online-Image-to-text', [toolsController::class, 'OCR'])->name('OCR');
Route::get('tools/online-keyword-density-checker', [toolsController::class, 'keyword_density_checker'])->name('key.density.checker');
Route::get('tools/online-meta-tag-analyzer', [toolsController::class, 'meta_tag_analyzer'])->name('meta.tag.analyzer');

// sitemap start here

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Models\Tag;


Route::get('/sitemap.xml', function() {
    $sitemap = Sitemap::create();

    // Home
    $sitemap->add(Url::create('/')->setPriority(1.0));

    // Static Pages
    $pages = Page::where('status', 1)->get();
    foreach($pages as $page){
        $sitemap->add(Url::create("/page/{$page->slug}")->setPriority(0.8));
    }

    // Blog Posts
    $posts = Post::where('status', 1)->get();
    foreach($posts as $post){
        $sitemap->add(Url::create("/post/{$post->slug}")->setLastModificationDate($post->updated_at)->setPriority(0.9));
    }

  

    // Tools SEO Pages
    $tools = DB::table('tools_seo')->get();
    foreach($tools as $tool){
        $sitemap->add(Url::create("/tools/{$tool->page_slug}")->setPriority(0.5));
    }

    return $sitemap->toResponse(request());
});