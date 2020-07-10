<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * マイページ表示
     *
     * @return void
     */
    public function show($userId)
    {
        $posts = User::find($userId)->posts->sortByDesc('updated_at');
        return view('users.show', compact('posts'));
    }
}
