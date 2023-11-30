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
<script>
    new jKanban({
        element: '#kanban',
        gutter: '10px',
        widthBoard: '100%',
        responsivePercentage: true,
        dragBoards: false, 
        click: function (el) {
            const dropdownElementList = document.querySelectorAll('.dropdown');
            const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));
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
                                    <p class="m-0 item-subtitle">{{$c->name}}</p>            
                                    
                                    <ul class="dropdown-menu" data-chatid="{{$c->chat_id}}">
                                        <li><a class="dropdown-item text-info btn-contact-message" href="#">Перейти к чату</a></li>    
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-success btn-status-success" href="#">Завершить</a></li>
                                        <li><a class="dropdown-item text-danger btn-status-danger" href="#">Забраковать</a></li>
                                    </ul>`,
                                'class': ['dropdown'],
                                'chatId': '{{$c->chat_id}}',
                                'bs-toggle': 'dropdown'
                            },
                        @endif
                    @endforeach
                ]
            },
            @endforeach
        ]
    });

    $('.btn-status-success').on('click', function () {
        const chatId = $(this).data('chatid');

        $.ajax({
            url: '/changestatus',
            method: 'POST',
            dataType: 'json',
            data: {
                chatId: chatId,
                status: 'success'
            },
            success: function (data) {
                if (data.status == 'ok') {
                    // Remove from kanban
                    $(this).parent().parent().parent().remove();

                    $('.toast-body').text('Контакт переведён в статус завершён');

                    const toastElList = document.querySelectorAll('.toast');
                    const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка изменения статуса');

                const toastElList = document.querySelectorAll('.toast');
                const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
            }
        });
    });

    $('.btn-contact-message').on('click', function () {
        const chatId = $(this).data('chatid');

        console.log(chatId);

        $.ajax({
            url: '/chatiframe',
            method: 'GET',
            dataType: 'json',
            data: {
                chatId: chatId
            },
            success: function (data) {
                if (data.status == 'ok') {
                    window.open(data.iframeurl, '_blank');
                }
            },
            error: function () {
                $('.toast-body').text('Произошла ошибка во время открытия чата');

                const toastElList = document.querySelectorAll('.toast');
                const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
            }
        });
    });

    $('.btn-status-danger').on('click', function () {

    });
</script>
@endsection