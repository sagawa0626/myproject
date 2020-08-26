@extends('app')

@section('title', '家族招待')

@section('content')
    @include('familynav')
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3 text-center">
            <div class="form-group">
                <label class="control-label"></label>
                <h1> {{ $email }}を招待しました</h1>
            </div>
            <div class="form-group">
                <h3 class="text-danger">以下が招待URLです。LINEなどでURLを共有くださいませ<br>
                    このURLに入り新規ユーザーはアカウント登録をしていただきます
                </h3>
            </div>
            <input class="text-center"  id="omakeCopyTarget" value="{{ route('invitation.recieve', ['token' => $token]) }}" type="text">
            <div class="form-group">
                <button class="btn" onclick="omakeCopyToClipboard()" data-toggle="tooltip" data-placement="top">
                コピーする
                </button>
            </div>
        </div>
    </div>
    
@endsection