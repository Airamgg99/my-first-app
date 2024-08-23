<div class="relative py-2">
    <label for="{{ $label }}"
        class="absolute left-2 top-4 text-gray-900 text-xs transition-all transform origin-[0] font-bold
        peer-focus:text-blue-500 peer-focus:top-0 peer-focus:text-xs
        peer-[:not(:placeholder-shown)]:top-0 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-gray-500 
        pointer-events-none z-10 bg-white px-1">
        {{ $inside }}
    </label>
    <select name="{{ $name }}" id="{{ $id }}" required wire:model="{{ $wire }}"
        class="peer pt-6 pb-3 pe-9 block w-full border-[#1B3D73] rounded-t-md text-sm 
        focus:border-[#1B3D73] focus:ring-[#1B3D73] disabled:opacity-50 disabled:pointer-events-none 
        appearance-none">
        <option value="0" selected disabled>{{ $text }}</option>
        @foreach ($elements as $item)
            <option value="{{ $item['id'] }}">
                {{ $item[$option] }}
            </option>
        @endforeach
    </select>
</div>
