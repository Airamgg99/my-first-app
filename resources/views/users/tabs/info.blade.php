<div class="w-full h-full flex flex-col">
    {!! Form::open([
        'route' => ['users.update', $user->id],
        'method' => 'PUT',
        'enctype' => 'multipart/form-data',
        'class' => 'flex flex-col flex-grow w-full h-full',
    ]) !!}
    <div class="flex flex-row w-full">
        <div class="flex-grow pr-4">
            <div class="mb-6 w-full">
                @include('components.inputs.texts.edit', [
                    'text' => 'Name',
                    'type' => 'text',
                    'name' => 'name',
                    'required' => 'required',
                    'value' => $user->name,
                ])
            </div>
            <div class="mb-6 w-full">
                @include('components.inputs.texts.edit', [
                    'text' => 'Email',
                    'type' => 'email',
                    'name' => 'email',
                    'required' => 'required',
                    'value' => $user->email,
                ])
            </div>
            <div class="mb-6 w-full">
                @include('components.inputs.texts.edit', [
                    'text' => 'New Password',
                    'type' => 'password',
                    'name' => 'password',
                    'required' => null,
                    'value' => null,
                ])
            </div>
            <div class="mb-6">
                @include('components.inputs.selectize.edit', [
                    'id' => 'role',
                    'text' => 'Select a role',
                    'name' => 'role_id',
                    'option' => 'role',
                    'option_id' => 'id',
                    'required' => true,
                    'elements' => App\Models\Roles\Role::orderBy('role')->get(),
                    'value' => $user->role_id,
                ])
            </div>
            <div class="mb-6">
                @include('components.inputs.selectize.edit', [
                    'id' => 'status',
                    'text' => 'Select a status',
                    'name' => 'status_id',
                    'option' => 'status',
                    'option_id' => 'id',
                    'required' => true,
                    'elements' => App\Models\Statuses\Status::orderBy('status')->get(),
                    'value' => $user->status_id,
                ])
            </div>
        </div>
        <div class="w-1/4 flex flex-col items-center">
            <div class="w-full mb-6">
                @if ($user->image)
                    <img src="{{ $user->getImage() }}" alt="{{ $user->name }}" title="{{ $user->name }}"
                        class="w-full h-96 border border-[#1B3D73] mb-2">
                @else
                    <img src="/images/notFound.png" class="w-full h-96 border border-[#1B3D73] mb-2">
                @endif
                <label for="new-image-input" class="block mb-2 text-sm font-medium text-gray-900">New image</label>
                <input type="file" id="new-image-input" name="image" accept="image/png, image/jpeg, image/jpg"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>
        </div>
    </div>
    <div class="flex justify-between mt-auto">
        @include('components.buttons.back', [
            'route' => route('users.index'),
            'text' => 'Back',
        ])
        @include('components.buttons.submit', [
            'text' => 'Submit',
        ])
    </div>
    {!! Form::close() !!}
</div>
