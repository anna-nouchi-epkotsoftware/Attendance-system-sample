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
$nowDay =$now->format('Y年m月d日');
$thisYear =$now->format('Y');
$thisMonth =$now->format('m');
@endphp


@extends('user.base')

@section('content')
<h1>{{ $nowDay }}{{ $dayOfWeek }}</h1>

<!-- 出退勤アラート表示 -->
<x-alert type="danger" :message="session('danger')" />
<!-- 出退勤サクセス表示 -->
<x-alert type="success" :message="session('success')" />

<!-- タイムカード -->
<div class="container border border-2 rounded w-75 text-center mt-4 my-5 p-0">
    <div class="row">
        <div class="col fs-3 fw-bold p-2">
            タイムカード
        </div>
    </div>

    <div class="row">
        <div class="col">
            <!-- リアルタイム時計表示 -->
            <p id="RealtimeClockArea2" class="fs-1 fw-bold text-light bg-secondary"></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- 出勤ボタン -->
            <p><a href="{{ route('report.store',Auth::user()) }}" class="btn btn-primary fw-bold w-50 h-100 fs-2 mt-4 my-4">出勤</a></p>
        </div>
        <div class="col">
            <!-- 退勤ボタン -->
            <p><a href="{{ route('report.update', Auth::user() ) }}" class="btn btn-danger fw-bold w-50 h-100 fs-2 mt-4 my-4">退勤</a></p>
        </div>
    </div>
</div>

<!-- 月変更ボタン -->
<form action="{{ route('work.show',Auth::user() ) }}" method="POST" class="my-3">
    @csrf
    <select name="year" class="fs-5">

        <!-- 年の<option>タグ作成 -->
        @if(isset($searchYear))
            @foreach (range(2018,$thisYear) as $year)
                @if($year == $searchYear)
                    <option value="{{ $year }}" selected>{{ $year }}年</option>
                @else
                    <option value="{{ $year }}">{{ $year }}年</option>
                @endif
            @endforeach
        @else
            @foreach (range(2018,$thisYear) as $year)
                @if($year == $thisYear)
                    <option value="{{ $year }}" selected>{{ $year }}年</option>
                @else
                    <option value="{{ $year }}">{{ $year }}年</option>
                @endif
            @endforeach
        @endif
    </select>
    <select name="month" class="fs-5 me-2">

        <!--月の<option>タグ作成 -->
        @if(isset($searchMonth))
            @foreach (range(1,12) as $month)
                @if ($month == $searchMonth)
                    <option value="{{ $month }}" selected>{{ $month }}月</option>
                @else
                    <option value="{{ $month }}">{{ $month }}月</option>
                @endif
            @endforeach
        @else
            @foreach (range(1,12) as $month)
                @if ($month == $thisMonth)
                    <option value="{{ $month }}" selected>{{ $month }}月</option>
                @else
                    <option value="{{ $month }}">{{ $month }}月</option>
                @endif
            @endforeach
        @endif

    </select>
    <button type="submit" class="btn btn-outline-dark btn-sm work-index-btn me-2">検索</button>
    <span><a href="{{ route('work.index',Auth::user()) }}" class="btn btn-outline-dark btn-sm work-index-btn">今月</a></span>
</form>

<!-- 勤怠データ一覧表示 -->
<table class="table table-bordered border-dark">
    <thead class="table-secondary">
        <tr>
            <th scope="col">日付</th>
            <th scope="col">曜日</th>
            <th scope="col">始業時間</th>
            <th scope="col">退勤時間</th>
            <th scope="col">休憩時間</th>
            <th scope="col">備考</th>
            <th scope="col">総務コメント</th>
            <th scope="col">申請</th>
            <th scope="col">承認ステータス</th>
        </tr>
    </thead>
    <tbody>
        @foreach($works as $work)
        <tr>
            <th>{{ $work->date }}</th>
            <th>
                @php
                $date =date('w',strtotime($work->date));
                $week = [
                '日', //0
                '月', //1
                '火', //2
                '水', //3
                '木', //4
                '金', //5
                '土', //6
                ];
                echo $week[$date];
                @endphp
            </th>
            <td>{{ $work->work_start_time }}</td>
            <td>{{ $work->work_end_time }}</td>
            <td>{{ $work->break_time }}</td>
            <td>{{ $work->work_content }}</td>
            <td>{{ $work->comment }}</td>
            <td><a href="{{ route('work.register.edit',['user' => Auth::user()->id,'work' => $work->id]) }}" class="btn btn-outline-success">申請</a></td>
            @if($work->status_id === 1)
            <td>
                <p class="text-danger">申請してください</p>
            </td>
            @elseif($work->status_id === 2)
            <td>
                <p class="text-secondary">申請中</p>
            </td>
            @else
            <td>
                <p class="text-primary">承認済み</p>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

<!-- JSリアルタイム時計 -->
<script>
    (() => {
        const realtimeElement = document.getElementById("RealtimeClockArea2");

        //時間取得
        function showClock2() {
            const nowTime = new Date();
            const nowHour = String(nowTime.getHours()).padStart(2, '0');
            const nowMin = String(nowTime.getMinutes()).padStart(2, '0');
            const nowSec = String(nowTime.getSeconds()).padStart(2, '0');
            const msg = nowHour + ":" + nowMin + ":" + nowSec;
            realtimeElement.textContent = msg;
        }
        showClock2(); // 初期表示
        setInterval(showClock2, 1000); //1秒ごとに処理
    })();
</script>

@endsection