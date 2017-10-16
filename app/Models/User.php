<?php

namespace App\Models;

use App\Models\Traits\Followable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    protected $fillable = [
        'username', 'password',
    ];

    protected $with = ['profile'];

    protected $appends = ['avatar_url', 'path', 'isFollowed'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected function setUsernameAttribute($username)
    {
        $this->attributes['username'] = strtolower($username);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function notReplyPosts() {
        return $this->hasMany(Post::class)->notReply();
    }

    public function isMe()
    {
        return $this->id == auth()->id();
    }

    public function getAvatarUrl() {
        return asset('storage/avatars/' . $this->profile->avatar);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->getAvatarUrl();
    }

    public function getPathAttribute() {
        return '/id' . $this->id;
    }
}
