<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
            'body'    => ['required', 'string']
        ]);

        $data = Comment::create($comment);

        return response()->json([
            'success'  => true,
            'message'  => 'Comment has been added',
            'data'     => $data
        ], 201);
    }

    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'success'  => true,
            'message'  => 'Comment with id: ' . $id . ' has been deleted'
        ], 200);
    }
}
