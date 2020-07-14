@extends('layouts.app')
@section('content')
  <div class="card">
    <div class="p-3 d-sm-flex">
      <div class="mx-3 d-flex flex-column">
        <img src="https://the-kousatu.com/images/profile_image/profile1.jpeg" class="rounded" width="100" height="100">
        <div class="my-3 d-flex flex-column">
          {{-- <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4> --}}
          <span class="text-secondary">&#064;taro</span>
        </div>
      </div>
      <div class="mx-3 mb-3 d-flex flex-column">
        <div class="d-flex">
          <a href="https://the-kousatu.com/users/1/edit" class="btn btn-primary">プロフィールを編集する</a>
        </div>
        <div class="d-flex">
          <span class="mt-2">testtesttesttesttesttesttesttesttesttesttesttesttesttest</span>
        </div>
      </div>
    </div>
    <div class="">
    <div class="items-wrap p-3">
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
      </div><!-- row -->
    </div><!-- items-wrap -->
    </div>
  </div>
@endsection
