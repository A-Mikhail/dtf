@layout('layout')

@section('csstop')
<link rel="stylesheet" href="/libs/datatable/jquery.dataTables.min.css">
<link rel="stylesheet" href="/libs/datatable/buttons.dataTables.min.css">
<link rel='stylesheet' href='/libs/select2/select2.min.css'>
@endsection

@section('content')
<div class="container px-4 py-5">
    <div class="row pb-4">
        <!-- Статистика за сегодня -->
        <h4 class="pb-2 border-bottom">Статистика за сегодня</h4>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2">
            @foreach($statbynow as $sn)
            <div class="col d-flex align-items-start">
                <svg class="bi text-body-secondary flex-shrink-0 me-3" width="1.75em" height="1.75em">
                    <use xlink:href="#bootstrap" />
                </svg>

                <div>
                    <h3 class="fw-bold mb-0 fs-4 text-body-emphasis text-center">{{$sn->cnt}}</h3>
                    <p>{{__("statuses.$sn->current_status")}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="row">
        <!-- Статистика за период -->
        <h4 class="pb-2 border-bottom">Статистика c {{date_format(date_create($from), 'd.m.Y')}} по {{date_format(date_create($to), 'd.m.Y')}}</h4>
    
        <div class="row justify-content-end">
            <form method="get" action='/dashboard/tasks'>
				<div class="row">
					<div class="col-12 col-md-2">
						<div class="form-group">
							<input type="text" name="filter_start_date" class="form-control fc-datepicker" placeholder="С"
                                value="{{Input::get('filter_start_date',date('01.m.Y'))}}" />
						</div>
					</div>

					<div class="col-12 col-md-3">
						<div class="input-group">
							<input type="text" name="filter_end_date" class="form-control fc-datepicker" placeholder="По" 
                                value="{{Input::get('filter_end_date',date('t.m.Y'))}}" />

							<button type="submit" class="btn btn-primary">
								<i class="fa fa-calendar"></i>
							</button>
						</div>
					</div>
				</div>
			</form>
        </div>

        <table id="clientTable" class="mx-auto mb-4 display">
            <thead>
                <tr>
                    <th>Статус</th>
                    <th>Кол-во</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statbydate as $sd)
                <tr>
                    <td>
                        <span class="badge badge-success rounded-pill d-inline">{{__("statuses.$sd->current_status")}}</span>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{$sd->cnt}}</p>
                    </td>
                    <td>{{date_format(date_create($sd->times), 'd.m.Y')}}</td>
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
<script src="/libs/jquery.maskedinput/js/jquery.maskedinput.js"></script>

<script>
    $('.fc-datepicker').mask('99.99.9999');

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