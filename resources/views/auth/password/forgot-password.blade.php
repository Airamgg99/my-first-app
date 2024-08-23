@extends('layouts.login.login')
@section('title', 'Forgot Password')
@section('content')

    <div class="flex min-h-full flex-col justify-center py-12 px-6 lg:px-8 bg-[#d6d8da]">
        <main id="reset" role="reset" class="w-full max-w-md mx-auto">
            <div class="bg-white rounded">
                <div class="p-5 sm:p-7">
                    <div class="text-center">
                        <h1 class="block text-2xl font-bold text-[#02225A]">Password forgotten?</h1>
                    </div>
                    <div class="mt-3">
                        {!! Form::open([
                            'route' => 'password.email',
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
                            <button type="submit"
                                class="flex w-full justify-center text-[#02225A] rounded-md bg-[#FDC700] px-3 py-2 text-sm font-semibold  hover:text-white shadow-sm hover:bg-[#02225A]">
                                Restore password
                            </button>
                        </div>
                        <div class="flex pt-3 justify-center">
                            <p class="text-sm font-medium justify-center">
                                Remember your password?
                                <a class="text-[#02225A] decoration-2 hover:underline font-medium"
                                    href="{{ route('login.index') }}">
                                    Click here
                                </a>
                            </p>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </main>
    </div>
@endsection
