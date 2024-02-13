@layout('layout')

@section('csstop')
<link rel='stylesheet' href='/libs/select2/select2.min.css'>
@endsection

@section('content')
<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Статистика за сегодня</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#collection" />
                </svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="feature col">
            <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#people-circle" />
                </svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="feature col">
            <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#toggles2" />
                </svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
    </div>
    
    <!-- Статистика за период -->
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
                    <span class="badge badge-success rounded-pill d-inline">{{__("statuses.$sd.current_status")}}</span>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{$sd.cnt}}</p>
                </td>
                <td>{{$sd.times}}</td>
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