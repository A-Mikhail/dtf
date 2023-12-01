@layout('layout')

@section('content')
    <iframe src="{{$iframeurl}}" allow="microphone *"  class="w-100 border-0" style="height: calc(100% - 152px); width: 100vw; padding: 0; margin: 0; left: 0; position: absolute;"></iframe>
@endsection