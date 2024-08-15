@extends('layouts.app')

@section('contenido')
    <section class="content_login flex flex-col items-center py-10">
        <div class="contenedor-imagen mb-8">
            <img class="imagen"
                src="https://economipedia.com/wp-content/uploads/Finanzas.jpg"
                alt="login" width="650px" height="650px" />
        </div>
        <div class="container-login">
            <form action="{{route('login')}}" method="post">
                <h1 class="text-3xl font-bold text-center text-white mb-6">Iniciar Sesión</h1>
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif
                <div class="mb-5">
                    <label for="correo_electronico" class="mb-2 block text-white font-bold">
                        Email
                    </label>
                    <input id="correo_electronico" name="correo_electronico" type="email" placeholder="Tu Email de Registro"
                        class="border p-3 w-full rounded-lg text-black
                        @error('correo_electronico') border-red-500 @enderror"
                        value="{{ old('correo_electronico') }}" />
                    @error('correo_electronico')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="contrasenna" class="mb-2 block text-white font-bold">
                        Contraseña
                    </label>
                    <input id="contrasenna" name="contrasenna" type="password" placeholder="Contraseña de Registro"
                        class="border p-3 w-full rounded-lg text-black
                        @error('contrasenna') border-red-500 @enderror" />
                    @error('contrasenna')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Ingresar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                            uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
            <br>
            <a style="color:white;" href="{{ route('register') }}" class="block mt-4 text-center">No tienes una cuenta creada?</a>
            <a href="{{ route('register') }}" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    text-center uppercase font-bold w-full p-3 text-white rounded-lg mt-4 block">Registrarse</a>
        </div>
    </section>
@endsection
