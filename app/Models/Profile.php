<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'gender', 'first_name', 'last_name', 'avatar'];

    public function getFullName()
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
