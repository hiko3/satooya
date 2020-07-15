@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header">{{ __('会員情報編集') }}</div>
  <div class="card-body">
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ニックネーム') }}</label>
      
        <div class="col-md-6">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
      
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      
      <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
        <div class="col-md-6">
          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="name" autofocus>
      
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
  
      <div class="form-group row">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('性別') }}</label>
  
        <div class="col-md-6">
          <div class="form-row">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" name="gender" value="男性" checked id="custom-radio-1">
              <label class="custom-control-label" for="custom-radio-1">男性</label>
            </div>
            <div class="custom-control custom-radio mx-3">
              <input type="radio" class="custom-control-input" name="gender" value="女性" id="custom-radio-2">
              <label class="custom-control-label" for="custom-radio-2">女性</label>
            </div>
          </div>
          @error('gender')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
  
      <div class="form-group row">
        <label for="prefecture_id" class="col-md-4 col-form-label text-md-right">{{ __('都道府県') }}</label>
  
        <div class="col-md-6">
          <select name="prefecture_id" class="form-control">
            <option value="" style="display: none;">選択してください</option>
            @foreach ($prefectureList as $index => $name)
              <option value="{{ $index }}" @if ($user->prefecture_id === $index) selected @endif>{{ $name }}</option>
            @endforeach
          </select>
          @error('prefecture')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('アバター') }}</label>
        <div class="col-md-6">
          <p><input type="file" name="avatar" accept="image/*" id="myfile"></p>
          @error('avatar')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <img src="{{ asset('storage/images/'.$user->avatar) ?? ''}}" id="img-prev" width="200" height="200">
        </div>
      </div>

      <div class="form-group row">
        <label for="introduction" class="col-md-4 col-form-label text-md-right">{{ __('紹介文') }}</label>
      
        <div class="col-md-6">
          <textarea id="introduction" type="text" class="form-control @error('introduction') is-invalid @enderror" name="introduction" autocomplete="introduction" autofocus rows="5">
            {{ $user->introduction ?? '' }}
          </textarea>
      
          @error('introduction')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
  
      <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary">
            {{ __('登録') }}
          </button>
        </div>
      </div>

    </form>
  </div>
</div>
@endsection