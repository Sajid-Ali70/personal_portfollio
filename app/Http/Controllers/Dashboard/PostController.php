<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 3) {
            $posts = Post::with(['category', 'tags', 'user'])->withCount(['comments'])->orderBy('id', 'DESC')->paginate(20);
        } else {
            $posts = Post::with(['category', 'tags', 'user'])->withCount(['comments'])->orderBy('id', 'DESC')->where('user_id', Auth::id())->paginate(20);
        }

        return view('dashboard.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->orderBy('title', 'ASC')->get();
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('dashboard.post.add', compact('categories', 'tags'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'string'],
        'meta_keywords' => ['required', 'string'],
        'meta_description' => ['required', 'string'],
        'slug' => ['required', 'string', 'unique:posts,slug'],
        'content' => ['required', 'string'],
        'category' => ['required', 'exists:categories,id'],
        'tags' => ['nullable', 'array'],
        'featured' => ['nullable', 'boolean'],
        'comment' => ['nullable', 'boolean'],
        'status' => ['required', Rule::in(['0', '1'])],
        'thumbnail' => ['nullable', 'image'],
    ]);

    $imageName = "";
    
    // Upload Thumbnail
    if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
        $image = $request->file('thumbnail');
        $imageName = md5(time().rand(11111, 99999)).'.'.$image->extension();
        $image->move(public_path('uploads/post'), $imageName);
    }

    // Process meta keywords (same as update function)
    $keywords = '';
    $json = json_decode($request->meta_keywords, true);
    
    if (is_array($json)) {
        $keywords = collect($json)
            ->pluck('value')           // get only 'value' field
            ->map(fn ($item) => strtolower(trim($item)))
            ->filter()                 // remove empty
            ->unique()
            ->implode(',');
    } else {
        $keywords = $request->meta_keywords;
    }

    // Create post with all fields (this is what was missing!)
    $post = Post::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'slug' => Str::slug($request->slug),
        'category_id' => $request->category,
        'content' => $request->content,
        'thumbnail' => $imageName,
        'is_featured' => $request->has('featured') ? 1 : 0,
        'enable_comment' => $request->has('comment') ? 1 : 0,
        'status' => Auth::user()->role == 1 ? '0' : $request->status,
        // These three lines were missing!
        'meta_title' => $request->title,
        'meta_description' => $request->meta_description,
        'meta_keywords' => $keywords,
    ]);
    
    $insertedId = $post->id;

    // Attach tags
    if (!empty($validated['tags'])) {
        foreach ($validated['tags'] as $tag) {
            $tag = Tag::firstOrCreate(['name' => Str::lower($tag)]);
            $post->tags()->attach([$tag->id]);
        }
    }

    return redirect()->route('dashboard.posts.index', $insertedId)
                     ->with('success', 'Post created successfully');
}

    public function edit($id)
    {
        $post = Post::with(['tags'])->withCount(['tags'])->find($id);
        if ($post && Gate::allows('update-post', $post)) {
            $categories = Category::where('status', true)->orderBy('title', 'ASC')->get();
            $tags = Tag::orderBy('name', 'ASC')->get();

            return view('dashboard.post.edit', compact('post', 'categories', 'tags'));
        }

        return back()->withErrors('Post not exists!');
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post && Gate::allows('update-post', $post)) {
            $validated = $request->validate([
                'title' => ['required', 'string'],
                'meta_keywords' => ['required', 'string'],
                'meta_description' => ['required', 'string'],
                'slug' => ['required', 'string', Rule::unique('posts', 'slug')->ignore($post->id)],
                'content' => ['required', 'string'],
                'category' => ['required', 'exists:categories,id'],
                'tags' => ['nullable', 'array'],
                'featured' => ['nullable', Rule::in(['0', '1'])],
                'comment' => ['nullable', Rule::in(['0', '1'])],
                'status' => ['required', Rule::in(['0', '1'])],
                'thumbnail' => ['nullable', 'image'],
            ]);
            $json = json_decode($request->meta_keywords, true);

            if (is_array($json)) {
                $keywords = collect($json)
                    ->pluck('value')           // get only 'value' field
                    ->map(fn ($item) => strtolower(trim($item)))
                    ->filter()                 // remove empty
                    ->unique()
                    ->implode(',');
            }
            $post->title = $validated['title'];
            $post->slug = Str::slug($validated['slug']);
            $post->category_id = $validated['category'];
            $post->content = $validated['content'];
            $post->is_featured = Arr::has($validated, 'featured');
            $post->enable_comment = Arr::has($validated, 'comment');
            $post->status = Auth::user()->role == 1 ? '0' : $validated['status'];
            $post->meta_title = $request->title;
            $post->meta_description = $request->meta_description;
            $post->meta_keywords = $keywords;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $imageName = md5(time().rand(11111, 99999)).'.'.$image->extension();
                $image->move(public_path('uploads/post'), $imageName);
                if (File::exists(public_path('uploads/post/'.$post->thumbnail))) {
                    File::delete(public_path('uploads/post/'.$post->thumbnail));
                }
                $post->thumbnail = $imageName;
            }
            $post->save();
            if (Arr::has($validated, 'tags')) {
                $tagArr = [];
                foreach ($validated['tags'] as $tag) {
                    $tag = Tag::firstOrCreate(['name' => Str::lower($tag)]);
                    $tagArr[] = $tag->id;
                }
                $post->tags()->sync($tagArr);
            } else {
                $post->tags()->sync([]);
            }

            return redirect()->route('dashboard.posts.index')->with('success', 'Post updated!');
        }

        return back()->withErrors('Post not exists!');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post && Gate::allows('update-post', $post)) {
            $post->delete();

            return back()->with('success', 'Post deleted!');
        }

        return back()->withErrors('Post not exists!');
    }

    public function status($id)
    {
        $post = Post::find($id);
        if ($post && Gate::allows('update-post', $post)) {
            if (Auth::user()->role == 1) {
                return back()->withErrors("You can't update status!");
            }
            $post->status = $post->status ? '0' : '1';
            $post->save();
            $alert = $post->status ? 'Post published!' : 'Post drafted!';

            return back()->with('success', $alert);
        }

        return back()->withErrors('Post not exists!');
    }

    public function featured($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->is_featured = $post->is_featured ? '0' : '1';
            $post->save();
            $alert = $post->is_featured ? 'Post added to featured!' : 'Post removed from featured!';

            return back()->with('success', $alert);
        }

        return back()->withErrors('Post not exists!');
    }

    public function comment($id)
    {
        $post = Post::find($id);
        if ($post && Gate::allows('update-post', $post)) {
            $post->enable_comment = $post->enable_comment ? '0' : '1';
            $post->save();
            $alert = $post->enable_comment ? 'Post comment enabled!' : 'Post comment disabled!';

            return back()->with('success', $alert);
        }

        return back()->withErrors('Post not exists!');
    }

    public function trashed()
    {
        if (Auth::user()->role == 3) {
            $posts = Post::onlyTrashed()->with(['category' => function ($q) {
                $q->withTrashed();
            }, 'tags', 'user'])->withCount(['comments' => function ($q) {
                $q->withTrashed();
            }])->orderBy('id', 'DESC')->paginate(20);
        } else {
            $posts = Post::onlyTrashed()->with(['category' => function ($q) {
                $q->withTrashed();
            }, 'tags', 'user'])->withCount(['comments' => function ($q) {
                $q->withTrashed();
            }])->orderBy('id', 'DESC')->where('user_id', Auth::id())->paginate(20);
        }

        return view('dashboard.post.trashed', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if ($post && Gate::allows('update-post', $post)) {
            if ($post->category()->withTrashed()->first()->deleted_at) {
                return back()->withErrors('Restore the category first!');
            }
            $post->restore();

            return back()->with('success', 'Post restored!');
        }

        return back()->withErrors('Post not exists!');
    }

    public function delete($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if ($post && Gate::allows('update-post', $post)) {
            if (File::exists(public_path('uploads/post/'.$post->thumbnail))) {
                File::delete(public_path('uploads/post/'.$post->thumbnail));
            }
            $post->tags()->sync([]);
            $post->comments()->forceDelete();
            $post->forceDelete();

            return back()->with('success', 'Post deleted!');
        }

        return back()->withErrors('Post not exists!');
    }
}
