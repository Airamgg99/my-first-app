<span data-tooltip-target="tooltip-default-{{ $id }}" data-tooltip-trigger="{{ $trigger }}"
    class="bg-[#FDC700] text-[#1B3D73] text-xs font-medium px-2.5 py-0.5 rounded">{{ $badgeText }}</span>


<div id="tooltip-default-{{ $id }}" role="tooltip"
    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium bg-[#FDC700] transition-opacity 
    duration-300 text-[#1B3D73] rounded-lg shadow-sm opacity-0 tooltip">
    {{ $tooltipText }}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
