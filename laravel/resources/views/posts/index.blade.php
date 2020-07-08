@extends('layouts.app')
@section('content')
  <div class="album py-5">
    <form action="{{ route('post.index') }}" class="post-form" method="GET">
      <div class="search-wrap p-3">
        <ul class="nav nav-pills pb-2" id="category-tab">
          <li class="nav-item">
            <a class="btn nav-link category-link active" id="0">すべて</a>
          </li>
          @foreach($categories as $category)
          <li class="nav-item">
            <a class="btn nav-link category-link" id="{{ $category->id }}">{{ $category->name }}</a>
          </li>
          @endforeach
        </ul>
        <input type="hidden" name="tag_category_id" value="{{ old('tag_category_id') }}" id="category-val">
        <div class="form-row">
          <div class="input-group col-md-4">
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
          <div class="input-group col-md-8">
            <div class="input-group-prepend">
              <div class="input-group-text bg-transparent mr-1">募集対象地域</div>
            </div>
            <select name="prefectures[]" class="form-control" id="js-multiple" multiple="multiple">
              @foreach ($prefectureList as $index => $name)
                <option value="{{ $index }}" @if(old('prefectures') == $index) selected @endif>{{ $name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-row mt-1">
          <div class="input-group col-md-4">
            <div class="input-group-prepend">
              <div class="input-group-text bg-transparent mr-1">性別</div>
            </div>
            <select name="gender" class="form-control">
              <option value="">すべて</option>
              <option value="オス">オス</option>
              <option value="メス">メス</option>
            </select>
          </div>
          <div class="input-group col-md-5">
            <input type="text" name="title" class="form-control" placeholder="キーワード">
          </div>
          <div class="input-group col-md-3">
            <button type="submit" class="btn btn-outline-success">検索する</button>
          </div>
        </div>
        <div class="row">
          <ul class="nav nav-tabs pt-3 col-md-9">
            <li class="nav-item"><a href="#" id="new" class="nav-link sort-link active">新着順</a></li>
            <li class="nav-item"><a href="#" id="deadline" class="nav-link sort-link">期限順</a></li>
            <input type="hidden" name="sort" value="" id="sort-val">
          </ul>
          <div class="text-muted col-md-3 py-3 pl-5">{{ $postCount }}件中 1~{{ $posts->count() }}件</div>
        </div>
      </div>
    </form>
    <div class="items-wrap">
      <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              @if (!empty($post->image))
                <img class="card-img-top" src="{{ asset('storage/images/'.$post->image) }}" alt="Card image cap" width="250" height="200">  
              @endif
              <div class="card-body"> 
                <h5 class="card-title">{{ Str::limit($post->title, 20) }}</h5>
                <p class="small">{{ $post->subCategory->name ?? '' }}</p>
                <p class="small">雌雄:
                  @if ($post->gender === 'オス')
                      <i class="fas fa-mars male-color"></i>
                  @elseif($post->gender === 'メス')
                      <i class="fas fa-venus female-color"></i>
                  @else
                      不明
                  @endif
                </p>
                <p class="small">募集地域 : 
                @foreach ($post->prefectures as $prefecture)
                @if (!$loop->first)
                  ,
                @endif
                  {{ $prefecture->name }}
                @endforeach
                </p>
                  <a href="{{ route('post.show', $post->id) }}" class="stretched-link"></a>
                  <p class="small">募集状況 : {{ $post->recruit_status }}</p>
                  <p class="small">{{ $post->deadline_date }}まで</p>
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