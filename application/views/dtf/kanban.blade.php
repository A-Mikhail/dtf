@layout('layout')

@section('csstop')
<style>
    .kanban-board .kanban-drag {
        max-height: 80vh !important;
        overflow-y: auto !important;
        overflow-x: hidden;
        padding: 10px !important;
    }

    .kanban-board header {
        padding: 10px !important;
        font-size: 12pt !important;
    }

    .item-title, .item-subtitle {
        word-wrap: break-word;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div id="kanban">
            </div>
        </div>
    </div>
</div>

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Оповещение</strong>
        <small class="text-body-secondary">Только что</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>

    <div class="toast-body">
    </div>
</div>
@endsection

@section('js')
<script src="/libs/socket.io.min.js"></script>

<script>
    new jKanban({
        element: '#kanban',
        gutter: '10px',
        widthBoard: '100%',
        responsivePercentage: true,
        dragBoards: false, 
        click: function (el) {
            window.open(`/client/${$(el).data('chatid')}`, '_blank');
        },
        dropEl: function (el, target, source, sibling) {
            $.ajax({
                url: '/changestatus',
                method: 'POST',
                dataType: 'json',
                data: {
                    chatId: $(el).data('chatid'),
                    status: $(target).parent().data('id')
                },
                error: function () {
                    $('.toast-body').text('Ошибка изменения статуса');

                    const toastElList = document.querySelectorAll('.toast');
                    const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
                }
            });
        },
        boards: [
            @foreach($statuses as $status => $color)
            {
                'id': '{{$status}}',
                'title': '{{__("statuses.$status")}}',
                'class': 'bg-{{$color}}, text-white',
                'item': [
                    @foreach($clients as $c)
                        @if ($c->current_status == $status) 
                            {
                                'title': `<p class="fw-bold m-0 item-title">{{$c->chat_id}}</p>
                                    <p class="m-0 item-subtitle">{{$c->name}}</p>`,
                                'chatId': '{{$c->chat_id}}',
                            },
                        @endif
                    @endforeach
                ]
            },
            @endforeach
        ]
    });

    // apiKey интеграции, полученный из личного кабинета Wazzup
    const apiKey = '38bf7b77d71c43dbaa07b9ed936af840';

    // id менеджера из вашей CRM
    const userId = '1';

    // Опции подключения к сервису нотификаций
    const connectOptions = {
        path: '/ws-counters/',
        transports: ['websocket', 'polling']
    };

    // Получаем url для подключения к сервису нотификаций
    fetch(`https://integrations.wazzup24.com/counters/ws_host/api_v3/${apiKey}`)
        .then((response) => response.json())
        .then((data) => {
            const { host } = data;
            // Подключаемся при помощи socket.io
            const client = io(`https://${host}`, connectOptions);
            // Слушаем событие 'connect'
            client.on('connect', () => {
                // Завершаем подключение: транслируем событие 'counterConnecting', в котором передаем данные клиента
                client.emit('counterConnecting', {
                    type: 'api_v3',
                    apiKey,
                    userId
                });
            });

            // Обновление счетчика неотвеченных
            client.on('counterUpdate', (data) => {
                // используйте counter для работы через веб-сокеты
                // или counterV2 + type для работы по новому механизму подсчета неотвеченных
                // type может быть 'red' или 'grey', в случае если counterV2>0 или null, если counterV2 = 0
                const { counter, counterV2, type } = data;

                const myBadgerOptions = {}; // See: constructor for customization options
                const myBadger = new Badger(myBadgerOptions);

                myBadger.value = counter;
            });
        })
        .catch((error) => {
            console.log('Connection error', error);
        });
</script>
@endsection