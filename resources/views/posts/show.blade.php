@extends('layouts.app')
@section('content')
  <div class="card">
    <div class="card-header d-flex justify-content-around">
      <span class="">あああああああ</span>
      <span class="">掲載期限 : {{ $post->deadline_date }}</span>
    </div>
    <div class="row no-gutters">
      <div class="col-md-4 p-3">
        @if (!empty($post->image))
          <img class="card-img-top" src="{{ asset('storage/images/'.$post->image) }}" alt="Card image cap" width="250" height="200">
        @else
          <img class="card-img-top" src="{{ asset('storage/images/noimage.png') }}" alt="Card image cap" width="250" height="200">
        @endif
        @if ($post->user_id === Auth::id())
          <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-primary btn-block mt-3">編集</a>
          <form action="{{ route('post.destroy', $post->id) }}" method="POST" id="delete-form">
            @method('DELETE') @csrf
            <button class="btn btn-outline-danger btn-block mt-3" id="delete">削除</button>
          </form>
        @endif
        @auth
          @if (Auth::id() !== $post->user->id)
            @if (Auth::user()->is_favorite($post->id))
              <button class="btn btn-warning btn-block favorite mt-3" data-postid="{{ $post->id }}" data-or_favorite="unfavorite">お気に入り解除</button>
            @else
              <button class="btn btn-success btn-block favorite mt-3" data-postid="{{ $post->id }}" data-or_favorite="favorite">お気に入り登録</button>
            @endif
            <a href="{{ route('contact.create', $post->user->id) }}" class="btn btn-primary btn-block mt-2 "><small>里親を申し出る・質問する</small></a>
          @endif
          
        @endauth
      </div>
      <div class="col-md-8">
        <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
          <p>種類 : {{ $post->subCategory->name ?? '' }}</p>
          <p>雌雄:
            @if ($post->gender === 'オス')
                <i class="fas fa-mars male-color"></i>
            @elseif($post->gender === 'メス')
                <i class="fas fa-venus female-color"></i>
            @else
                不明
            @endif
          </p>
          <p>募集対象地域 : 
            @foreach ($post->prefectures as $prefecture)
            @if (!$loop->first)
              ,
            @endif
              {{ $prefecture->name }}
            @endforeach
          </p>
          <p class="card-text">説明(募集経緯、性格、健康状態等)</p>
          <p class="card-text">{{ $post->content }}</p>
          <p class="card-text"><small class="text-muted">Last updated {{ $diff }} days ago</small></p>
        </div>
      </div>
    </div>
  </div>
@endsection