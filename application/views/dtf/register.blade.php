@layout('layout')

@section('csstop')

@endsection

@section('content')
    <h1 class="h3 mb-3 fw-normal">Регистрация пользователя</h1>

    <div class="input-group mb-3">
        <label for="fio" class="form-label">ФИО</label>
        <input type="text" class="form-control" name="fio" id="fio" placeholder="name">
    </div>

    <div class="input-group mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-control" name="login" id="floatingInput" placeholder="name">
    </div>

    <div class="input-group mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
    </div>

    <div class="input-group mb-3">
        <label for="repeatpassword" class="form-label">Повторите пароль</label>
        <input type="password" class="form-control" name="repeatpassword" id="floatingPassword" placeholder="Password">
    </div>

    <select class="form-control" name="alevel" data-placeholder="Выберите уровень доступа">
        <option value="">Выберите уровень доступа</option>
        <option value="1">Администратор</option>
        <option value="2">Менеджер</option>
    </select>

    <button class="btn btn-primary w-100 py-2" type="submit">Регистрация</button>
@endsection

@section('js')
<script>

</script>
@endsection