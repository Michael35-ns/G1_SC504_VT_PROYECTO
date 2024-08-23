@extends('layouts.app')

@section('titulo')
    Editar Transacción
@endsection

@section('contenido')
    <section class="flex items-center justify-center max-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Editar Gasto</h3>
            <form action="{{ route('editarGasto', $gasto['ID_GASTO']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="id_transaccion" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select id="id_transaccion" name="id_transaccion" class="border border-gray-300 rounded w-full py-2 px-4">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria['ID_TRANSACCION'] }}"
                                {{ old('id_transaccion', $gasto['ID_TRANSACCION']) == $categoria['ID_TRANSACCION'] ? 'selected' : '' }}>
                                {{ $categoria['TIPO_TRANSACCION'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_transaccion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    </select>
                </div>
                <div class="mb-4">
                    <label for="monto_gasto" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" id="monto_gasto" name="monto_gasto"
                        value="{{ old('monto_gasto', $gasto['MONTO_GASTO']) }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('monto_ingreso')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="border border-gray-300 rounded w-full py-2 px-4">{{ old('descripcion', $gasto['DESCRIPCION_GASTO']) }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="fecha_gasto">Fecha del gasto:</label>
                    <input type="date" id="fecha_gasto" name="fecha_gasto"
                        value="{{ old('fecha_gasto', $gasto['FECHA_GASTO']) }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('fecha_ingreso')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Estado del
                        gasto:</label>
                    <select id="flujo" name="id_flujo" class="border border-gray-300 rounded w-full py-2 px-4">
                        @foreach ($flujos as $flujo)
                            @if ($flujo['TIPO_ESTADO'] === 'TRANSACCION')
                                <option value="{{ $flujo['ID_FLUJO'] }}"
                                    {{ old('id_flujo', $gasto['ID_FLUJO']) == $flujo['ID_FLUJO'] ? 'selected' : '' }}>
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
                    <a href="{{ route('Gasto') }}" class="py-2 px-4 bg-red-500  text-white rounded">Cancelar</a>
                    <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded">Actualizar</button>
                </div>
            </form>
        </div>
    </section>
@endsection
