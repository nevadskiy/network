<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    public function destroy(User $user, Post $post) {
    	return $this->filter($post, $user->id);
    }

    /**
     * Recursion check if user can delete current post
     * If current comment belongs to auth user comment,
     * then user can delete it.
     */
    public function filter($post, $userId) {
    	if ($post->user_id == $userId) {
    		return true;
    	}
    	if($post->depth) {
    		return $this->filter($post->parent()->first(), $userId);
    	}
    	return false;
    }
}
