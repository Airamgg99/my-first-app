<x-breadcrumbs.users.index>
    <x-breadcrumbs.element icon="phosphor-users-three-light" :text="$user->name" :route="route('users.edit', $user->id)" />
    {{ $slot }}
</x-breadcrumbs.users.index>
