<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	protected function search($query) {
		return \DB::table('users')->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->where('username', 'like', '%' . $query .'%')
                ->orWhere(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%' . $query .'%')
                ->limit(5)
                ->get();
	}


    public function results(Request $request)
    {
		$query = $request->input('query');
        if (!$query) {
        	return abort(403);
        };

		$users = $this->search($query);
        return response($users);

    }

    public function index(Request $request) {
    	$query = $request->input('q');
        if (!$query) {
        	back();
        }

        $users = $this->search($query);
        return view('profile.index', compact('users'));
    }
}
