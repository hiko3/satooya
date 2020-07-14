@extends('layouts.app')

@section('content')

<div class="card p-3">
  <form method="POST" action="{{ route('contact.send') }}">
      @csrf
      <h2>以下の内容を掲載者{{ $user->name }}さんに送信します</h2>  
      <table class="table">
        <tbody>
          <tr>
            <th scope="row">件名</th>
            <td>{{ $inputs['type'] }}</td>
          </tr>
          <tr>
            <th scope="row">ニックネーム</th>
            <td>{{ Auth::user()->name }}</td>
          </tr>
          <tr>
            <th scope="row">お住まいの地域</th>
            <td>{{ Auth::user()->prefecture->name }}</td>
          </tr>
          <tr>
            <th scope="row">性別</th>
            <td>{{ Auth::user()->gender }}</td>
          </tr>
        </tbody>
      </table>
  
      <label>申し込み・お問い合わせメッセージ</label>
      <div>
        {!! nl2br(e($inputs['body'])) !!}
      </div>
      <input type="hidden" name="type" value="{{ $inputs['type'] }}">
      <input type="hidden" name="body" value="{{ $inputs['body'] }}">
  
      <button type="submit" name="action" value="back" class="btn btn-warning">
          入力内容修正
      </button>
      <button type="submit" name="action" value="submit" class="btn btn-success">
          送信する
      </button>
  </form>
</div>
@endsection