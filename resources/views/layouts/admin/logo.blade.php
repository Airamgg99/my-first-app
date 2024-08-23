<div class="flex items-center justify-start">
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
        class="bg-[#1B3D73] visible inline-flex relative items-center p-2 text-sm rounded-lg 
        border-2 border-[#FDC700] md:hidden focus:outline-none focus:ring-1 focus:ring-[#FDC700]">
        <x-ik-hamburger class="w-6 h-6 text-[#FDC700]" />
    </button>
    <a href="{{ route('index') }}" class="flex ms-2 md:me-24">
        <span class="self-center text-xl font-semibold text-[#FDC700] sm:text-2xl whitespace-nowrap">
            My App</span>
    </a>
</div>
