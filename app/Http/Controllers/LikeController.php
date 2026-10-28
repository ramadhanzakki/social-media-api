<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $like = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id']
        ]);

        $data = Like::create($like);

        return response()->json([
            'success'  => true,
            'message'  => 'You like this post',
            'data'     => $data
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $like = Like::findOrFail($id);
        $like->delete();

        return response()->json([
            'success'  => true,
            'message'  => "Unliked"
        ], 200);
    }
}
