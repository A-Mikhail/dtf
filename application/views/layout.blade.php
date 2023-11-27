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

    @yield('csstop')
</head>

<body>
    <header class="p-3 bg-body-tertiary border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap">
                <ul class="nav col-6 mb-2 mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary active">Главная</a></li>
                </ul>

                <div class="col-6 text-end">
                    <a href="/logout" type="button" class="btn btn-danger">Выход</a>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <script src='/libs/jquery/jquery-3.7.1.min.js'></script>
    <script src='/libs/bootstrap/js/bootstrap.bundle.min.js'></script>
    <script src='/libs/jkanban/jkanban.min.js'></script>

    <script src='/main.js'></script>

    @yield('js')
</body>

</html>