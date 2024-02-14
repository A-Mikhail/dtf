@layout('layout')

@section('csstop')
<link rel="stylesheet" href="/libs/datatable/jquery.dataTables.min.css">
<link rel="stylesheet" href="/libs/datatable/buttons.dataTables.min.css">
<link rel='stylesheet' href='/libs/select2/select2.min.css'>
@endsection

@section('content')
<div class="container">
    <div class="px-4 py-5 my-5">
        <div class="row justify-content-between">
            <div class="col-3 pb-4">
                <div class="form-group mg-b-10-force">
                    <select class="form-control select2" id="reporting_date" data-placeholder="Выберите месяц">
                        <?php $rucurmonth='Текущий месяц'; ?>
                        @foreach($months as $k => $v)
                            @if(Input::get('reporting_date') == $k)
                            <option value="{{$k}}" selected="">{{$v}}</option>
                            <?php $rucurmonth=$v; ?>
                            @else
                            <option value="{{$k}}">{{$v}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>	
            </div>

            <div class="col-3 pb-4">
                <select class="form-control dtable-filter" id="status_filter" data-placeholder="Все статусы">
                    <option value="">Все статусы</option>

                    @foreach($uniqueStatuses as $us)
                        <option value="{{$us}}">{{$us}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table id="clientTable" class="mx-auto mb-4 display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Номер</th>
                    <th>Имя</th>
                    <th>Статус</th>
                    <th>Цена</th>
                    <th>Метраж</th>
                    <th>Обновлён</th>
                    <th>Создан</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td><a href="/client/{{$c->chat_id}}" target="_blank">{{$c->chat_id}}</a></td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->current_status}}</td>
                    <td>{{$c->last_price}}</td>
                    <td>{{$c->last_supply_m}}</td>
                    <td>{{$c->updated_at}}</td>
                    <td>{{$c->created_at}}</td>
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

    let table = new DataTable('#clientTable', {
        responsive: true,
        order: [[6, 'desc']],
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

	$('.select2').select2({
		minimumResultsForSearch: Infinity
	});

	$('#reporting_date').on('select2:select', function (e) {
		var data = e.params.data;
		
		location.replace("?reporting_date=" + data.id);
	});
</script>
@endsection