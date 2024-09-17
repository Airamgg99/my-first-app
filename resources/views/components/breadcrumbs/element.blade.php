<li aria-current="page">
    <x-eos-keyboard-arrow-right class="w-4 h-4 text-gray-400" />
</li>
<li class="inline-flex items-center">
    <a href="{{ $route }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
        <x-dynamic-component :component="$icon" class="w-4 h-4 text-gray-400 mr-1" />
        <span>{{ $text }}</span>
    </a>
</li>
