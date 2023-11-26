@layout('layout')


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
        gutter: '15px',
        widthBoard: '100%',
        responsivePercentage: true,
        click: function (el) {
            const dropdownElementList = document.querySelectorAll('.dropdown');
            const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));
        },
        boards: [
            @foreach($statuses as $s)
            {
                'id': '{{$s->current_status}}',
                'title': '{{__("statuses.$s->current_status")}}',
                'class': 'bg-primary,text-white',
                'item': [
                    @foreach($clients as $c)
                    {
                        'title': `<p class="fw-bold m-0">{{$c->chat_id}}</p>
                            <p class="m-0">{{$c->name}}</p>            
                            
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-success btn-status-success" href="#">Завершить</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger btn-status-danger" href="#">Забраковать</a></li>
                            </ul>`,
                        'class': ['dropdown'],
                        'chatId': '{{$c->chat_id}}',
                        'bs-toggle': 'dropdown'
                    },
                    @endforeach
                ]
            },
            @endforeach
        ]
    });

    $('.btn-status-success').on('click', function () {
        const chatId = $(this).parent().parent().parent().data('chatid');

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

                    $('.toast-body').text('Статус изменён на завершено');

                    const toastElList = document.querySelectorAll('.toast');
                    const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, option));
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка изменения статуса');

                const toastElList = document.querySelectorAll('.toast');
                const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, option));
            }
        });
    });

    $('.btn-status-danger').on('click', function () {

    });
</script>
@endsection