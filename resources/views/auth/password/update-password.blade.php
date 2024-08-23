@extends('layouts.login.login')
@section('title', 'Reset Password')
@section('content')


    <div class="flex justify-center items-center">
        <section>
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="w-full mb-2 p-6 bg-white rounded-lg md:mt-0 sm:max-w-md sm:p-8">
                    <h2 class="mb-3 text-xl font-bold text-center leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Cambiar contraseña
                    </h2>
                    {!! Form::open([
                        'route' => ['password.update', $user->id],
                        'method' => 'POST',
                    ]) !!}
                    <div class="mb-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Nueva
                            contraseña</label>
                        <input type="password" name="password" id="password" placeholder=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>

                    <div class="mb-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Confirma
                            contraseña</label>
                        <input type="password" name="password_confirm" id="password_confirm" placeholder=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full text-grey-900 bg-blue-300 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-3 text-center">Restablecer
                        contraseña</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $('form').on('submit', function(e) {
            e.preventDefault();
            var password = $('#password').val().trim();
            var password_confirm = $('#password_confirm').val().trim();
            var requirement = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;

            // LONGITUD DE LA CONTRASEÑA
            if (password.length < 8) {
                swal("Error", "La contraseña debe tener mínimo 8 caracteres.", "error");
                return;
            }

            // MAYÚSCULA, MINÚSCULA Y NÚMERO
            if (!password.match(requirement)) {
                swal("Error", "La contraseña requiere al menos una mayúscula, una minúscula y un número.", "error");
                return;
            }

            // COMPROBAR QUE SON IDÉNTICAS
            if (password != password_confirm) {
                swal("Error", "Las contraseñas deben coincidir.", "error");
                return;
            }

            this.submit();
        });
    </script>
@endsection
