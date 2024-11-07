<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function like(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'id_post' => 'required|integer',
        ]);

        // Get the post by slug
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found.'], 404);
        }

        // Create the like only if it doesn't already exist
        $like = Like::where('id_post', $validatedData['id_post'])
            ->where('author_id', auth()->id())
            ->first();

        if (!$like) {
            // If not liked yet, create a new like
            Like::create([
                'id_post' => $validatedData['id_post'],
                'author_id' => auth()->id(),
            ]);

            return response()->json(['success' => true, 'message' => 'Post liked successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'You have already liked this post.'], 409);
    }

    public function unlike($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $like = $post->likes()->where('author_id', auth()->id())->first();

        if (!$like) {
            return response()->json(['success' => false, 'message' => 'You have not liked this post.'], 400);
        }

        $like->delete(); // Menghapus like
        return response()->json(['success' => true, 'message' => 'Post unliked successfully!']);
    }
}
