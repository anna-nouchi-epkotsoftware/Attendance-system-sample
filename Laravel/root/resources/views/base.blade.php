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
    <div class="container-fluid m-0">
        <!-- ヘッダー -->
        <div class="row">
            <header class="d-flex text-light header">
                <p class="me-auto">Web日報登録</p>
                <p class="me-5">勤怠花子</p>
                <a class="text-light">logout</a>
            </header>
        </div>
        <!-- ヘッダー終わり-->

        <!-- サイドバー -->
        <div class="row">
            <nav class="col-2 box1">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="p-2">トップページ</a></li>
                    <li class="nav-item"><a href="#" class="p-2">申請管理</a></li>
                    <li class="nav-item"><a href="#" class="p-2">社員管理</a></li>
                    <li class="nav-item"><a href="#" class="p-2">休日設定</a></li>
                    <li class="nav-item"><a href="#" class="p-2">勤怠管理</a></li>
                    <li class="nav-item"><a href="#" class="p-2">交通費管理</a></li>
                    <li class="nav-item"><a href="#" class="p-2">備品管理</a></li>
                </ul>
            </nav>
            <!-- サイドバー終わり -->

            <!-- コンテンツ部分 -->
            <main class="col-10 box2">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">社員名</th>
                            <th scope="col">入社日</th>
                            <th scope="col">詳細</th>
                            <th scope="col">編集</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>

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