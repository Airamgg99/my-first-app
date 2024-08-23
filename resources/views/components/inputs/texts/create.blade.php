<div class="mb-3">
    <label for={{ $name }} class="block mb-2 text-sm font-medium text-gray-900 w-full">
        {{ $text }}
    </label>
    <input type={{ $type }} id={{ $name }} name={{ $name }}
        @if ($required) required @endif
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3D73] focus:border-[#1B3D73] block w-full p-2.5">
</div>
