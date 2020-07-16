@extends('layouts.app')
@section('content')
  
    <div class="search-wrap p-3 d-sm-flex">
      <div class="mx-3 d-flex flex-column">
        @if ($user->avatar)
          <img src="{{ asset('storage/images/'.$user->avatar) }}" class="rounded" width="100" height="100">
        @else
          <img src="{{ asset('storage/images/user_no-image.png') }}" width="100" height="100" class="rounded">
        @endif
        <div class="my-3 d-flex flex-column">
          <span class="text-secondary">{{ $user->name }}</span>
        </div>
      </div>
      <div class="mx-3 mb-3 d-flex flex-column">
        <div class="d-flex">
          <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">プロフィールを編集する</a>
        </div>
        <div class="d-flex">
          <span class="mt-2">{{ $user->introduction }}</span>
        </div>
      </div>
    </div>
    <form action="{{ route('user.show', $user->id) }}" class="post-form" method="GET">
      <div class="sort-wrap row p-3">
        <ul class="nav nav-tabs pt-3 col-md-9">
          <li class="nav-item"><a href="#" id="" class="nav-link sort-link active">募集</a></li>
          <li class="nav-item"><a href="#" id="favorite" class="nav-link sort-link">お気に入りした募集</a></li>
          <input type="hidden" name="sort" value="" id="sort-val">
        </ul>
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
                @auth
                  @if (Auth::id() !== $post->user->id)
                    @if (Auth::user()->is_favorite($post->id))
                      <button class="btn btn-warning btn-sm favorite mt-3" data-postid="{{ $post->id }}" data-or_favorite="unfavorite">お気に入り解除</button>
                    @else
                      <button class="btn btn-success btn-sm favorite mt-3" data-postid="{{ $post->id }}" data-or_favorite="favorite">お気に入り登録</button>
                    @endif
                  @endif
                @endauth
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->
        @endforeach
      </div><!-- row -->
    </div><!-- items-wrap -->

@endsection
