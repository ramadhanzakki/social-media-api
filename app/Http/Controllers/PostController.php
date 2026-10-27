<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
                        ->latest()
                        ->get();

        return response()->json([
            'status' => true,
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'title'   => ['required', 'string', 'max:255'],
            'body'    => ['nullable'],
            'image_url' => ['string', 'nullable']
        ]);

        if ($validated->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Input invalid'
            ], 400);
        }

        $post = Post::create([
            'user_id' => $request->user_id,
            'title'   => $request->title,
            'body'    => $request->body,
            'image_url' => $request->image_url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Success added new post',
            'data'    => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'success' => true,
            'data'    => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
