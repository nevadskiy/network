<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['body', 'user_id'];

    protected $with = ['replies', 'author'];

//    protected static function boot()
//    {
//        parent::boot();
//        static::addGlobalScope('likesCount', function($query) {
//            $query->withCount('likes');
//        });
//    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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
}
