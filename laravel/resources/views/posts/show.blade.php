@extends('layouts.app')
@section('content')
  <div class="card">
    <div class="card-header d-flex justify-content-around">
      <span class="">あああああああ</span>
      <span class="">掲載期限 : {{ $post->deadline_date }}</span>
    </div>
    <div class="row no-gutters">
      <div class="col-md-4 p-3">
        <img class="card-img-top" src="{{ asset('storage/images/'.$post->image) }}" alt="Card image cap" width="250" height="200"> 
      </div>
      <div class="col-md-8">
        <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
          <p>ペットの種類 : {{ $post->tagCategory->name }}</p>
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
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
@endsection