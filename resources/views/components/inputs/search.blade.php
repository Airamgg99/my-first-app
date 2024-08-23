<label for="search" class="sr-only">Buscar</label>
<div class="relative flex items-center ml-0.5">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <x-phosphor-magnifying-glass class="flex-shrink-0 w-5 h-5 text-[#02225A] transition duration-75" />
    </div>
    <input type="text" id="table-search" wire:model="searchTerm"
        class="block pl-10 pr-3 mr-0.5 mt-0.5 text-sm text-[#02225A] placeholder-[#02225A] border border-[#02225A] 
        rounded-lg w-56 bg-gray-50 focus:ring-[#02225A] focus:border-[#02225A]"
        placeholder="{{ $search }}">
</div>
