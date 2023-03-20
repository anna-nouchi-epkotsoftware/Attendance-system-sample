<!-- 更新確認画面 -->
@extends('base')

@section('content')
<h1>更新確認画面</h1>
<div class="alert alert-info" role="alert">入力内容に間違いなければページ下の<strong>更新ボタン</strong>を押して確定してください。</div>
<form class="" action="{{ route('user.update', $user) }}" method="POST">
    @method('PATCH')
    {{ csrf_field() }}
    @include('admin.form' , ['readOnly' =>false])
    <div class="container-fluid">
        <div class="row">
            <div class="col"><a class="btn btn-secondary" href="{{ route('user.edit', $user ) }}">戻る</a></div>
            <div class="col-md-auto"><button type="submit" class="btn btn-outline-primary">更新</button></div>
        </div>
    </div>
</form>
@endsection