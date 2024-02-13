@layout('layout')

@section('csstop')
<link rel='stylesheet' href='/libs/select2/select2.min.css'>
@endsection

@section('content')
<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Статистика за сегодня</h2>

    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Статус</th>
                <th>Кол-во</th>
                <th>Дата</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statbynow as $sn)
            <tr>
                <td>
                    <span class="badge badge-success rounded-pill d-inline">{{__("statuses.$sn->current_status")}}</span>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{$sn->cnt}}</p>
                </td>
                <td>{{$sn->times}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Статистика за период -->
    <h2 class="pb-2 border-bottom">Статистика c {{date_format(date_create($from), 'd.m.Y')}} по {{date_format(date_create($to), 'd.m.Y')}}</h2>

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
                <td>{{$sd->times}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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