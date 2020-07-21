@extends('layouts.app')
@section('content')

  <div class="card p-3">
    <form method="POST" action="{{ route('contact.confirm') }}">
    @csrf
    @if ($user->avatar)
      <h2>以下の内容を掲載者 <img src="{{ $user->avatar }}">{{ $user->name }}さんに送信します</h2>  
    @else
      <h2>以下の内容を掲載者 <img src="{{ Storage::disk('s3')->url('user_no-image.png') }}" width="30" height="30">{{ $user->name }}さんに送信します</h2> 
    @endif
  
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">件名</th>
          <td>
            <select name="type" class="@error('type') is-invalid @enderror">
              <option value="" style="display: none;">選択してください</option>
              <option value="里親の申し込み" @if (old('type') == "里親の申し込み") selected @endif>里親の申し込み</option>
              <option value="質問・お問い合わせ" @if (old('type') == "質問・お問い合わせ") selected @endif>質問・お問い合わせ</option>
            </select>
            @error('type')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </td>
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
  
    <div class="form-group">
      <label>申し込み・お問い合わせメッセージ</label>
      <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="10">{{ old('body') }}</textarea>
      @error('body')
        <span class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  
    <button type="submit" class="btn btn-primary">
      入力内容確認
    </button>
  </form>
  </div>
@endsection