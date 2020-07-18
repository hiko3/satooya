@extends('layouts.app')
@section('content')

<div class="card bg-default p-5 mt-5">
  <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">募集タイトル</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
      @error('title')
        <span class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-row">
      <div class="form-group col-sm-6">
        <label for="tag-category">ペットの種類</label>
        <select class="form-control @error('tag_category_id') is-invalid @enderror" name="tag_category_id" id="parent">
          <option value="" style="display: none;">選択してください(大別)</option>
          @foreach ($categoryList as $index => $name)
            <option value="{{ $index }}" @if (old('tag_category_id') == $index) selected @endif>{{ $name }}</option>
          @endforeach
        </select>
        @error('tag_category_id')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>  
        @enderror
        <select class="form-control @error('sub_category_id') is-invalid @enderror" name="sub_category_id" id="children" data-old_sub_category="{{ old('sub_category_id') }}">
          <option value="">選択してください(小別)</option>
        </select>
        @error('sub_category_id')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>  
        @enderror
      </div>

      <div class="form-group col-sm-6 pl-5">
        <label for="gender">性別</label>
        <div class="form-row">
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="gender" value="オス" @if(old('gender') === 'オス') checked @endif id="custom-radio-1">
            <label class="custom-control-label" for="custom-radio-1">オス</label>
          </div>
          <div class="custom-control custom-radio mx-3">
            <input type="radio" class="custom-control-input" name="gender" value="メス" @if(old('gender') === 'メス') checked @endif id="custom-radio-2">
            <label class="custom-control-label" for="custom-radio-2">メス</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="gender" value="不明" @if(old('gender') === '不明') checked @endif id="custom-radio-3">
            <label class="custom-control-label" for="custom-radio-3">不明</label>
          </div>
          @error('gender')
            <span class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-sm-8">
        <label for="js-multiple" style="display: block">募集対象地域
          <small class="text-muted pl-3">＊複数選択可</small>
        </label>
        <div class="@error('prefecture_id') is-invalid @enderror">
          <select class="form-control" id="js-multiple" name="prefecture_id[]" multiple="multiple">
            <option value="" style="display: none;">選択してください</option>
            @foreach ($prefectureList as $index => $name)
              <option value="{{ $index }}" @foreach((array)old('prefecture_id') as $prefecture)
                @if ($prefecture == $index) selected @endif @endforeach>{{ $name }}
              </option>
            @endforeach
          </select>
        </div>
        @error('prefecture_id')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="file">写真アップロード</label>
        <input type="file" name="image" accept="image/*" id="myfile" class="@error('image') is-invalid @enderror">
        @error('image')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <img id="img-prev" width="200px" height="200px" class="">

      <div class="form-group pt-3">
        <label for="deadline_date">掲載期限
          <small class="text-muted pl-3">1年以内の日付をご指定ください</small>
        </label>
        <input type="date" name="deadline_date" class="form-control @error('deadline_date') is-invalid @enderror"
        value="{{ old('deadline_date') }}">
        @error('deadline_date')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label for="content">説明</label>
      <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3" placeholder="募集経緯、性格、健康状態等">{{ old('content') }}</textarea>
      @error('content')
        <span class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">送信する</button>
  </form>
</div>
@endsection
