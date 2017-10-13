<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $gender)
    {
        $this->user = $user;
        $this->gender = $gender;
    }
}
