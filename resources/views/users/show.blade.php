@extends('app')

@section('title', 'プロフィール')

@section('content')
    @include('nav')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <a href="/users/{{ Auth::user()->id }}" class="text-dark">
                        @if($user->profile_photo)
                            <p>
                                <img width="50%" height="50%" src="{{ asset('storage/profile_images/' . $user->profile_photo) }}" />
                            </p>
                            @else
                                <i class="fas fa-user-circle fa-3x"></i>
                        @endif
                    </a>
                </div>
                <h2 class="h5 card-title m-0">
                    <a href="/users/{{ Auth::user()->id }}" class="text-dark">
                        名前：{{ $user->name }}
                    </a>
                    <hr>
                    <h3 class="h5 card-title m-0">
                        この家族の役割：{{ $user->relationship }}
                    </h3>
                    <hr>
                    @if($user->id == Auth::user()->id)
                        <a class="btn blue-gradient btn-block" href="/users/edit">プロフィールを編集</a>
                    @endif
                </h2>
            </div>
        </div>
    </div>
@endsection