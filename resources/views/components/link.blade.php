<a href="{{ route($route, [$key => $id]) }}" @class(['btn text-white mb-2 w-100',$getBtnClass])>
   {{ $slot }}
   {{ $text }}
</a>