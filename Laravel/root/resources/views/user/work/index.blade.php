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
$now =$now->format('Y年m月d日');
@endphp


@extends('user.base')

@section('content')

<h1>勤怠一覧</h1>
<div>{{ $now }}{{ $dayOfWeek }}</div>
<p id="RealtimeClockArea">※ここに時計が表示されます。</p>

<!-- 出勤ボタン -->
<p><a href="{{ route('report.store',Auth::user()) }}" class="btn btn-primary">出勤</a></p>
<!-- 退勤ボタン -->
<p><a href="{{ route('report.update', Auth::user() ) }}" class="btn btn-danger">退勤</a></p>

<!-- 月変更ボタン -->
<form action="{{ route('work.index2',Auth::user() ) }}" method="POST">
    @csrf
    <select name="year">
        @php
        $year = '';
        for ($i=2022; $i <= $thisYear; $i++) { if($i==$thisYear){ $year .='<option value="' .$i.'" selected>'.$i.'年</option>';
            }else{
            $year .='<option value="' .$i.'">'.$i.'年</option>';
            }
            }
            echo $year;
            @endphp
    </select>
    <select name="month">
        @php
        $month ='';
        for ($i=1; $i <= 12; $i++) { if($i==$thisMonth){ $month .='<option value="' .$i.'" selected>'.$i.'月</option>';
            }else{
            $month .='<option value="' .$i.'">'.$i.'月</option>';
            }
            }
            echo $month;
            @endphp
    </select>
    <button type="submit">違う月へ</button>
</form>

<!-- 勤怠データ一覧表示 -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">日付</th>
            <th scope="col">始業時間</th>
            <th scope="col">退勤時間</th>
            <th scope="col">休憩時間</th>
            <th scope="col">備考</th>
            <th scope="col">申請</th>
            <th scope="col">承認</th>
        </tr>
    </thead>
    <tbody>
        @foreach($works as $work)
        <tr>
            <th>{{ $work->date }}</th>
            <td>{{ $work->work_start_time }}</td>
            <td>{{ $work->work_end_time }}</td>
            <td>{{ $work->break_time }}</td>
            <td>{{ $work->work_content }}</td>
            <td><a href="{{ route('work.register.show',['user' => Auth::user()->id,'work' => $work->id]) }}" class="btn btn-outline-success">登録</a></td>
            <td>承認の可否表示</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- 勤怠データ一覧表示（提案２） -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">日付</th>
            <th scope="col">始業時間</th>
            <th scope="col">退勤時間</th>
            <th scope="col">休憩時間</th>
            <th scope="col">備考</th>
            <th scope="col">変更</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dateList as $key => $date)
        <tr>
            <th>{{ $date }}</th>
            @foreach($works as $work)
            @if($key === $work->date)
            <td>{{ $work->work_start_time}}</td>
            <td>{{ $work->work_end_time}}</td>
            <td>{{ $work->break_time}}</td>
            <td>{{ $work->work_content}}</td>
            <td><a href="" class="btn btn-outline-success">変更</a></td>
            @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
<tr></tr>
<th></th>
<td></td>

<!-- リアルタイム時計 -->
<script>
    function showClock1() {
        var nowTime = new Date();
        var nowHour = nowTime.getHours();
        var nowMin = nowTime.getMinutes();
        var nowSec = nowTime.getSeconds();
        var msg = nowHour + ":" + nowMin + ":" + nowSec;
        document.getElementById("RealtimeClockArea").innerHTML = msg;
    }
    setInterval('showClock1()', 1000);
</script>

@endsection