@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gradient-to-r from-red-100 via-red-200 to-red-300 shadow-md rounded-lg p-6 max-w-md mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4 text-center">
                🗑️ Confirmar Eliminación
            </h1>

            <div class="text-center mb-4">
                <p class="text-lg text-gray-700">
                    ¿Estás seguro de que deseas eliminar esta reseña? 🔍
                </p>
                <p class="text-gray-600 mt-2">
                    ⚠️ Esta acción es Irreversible. ⚠️
                </p>
            </div>

            <div class="flex justify-center">
                <form action="{{ route('resennas.eliminar', ['id' => $resenna['ID_RESENNA']]) }}" method="POST"
                    class="flex flex-col space-y-4">
                    @csrf
                    @method('POST')

                    <button type="submit"
                        class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors duration-300">
                        ✅ Confirmar
                    </button>

                    <a href="{{ route('resena') }}"
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg text-center hover:bg-blue-700 transition-colors duration-300">
                        ⬅️ Regresar
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
