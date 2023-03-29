@extends('user.base')

@section('content')

<h1>社員側トップページ</h1>

@if (session('login_success'))
<div class="alert alert-success">{{session('login_success')}}</div>
@endif

<div>ID:{{ Auth::user()->id }}</div>
<div>名前:{{ Auth::user()->last_name }}</div>
<div>メールアドレス:{{ Auth::user()->email }}</div>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">ログアウト</button>
</form>
@endsection