@extends('user.base')

@section('content')

<h1>勤怠一覧</h1>

<form action="{{ route('works.store',Auth::user() ) }}" method="POST">
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
        @foreach($works as $work)
        <tr>
            <th>{{ $work->date }}</th>
            <td>{{ $work->work_start_time }}</td>
            <td>{{ $work->work_end_time }}</td>
            <td>{{ $work->break_time }}</td>
            <td>{{ $work->work_content }}</td>
            <td><a href="" class="btn btn-outline-success">変更</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

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
        <tr><th>{{ $date }}</th>
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
@endsection