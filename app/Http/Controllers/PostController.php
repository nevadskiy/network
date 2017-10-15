<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post = null)
    {
        $this->validate($request, [
            'body' => 'required|max:255'
        ]);

        if (is_null($post)) {
            $post = auth()->user()->posts()->create([
                'body' => $request->body,
                'depth' => 0
            ]);
        } else if ($post->depth < 4) {
            $post = $post->replies()->create([
                'body' => $request->body,
                'user_id' => auth()->id(),
                'depth' => $post->depth + 1
            ]);
        } else {
            return abort(403);
        }

        if ($request->expectsJson()) {
            return response($post->load('author'));
        }

        return back();
    }

    // public function storeReply(Request $request, Post $post)
    // {

    //     $this->validate($request, [
    //         'body' => 'required|max:255'
    //     ]);

    //     $reply = $post->replies()->create([
    //         'body' => $request->body,
    //         'user_id' => auth()->id()
    //     ]);

    //     if ($request->expectsJson()) {
    //         return response($reply->load('author'));
    //     }

    //     return back();
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->body = $request->body;
        $post->save();
        return response(['Status' => 'Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return response(['Status' => 'Deleted']);
    }
}
