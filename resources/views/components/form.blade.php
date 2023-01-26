<form action="{{ route($route, [$key => $id]) }}" method="{{ $method }}">
    @method($method)
    @csrf
   {{ $slot }}
</form>