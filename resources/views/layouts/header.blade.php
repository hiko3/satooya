
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ route('post.index') }}">
        <i class="fas fa-paw pr-1"></i>{{ config('app.name') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @guest
        <ul class="navbar-nav ml-auto">
          <li class="nav-items">
            <a class="btn btn-outline-success" href="{{ route('login.guest') }}">ゲストユーザーとしてログインする（全機能使用可能）</a>
          </li>
        </ul>
        @endguest

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @auth
              <a class="nav-link" href="{{ route('post.create') }}"><i class="fas fa-upload pr-2 pt-2"></i>募集する</a>
          @endauth
          @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt pr-1"></i>{{ __('ログイン') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus pr-1"></i>{{ __('会員登録') }}</a>
              </li>
            @endif
          @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              @if (Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" width="35" height="35" class="rounded">
              @else
                <img src="{{ Storage::disk('s3')->url('user_no-image.png') }}" width="35" height="35" class="rounded">
              @endif
                <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt pr-1"></i>{{ __('ログアウト') }}
              </a>
              <a class="dropdown-item" href="{{ route('user.show', Auth::id()) }}">
                  <i class="fas fa-user pr-1"></i>{{ __('マイページ') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
