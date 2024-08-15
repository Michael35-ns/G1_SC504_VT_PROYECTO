@extends('layouts.app')

@section('titulo')
    Editar Reseña
@endsection

@section('contenido')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Reseña</h1>

        <form action="{{ route('resennas.update', $resenna->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="detalle" class="block text-gray-700">Detalle</label>
                <input type="text" id="detalle" name="detalle" class="w-full border-gray-300 rounded-md" value="{{ $resenna->detalle }}" required>
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="w-full border-gray-300 rounded-md" required>{{ $resenna->descripcion }}</textarea>
            </div>
            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded-md shadow hover:bg-cyan-700">Actualizar</button>
        </form>
    </div>
@endsection
