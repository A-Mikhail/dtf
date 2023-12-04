@layout('layout')

@section('csstop')
<link rel="stylesheet" href="/libs/datatable/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="px-4 py-5 my-5">
        <div>
            <select class="form-control select2 col dtable-filter" id="status_filter" data-placeholder="Все статусы">
                <option value="">Все статусы</option>

                @foreach($array_unique($clients)->current_status as $c)
                    <option value="{{$c->current_status)}}">{{$c->current_status}}</option>
                @endforeach
            </select>
        </div>

        <table id="clientTable" class="mx-auto mb-4 display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Номер</th>
                    <th>Имя</th>
                    <th>Статус</th>
                    <th>Обновлён</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->chat_id}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->current_status}}</td>
                    <td>{{$c->updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="/libs/datatable/jquery.dataTables.min.js"></script>

<script>
	$.fn.dataTable.ext.search.push(
		function( settings, data, dataIndex ) {
			if (data[8]==$('#status_filter').val()){
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
        }
    });
</script>
@endsection