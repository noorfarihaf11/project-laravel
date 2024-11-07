<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use App\Http\Controllers\UserActivityController;
use App\Models\UserActivity;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $menus = Menu::all();
        $posts = Post::where('author_id', auth()->user()->id_user)->get();
        $user_photos = $user->user_photos;
        return view('dashboard.posts.index', compact('posts','user','menus','user_photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $categories = Category::all();
        $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('dashboard.posts.create', compact('categories', 'menus','user','user_photos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'id_category' => 'required',
            'image' => 'image|file|max:10240',
            'body' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['author_id'] = auth()->user()->id_user;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validatedData);
        
        $this->logUserActivity('Created new post', 'success');

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = auth()->user();
       $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('dashboard.posts.show', compact('post', 'menus','user','user_photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $user = auth()->user();
        $categories = Category::all();
       $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('dashboard.posts.edit', compact('post', 'categories', 'menus','user','user_photos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'id_category' => 'required',
            'image' => 'image|file|max:10240',
            'body' => 'required'
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('image')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['author_id'] = auth()->user()->id_user;

        $post->update($validatedData);

        $this->logUserActivity('Updated post', 'success');

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }

        $post->delete();
        $this->logUserActivity('Deleted new post', 'success');

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    /**
     * Check the unique slug.
     */
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function logUserActivity($description, $status)
    {
        UserActivity::create([
            'description' => $description,
            'status' => $status,
            'id_user' => Auth::id(),
            'delete_mark' => 'N',
        ]);
    
        return redirect('/home');
    }
}
