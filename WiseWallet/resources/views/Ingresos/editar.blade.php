@extends('layouts.app')

@section('titulo')
    Editar Transacción
@endsection

@section('contenido')
    <section class="hidden sm:grid grid-cols-3 gap-6 justify-items-center">

        {{-- FORMULARIO DE EDICIÓN --}}
        <div class="col-span-1 bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Editar Ingreso</h3>

            <form action="{{ route('editarIngreso', $ingreso->id_ingreso) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select id="categoria" name="id_transaccion" class="border border-gray-300 rounded w-full py-2 px-4">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria['ID_TRANSACCION'] }}"
                                {{ old('id_transaccion', $ingreso->id_transaccion) == $categoria['ID_TRANSACCION'] ? 'selected' : '' }}>
                                {{ $categoria['TIPO_TRANSACCION'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_transaccion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="border border-gray-300 rounded w-full py-2 px-4">{{ old('descripcion', $ingreso->descripcion_ingreso) }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del ingreso</label>
                    <input type="date" id="fecha" name="fecha_ingreso"
                        value="{{ old('fecha_ingreso', $ingreso->fecha_ingreso) }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('fecha_ingreso')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" id="monto" name="monto_ingreso"
                        value="{{ old('monto_ingreso', $ingreso->monto_ingreso) }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('monto_ingreso')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="estado"
                        class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Estado</label>
                    <select id="estado" name="id_estado"
                        class="w-full p-2 rounded bg-slate-400 text-white border-gray-300 py-2 px-4">
                        @foreach ($estados as $estado)
                            <option value="{{ $estado['ID_ESTADO'] }}"
                                {{ old('id_estado', $ingreso->id_estado) == $estado['ID_ESTADO'] ? 'selected' : '' }}>
                                {{ $estado['TIPO_ESTADO'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_estado')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('Ingreso') }}" class="py-2 px-4 bg-gray-500 text-white rounded">Cancelar</a>
                    <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </section>
@endsection
