@extends('app')

@section('title', 'プロフィール編集')

@section('content')
    @include('nav')
    @include('error_card_list')

    <div class="col-md-offset-2 mb-4 edit-profile-wrapper">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="profile-form-wrap">
                    <form class="edit_user" enctype="multipart/form-data" action="/users/update" accept-charset="UTF-8" method="post">
                        <input name="utf8" type="hidden" value="" />
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="user_profile_photo">プロフィールの写真</label><br>
                            @if($user->profile_photo)
                                <p>
                                    <img width="500px" height="500px" src="{{ $user->profile_photo }}" alt="avatar" />
                                </p>
                            @endif
                            <input type="file" name="user_profile_photo" value="{{ old('user_profile_photo', $user->id) }}" accept="image/jpeg,image/gif,image/png" />
                        </div>
                        <div class="form-group">
                            <label for="user_name">名前<label>
                            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('user_name', $user->name) }}" name="user_name" />
                        </div>
                        <div class="form-group">
                            <label for="user_relationship">あなたの家族の立ち位置<label>
                            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('user_relationship', $user->relationship) }}" name="user_relationship" />
                        </div>
                        
                        <div class="form-group">
                            <label for="user_email">メールアドレス</label>
                            <input autofocus="sutofocus" class="form-control" type="email" value="{{ old('user_email', $user->email) }}" name="user_email" />
                        </div>
                        <input type="submit" name="commit" value="更新する" class="btn btn-primary" data-disable-with="更新する"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection