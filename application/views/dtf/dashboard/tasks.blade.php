@layout('layout')

@section('csstop')
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
    
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
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
<script src="/libs/select2/select2.min.js"></script>

<script>
    $('#reporting_date').on('select2:select', function (e) {
        var data = e.params.data;

        location.replace("?reporting_date=" + data.id);
    });
</script>
@endsection