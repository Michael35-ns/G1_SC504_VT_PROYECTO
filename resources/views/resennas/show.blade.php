@extends('layouts.app')

@section('titulo', 'Detalle de la Reseña')

@section('contenido')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Detalles de la Reseña</h1>

        <p><strong>Detalle:</strong> {{ $resenna->detalle }}</p>
        <p><strong>Descripción:</strong> {{ $resenna->descripcion }}</p>
        <p><strong>Fecha:</strong> {{ $resenna->fecha }}</p>
        <p><strong>Usuario:</strong> {{ $resenna->usuario_reg }}</p>
        <p><strong>Calificación:</strong> {{ $resenna->calificacion }} estrellas</p>

        <a href="{{ route('resennas.edit', $resenna->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</a>
        <form action="{{ route('resennas.destroy', $resenna->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
        </form>
        <a href="{{ route('resennas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Regresar</a>
    </div>
@endsection
