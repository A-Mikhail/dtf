@layout('layout')


@section('content')
<div class="container">
    <div class="row m-b-30">
        <div class="col-md-12">
            <div id="kanban"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/js/kanban.js"></script>
@endsection