<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * マイページ表示
     *
     * @return void
     */
    public function show(Request $request, $userId)
    {
        $user = User::with(['posts.subCategory', 'posts.prefectures'])->find($userId);
        $input = $request->only('sort');
        // dd($input['sort']);
        if ($input['sort'] ?? '' === 'favorite') {
          $posts = Auth::user()->favorites()->with(['subCategory', 'prefectures', 'user'])->get();
        } else {
          $posts = $user->posts->sortByDesc('updated_at');
        }
        return view('users.show', compact('user', 'posts'));
    }

    /**
     * 会員情報編集ページ
     *
     * @param [type] $userId
     * @return void
     */
    public function edit($userId)
    {
      $user = User::find($userId);
      $prefectureList = $user->prefecture->pluck('name', 'id');
      return view('users.edit', compact('user', 'prefectureList'));
    }

    /**
     * 会員情報更新処理
     *
     * @param Request $request
     * @param [type] $userId
     * @return void
     */
    public function update(Request $request, $userId)
    {
      $user = User::find($userId);
      $inputs = $request->all();
      if (!is_null($request->file('avatar'))) {
        $inputs['avatar'] = $request->file('avatar')->hashName();
        $request->file('avatar')->store('/public/images');
      }
      $user->update($inputs);
      return redirect()->route('user.show', $user->id);
    }

}
