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
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary active">Главная</a></li>
                </ul>

                <div class="text-end">
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
</body>

</html>