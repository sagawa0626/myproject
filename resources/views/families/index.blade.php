@extends('app')

@section('title', '家族一覧')

@section('content')
    @include('familynav')
    <div class="card">
        <h2 class="card-header text-center">素晴らしい家族一覧</h2>
        <div class="card-body text-center">
            <p class="lead">それぞれの該当する家族からお入りくださいませ<br>
            ※家族に入る際はパスワードが必要となります<br>
            また下のボタンにより新たに家族を作成する事もできます<br>
            </p>
            <a class="btn btn-primary" href="{{ route('families.create') }}" role="button">新規で家族を作成する</a>
        </div>
        @foreach($families as $family)
            <div class="container" style="margin-top:15px;">
                <div class="col-md-14">
                    <div class="card">
                        <div class="card-block">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>家族名</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="lead">{{ $family->family_name }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-lg btn-primary" href="{{ route('posts.index', ['family_id' => $family->id]) }}" role="button">
                                                この家族に入る
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection