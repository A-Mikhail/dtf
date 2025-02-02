@layout('layout')

@section('csstop')

@endsection

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h1 class="h3 mb-3 fw-normal">Регистрация пользователя</h1>
    
            <form>
                <label for="fio" class="form-label">ФИО</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fio" placeholder="ФИО">
                </div>
        
                <label for="login" class="form-label">Логин</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="login" placeholder="Логин">
                </div>
        
                <label for="password" class="form-label">Пароль</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Пароль">
                </div>
        
                <label for="repeatpassword" class="form-label">Повторите пароль</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="repeatpassword" placeholder="Повторите пароль">
                </div>
        
                <label for="alevel" class="form-label">Уровень доступа</label>
                <div class="input-group mb-3">
                    <select class="form-control" name="alevel" data-placeholder="Выберите уровень доступа">
                        <option value="">Выберите уровень доступа</option>
                        <option value="1">Администратор</option>
                        <option value="2">Менеджер</option>
                    </select>
                </div>
        
                <button class="btn btn-success w-100 py-2 mt-3 btn-create-user">Создать пользователя</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const toastBootstrap = new bootstrap.Toast($('#toast')[0]);

    $('.btn-create-user').on('click', function (e) {
        e.preventDefault();
        
        $.ajax({
            url: '/register',
            method: 'POST',
            dataType: 'json',
            data: $('form').serialize(),
            success: function (data) {
                if (data.status == 'success') {
                    $('.toast-body').text(`Пользователь ${$("input[name='fio']").val()} создан`);
                    toastBootstrap.show();
                } else if (data.status == 'exist') {
                    $('.toast-body').text(`Пользователь ${$("input[name='login']").val()} уже существует`);
                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка во время регистрации пользователя');
                toastBootstrap.show();
            }
        });
    });

    $("input[name='repeatpassword']").on('blur', function () {       
        if ($("input[name='password']").val() !== $("input[name='repeatpassword']").val()) {

            $('.btn-create-user').attr('disabled', true);

            $('.toast-body').text('Пароль не совпадает');
            toastBootstrap.show();
        } else {
            $('.btn-create-user').attr('disabled', false);
        }
    });
</script>
@endsection