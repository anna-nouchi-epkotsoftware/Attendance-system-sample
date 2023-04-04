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
            <form action="" method="POST" class="my-3">
                @csrf
                <table class="table create-table mx-auto w-50">
                    <tr>
                        <th>年</th>
                        <td>
                            <select name="year" class="fs-5">
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
                        <th>月</th>
                        <td>
                            <select name="month" class="fs-5 me-2">
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
                        <th>ID</th>
                        <td><input type="number"></td>
                    </tr>
                    <tr>
                        <th>名字</th>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <th>名前</th>
                        <td><input type="text"></td>
                    </tr>
                </table>
                <div class="text-center"><button type="submit" class="btn btn-outline-dark btn-sm work-index-btn me-2">検索</button></div>
            </form>
        </div>
    </div>
</div>

<!-- 勤怠データ一覧表示 -->
<table class="table table-bordered border-dark">
    <thead class="table-secondary">
        <tr>
            <th scope="col">NO.</th>
            <th scope="col">ID</th>
            <th scope="col">名字</th>
            <th scope="col">氏名</th>
        </tr>
    </thead>
    <tbody>
        @foreach([] as $work)
        <tr>
            <td>
                @php
                $number = 0;
                $number = $number + 1;
                @endphp
                {{ $number }}
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection