@extends('layouts.app')
@section('content')
  <div class="album py-5">
    @include('posts.search')
    <div class="items-wrap">
      <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            @if (!empty($post->image))
              <img class="card-img-top" src="{{ asset('storage/images/'.$post->image) }}" alt="Card image cap" width="250" height="200">  
            @else
              <img class="card-img-top" src="{{ asset('storage/images/noimage.png') }}" alt="Card image cap" width="250" height="200">
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
                      <button class="btn btn-warning btn-sm favorite" data-postid="{{ $post->id }}" data-or_favorite="unfavorite">お気に入り解除</button>
                    @else
                      <button class="btn btn-success btn-sm favorite" data-postid="{{ $post->id }}" data-or_favorite="favorite">お気に入り登録</button>
                    @endif
                  @endif
                @endauth
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->
        @endforeach
      </div><!-- row -->
    </div><!-- items-wrap -->
    <div class="pagination justify-content-center">
      {{ $posts->appends(request()->input())->links() }}
    </div>
  </div><!-- album -->
@endsection
