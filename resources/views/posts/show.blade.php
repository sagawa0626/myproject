@extends('app')

@section('title', 'アルバム一覧')

@include('nav')

@section('content')
    <div class="jumbotron text-center"
        style="background:url(/images/holiday.jpg); 
        background-size: cover; 
        background-repeat: no-repeat; 
        background-attachment: fixed; 
        background-position: center center;">
        <div class="container">
            <h1 class="jumbotron-heading text-white">家族の思い出</h1>
            <p class="lead text-white">
                これまでに投稿された貴重な思い出たちをアルバムにしました<br>
                きっとあなたの心の安らぎになることでしょう<br>
                心ゆくまでご覧ください
            </p>
        </div>
    </div>


    <div class="album py-5">
        <div class="container">
            <div class="row">
                @foreach($users as $user)
                    @foreach($user->posts()->orderBy('created_at', 'desc')->get() as $post)
                        <div class="col-md-4 text-center">
                            <div class="lead font-weight-lighter"><hr>
                                {{ $post->created_at->format('Y/m/d') }} 
                            </div>
                            <a href="{{ asset('storage/image/' . $post->image_path) }}" data-lightbox="group" data-title="{{ $post->title }}">
                                <img class="card-img-top" style="height: 200; width: 300; display: inline-block; margin-bottom: 20px;" src="{{ asset('storage/image/' . $post->image_path) }}" alt="Thumbnail" data-holder-rendered="true">
                            </a>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection