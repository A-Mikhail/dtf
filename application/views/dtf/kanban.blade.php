@layout('layout')


@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div id="kanban"></div>
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
            alert(el.innerHTML);
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
                        'title': '{{$c->name}}'
                    },
                    @endforeach
                ]
            },
            @endforeach
        ]
    });    
</script>
@endsection