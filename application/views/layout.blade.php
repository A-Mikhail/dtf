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
                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                      <a href="#" class="nav-link text-secondary">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                        Home
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                        Dashboard
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                        Orders
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                        Products
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link text-white">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                        Customers
                      </a>
                    </li>
                  </ul>
                  
                <ul class="nav col-6 mb-2 mb-md-0">
                    <li><a href="/" class="nav-link px-2 text-secondary active">Kanban</a></li>
                    <li><a href="/client/table" class="nav-link px-2 text-secondary active">Таблица</a></li>
                    <li><a href="/wazzup/all" class="nav-link px-2 text-secondary active">Все чаты</a></li>
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