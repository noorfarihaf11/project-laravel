<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\JenisUser;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Log;


class CommentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::all();
        $categories = Category::all();
        $menus = Menu::all();
        $comments = Comment::all();
        return view('/posts/{post:slug}', compact('categories', 'menu_users', 'user', 'menus', 'comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'comments' => 'required|string|max:255',
            'id_post' => 'required|exists:posts,id_post',
            'author_id' => 'required|exists:users,id_user',
        ]);

        // Create the comment
        $comment = Comment::create([
            'comments' => $validatedData['comments'],
            'id_post' => $validatedData['id_post'],
            'author_id' => $validatedData['author_id'],
        ]);

        $post = Post::find($validatedData['id_post']);

        return redirect("/posts/{$post->slug}")->with('success', 'New comments has been added!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_komen' => 'required|integer|exists:comments,id_komen',
            'comments' => 'required|string|max:255'
        ]);

        // Find user by ID
        $comment = Comment::find($request->id_komen);

        Log::info('Updating comment with ID: ' . $request->id_komen);

        if ($comment) {
            $comment->comments = $request->comments;
            $comment->updated_at = now(); // Update timestamp
            $comment->save();

            // Return success response
            return response()->json(['success' => true]);
        }

        // Return error response if user not found
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}
