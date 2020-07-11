<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
		public function __construct()
		{
			$this->middleware('auth');
		}

    public function store(Request $request)
    {
        $postId = $request['post_id'];
        Auth::user()->favorite($postId);
        return "store";
    }

    public function destroy(Request $request)
    {
        $postId = $request['post_id'];
        Auth::user()->unfavorite($postId);
        return "destroy";
    }

}
