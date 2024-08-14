@extends('layouts.app')

@section('contenido')
<div class="container mx-auto py-8">
    <h1 class="text-4xl font-black text-gray-900 mb-6">Agregar Reseña</h1>

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('resennas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="detalle" class="block text-gray-700 text-sm font-bold mb-2">Detalle:</label>
                <input type="text" id="detalle" name="detalle" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">Guardar Reseña</button>
            </div>
        </form>
    </div>
</div>
@endsection

