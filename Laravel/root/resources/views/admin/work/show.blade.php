@extends('base')

@section('content')
<h1>{{ $searchYear }}年{{ $searchMonth }}月の勤怠データ</h1>
<p>氏名：{{ $name }}</p>

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
            <th scope="col">承認</th>
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
            <td><a href="" class="btn btn-outline-success">承認</a></td>
            @php
            if($work->status_id === 1){
            echo '<td>
                <p class="text-secondary">申請待ち</p>
            </td>';
            }elseif($work->status_id === 2){
            echo '<td>
                <p class="text-danger">承認してください</p>
            </td>';
            }else{
            echo '<td>
                <p class="text-primary">承認済み</p>
            </td>';
            }
            @endphp
        </tr>
        @endforeach
    </tbody>
</table>
@endsection