@layout('layout')


@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div id="kanban">
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    new jKanban({
        element: '#kanban',
        gutter: '15px',
        widthBoard: '100%',
        responsivePercentage: true,
        click: function (el) {
            const dropdownElementList = document.querySelectorAll('.dropdown');
            const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
        },
        // Right click
        context: function (el, event) {
            console.log(el, event);

            const dropdownElementList = document.querySelectorAll('.dropdown');
            const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
        },
        boards: [
            @foreach($statuses as $s)
            {
                'id': '{{$s->current_status}}',
                'title': '{{__("statuses.$s->current_status")}}',
                'class': 'bg-primary,text-white',
                'item': [
                    @foreach($clients as $c)
                    {
                        'title': '<p class="fw-bold m-0">{{$c->chat_id}}</p> <p class="m-0">{{$c->name}}</p>',
                        'class': ['dropdown'],
                        'bs-toggle': 'dropdown'
                    },
                    @endforeach
                ]
            },
            @endforeach
        ]
    });    
</script>
@endsection