@layout('layout')

@section('csstop')
<style>

</style>
@endsection

@section('content')
<div class="container pt-4">
    <h5>{{$client->chat_id}}</h5>
    <div class="mb-1 text-body-secondary">{{$client->name}}</div>

    <div class="row" class="height: 80%;">
        <div class="col-12 col-md-6">
            <iframe src="{{$iframelink}}" allow="microphone *"  class="w-100 h-100 border-0"></iframe>
        </div>

        <div class="col-6"></div>
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