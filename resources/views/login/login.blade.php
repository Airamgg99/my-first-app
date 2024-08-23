@extends('layouts.login.login')
@section('content')
    <div class="flex min-h-full flex-col justify-center py-12 px-6 lg:px-8 bg-[#d6d8da]">
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="py-6 space-y-6 shadow rounded-lg divide-y divide-slate-400 border bg-white">
                <h2 class="px-4 text-center p-2 text-xl font-bold text-[#02225A]">My App Access</h2>
                {!! Form::open([
                    'route' => 'login.authenticate',
                    'method' => 'POST',
                    'class' => 'space-y-6',
                ]) !!}
                <div class="px-4 sm:px-10">
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <input type="text" name="email" id="email"
                            class="block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-[#FDC700] focus:ring-[#FDC700] focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 focus:outline-none "
                            placeholder="Email">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <x-phosphor-user class="w-4 h-4 text-gray-400" />
                        </div>
                    </div>
                </div>
                <div class="px-4 sm:px-10">
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <input type="password" name="password" id="password"
                            class="block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-[#FDC700] focus:ring-[#FDC700] focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 focus:outline-none "
                            placeholder="Password">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <x-phosphor-lock-simple-light class="w-4 h-4 text-gray-400" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-medium hover:underline text-[#02225A] decoration-2">Forgot your password?</a>
                </div>
                <div class="px-4 sm:px-10">
                    <button type="submit"
                        class="flex w-full justify-center text-[#02225A] rounded-md bg-[#FDC700] px-3 py-2 text-sm font-semibold hover:text-white shadow-sm hover:bg-[#02225A]">
                        Enter
                    </button>
                </div>
                <div class="flex justify-center">
                    <p class="text-sm font-medium">No account?
                        <a href="{{ route('register') }}"
                            class="text-sm font-medium hover:underline text-[#02225A] decoration-2">Register here</a>
                    </p>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
