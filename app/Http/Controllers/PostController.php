<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /* store new posts */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|in:technology,business,lifestyle',
        ]);

        // Create the post
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'user_id' => auth()->user()->id,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Post created successfully!');
    }

    /* retrive all posts */
   // app/Http/Controllers/PostController.php
public function index()
{
    $posts = Post::with(['user', 'comments'])
                ->withCount('comments')
                ->latest()
                ->get();
    
    return view('dashboard', compact('posts'));
}

public function technology()
{
    $posts = Post::with(['user', 'comments'])
                ->withCount('comments')
                ->where('category', 'technology')
                ->latest()
                ->get();
    
    return view('dashboard', compact('posts'));
}

public function business()
{
    $posts = Post::with(['user', 'comments'])
                ->withCount('comments')
                ->where('category', 'business')
                ->latest()
                ->get();
    
    return view('dashboard', compact('posts'));
}

public function lifestyle()
{
    $posts = Post::with(['user', 'comments'])
                ->withCount('comments')
                ->where('category', 'lifestyle')
                ->latest()
                ->get();
    
    return view('dashboard', compact('posts'));
}

public function showComments(Post $post)
{
    $comments = $post->comments()
                    ->with(['user','post'])
                    ->latest()
                    ->get()
                    ->map(function ($comment) {
                        // Add isAuth parameter to each comment
                        $comment->isAuth = auth()->check() && 
                                          auth()->id() === $comment->user_id;
                        $comment->isPostAuth = auth()->check() && 
                                          auth()->id() === $comment->post->user_id;
                        return $comment;
                    });

    return view('comments', [
        'post' => $post,
        'comments' => $comments
    ]);
}



public function showMainPost(Post $post)
{
    return view('createcomment', [
        'post' => $post,
       
    ]);
}



}
