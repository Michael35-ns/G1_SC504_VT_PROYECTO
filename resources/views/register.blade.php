@extends('layouts.app')

@section('contenido')

    <section class="content_login flex flex-col items-center py-10">
        <div class="contenedor-imagen mb-8">
            <img class="imagen" src="https://economipedia.com/wp-content/uploads/Finanzas.jpg" alt="login" width="650px" height="650px" />
        </div>
        <div class="container-login">
            <form action="" method="post" enctype="multipart/form-data">
                <h1 class="text-3xl font-bold text-center text-white mb-6">Registro</h1>
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif
                <div class="mb-5">
                    <label for="nombre_completo" class="mb-2 block text-white font-bold">
                        Nombre completo:
                    </label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" class="form-control border p-2 rounded-lg" required/>
                    <input type="text" id="apellido1" name="apellido1" class="form-control" placeholder="Apellido1" class="form-control border p-2 rounded-lg"/>
                    <input type="text" id="apellido2" name="apellido2" class="form-control" placeholder="Apellido2" class="form-control border p-2 rounded-lg"/>
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block text-white font-bold">
                        Nombre de usuario
                    </label>
                    <input id="username" name="username" type="text" placeholder="Nombre usuario"
                        class="form-control border p-2 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}" />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block text-white font-bold">
                        Email
                    </label>
                    <input id="email" name="email" type="email" placeholder="Tu Email de Registro"
                        class="form-control border p-2 w-full rounded-lg @error('email') border-red-500 @enderror"
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
                        class="form-control border p-2 w-full rounded-lg @error('password') border-red-500 @enderror" />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block text-white font-bold">
                        Foto de perfil
                    </label>
                    <input id="image" name="image" type="file" class="form-control input-mediano border p-2 w-full rounded-lg @error('image') border-red-500 @enderror" />
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </section>
@endsection

