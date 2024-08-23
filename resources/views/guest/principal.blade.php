@extends('layouts.app')

@section('titulo')
    😁 ¡Bienvenido! 😁
@endsection

@section('contenido')
    <div class="flex flex-col items-center bg-gray-100 p-8">
        @php
            $nombreUsuario = session('NombreUsuario');
        @endphp
        @if ($nombreUsuario)
            <div class="text-center p-6 bg-blue-700 text-white rounded-lg shadow-lg mb-6">
                <h1 class="text-3xl font-bold">
                    🎉 ¡Hola, {{ $nombreUsuario }}! 🎉
                </h1>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0">
            <!-- Comentario Destacado -->
            <div
                class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
                <h3 class="text-xl font-semibold text-white mb-4">🌟Comentario Destacado</h3>
                <p class="text-white">
                    <strong>{{ $resumen->comentario_max_rating }}</strong>
                </p>
                <p class="text-white mt-2">
                    Creado por: <strong>{{ $resumen->usuario_max_rating }}</strong>
                </p>
            </div>

            <!-- Resumen de Reseñas -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-md md:w-1/2">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">📊 Resumen de Reseñas</h3>
                <p class="text-gray-700">
                    Total de Reseñas: <strong>{{ $resumen->total_resenas }}</strong>
                </p>
                <p class="text-gray-700">
                    Promedio de Puntuación: <strong>{{ number_format($resumen->promedio_puntuacion, 2) }}</strong>
                </p>
            </div>

            <div
                class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
                <h2 class="text-2xl font-bold text-gray-100 mb-4">
                    🛑 Peor Calificación
                </h2>
                <div class="overflow-x-auto text-white">
                    @if ($peorCalificacion)
                        <h3 class="text-xl font-semibold">{{ $peorCalificacion->detalle }}</h3>
                        <p class="mt-2">{{ $peorCalificacion->descripcion }}</p>
                        <p class="mt-4"><strong>Rating:</strong> {{ $peorCalificacion->rating }}</p>
                        <p><strong>Fecha:</strong>
                            {{ \Carbon\Carbon::parse($peorCalificacion->creation_date)->format('d/m/Y') }}</p>
                    @else
                        <p class="text-gray-400">No se encontraron calificaciones.</p>
                    @endif
                </div>
            </div>

        </div>
        <div class="max-w-7xl mx-auto p-8 bg-blue-100 rounded-lg shadow-lg mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                🎉 ¡Estamos emocionados de tenerte aquí! 🎉
            </h2>
            <p class="text-gray-700 mb-4">
                ¡Hola y bienvenido a nuestra aplicación! 🌟 Ya sea que seas un usuario nuevo que acaba de registrarse o
                un veterano que ha regresado, estamos encantados de tenerte con nosotros.
            </p>
            <p class="text-gray-700 mt-4 mb-4">
                Para comenzar, te invitamos a <strong>leer las reseñas</strong> sobre nuestra aplicación. Aquí podrás
                encontrar comentarios y valoraciones que te ayudarán a sacar el máximo provecho de nuestra plataforma. 🚀
            </p>
            <p class="text-gray-700 mb-4">
                ¡Te invitamos a leer nuestras noticias más nuevas! Para que estés informado al 100% todos los días.
            </p>
            <a href="{{ url('/home') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Ver Noticias Recientes
            </a>
        </div>

        <div class="max-w-7xl mx-auto p-8 bg-gray-900 rounded-lg shadow-lg mt-8">
            <h2 class="text-2xl font-bold text-gray-100 mb-4">
                🌟 Top 5 Usuarios con Más Reseñas 🌟
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-gray-300">
                            <th class="py-3 px-6 border-b">Usuario</th>
                            <th class="py-3 px-6 border-b">Número de Reseñas</th>
                            <th class="py-3 px-6 border-b">Promedio de Puntuación</th>
                            <th class="py-3 px-6 border-b">Reseña con Mayor Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuariosTop5 as $usuario)
                            <tr class="text-gray-200">
                                <td class="py-3 px-6 border-b border-gray-700">{{ $usuario->usuario }}</td>
                                <td class="py-3 px-6 border-b border-gray-700">{{ $usuario->numero_resenas }}</td>
                                <td class="py-3 px-6 border-b border-gray-700">
                                    {{ number_format($usuario->promedio_puntuacion, 2) }}</td>
                                <td class="py-3 px-6 border-b border-gray-700">{{ $usuario->resena_max_rating }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
