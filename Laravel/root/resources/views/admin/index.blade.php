@extends('base')

@section('content')
<div class="index-table">
    <p class="index-table-p"><a href="{{ route('user.register.create') }}" class="btn btn-outline-primary w-25">新規登録</a></p>
<p>{{ $users->total() }}&nbsp;件</p>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">社員名</th>
            <th scope="col">入社日</th>
            <th scope="col">詳細</th>
            <th scope="col">編集</th>

        </tr>
    </thead>
    <tbody>
        <!-- テーブルのデータ取得ループ -->
        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->last_name }}&nbsp;{{ $user->first_name }}</td>
            <td>{{ $user->join_date }}</td>
            <td><a href="{{ route('user.show', $user ) }}" class="btn btn-outline-warning">詳細</a></td>
            <td><a href="{{ route('user.edit', $user ) }}" class="btn btn-outline-success">編集</a></td>

        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
</div>
@endsection