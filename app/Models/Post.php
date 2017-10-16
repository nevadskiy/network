<?php

namespace App\Models;

use App\Models\Traits\Likable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likable;

    protected $fillable = ['body', 'user_id', 'depth'];

    protected $with = ['replies', 'author'];

    protected $appends = ['isLiked', 'likes_count'];

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
