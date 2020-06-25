@extends('layouts.app')
@section('content')
  
  <div class="album py-5">
    <form action="{{ route('post.index') }}" class="post-form" method="GET">
      <div class="search-wrap p-3">
        <ul class="nav nav-pills pb-2" id="category-tab">
          <li class="nav-item">
            <a class="btn nav-link active" id="0">すべて</a>
          </li>
          @foreach($categories as $category)
          <li class="nav-item">
            <a class="btn nav-link" id="{{ $category->id }}">{{ $category->name }}</a>
          </li>
          @endforeach
        </ul>
        <input type="hidden" name="tag_category_id" value="{{ old('tag_category_id') }}" id="category-val">
        <div class="form-row">
          <div class="input-group col-sm-6">
            <div class="input-group-prepend">
              <div class="input-group-text bg-transparent mr-1">募集状況</div>
            </div>
            <select name="recruit_status" class="form-control">
              <option value="">すべて</option>
              <option value="里親募集中" @if (old('recruit_status') == "里親募集中") selected @endif>里親募集中</option>
              <option value="里親決定" @if (old('recruit_status') == "里親決定") selected @endif>里親決定</option>
              <option value="募集終了" @if (old('recruit_status') == "募集終了") selected @endif>募集終了</option>
            </select>
          </div>
          <div class="input-group col-sm-6">
            <div class="input-group-prepend">
              <div class="input-group-text bg-transparent mr-1">募集対象地域</div>
            </div>
            <select name="prefectures[]" class="form-control" id="js-multiple" multiple="multiple">
              @foreach ($prefectureList as $index => $name)
                <option value="{{ $index }}" @if(old('prefecture_id') == $index) selected @endif>{{ $name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-row mt-1">
          <div class="input-group col-sm-4">
            <div class="input-group-prepend">
              <div class="input-group-text bg-transparent mr-1">性別</div>
            </div>
            <select name="gender" class="form-control">
              <option value="">すべて</option>
              <option value="オス">オス</option>
              <option value="メス">メス</option>
            </select>
          </div>
          <div class="input-group col-sm-5">
            <input type="text" name="title" class="form-control" placeholder="キーワード">
          </div>
          <div class="input-group col-sm-3">
            <button type="submit" class="btn btn-outline-success">検索する</button>
          </div>
        </div>
      </div>
    </form>
    <div class="items-wrap border-top pt-3">
      <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              @if (!empty($post->image))
                <img class="card-img-top img-fluid" src="{{ asset('storage/images/'.$post->image) }}" alt="Card image cap" width="250" height="200">  
              @endif
              <div class="card-body">
                <h5 class="card-title">{{ Str::limit($post->title, 20) }}</h5>
                <p class="small">{{ $post->tagCategory->name }}</p>
                @foreach ($post->prefectures as $prefecture)
                  <p class="small">{{ $prefecture->name }}</p>
                @endforeach
                  <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-outline-secondary stretched-link mt-2">見る</a>
                <p class="small">掲載期限 : {{ $post->deadline_date }}</p>
                <p class="small">募集状況 : {{ $post->recruit_status }}</p>
              </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->
        @endforeach
      </div>
    </div><!-- row -->
    <div class="pagination justify-content-center">
      {{ $posts->appends(request()->input())->links() }}
    </div>
  </div><!-- album -->
@endsection