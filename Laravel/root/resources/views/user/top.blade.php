@extends('user.base')

@section('content')
<div class="container w-75">
<x-alert type="success" :message="session('success')" />
    <div class="row">
        <div class="col mt-4 my-5">
            <h1 class="user-top-title fs-2">勤怠管理</h1>
        </div>
    </div>
    <div class="row">
        <div class="col ms-5">
            <a href="{{ route('work',Auth::user()) }}" class="user-top-a">勤怠一覧</a>
        </div>
    </div>
</div>
@endsection