@extends('layouts.app')

@section('titulo')
    Transacciones
@endsection

@section('contenido')

<div class="w-1/3 p-4 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4 text-center">Gráfico de Porcentaje</h1>
    <div class="relative pt-1">
        <div class="flex mb-2 items-center justify-between">
            <div>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-teal-600 bg-teal-200">
                    {{ $label }}
                </span>
            </div>
            <div class="text-right">
                <span class="text-xs font-semibold inline-block text-teal-600">
                    {{ $percentage }}%
                </span>
            </div>
        </div>
        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-teal-200">
            <div style="width: {{ $percentage }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-500"></div>
        </div>
    </div>
</div>

    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        @if (session('success'))
            <div class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('ingreso.store') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Titulo
                </label>
                <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicación"
                    class="border p-3 w-full rounded-lg 
                @error('titulo') border-red-500 @enderror"
                    value="{{ old('titulo') }}" />
                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" type="text" placeholder="Descripción de la publicación"
                    class="border p-3 w-full rounded-lg 
                @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <input type="submit" value="Crear Ingreso"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg" />
        </form>
    </div>
@endsection
