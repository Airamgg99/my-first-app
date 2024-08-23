<label for={{ $name }} class="block mb-2 text-sm font-medium text-gray-900">
    {{ $text }}
</label>
<select id={{ $id }} name={{ $name }} @if ($required) required @endif
    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B3D73] focus:border-[#1B3D73] block w-full p-2.5">
    <option value="" selected disabled>Select an option</option>
    @foreach ($elements as $item)
        <option value="{{ $item[$option_id] }}" @if ($item[$option_id] == $value) selected @endif>
            {{ $item[$option] }}
        </option>
    @endforeach
</select>
<script>
    $(document).ready(function() {
        $('#{{ $name }}').selectize();
    })
</script>
