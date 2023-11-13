<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>DTF.KZ</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel='stylesheet' type='text/css' media='screen' href='/libs/jkanban/jkanban.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='/libs/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='/main.css'>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Главная</a></li>
                <a href="/logout" type="button" class="btn btn-danger">Выход</a>
            </ul>
        </header>
    </div>

    @yield('content')

    <script src='/libs/jquery/jquery-3.7.1.min.js'></script>
    <script src='/libs/bootstrap/js/bootstrap.bundle.min.js'></script>
    <script src='/libs/jkanban/jkanban.min.js'></script>

    <script src='/main.js'></script>
</body>

</html>