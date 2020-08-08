@extends('app')

@section('title', '家族一覧')

@section('content')
    @include('familynav')
    <div class="card">
        <h2 class="card-header">素晴らしい家族一覧</h2>
        <div class="card-body">
            <p class="lead">それぞれの該当する家族からお入りくださいませ<br>
            ※家族に入る際はパスワードが必要となります<br>
            また下のボタンにより新たに家族を作成する事もできますよ<br>
            </p>
            <a class="btn btn-primary" href="#" role="button">新規で家族を作成する</a>
        </div>
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>家族名</th>
                    <th>作成日</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="lead">1</td>
                    <td class="lead">佐川家</td>
                    <td class="lead">2020/08/07</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection