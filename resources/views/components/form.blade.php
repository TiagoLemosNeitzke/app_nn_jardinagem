<form action="{{ route($route, [$key => $id]) }}" method="{{ $method }}">
    @method($httpVerb)
    @csrf
   {{ $slot }}
</form>