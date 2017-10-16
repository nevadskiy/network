<?php

namespace App\Models\Traits;

use App\Models\User;

trait Likable {
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function like()
    {
        if (!$this->isLiked()) {
            $this->likes()->attach(auth()->id());
        }
    }

    public function unlike()
    {
        if ($this->isLiked()) {
            $this->likes()->detach(auth()->id());
        }
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}