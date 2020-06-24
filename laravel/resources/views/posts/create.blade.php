@extends('layouts.app')
@section('content')

<div class="card bg-default p-5 mt-5">
  <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group @error('title') is-invalid @enderror">
      <label for="title">募集タイトル</label>
      <input type="text" class="form-control" name="title" >
      @error('title')
        <span class="alert-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-row">
      <div class="form-group col-sm-6 @error('tag_category_id') is-invalid @enderror">
        <label for="tag-category">ペットの種類</label>
        <select class="form-control" name="tag_category_id">
          <option value="" style="display: none;">選択してください</option>
          @foreach ($categoryList as $index => $name)
            <option value="{{ $index }}">{{ $name }}</option>
          @endforeach
        </select>
        @error('tag_category_id')
          <span class="alert-danger">{{ $message }}</span>  
        @enderror
      </div>
      <div class="form-group col-sm-6">
        <label for="gender">性別</label>
        <select name="gender" class="form-control">
          <option value="オス">オス</option>
          <option value="メス">メス</option>
          <option value="不明">不明</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-sm-6">
        <label for="recruit_status">募集状況</label>
        <select name="recruit_status" class="form-control">
          <option value="里親募集中">里親募集中</option>
          <option value="里親決定">里親決定</option>
          <option value="募集終了">募集終了</option>
        </select>
      </div>
      <div class="form-group col-sm-6 @error('prefecture') is-invalid @enderror">
        <label for="tag-category">現在所在地</label>
        <select class="form-control" name="prefecture_id" aria-multiselectable="true">
          <option value="" style="display: none;">選択してください</option>
          @foreach ($prefectureList as $index => $name)
            <option value="{{ $index }}">{{ $name }}</option>
          @endforeach
        </select>
        @error('prefecture')
          <span class="alert-danger">{{ $message }}</span>
        @enderror
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-sm-6 @error('image') is-invalid @enderror">
        <label for="file">写真アップロード</label>
        <p><input type="file" name="image" accept="image/*"></p>
        @error('image')
          <span class="alert-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group col-sm-6">
        <label for="deadline_date">掲載期限</label>
        <input type="date" name="deadline_date" class="form-control">
      </div>
    </div>
    <div class="form-group @error('content') is-invalid @enderror">
      <label for="content">募集経緯</label>
      <textarea class="form-control" name="content" rows="3"></textarea>
      @error('content')
        <span class="alert-danger">{{ $message }}</span>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">送信する</button>
  </form>
</div>
@endsection
