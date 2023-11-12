<!DOCTYPE html> <html> <head> <meta charset='utf-8'> <meta http-equiv='X-UA-Compatible' content='IE=edge'>
<title>DTF.KZ</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>

<link rel='stylesheet' type='text/css' media='screen' href='/libs/jkanban/jkanban.min.css'>
<link rel='stylesheet' type='text/css' media='screen' href='/libs/bootstrap/bootstrap.min.css'>
<link rel='stylesheet' type='text/css' media='screen' href='/main.css'>
</head>

<body>
    <form action="/login" method="POST"> 
        {{Form::token()}} 

        <main class="form-signin w-100 m-auto">
            <form>
                <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Пожалуйста, авторизуйтесь</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email адрес</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Пароль</label>
                </div>

                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" value="remember" name='remember' id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Запомнить меня
                    </label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Вход</button>
            </form>
        </main>
    </form>

    <script src='/libs/jquery/jquery-3.7.1.min.js'></script>
    <script src='/libs/bootstrap/bootstrap.bundle.min.js'></script>
    <script src='/libs/jkanban/jkanban.min.js'></script>

    <script src='/main.js'></script>
</body>

</html>