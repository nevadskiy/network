<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $posts = Post::notReply()->where(function ($query) {
            return $query->where('user_id', auth()->user()->id)
                ->orWhereIn('user_id', auth()->user()->following()->pluck('user_id'));
        })->latest()
            ->paginate(100);

//        $posts = auth()->user()->following()->with(['posts' => function($query) {
//            $query->notReply()->orderBy('id', 'desc')->get();
//        }])->get();

//        $timeline->posts->merge(auth()->user());

//        return $posts;

        return view('dashboard', compact('posts'));
//        return dd($timeline);

//        return Post::notReply()->latest()->where('user_id', )->get();

    }
}
