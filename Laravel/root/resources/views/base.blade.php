<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web日報</title>
    <!-- bootstrapのcss -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- css読み込み -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>

<body>

    <!-- ヘッダー -->
    <nav class="navbar navbar-expand-sm text-light header sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand text-light header-title" href="{{ url('/admin') }}">Web日報</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item header-item">
                    管理者画面
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light header-item pt-0" href="#">logout(未実装)</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- ヘッダー終わり-->
    <div class="container-fluid m-0">
        <!-- サイドバー -->
        <div class="row">
            <nav class="col-2 box1">
                <div class="">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="{{ url('/admin') }}" class="p-2 nav-link">トップページ</a></li>
                        <li class="nav-item"><a href="{{ route('users') }}" class="p-2 nav-link">社員管理</a></li>
                        <li class="nav-item"><a href="{{ route('admin.works.index') }}" class="p-2 nav-link">勤怠管理</a></li>
                    </ul>
                </div>
            </nav>
            <!-- サイドバー終わり -->

            <!-- コンテンツ部分 -->
            <main class="col-10 box2" role="main">
                @yield('content')
            </main>
            <!-- コンテンツ部分終わり -->


        </div>
    </div>







    <!-- bootstrapのjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- js読み込み -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>