@extends('app')

@section('title', '家族新規作成')

@section('content')
    @include('familynav')
    <form method="POST" action="{{ route('families.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="control-label">家族名</label>
            <input class="form-control" type="text" name="family_name" required value="{{ old('family_name') }}">
        </div>
        <div class="form-group">
          <label class="control-label">家族のパスワード</label>
          <input class="form-control" type="text" name="family_password" required value="{{ old('family_password') }}">
        </div>
        <button type="submit" class="btn blue-gradient btn-block">新規作成する</button>
    </form>
@endsection