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
        $user = User::find($userId)->first();
        return view('users.show', compact('user'));
    }
}
