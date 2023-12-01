@layout('layout')

@section('csstop')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <h4>{{$client}}</h4>
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

    const contactMessage = (chatId) => {
        $('.btn-contact-message').off('click').on('click', function () {
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
    };
</script>
@endsection