@layout('layout')

@section('csstop')
<link rel="stylesheet" href="/libs/datatable/jquery.dataTables.min.css">
<link rel="stylesheet" href="/libs/datatable/buttons.dataTables.min.css">
<link rel='stylesheet' href='/libs/select2/select2.min.css'>
@endsection

@section('content')
<div class="container">
    <div class="px-4 py-5 my-5">
        <div class="row justify-content-end">
            <div class="col-3 pb-4">
                <select class="form-control dtable-filter" id="status_filter" data-placeholder="Все статусы">
                    <option value="">Все статусы</option>
                    <option value="Активный">Активный</option>
                    <option value="Заблокирован">Заблокирован</option>
                </select>
            </div>
        </div>

        <table id="clientTable" class="mx-auto mb-4 display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Имя пользователя</th>
                    <th>ФИО</th>
                    <th>Статус</th>
                    <th>Роль</th>
                    <th>Создан</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->username}}</td>
                    <td>{{$u->active}}</td>
                    <td>{{$u->alevel}}</td>
                    <td>{{$u->created_at}}</td>
                    @if($u->active == 'Активный')
                    <td><button type="button" class="btn btn-sm btn-danger btn-block-user" data-id="{{$u->id}}" data-mdb-ripple-init>Заблокировать</button></td>
                    @else
                    <td><button type="button" class="btn btn-sm btn-success btn-unblock-user" data-id="{{$u->id}}" data-mdb-ripple-init>Разблокировать</button></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="/libs/datatable/jquery.dataTables.min.js"></script>
<script src="/libs/datatable/dataTables.buttons.min.js"></script>
<script src="/libs/datatable/jszip.min.js"></script>
<script src="/libs/datatable/pdfmake.min.js"></script>
<script src="/libs/datatable/vfs_fonts.js"></script>
<script src="/libs/datatable/buttons.html5.min.js"></script>
<script src="/libs/select2/select2.min.js"></script>

<script>
	$.fn.dataTable.ext.search.push(
		function( settings, data, dataIndex ) {
			if (data[3]==$('#status_filter').val()){
				return true;
			}else if($('#status_filter').val()==''){
				return true;
			}
			return false;
		}
	);

    $("#status_filter").on('change keyup click',function(){
        $('#clientTable').DataTable().draw();
    });

    $('.btn-block-user').on('click', function (){
        let id = $(this).data('id');
        let that = this;

        $.ajax({
            url: `/user/block/${id}`,
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status == 'success') {
                    $('.toast-body').text('Пользователь заблокирован');
                    toastBootstrap.show();

                    $(that).removeClass('btn-danger btn-block-user').addClass('btn-success btn-unblock-user');
                    $(that).text('Разблокировать');
                } else if (data.status == 'not found') {
                    $('.toast-body').text('Пользователь не найден');
                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка во время блокировки пользователя');
                toastBootstrap.show();
            }
        });
    });
    
    $('.btn-unblock-user').on('click', function (){
        let id = $(this).data('id');
        let that = this;

        $.ajax({
            url: `/user/unblock/${id}`,
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status == 'success') {
                    $('.toast-body').text('Пользователь разблокирован');
                    toastBootstrap.show();

                    $(that).removeClass('btn-success btn-unblock-user').addClass('btn-danger btn-block-user');
                    $(that).text('Заблокировать');
                } else if (data.status == 'not found') {
                    $('.toast-body').text('Пользователь не найден');
                    toastBootstrap.show();
                }
            },
            error: function () {
                $('.toast-body').text('Ошибка во время блокировки пользователя');
                toastBootstrap.show();
            }
        });
    });

    let table = new DataTable('#clientTable', {
        responsive: true,
        language: {
            sProcessing: "Подождите...",
            sLengthMenu: "Показать _MENU_ записей",
            sZeroRecords: "Записи отсутствуют.",
            sInfo: "Записи с _START_ до _END_ из _TOTAL_ записей",
            sInfoEmpty: "Записи с 0 до 0 из 0 записей",
            sInfoFiltered: "(отфильтровано из _MAX_ записей)",
            sInfoPostFix: "",
            searchPlaceholder: 'Поиск...',
            sSearch: "",
            sUrl: "",
            oPaginate: {
                sFirst: "Первая",
                sPrevious: "<",
                sNext: ">",
                sLast: "Последняя"
            },
            oAria: {
                sSortAscending: ": активировать для сортировки столбца по возрастанию",
                sSortDescending: ": активировать для сортировки столбцов по убыванию"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Скопировать'
            },
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
</script>
@endsection