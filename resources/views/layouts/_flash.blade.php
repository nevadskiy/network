@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <script>
        	console.log('HERE');
        	window.flash('{{ Session::get($msg) }}', '{{ $msg }}')
        </script>
    @endif
@endforeach