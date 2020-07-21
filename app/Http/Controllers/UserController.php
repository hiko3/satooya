<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if ($input['sort'] ?? '' === 'favorite') {
          $posts = $user->favorites()->with(['subCategory', 'prefectures', 'user'])->get();
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
    public function update(UserRequest $request, $userId)
    {
      $user = User::find($userId);
      $inputs = $request->all();
      if (!is_null($request->file('avatar'))) {
        if (app()->isLocal()) {
          $path = $request->file('avatar')->store('/public/images');
          $inputs['avatar'] = Storage::url($path);
        } else {
          $path = Storage::disk('s3')->putFile('/', $request->file('avatar'), 'public');
          $inputs['avatar'] = Storage::disk('s3')->url($path);
        }
      }
      $user->update($inputs);
      return redirect()->route('user.show', $user->id);
    }

}
