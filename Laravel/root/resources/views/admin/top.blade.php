@extends('base')

@section('content')
<div class="container w-75">
    <div class="row">
        <div class="col mt-4 my-5">
            <h1 class="user-top-title fs-2">社員管理</h1>
        </div>
    </div>
    <div class="row">
        <div class="col ms-5">
            <a href="{{ route('users') }}" class="user-top-a">社員一覧</a>
        </div>
        <div class="col">
            <a href="{{ route('user.register.create') }}" class="user-top-a">社員登録</a>
        </div>
    </div>

    <div class="row">
        <div class="col mt-5 my-5">
            <h1 class="user-top-title fs-2">勤怠管理</h1>
        </div>
    </div>
    <div class="row">
        <div class="col ms-5">
            <a href="" class="user-top-a">勤怠一覧</a>
        </div>
    </div>
</div>
@endsection