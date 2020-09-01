<nav class="navbar navbar-expand-lg navbar-dark info-color">

    <a class="navbar-brand" href="/"><i class="fas fa-home"></i>
        fam(ホーム画面に戻る)
    </a>
    @auth
        <a class="navbar-brand" href="/users/{{ Auth::user()->id }}">
            ようこそ！ <u>{{ Auth::user()->name }}</u> さん
        </a>
    @endauth

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                </li>
            @endguest

            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts/show"><i class="fas fa-images"></i>アルバムを見る</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.index') }}"><i class="fas fa-book-reader"></i>家族の近況を見る</a>
            </li>
            @endauth

            @auth
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" type="button" onclick="location.href='/users/{{ Auth::user()->id }}'">
                        マイページ
                    </button>
                    <div class="dropdown-divider"></div>
                    <button form="logout-button" class="dropdown-item" type="submit">
                            ログアウト
                    </button>
                </div>
            </li>
            <form id="logout-button" method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
            <!-- Dropdown -->
            @endauth

        </ul>
    </div>
</nav>