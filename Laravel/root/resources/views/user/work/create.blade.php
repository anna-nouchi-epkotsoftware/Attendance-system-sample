@php
if($work->status_id === 1){
$readOnly= false;
}else{
$readOnly= true;
}
@endphp

@extends('user.base')

@section('content')

<h1>出退勤登録</h1>
<form action="{{ route('work.register.update',['user' => Auth::user()->id,'work' => $work->id]) }}" method="POST">
    @csrf
    <table class="table create-table my-5">
        <tr>
            <th class="table-secondary create-table-item">
                <label for="date">日付</label>
            </th>
            <td class="table-light">
                <input type="date" name="date" id="date" value="{{ $work->date->format('Y-m-d') }}" disabled>
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="work_start_time">出社時間</label>
            </th>
            <td class="table-light">
                <input type="time" name="work_start_time" id="work_start_time" value="{{ $work->work_start_time->format('H:i:s') }}" disabled>
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="work_end_time">退社時間</label>
            </th>
            <td class="table-light">
                <input type="time" name="work_end_time" class="@error('work_end_time') is-invalid @enderror" value="{{ $work->work_end_time->format('H:i:s') }}" id="work_end_time" disabled>
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="break_time">休憩時間</label>
            </th>
            <td class="table-light">
                <input type="time" name="break_time" class="@error('break_time') is-invalid @enderror" value="{{ $work->break_time }}" max="01:00" step="900" id="break_time" {{ $readOnly ? ' disabled ' : '' }}>
                @error('break_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="work_content">備考</label>
            </th>
            <td class="table-light">
                <input type="text" name="work_content" id="work_content" value="{{ old('work_content',$work->work_content) }}" {{ $readOnly ? ' disabled ' : '' }} placeholder="早退・遅刻など">
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item-last create-table-item">
                <label for="comment">総務コメント</label>
            </th>
            <td class="table-light create-table-item-last">
                <textarea name="comment" id="comment" placeholder="早退・遅刻などの理由を記載してください。" class="w-75" {{ $readOnly ? ' disabled ' : '' }}>{{ old('comment',$work->comment) }}</textarea>
            </td>
        </tr>
    </table>
    @php
    if($work->status_id === 1){
    echo '<div class="create-button"><button type="submit" class="btn btn-outline-primary w-25">申請</button></div>';
    }
    @endphp
    <div><a href="{{ route('work',Auth::user()) }}" class="btn btn-secondary">戻る</a></div>
</form>

@endsection