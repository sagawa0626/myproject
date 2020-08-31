@extends('app')

@section('title', '家族一覧')

@section('content')
    @include('familynav')
    @foreach($families as $family)
        <div class="card">
            <h1 class="card-header text-center"><strong>fam!!</strong>の世界へようこそ!!</h1>
            <div class="card-body text-center">
                    <a class="btn btn-primary" href="{{ route('families.create') }}" role="button">新規で家族を作成する</a>
            </div>
        </div>
    
        <div class="container">
            <div class="row">
                <div class="mx-auto">
                    <div class="card card-cascade">
                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" src="/images/house.jpg" alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">
                            <!-- Title -->
                            <h2 class="card-title"><strong>{{ $family->family_name }}</strong></h2>
                            <!-- Subtitle -->
                            <p class="font-weight-bold indigo-text py-2">以下の【この家族の家に入る】のボタンをクリックし入ってください</p>
                            <!-- Text -->
                            <a class="btn btn-lg btn-primary" href="{{ route('posts.index') }}" role="button">
                                この家族の家に入る
                            </a>
                        </div>
                        <div class="card-body card-body-cascade text-center">
                            @if($isHost)
                                <p class="font-weight-bold indigo-text py-2">
                                    家族作成者のユーザーのみ新規に家族を招待できます
                                </p>
                                <a class="btn btn-lg btn-default" href="{{ route('invitation.index') }}" role="button">
                                    新しい家族を招待する
                                </a>
                            @endif
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer text-muted text-center">
                            この家が誕生した日にち {{ $family->created_at->format('Y/m/d')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection