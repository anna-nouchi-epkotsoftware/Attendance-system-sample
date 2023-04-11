@extends('base')

@section('content')
<h1>編集</h1>

<form class="" action="{{ route( 'user.confirm',$user) }}" method="POST">
    {{ csrf_field() }}
    @include('admin.form' , ['readOnly' => false])
    <div class="container-fluid">
        <div class="row">
            <div class="col"><a class="btn btn-secondary" href="{{ route('user.show', $user ) }}">詳細へ戻る</a></div>
            <div class="col-md-auto"><button type="submit" class="btn btn-outline-primary">確認</button></div>
        </div>
    </div>
</form>
@endsection