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

<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="contactModalTitle">Выберите действие</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <button type="button" class="btn btn-info btn-contact-message">Перейти к чату</button>
                
                <hr class="dropdown-divider">
                
                <button type="button" class="btn btn-success btn-status-success">Завершить</button>
                <button type="button" class="btn btn-danger btn-status-danger">Забраковать</button>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
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
            const contactModal = new bootstrap.Modal('#contactModal');
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