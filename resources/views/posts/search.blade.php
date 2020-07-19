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
          <div class="input-group-text rounded-pill bg-transparent mr-1">募集状況</div>
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
          <div class="input-group-text rounded-pill bg-transparent mr-1">募集対象地域</div>
        </div>
        <select name="prefectures[]" class="form-control" id="js-multiple" multiple="multiple">
          @if (old('prefectures'))
            @foreach ($prefectureList as $index => $name)
              <option value="{{ $index }}"
              {{ in_array((string)$index, old("prefectures"), true) ? "selected" : "" }}>{{ $name }}
              </option>
            @endforeach
          @else
            @foreach ($prefectureList as $index => $name)
              <option value="{{ $index }}">{{ $name }}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="form-row mt-1">
      <div class="input-group col-md-4">
        <div class="input-group-prepend">
          <div class="input-group-text rounded-pill bg-transparent mr-1">性別</div>
        </div>
        <select name="gender" class="form-control">
          <option value="">すべて</option>
          <option value="オス">オス</option>
          <option value="メス">メス</option>
        </select>
      </div>
      <div class="input-group col-md-5">
        <input type="text" name="title" class="form-control"  value="{{ old('title') }}" placeholder="キーワード">
      </div>
      <div class="input-group col-md">
        <button type="submit" class="btn btn-outline-success"><i class="fas fa-search pr-1"></i>検索</button>
      </div>
      <div class="input-group col-md">
        <a href="{{ route('post.index') }}" class="btn btn-outline-secondary">クリア</a>
      </div>
    </div>
  </div>
  <div class="sort-wrap row p-3">
    <ul class="nav nav-tabs pt-3 col-md-9">
      <li class="nav-item"><a href="#" id="new" class="nav-link sort-link active">新着順</a></li>
      <li class="nav-item"><a href="#" id="deadline" class="nav-link sort-link">期限順</a></li>
      <input type="hidden" name="sort" value="" id="sort-val">
    </ul>
    <div class="text-muted col-md-3 py-3 pl-5">{{ $postCount }}件中 1~{{ $posts->count() }}件</div>
  </div>
</form>