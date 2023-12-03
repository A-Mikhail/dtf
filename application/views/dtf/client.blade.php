@layout('layout')

@section('csstop')
<style>

</style>
@endsection

@section('content')
<div class="container pt-4" style="height: 80%;">
    <!-- Header -->
    <div class="pb-2 border-bottom row">
        <div class="col-6">
            <h5>{{$client->chat_id}}</h5>
            <div class="mb-1 text-body-secondary">{{$client->name}}</div>
        </div>

        <div class="col-6 d-flex flex-row justify-content-end align-items-center gap-2">
            <button type="button" class="btn btn-success btn-status-success px-2">Завершить</button>
            <button type="button" class="btn btn-danger btn-status-reject px-2">Забраковать</button>
        </div>
    </div>

    <div class="row h-100">
        <!-- WA Chat -->
        <div class="col-12 col-md-7">
            <iframe src="{{$iframelink}}" allow="microphone *" class="w-100 h-100 border-0"></iframe>
        </div>

        <!-- Logs -->
        <div class="col-12 col-md-5">
            @if($clientLog)
            <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
                <div class="list-group">
                    @foreach($clientLog as $cl)
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    @if($cl->type == 'status')
                                    <h6 class="mb-0 fw-bold">Статус</h6>
                                    @endif
                                    <p class="mb-0 opacity-75">{{$cl->comment}}</p>
                                    <small class="mb-0 opacity-75">{{$cl->author}}</small>
                                </div>
                                <small class="opacity-50 text-nowrap">{{date_format(date_create($cl->created_at), 'd.m.Y')}}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @else
            <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
                <div class="list-group">
                    <p>Нет истории на данного клиента</p>
                </div>
            </div>
            @endif
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
    const statusSuccess = (chatId) => {
        $('.btn-status-success').off('click').on('click', function () {
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
    };

    const statusReject = (chatId) => {
        $('.btn-status-reject').off('click').on('click', function () {
            $.ajax({
                url: '/changestatus',
                method: 'POST',
                dataType: 'json',
                data: {
                    chatId: chatId,
                    status: 'reject'
                },
                success: function (data) {
                    if (data.status == 'ok') {
                        // Remove from kanban
                        $(this).parent().parent().parent().remove();
    
                        $('.toast-body').text('Контакт переведён в статус забракован');
    
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
    };
</script>
@endsection