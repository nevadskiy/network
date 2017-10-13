<?php

namespace App\Http\Controllers;

use Image;
use Hash;
use Storage;
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
            'last_name' => 'required|max:50',
            'avatar' => 'nullable|image|max:1000'
        ]);

        $request->user()->profile()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $imageName = hash('sha1', $request->user()->username) . '.' . $file->extension();
            $image = Image::make($file)->fit(150, null);
            Storage::disk('public')->put('avatars/' . $imageName, $image->encode());
            auth()->user()->profile()->update([
                'avatar' => $imageName
            ]);
        }

        return back()->with('success', 'Profile Updated');
    }

    protected function getView()
    {
        $user = auth()->user()->load('profile');
        return view('profile.edit.edit', compact('user'));
    }


}
