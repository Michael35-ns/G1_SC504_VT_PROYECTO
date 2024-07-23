@extends('layouts.app')

@section('titulo')
    Reseñas
@endsection

@section('contenido')
    <section class="container mx-auto px-4 py-8">
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Reseñas</h2>
            <a href="{{ route('resennas.create') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                Crear Reseña
            </a>
        </div>

        <!-- Ejemplo de Reseña 1 -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex items-center mb-2">
                <h3 class="text-xl font-semibold text-gray-900">Juan Pérez</h3>
                <span class="ml-2 text-gray-500 text-sm">15 Jul 2024</span>
            </div>
            <p class="text-lg font-semibold text-gray-700">Excelente Servicio</p>
            <p class="text-gray-600">Tuve una experiencia maravillosa con la página. La informacion superó mis expectativas y el servicio fue excepcional.</p>

            <div class="flex items-center mt-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-500' : 'text-gray-300' }}"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.08 1.122-6.537L1 6.92l6.54-.954L10 0l2.46 5.966 6.54.954-4.242 4.623 1.122 6.537L10 15z"/>
                    </svg>
                @endfor
            </div>

            @if (auth()->user() && (auth()->user()->id == 1 || auth()->user()->is_admin)) =
                <div class="flex justify-end mt-2">
                    <a href="{{ route('resennas.edit', 1) }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-1 px-3 rounded mr-2">
                        Editar
                    </a>
                    <form action="{{ route('resennas.destroy', 1) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Ejemplo de Reseña 2 -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex items-center mb-2">
                <h3 class="text-xl font-semibold text-gray-900">María Gómez</h3>
                <span class="ml-2 text-gray-500 text-sm">10 Jul 2024</span>
            </div>
            <p class="text-lg font-semibold text-gray-700">Muy Satisfecha</p>
            <p class="text-gray-600">Completamente satisfecha con la experiencia de usar esta pagina, todo muy util y valioso.</p>

            <div class="flex items-center mt-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= 5 ? 'text-yellow-500' : 'text-gray-300' }}"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.08 1.122-6.537L1 6.92l6.54-.954L10 0l2.46 5.966 6.54.954-4.242 4.623 1.122 6.537L10 15z"/>
                    </svg>
                @endfor
            </div>

            @if (auth()->user() && (auth()->user()->id == 2 || auth()->user()->is_admin)) <!-- Reemplazar 2 con el ID del usuario autenticado -->
                <div class="flex justify-end mt-2">
                    <a href="{{ route('resennas.edit', 2) }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-1 px-3 rounded mr-2">
                        Editar
                    </a>
                    <form action="{{ route('resennas.destroy', 2) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endif
        </div>
        
        <!-- Ejemplo de Reseña 3 -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex items-center mb-2">
                <h3 class="text-xl font-semibold text-gray-900">Carlos Sánchez</h3>
                <span class="ml-2 text-gray-500 text-sm">05 Jul 2024</span>
            </div>
            <p class="text-lg font-semibold text-gray-700">Buen Producto</p>
            <p class="text-gray-600">Seguire usando la pagina para administrar mi dinero, definitivamente me ha ayudado.</p>

            <div class="flex items-center mt-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= 3 ? 'text-yellow-500' : 'text-gray-300' }}"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.08 1.122-6.537L1 6.92l6.54-.954L10 0l2.46 5.966 6.54.954-4.242 4.623 1.122 6.537L10 15z"/>
                    </svg>
                @endfor
            </div>

            @if (auth()->user() && (auth()->user()->id == 3 || auth()->user()->is_admin)) <!-- Reemplazar 3 con el ID del usuario autenticado -->
                <div class="flex justify-end mt-2">
                    <a href="{{ route('resennas.edit', 3) }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-1 px-3 rounded mr-2">
                        Editar
                    </a>
                    <form action="{{ route('resennas.destroy', 3) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </section>
@endsection
