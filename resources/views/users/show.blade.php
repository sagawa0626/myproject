@extends('app')

@section('title', 'プロフィール')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="mx-auto">
                <div class="card card-cascade">

                    <!-- Card image -->
                    <div class="view view-cascade overlay">
                        <img width="500px" height="500px" class="card-img-top" src="{{ $user->profile_photo }}" alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                    </div>
                    <div class="card-body card-body-cascade text-center">

                    <!-- Title -->
                    <h3 class="card-title"><strong>{{ $user->name }}</strong></h3>
                    <hr>
                    <!-- Subtitle -->
                    <h5 class="font-weight-bold indigo-text py-2">登録されているメールアドレス</h5>
                    <p>{{ $user->email }}</p>
                    <hr>
                    <h5 class="font-weight-bold indigo-text py-2">この家族の立ち位置</h5>
                    @if($user->relationship)
                        <p>{{ $user->relationship }}</p>
                    @else
                        <p class="text-danger">※まだ登録がされていません</p>
                    @endif
                    <hr>
                    <!-- Text -->
                    @if($user->id == Auth::user()->id)
                        <p class="card-text">
                            <a class="btn btn-lg btn-primary" href="/users/edit" role="button">プロフィール編集</a>
                        </p>
                    @endif



                </div>
            </div>
        </div>
    </div>
@endsection