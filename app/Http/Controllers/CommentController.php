<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store the comment
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:1000',
        ]);

        // Create the comment
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(), // Make sure the user is authenticated
            'body' => $request->comment,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Your comment has been posted!');
    }


public function destroy(Comment $comment)
{
    // Automatically uses CommentPolicy@delete
    $this->authorize('delete', $comment); 

    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully.');
}

public function update(Request $request, Comment $comment)
{
     // Automatically uses CommentPolicy@update
    $this->authorize('update', $comment);

    $validated = $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $comment->update([
        'body' => $validated['body'],
    ]);

    return redirect()->back()->with('success', 'Comment updated successfully!');
}



}
