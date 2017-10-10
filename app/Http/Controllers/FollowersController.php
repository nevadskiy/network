<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function store(User $user)
    {
        $user->follow();
        return back();
    }

    public function destroy(User $user)
    {
        //policy to denay followin myself

        $user->unfollow();

        return back();
    }
}
