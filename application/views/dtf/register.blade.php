@layout('layout')

@section('csstop')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="h3 mb-3 fw-normal">Регистрация пользователя</h1>
    
            <label for="fio" class="form-label">ФИО</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="fio" id="fio" placeholder="ФИО">
            </div>
    
            <label for="login" class="form-label">Логин</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="login" id="floatingInput" placeholder="Логин">
            </div>
    
            <label for="password" class="form-label">Пароль</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Пароль">
            </div>
    
            <label for="repeatpassword" class="form-label">Повторите пароль</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="repeatpassword" id="floatingPassword"
                    placeholder="Повторите пароль">
            </div>
    
            <div class="input-group mb-3">
                <select class="form-control" name="alevel" data-placeholder="Выберите уровень доступа">
                    <option value="">Выберите уровень доступа</option>
                    <option value="1">Администратор</option>
                    <option value="2">Менеджер</option>
                </select>
            </div>
    
            <button class="btn btn-primary w-100 py-2 btn-create-user" type="submit">Создать пользователя</button>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

</script>
@endsection