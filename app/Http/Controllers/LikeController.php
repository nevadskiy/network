<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $post->like();

        return response(['Status' => 'Liked']);
    }

    public function destroy(Post $post)
    {
        $post->unlike();

        return response(['Status' => 'Unliked']);
    }
}