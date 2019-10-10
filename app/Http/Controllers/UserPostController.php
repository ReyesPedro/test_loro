<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;


class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response()->json([
            'data' => $user->posts,
            'message' => 'Documents found'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request, User $user)
    {
        $post = Post::create($request->all());

        $post = $user->posts()->save($post);

        return response()->json([
            'data' => $post,
            'message' => 'Document created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Post $post)
    {
        //Se valida que ambos esten relacionados
        if ($user->_id != $post->user_id) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }
        return response()->json([
            'data' => $post,
            'message' => 'Document found'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, User $user, Post $post)
    {
        //Se valida que ambos esten relacionados
        if ($user->_id != $post->user_id) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        $post->update($request->all());

        return response()->json([
            'data' => $post,
            'message' => 'Document updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Post $post)
    {
        //Se valida que ambos esten relacionados
        if ($user->_id != $post->user_id) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        $post->delete();

        return response()->json(null, 204);
    }
}
