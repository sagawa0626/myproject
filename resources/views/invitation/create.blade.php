@extends('app')

@section('title', '家族招待')

@section('content')
    @include('familynav')
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
            <div class="card-body text-center">
                <h4>招待したい人のメールアドレスを打ち込んでください</h4>
                <div class="card-text">
                    <form method="POST" action="{{ route('invitation.create') }}">
                        @csrf
                        <div class="md-form">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="text" name="email" required value="{{ old('email') }}">
                            </div>
                            <button type="submit" class="btn btn-block btn-primary mt-2 md-2">招待する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
    