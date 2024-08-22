@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-5xl font-extrabold text-gray-900 text-center mb-8">
            ⭐️ Reseñas ⭐️
        </h1>

        <!-- Botón para crear reseña -->
        <div class="text-center mb-8">
            <a href="{{ route('resennas.create') }}"
                class="bg-gradient-to-r from-gray-700 to-gray-900 text-white py-2 px-4 rounded-md inline-flex items-center justify-center hover:from-gray-600 hover:to-gray-800 transition-colors duration-300">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                 Crear Reseña 
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($resenasOrdenadas as $resena)
                @if ($resena['ID_ESTADO'] == 1)
                    @php
                        $fullStars = floor($resena['RATING']);
                        $halfStar = $resena['RATING'] - $fullStars >= 0.5;
                        $emptyStars = 5 - ($fullStars + ($halfStar ? 1 : 0));
                    @endphp
                    <div
                        class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
                        <h3 class="text-2xl font-semibold text-gray-100 mb-3">
                            ⭐️ Reseña de {{ $resena['USERNAME'] }} ⭐️
                        </h3>
                        <p class="text-gray-200 mb-3"><strong>Detalle:</strong> {{ $resena['DETALLE'] }}</p>
                        <p class="text-gray-200 mb-3"><strong>Descripción:</strong> {{ $resena['DESCRIPCION'] }}</p>
                        <div class="flex items-center mb-4">
                            @for ($i = 0; $i < $fullStars; $i++)
                                <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            @endfor
                            @if ($halfStar)
                                <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    <path
                                        d="M12 2L9.19 8.63 2 9.24l5.46 4.73L5.82 21l6.18-4.73L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2z"
                                        fill="white" opacity="0.5" />
                                </svg>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            @endfor
                        </div>
                        <div class="flex justify-between items-center border-t border-gray-500 pt-4">
                            <p class="text-gray-300 text-sm">
                                📅 {{ \Carbon\Carbon::parse($resena['CREATION_DATE'])->format('d M Y') }}</p>
                            @if ($resena['ID_USUARIO'] == $id_usuario)
                                <a href="{{ route('resennas.delete', ['id' => $resena['ID_RESENNA']]) }}"
                                    class="bg-red-800 text-white p-2 rounded-full flex items-center justify-center hover:bg-red-900 transition-colors duration-300">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M6 19h12v-1H6v1zM5 4h14l-1 1H6L5 4zm1 14h12V7H6v11z" />
                                    </svg>
                                    Eliminar
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
