<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePost  $request
     * @return Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated);
        $post['user_id'] = User::first()->id;
        $post->save();
        return response('Successfully created new post.', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return Post
     */
    public function show(Post $post)
    {
        if($post == null)
            abort(404, "Post not found.");
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
        if($post == null)
            abort(404, "Post not found.");
        $validated = $request->validated();
        $post->update($validated);
        return response("Successfully updated post $post->id.", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post == null)
            abort(404, "Post not found.");
        $post->delete();
        return response("Successfully deleted post $post->id", 200);
    }
}
