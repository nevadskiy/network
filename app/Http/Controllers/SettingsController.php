<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function account()
    {
        return $this->getView();
    }

    public function profile()
    {
        return $this->getView();
    }

    public function postProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50'
        ]);

        $request->user()->profile()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return back();
    }

    protected function getView()
    {
        $user = auth()->user()->load('profile');
        return view('profile.edit.edit', compact('user'));
    }


}
