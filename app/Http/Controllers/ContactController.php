<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactSendmail;
use App\Models\User;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
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

    /**
     * 確認画面表示
     *
     * @param Request $request
     * @return void
     */
    public function confirm(ContactRequest $request)
    {
      $inputs = $request->all();
      $userId = $request->session()->get('id');
      $user = User::find($userId);
      return view('contacts.confirm', compact('inputs', 'user'));
    }

    /**
     * メール送信
     *
     * @param Request $request
     * @return void
     */
    public function send(Request $request)
    {
      $action = $request->input('action');
      $inputs = $request->except('action');
      $userId = $request->session()->get('id');
      $user = User::find($userId);
      if($action !== 'submit'){
        return redirect()->route('contact.create', $userId)->withInput($inputs);
      } else {
      Mail::to(Auth::user()->email)->send(new ContactSendmail([
        'subject' => '送信完了しました(satooya)',
        'title'   => $inputs['type'],
        'name'    => Auth::user()->name,
        'prefecture' => Auth::user()->prefecture->name,
        'gender'  => Auth::user()->gender,
        'body'    => $inputs['body'],
      ]));
      Mail::to($user->email)->send(new ContactSendmail([
        'subject' => 'satooyaから'.$inputs['type'].'がありました。こちらから直接返信してください。',
        'title' => 'satooyaから'.$inputs['type'].'がありました',
        'name' => Auth::user()->name,
        'prefecture' => Auth::user()->prefecture->name,
        'gender' => Auth::user()->gender,
        'body' => $inputs['body'],
      ]));
      $request->session()->regenerateToken();
      return redirect()->route('post.index')->with([
        'msg_success' => 'メール送信完了しました',
        'color'       => 'success',
      ]);

      }
    }

}
