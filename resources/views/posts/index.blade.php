@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')
        <div class="col-md-5 col-md-5 mx-auto">
            @foreach($users as $user)
                    @foreach($user->posts()->orderBy('created_at', 'desc')->get() as $post)
                        <div class="card mt-4">
                            <div class="card-body d-flex flex-row">
                                    @if($user->profile_photo)
                                        <a href="/users/{{ $post->user->id }}" class="text-dark">
                                            <img class="post-profile-icon" src="{{ asset('storage/profile_images/' . $user->profile_photo) }}"/>
                                        </a>
                                    @else
                                        <a href="/users/{{ $post->user->id }}" class="text-dark">
                                            <i class="fas fa-user-circle fa-3x mr-1"></i>
                                        </a>
                                    @endif
                                <div>
                                    <div class="font-weight-bold" class="text-dark"> 
                                        {{ $post->user->name }}
                                    </div>
                                    <div class="font-weight-lighter">
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                @if( Auth::id() === $post->user_id )
                                    <!-- dropdown -->
                                    <div class="ml-auto card-text">
                                        <div class="dropdown">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <button type="button" class="btn btn-link text-muted m-0 p-2">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post]) }}">
                                                    <i class="fas fa-pen mr-1"></i>投稿を更新する
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                                                        <i class="fas fa-trash-alt mr-1"></i>投稿を削除する
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- dropdown -->

                                    <!-- modal -->
                                    <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        {{ $post->title }}を削除します。よろしいですか？
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                                        <button type="submit" class="btn btn-danger">削除する</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal -->
                                @endif
                            </div>
                            <div class="card" style="width: 100%;">
                                <img class="card-img-top" src="{{ asset('storage/image/' . $post->image_path) }}">
                            </div>
                            <div class="card-body pt-4 pb-2">
                                <h3 class="h4 card-title">
                                    {{ $post->title }}
                                </h3>
                                <div class="card-text">
                                    {!! nl2br(e( $post->body)) !!}
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-2 pl-3">
                                <div class="card-text">
                                    <post-like
                                        :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                                        :initial-count-likes='@json($post->count_likes)'
                                        :authorized='@json(Auth::check())'
                                        endpoint="{{ route('posts.like', ['post' => $post]) }}"
                                    >
                                    </post-like>
                                </div>
                                <div id="comment-post-{{ $post->id }}">
                                    @foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                                        <div class="mb-2">
                                            <span>
                                                <strong>
                                                    <a class="no-text-decoration black-color" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                                                </strong>
                                            </span>
                                            <span>{{ $comment->comment }}</span>
                                            <div class="font-weight-lighter">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <hr>
                            <div class="form-group" id="comment-form-post-{{ $post->id }}">
                                <form class="w-100" id="new_comment" action="/posts/{{ $post->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="✓" />
                                    
                                    {{csrf_field()}}
                                    
                                    <input value="{{ $post->id }}" type="hidden" name="post_id" />
                                    <input class="form-control comment-input border" placeholder="コメントを追加 ..." autocomplete="off" type="text" name="comment" />
                                </form>
                            </div>
                        </div>
                    @endforeach
            @endforeach
        </div>
@endsection