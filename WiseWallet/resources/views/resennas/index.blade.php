@extends('layouts.app')

@section('contenido')
<div class="container mx-auto relative">
    <!-- Título principal -->
    <h1 class="text-5xl font-black text-gray-900 text-center mb-2absolute top-0 left-0/0 transform -translate-x-0/0 -translate-y-11 ">Reseñas</h1>
    
    <!-- Subtítulo -->
    <h2 class="text-3xl font-bold text-blue-600 mb-3 absolute top-7 left-2/11 transform -translate-x-3/11 -translate-y-8">Publicaciones</h2>

    <!-- Contenedor de reseñas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 flex-grow">
        @foreach ($resennas as $resenna)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-2">{{ $resenna->usuario_reg }}</h3>
                <p class="text-gray-700 mb-2"><strong>Detalle:</strong> {{ $resenna->detalle }}</p>
                <p class="text-gray-700 mb-2"><strong>Descripción:</strong> {{ $resenna->descripcion }}</p>
                <div class="flex justify-between items-end mt-4">
                    <div class="flex items-center">
                        @for ($i = 0; $i < $resenna->calificacion; $i++)
                            <i class="fas fa-star text-yellow-500"></i>
                        @endfor
                        @for ($i = $resenna->calificacion; $i < 5; $i++)
                            <i class="far fa-star text-yellow-500"></i>
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm">{{ $resenna->fecha_creacion }}</p>
                </div>
                <!-- Botones de acciones -->
                <div class="mt-4 flex gap-4">
                    <a href="{{ route('resennas.edit', $resenna->id_resenna) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">Modificar</a>
                    <form action="{{ route('resennas.destroy', $resenna->id_resenna) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Botones al final de la página -->
    <div class="flex justify-between items-center p-4 bg-white shadow-lg mt-8">
        <!-- Botón de Agregar Reseña (izquierda) -->
        <div class="flex-none">
            <a href="{{ route('resennas.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow hover:bg-green-600">Agregar Reseña</a>
        </div>
        
        <!-- Botón de Modificar (centro) -->
        <div class="flex-grow flex justify-center">
            <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">Modificar</a>
        </div>
        
        <!-- Botón de Eliminar (derecha) -->
        <div class="flex-none">
            <form action="#" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg shadow hover:bg-red-600">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
