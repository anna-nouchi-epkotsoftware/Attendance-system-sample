@extends('base')

@section('content')
<h1>詳細</h1>
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<form class="">
    {{ csrf_field() }}
    @include('admin.form' , ['readOnly' => true])
</form>
<div class="container-fluid">
    <div class="row">
        <div class="col"><a class="btn btn-secondary" href="{{ route('users.index') }}">一覧</a></div>
        <div class="col-md-auto"><a class="btn btn-primary" href="{{ route('user.edit', $user ) }}">編集</a></div>
        <!-- Button trigger modal -->
        <div class="col col-lg-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                削除
            </button>
        </div>
        <!-- Button trigger modal -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">削除確認</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                本当に削除してもいいですか？？？
            </div>
            <div class="modal-footer">
                <form method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">OK</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>
@endsection