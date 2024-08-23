<nav class="fixed top-0 z-50 w-full bg-[#1B3D73] border-b border-gray-200">
    <div class="px-3 py-3 2xl:px-5 2xl:pl-3">
        <div class="flex items-center justify-between">
            @include('layouts.user.logo')

            @include('layouts.user.profile')
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        @include('layouts.user.sidebar')
    </div>
</aside>
