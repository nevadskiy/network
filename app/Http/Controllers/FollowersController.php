<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    protected function protection($user)
    {
        if ($user->id == auth()->id()) {
            return abort(403);
        }
    }

    public function store(User $user)
    {
        $this->protection($user);

        $user->follow();
        return response(['Status' => 'Success']);
    }

    public function destroy(User $user)
    {
        $this->protection($user);

        $user->unfollow();

        return response(['Status' => 'Success']);
    }
}
