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
        return view('dashboard');
    }

    public function feed() {
        $posts = Post::notReply()->where(function ($query) {
            return $query->where('user_id', auth()->user()->id)
                ->orWhereIn('user_id', auth()->user()->following()->pluck('user_id'));
            })->latest()
            ->paginate(30);
        return $posts;
    }
}
