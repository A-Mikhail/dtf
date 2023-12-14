@layout('layout')

@section('csstop')
<link rel='stylesheet' type='text/css' media='screen' href='/libs/jkanban/jkanban.min.css'>

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
<script src='/libs/jkanban/jkanban.min.js'></script>

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
                                @if($c->price)
                                'title': `<p class="fw-bold m-0 item-title">{{$c->chat_id}}</p>
                                    <p class="m-0 item-subtitle">{{$c->name}}</p>
                                    <p class="m-0" style="font-size: small;">{{number_format($c->price,0,'.',' ')}} ₸</p>
                                    <p style="font-size: small;" class="text-end m-0">{{date_format(date_create($c->created_at), 'd.m.Y')}}</p>`
                                @else
                                'title': `<p class="fw-bold m-0 item-title">{{$c->chat_id}}</p>
                                    <p class="m-0 item-subtitle">{{$c->name}}</p>
                                    <p style="font-size: small;" class="text-end m-0">{{date_format(date_create($c->created_at), 'd.m.Y')}}</p>`,
                                @endif
                                'chatId': '{{$c->chat_id}}',
                            },
                        @endif
                    @endforeach
                ]
            },
            @endforeach
        ]
    });
</script>
@endsection