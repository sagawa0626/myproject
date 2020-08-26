@extends('app')

@section('title', '招待を受ける')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <h1 class="text-center text-dark">fam!!<h1>
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <h2 class="h3 card-title text-center mt-2">ユーザー登録</h2>
                            <h5>登録完了後に家族と合流できます</h5>
                            <div class="card-text">
                                <form method="POST" action="{{ route('invitation.register') }}">
                                    @csrf
                                    <div class="md-form">
                                        <input class="form-control" type="hidden" id="token" name="token" required value="{{ $token }}">
                                        <label for="name">ユーザー名</label>
                                        <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                                        <small>自分のお名前をお入れください</small>
                                    </div>
                                    <div class="md-form">
                                        <label for="email">メールアドレス</label>
                                        <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                                    </div>
                                    <div class="md-form">
                                        <label for="password">パスワード</label>
                                        <input class="form-control" type="password" id="password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn blue-gradient btn-block">招待を受ける</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



