<?php

namespace App\Models\Traits;

use App\Models\User;

trait Followable {
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function follow()
    {
        if (!$this->isFollowed()) {
            $this->followers()->attach(auth()->id());
        }
    }

    public function unfollow()
    {
        if ($this->isFollowed()) {
            return $this->followers()->detach(auth()->id());
        }
        return $this->followers;
    }

    public function isFollowed()
    {
        return $this->followers()->where('follower_id', auth()->id())->exists();
    }

    public function getIsFollowedAttribute()
    {
        return $this->isFollowed();
    }
}