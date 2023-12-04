@layout('layout')

@section('csstop')
<link rel="stylesheet" href="/libs/datatable/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <table id="clientTable" class="display">
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
            <tr>
                @foreach($clients as $c)
                    <td>{{$c->id}}</td>
                    <td>{{$c->chat_id}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->current_status}}</td>
                    <td>{{$c->updated_at}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="/libs/datatable/jquery.dataTables.min.js"></script>

<script>
    let table = new DataTable('#clientTable', {
        responsive: true
    });
</script>
@endsection