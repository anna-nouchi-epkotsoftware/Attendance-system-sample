@php
$now = new DateTime();
$week = [
'日', //0
'月', //1
'火', //2
'水', //3
'木', //4
'金', //5
'土', //6
];
$date = $now->format('w');
//日本語で曜日を出力
$dayOfWeek=$week[$date] . '曜日';
$day =$now->format('Y年m月d日');

if($date == 0 || $date == 6){
$readOnly= true;
}else{
$readOnly= false;
}
@endphp

@extends('user.base')

@section('content')

<h1>出退勤登録</h1>
<form action="{{ route('work.register.update',['user' => Auth::user()->id,'work' => $work->id]) }}" method="POST">
    @csrf
    <table class="table create-table">
        <tr>
            <th class="table-secondary create-table-item">
                <label for="date">日付</label>
            </th>
            <td class="table-light">
                <input type="date" name="date" id="date" value="{{ $work->date }}">
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="work_start_time">出社時間</label>
            </th>
            <td class="table-light">
                <input type="time" name="work_start_time" id="work_start_time" value="{{ $work->work_start_time }}">
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="work_end_time">退社時間</label>
            </th>
            <td class="table-light">
                <input type="time" name="work_end_time" class="@error('work_end_time') is-invalid @enderror" value="{{ $work->work_end_time }}" id="work_end_time">
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
                @error('last_name_kana')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item">
                <label for="work_content">備考</label>
            </th>
            <td class="table-light">
                <input type="text" name="work_content" id="work_content" class="@error('first_name') is-invalid @enderror" value="{{ $work->work_content }}" {{ $readOnly ? ' disabled ' : '' }} placeholder="早退・遅刻など">
                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="table-secondary create-table-item-last create-table-item">
                <label for="comment">総務コメント</label>
            </th>
            <td class="table-light create-table-item-last">
                <textarea name="comment" id="comment" placeholder="早退・遅刻などの理由を記載してください。" class="w-75" {{ $readOnly ? ' disabled ' : '' }} value="{{ $work->comment }}"></textarea>
                @error('join_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
    </table>
    <div class="create-button"><button type="submit" class="btn btn-outline-primary w-25">申請</button></div>
</form>

@endsection