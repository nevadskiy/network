<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Session;

class CreateProfileForUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {        
        $event->user->profile()->create([
            'gender' => $event->gender,
            'avatar' => 'default/' . ((bool) $event->gender ? 'girl.png' : 'boy.png')
        ]);
        Session::flash('success', 'You successfully registered!');
    }
}
