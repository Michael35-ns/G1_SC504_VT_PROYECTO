@extends('layouts.app')

@section('contenido')
    <section class="content_login flex flex-col items-center py-10">
        <div class="relative w-full max-w-lg">
            <div class="absolute inset-0 bg-cover bg-center rounded-lg"
                style="background-image: url('https://economipedia.com/wp-content/uploads/Finanzas.jpg'); background-size: cover;">
            </div>
            <div class="relative bg-white bg-opacity-70 p-8 rounded-lg shadow-lg">
                <form id="registerForm" action="{{ url('/agregarUsuario') }}" method="POST" enctype="multipart/form-data">
                    <h1 class="text-3xl font-bold text-center text-black mb-6">Registro</h1>
                    @csrf
                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}
                        </p>
                    @endif
                    <div class="mb-5">
                        <label for="nombre" class="mb-2 block text-gray-700 font-bold">Nombre:</label>
                        <input type="text" id="nombre" name="nombre"
                            class="form-control w-full p-3 border border-gray-300 rounded-lg" placeholder="Nombre" required>
                    </div>
                    <div class="mb-5">
                        <label for="primer_apellido" class="mb-2 block text-gray-700 font-bold">Primer Apellido:</label>
                        <input type="text" id="primer_apellido" name="primer_apellido"
                            class="form-control w-full p-3 border rounded-lg" placeholder="Primer Apellido"
                            required>
                    </div>
                    <div class="mb-5">
                        <label for="segundo_apellido" class="mb-2 block text-gray-700 font-bold">Segundo Apellido:</label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido"
                            class="form-control w-full p-3 border rounded-lg" placeholder="Segundo Apellido"
                            required>
                    </div>
                    <div class="mb-5">
                        <label for="username" class="mb-2 block text-gray-700 font-bold">Nombre de usuario:</label>
                        <input id="username" name="username" type="text" placeholder="Nombre usuario"
                            class="form-control w-full p-3 border rounded-lg @error('username') border-red-500 @enderror"
                            value="{{ old('username') }}" required>
                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="correo_electronico" class="mb-2 block text-gray-700 font-bold">Email:</label>
                        <input id="correo_electronico" name="correo_electronico" type="email"
                            placeholder="Tu Email de Registro"
                            class="form-control w-full p-3 border rounded-lg @error('correo_electronico') border-red-500 @enderror"
                            value="{{ old('correo_electronico') }}" required>
                        @error('correo_electronico')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="contrasenna" class="mb-2 block text-gray-700 font-bold">Contraseña:</label>
                        <input id="contrasenna" name="contrasenna" type="password" placeholder="Password de Registro"
                            class="form-control w-full p-3 border rounded-lg @error('contrasenna') border-red-500 @enderror"
                            required>
                        @error('contrasenna')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="image" class="mb-2 block text-gray-700 font-bold">Foto de perfil:</label>
                        <input id="image" name="image" type="file"
                            class="form-control w-full p-3 border rounded-lg @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Crear Cuenta"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
        </div>
    </section>
@endsection
