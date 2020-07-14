<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactSendmail;
use App\Models\User;

class ContactController extends Controller
{
    /**
     * お問い合わせページ表示
     *
     * @param [type] $userId
     * @return void
     */
    public function create($userId)
    {
      $user = User::find($userId);
      session(['id' => $user->id]);
      return view('contacts.create', compact('user'));
    }

    public function confirm(Request $request)
    {
      $inputs = $request->all();
      $userId = $request->session()->get('id');
      $user = User::find($userId);
      return view('contacts.confirm', compact('inputs', 'user'));
    }

    public function send(Request $request)
    {
      //フォームから受け取ったactionの値を取得
      $action = $request->input('action');

      //フォームから受け取ったactionを除いたinputの値を取得
      $inputs = $request->except('action');
      // dd($inputs);
      $userId = $request->session()->get('id');
      $user = User::find($userId);

      //actionの値で分岐
      if($action !== 'submit'){
        return redirect()->route('contact.create', $userId)->withInput($inputs);
      } else {
      // 自分のメールアドレスに送信完了メールを送信
      Mail::to(Auth::user()->email)->send(new ContactSendmail([
        'subject' => '送信完了しました(satooya)',
        'title'   => $inputs['type'],
        'name'    => Auth::user()->name,
        'prefecture' => Auth::user()->prefecture->name,
        'gender'  => Auth::user()->gender,
        'body'    => $inputs['body'],
      ]));

      // 相手のメールアドレスにメールを送信
      Mail::to($user->email)->send(new ContactSendmail([
        'subject' => 'satooyaから'.$inputs['type'].'がありました。こちらから直接返信してください。',
        'title' => 'satooyaから'.$inputs['type'].'がありました',
        'name' => Auth::user()->name,
        'prefecture' => Auth::user()->prefecture->name,
        'gender' => Auth::user()->gender,
        'body' => $inputs['body'],
      ]));

      //再送信を防ぐためにトークンを再発行
      $request->session()->regenerateToken();

      //送信完了ページのviewを表示
      return redirect()->route('post.index')->with([
        'msg_success' => 'メール送信完了しました',
        'color'       => 'success',
      ]);

      }
    }

}
