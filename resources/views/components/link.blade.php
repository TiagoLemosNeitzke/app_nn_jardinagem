<a href="{{ route($route, [$key => $id]) }}" @class(['btn fw-bold text-white mb-2 w-100',$getBtnClass])>
   {{ $slot }}
   {{ $text }}
</a>