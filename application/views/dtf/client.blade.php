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

        <div class="col-3">
            @if($client->getPrice())
            <span class="fs-5">{{$client->getPrice()}} ₸</span>
            @endif
        </div>

        <div class="col-3 d-flex flex-row justify-content-end align-items-center gap-2">
            @if($client->current_status == 'success')
            <button type="button" class="btn btn-success btn-status-success px-2" disabled>Завершить</button>
            @else
            <button type="button" class="btn btn-success btn-status-success px-2">Завершить</button>
            @endif

            @if($client->current_status == 'reject')
            <button type="button" class="btn btn-danger btn-status-reject px-2" disabled>Забраковать</button>
            @else
            <button type="button" class="btn btn-danger btn-status-reject px-2">Забраковать</button>
            @endif
        </div>
    </div>

    <!-- Change statuses and set price -->
    <div class="row pb-2 mt-4">
        <div class="col-12 col-md-7">
            <div class="col-12 col-md-6">
                <select class="form-control status-select" data-placeholder="Новый статус">
                    <option value="{{$client->current_status}}">{{$client->rustatus()}}</option>

                    @foreach($statuses as $s)
                        @if($s != $client->current_status)
                            <option value="{{$s}}">{{__("statuses.$s")}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="card p-2">
                <div class="input-group">
                    
                    <input type="number" id="price" class="form-control" placeholder="Стоимость">
                    <button class="btn btn-primary btn-save-price">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row h-100">
        <!-- WA Chat -->
        <div class="col-12 col-md-7 h-100">
            <iframe src="{{$iframelink}}" allow="microphone *" class="w-100 h-100 max-h-100"></iframe>
        </div>

        <!-- Logs -->
        <div class="col-12 col-md-5 h-100">
            @if($clientLog)
            <div class="overflow-y-auto mt-4" style="height: 70%">
                <div class="list-group">
                    @foreach($clientLog as $cl)
                    <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action gap-3 py-3">
                        <div>
                            @if($cl->type == 'status')
                            <h6 class="mb-0 fw-bold">Статус</h6>
                            @elseif($cl->type == 'price')
                            <h6 class="mb-0 fw-bold">Цена</h6>
                            @endif
                            <p class="mb-0 opacity-75">{{$cl->comment}}</p>
                            <small class="mb-0 opacity-75">{{$cl->author}}</small>
                        </div>
                        <small class="opacity-50 text-nowrap">{{date_format(date_create($cl->created_at), 'd.m.Y')}}</small>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="overflow-y-auto mt-4" style="height: 70%">
                <div class="list-group">
                    <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action gap-3 py-3">
                        <p>Нет истории на данного клиента</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<input type="hidden" name="chat_id" value="{{$client->chat_id}}">
@endsection

@section('js')
<script>
    const chatId = $('input[name="chat_id"]').val();

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
                    $('.toast-body').text('Контакт переведён в статус завершён');

                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка изменения статуса');
                
                toastBootstrap.show();
            }
        });
    });

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
                    $('.toast-body').text('Контакт переведён в статус забракован');

                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка изменения статуса');
                
                toastBootstrap.show();
            }
        });
    });

    $('.btn-save-price').off('click').on('click', function () {
        const priceVal = $('#price').val();

        $.ajax({
            url: '/setprice',
            method: 'POST',
            dataType: 'json',
            data: {
                chatId: chatId,
                price: priceVal
            },
            success: function (data) {
                if (data.status == 'ok') {
                    $('.toast-body').text('Сумма сохранена');

                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка изменения статуса');
                
                toastBootstrap.show();
            }
        });
    });

    $('.status-select').on('change', function() {
        $.ajax({
            url: '/changestatus',
            method: 'POST',
            dataType: 'json',
            data: {
                chatId: chatId,
                status: $(this).val()
            },
            success: function (data) {
                if (data.status == 'ok') {
                    $('.toast-body').text(`Статус успешно изменён на ${$(".status-select option:selected").text()}`);

                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка изменения статуса');
                
                toastBootstrap.show();
            }
        });
    });
</script>
@endsection