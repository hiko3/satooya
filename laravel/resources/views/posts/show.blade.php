@extends('layouts.app')
@section('content')
  <h1>{{ $post->title }}</h1>
  <div class="card">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img class="card-img-top img-fluid" src="{{ asset('storage/images/'.$post->image) }}" alt="Card image cap" width="250" height="200"> 
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
@endsection