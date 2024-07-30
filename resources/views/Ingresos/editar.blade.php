@extends('layouts.app')

@section('titulo')
    Editar Transacción
@endsection

@section('contenido')
    <section class="flex items-center justify-center max-h-screen">

        {{-- FORMULARIO DE EDICIÓN --}}
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Editar Ingreso</h3>

            <form action="{{ route('editarIngreso', $ingreso['ID_INGRESO']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select id="categoria" name="id_transaccion" class="border border-gray-300 rounded w-full py-2 px-4">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria['ID_TRANSACCION'] }}"
                                {{ old('id_transaccion', $ingreso['ID_TRANSACCION']) == $categoria['ID_TRANSACCION'] ? 'selected' : '' }}>
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
                    <textarea id="descripcion" name="descripcion" class="border border-gray-300 rounded w-full py-2 px-4">{{ old('descripcion', $ingreso['DESCRIPCION_INGRESO']) }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del ingreso</label>
                    <input type="date" id="fecha" name="fecha_ingreso"
                        value="{{ old('fecha_ingreso', $ingreso['FECHA_INGRESO']) }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('fecha_ingreso')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" step="0.01" id="monto" name="monto_ingreso"
                        value="{{ old('monto_ingreso', $ingreso['MONTO_INGRESO']) }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('monto_ingreso')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="flujo" class="block text-sm mb-1 font-medium text-gray-700">Frecuencia</label>
                    <select id="flujo" name="id_flujo" class="border border-gray-300 rounded w-full py-2 px-4">
                        @foreach ($flujos as $flujo)
                            @if ($flujo['TIPO_ESTADO'] === 'TRANSACCION')
                                <option value="{{ $flujo['ID_FLUJO'] }}"
                                    {{ old('id_flujo', $ingreso['ID_FLUJO']) == $flujo['ID_FLUJO'] ? 'selected' : '' }}>
                                    {{ $flujo['NOMBRE_ESTADO'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_flujo')
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
