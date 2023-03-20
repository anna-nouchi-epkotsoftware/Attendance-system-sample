@extends('base')

@section('content')
<h1>詳細</h1>
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<form class="" action="{{ route('user.destroy',$user) }}" method="POST" id="form1">
    @method('DELETE')
    {{ csrf_field() }}
    @include('admin.form' , ['readOnly' => true])
</form>
<div class="container-fluid">
    <div class="row">
        <div class="col"><a class="btn btn-secondary" href="{{ route('users') }}">一覧</a></div>
        <div class="col-md-auto"><a class="btn btn-primary" href="{{ route('user.edit', $user ) }}">編集</a></div>
        <div class="col col-lg-2"><button class="btn btn-danger" form="form1" type="submit">削除</button></div>
    </div>
</div>
@endsection