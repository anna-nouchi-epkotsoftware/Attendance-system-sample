@extends('base')

@section('content')
<h1>新規登録</h1>

<form class="" action="{{ route('user.register.store') }}" method="POST">
    {{ csrf_field() }}
    @include('admin.form_create' , ['readOnly' => false])

    <div class="create-button"><button type="submit" class="btn btn-outline-primary w-25">登録</button></div>
</form>
@endsection