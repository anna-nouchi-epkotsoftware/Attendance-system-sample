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

$number = 0;
@endphp

@extends('base')

@section('content')
<h1>{{ $nowDay }}{{ $dayOfWeek }}</h1>

<!-- 検索画面 -->
<div class="container border border-2 rounded mt-4 my-5 p-0 w-75">
    <div class="row text-center">
        <div class="col">
            <p class="fs-5 fw-bold p-1 text-white admin-work-index-search-title">ユーザー勤怠状況検索</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ route('admin.works.search') }}" method="POST" class="my-3">
                @csrf
                <table class="table create-table mx-auto w-50">
                    <tr>
                        <th>
                            <label for="year">年</label>
                        </th>
                        <td>
                            <select name="year" id="year" class="fs-5">
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
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="month">月</label>
                        </th>
                        <td>
                            <select name="month" id="month" class="fs-5 me-2">
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
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="id">ID</label>
                        </th>
                        <td>
                            <input type="number" name="id" id="id">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="name">名前</label>
                        </th>
                        <td>
                            <input type="text" name="name" id="name">
                        </td>
                    </tr>
                </table>
                <p class="mx-auto w-50">※IDまたは名前で検索してください。<br/>
                   ※IDと名前を当時に入力した場合はIDが優先されます。
                </p>
                <div class="text-center"><button type="submit" class="btn btn-outline-dark btn-sm work-index-btn me-2">検索</button></div>
            </form>
        </div>
    </div>
</div>

<!-- 勤怠データ一覧表示 -->
@if(isset($searchYear))
<div>{{ $searchYear}}年{{ $searchMonth}}月&nbsp;&nbsp;{{ $users->count() }}件</div>
@endif
<table class="table table-bordered border-dark w-75">
    <thead class="table-secondary">
        <tr>
            <th scope="col">NO.</th>
            <th scope="col">ID</th>
            <th scope="col">氏名</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users ?? [] as $user)
        <tr>
            <td>
                @php
                $number = $number + 1;
                echo $number;
                $name =$user->last_name.$user->first_name;
                @endphp
            </td>
            <td>{{ $user->id }}</td>
            <td>
                <a href="{{ route('admin.works.show',['user' => $user->id,'searchYear' => $searchYear,'searchMonth' => $searchMonth,'name' => $name]) }}">{{ $user->last_name }}&nbsp;{{ $user->first_name }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection