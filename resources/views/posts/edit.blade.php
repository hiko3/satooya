@extends('layouts.app')
@section('content')

<div class="card bg-default p-5 mt-5">
  <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-group">
      <label for="title">募集タイトル</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
      value="{{ old('title', $post->title) }}">
      @error('title')
        <span class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-row">
      <div class="form-group col-sm-6">
        <label for="tag-category">ペットの種類</label>
        <select class="form-control @error('tag_category_id') is-invalid @enderror" name="tag_category_id" id="parent" data-post_id="{{ $post->id }}">
          <option value="" style="display: none;">選択してください(大別)</option>
          @foreach ($categoryList as $index => $name)
            <option value="{{ old('tag_category_id', $index) }}" @if (old('tag_category_id', $post->tag_category_id) == $index) selected @endif>{{ $name }}</option>
          @endforeach
        </select>
        @error('tag_category_id')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>  
        @enderror
        <select class="form-control @error('sub_category_id') is-invalid @enderror" name="sub_category_id" id="children"
        data-old_sub_category="{{ old('sub_category_id') }}">
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
            <input type="radio" class="custom-control-input" name="gender" value="オス" id="custom-radio-1"
            @if (old('gender', $post->gender) === 'オス') checked @endif>
            <label class="custom-control-label" for="custom-radio-1">オス</label>
          </div>
          <div class="custom-control custom-radio mx-3">
            <input type="radio" class="custom-control-input" name="gender" value="メス" id="custom-radio-2"
            @if (old('gender', $post->gender) === 'メス') checked @endif>
            <label class="custom-control-label" for="custom-radio-2">メス</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="gender" value="不明" id="custom-radio-3"
            @if (old('gender', $post->gender) === '不明') checked @endif>
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
      <div class="form-group col-sm-4">
        <label for="recruit_status">募集状況</label>
        <select name="recruit_status" class="form-control">
          <option value="里親募集中" @if (old('recruit_status', $post->recruit_status) === '里親募集中') selected @endif>里親募集中</option>
          <option value="里親決定" @if (old('recruit_status', $post->recruit_status) === '里親決定') selected @endif>里親決定</option>
          <option value="募集終了" @if (old('recruit_status', $post->recruit_status) === '募集終了') selected @endif>募集終了</option>
        </select>
        @error('recruit_status')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group col-sm-8">
        <label for="js-multiple" style="display: block">募集対象地域
          <small class="text-muted pl-3">＊複数選択可</small>
        </label>
        <div class="@error('prefecture_id') is-invalid @enderror">
          <select class="form-control" id="js-multiple" name="prefecture_id[]" multiple="multiple">
            <option value="" style="display: none;">選択してください</option>
            @foreach ($prefectureList as $index => $name)
              <option value="{{ $index }}" @foreach($post->prefectures as $prefecture)
                @if (empty(old('prefecture_id')) && $prefecture->id === $index) selected
                @elseif (in_array($index, (array)old('prefecture_id'))) selected
                @endif @endforeach>{{ $name }}
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
      <div class="form-group col-xs-6">
        <label for="file">写真アップロード</label>
        <p><input type="file" name="image" accept="image/*" id="myfile" class="@error('image') is-invalid @enderror"></p>
        @error('image')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <img src="{{ asset('storage/images/'.$post->image) ?? '' }}" id="img-prev" width="200" height="200"> 

      <div class="form-group pt-3">
        <label for="deadline_date">掲載期限
          <small class="text-muted pl-3">1年以内の日付をご指定ください</small>
        </label>
        <input type="date" name="deadline_date" class="form-control @error('deadline_date') is-invalid @enderror"
        value="{{ old('deadline_date', $post->deadline_date) }}">
        @error('deadline_date')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <label for="content">説明</label>
      <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3" placeholder="募集経緯、性格、健康状態等">
        {{ old('content', $post->content) }}
      </textarea>
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
