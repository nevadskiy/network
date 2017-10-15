<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    protected $with = ['profile'];

    protected $appends = ['avatar_url', 'path', 'isFollowed'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
