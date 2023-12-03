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
    <div class="d-flex flex-column overflow-hidden min-vh-100 vh-100">
        <header class="p-1 bg-body-tertiary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li>
                        <a href="/" class="nav-link text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-kanban d-block mx-auto mb-1" viewBox="0 0 24 24">
                                <path
                                    d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path
                                    d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1z" />
                            </svg>
                            Kanban
                        </a>
                    </li>
                    <li>
                        <a href="/client/table" class="nav-link text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-table d-block mx-auto mb-1" viewBox="0 0 24 24">
                                <path
                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z">
                                </path>
                            </svg>
                            Таблица
                        </a>
                    </li>
                    <li>
                        <a href="/wazzup/all" class="nav-link text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-whatsapp d-block mx-auto mb-1" viewBox="0 0 24 24">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                            Все чаты
                        </a>
                    </li>
                </ul>

                <ul class="nav align-items-center">
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->username}}
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="/settings">Настройки</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">Выход</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </header>

        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script src='/libs/jquery/jquery-3.7.1.min.js'></script>
    <script src='/libs/popper.min.js'></script>
    <script src='/libs/bootstrap/js/bootstrap.bundle.min.js'></script>
    <script src='/libs/jkanban/jkanban.min.js'></script>

    <script src='/main.js'></script>

    @yield('js')
</body>

</html>