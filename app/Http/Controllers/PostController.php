<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

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
     * @return JsonResponse
     */
    public function store(StorePost $request)
    {

        $post = Post::create($request->validated());
        $request->user()->posts()->save($post);
        return response()->json([
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return Post
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StorePost $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json([
            'data' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response("Successfully deleted post $post->id", 200);
    }
}
