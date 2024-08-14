@extends('layouts.app')

@section('contenido')
    <section class="content_login flex flex-col items-center py-10">
        <div class="contenedor-imagen mb-8">
            <img class="imagen"
                src="https://economipedia.com/wp-content/uploads/Finanzas.jpg"
                alt="login" width="650px" height="650px" />
        </div>
        <div class="container-login">
            <form action="" method="post">
                <h1 class="text-3xl font-bold text-center text-white mb-6">Iniciar Sesión</h1>
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block text-white font-bold">
                        Email
                    </label>
                    <input id="email" name="email" type="email" placeholder="Tu Email de Registro"
                        class="border p-3 w-full rounded-lg
                        @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block text-white font-bold">
                        Contraseña
                    </label>
                    <input id="password" name="password" type="password" placeholder="Password de Registro"
                        class="border p-3 w-full rounded-lg
                        @error('password') border-red-500 @enderror" />
                    @error('password')
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
