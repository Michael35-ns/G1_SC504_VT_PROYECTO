@extends('layouts.app')

@section('titulo')
    Objetivos Financieros
@endsection

@section('contenido')
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 p-4">
        <br />
        <form action="{{ route('agregarObjetivos') }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
            @csrf
            <h3 class="text-xl font-bold mb-4 text-center">Registro de Objetivos Económicos</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nombre_objetivo" class="block text-sm font-medium text-gray-700">Nombre del Objetivo</label>
                    <input type="text" id="nombre_objetivo" name="nombre_objetivo"
                        class="border border-gray-300 rounded w-full py-2 px-4" required />
                </div>
                <div class="mb-4">
                    <label for="fecha_tope" class="block text-sm font-medium text-gray-700">Cual es al fecha tope de tu objetivo?</label>
                    <input type="date" id="fecha_tope" name="fecha_tope" value="{{ old('fecha_tope') }}"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    @error('fecha_tope')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="descripcion_objetivo" class="block text-sm font-medium text-gray-700">Descripción del
                        Objetivo</label>
                    <textarea id="descripcion_objetivo" name="descripcion_objetivo" class="border border-gray-300 rounded w-full py-2 px-4"></textarea>
                </div>
                <div>
                    <label for="monto_objetivo" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" id="monto_objetivo" name="monto_objetivo"
                        class="border border-gray-300 rounded w-full py-2 px-4" required />
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Seleccione la categoira del
                        objetivo:</label>
                    <select id="gasto" name="ID_TRANSACCION"
                        class="w-full p-2 rounded bg-slate-400 text-white border-gray-300 py-2 px-4">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria['ID_TRANSACCION'] }}"
                                {{ old('id_transaccion') == $categoria['ID_TRANSACCION'] ? 'selected' : '' }}>
                                {{ $categoria['TIPO_TRANSACCION'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Flujo</label>
                    <select id="ID_FLUJO" name="ID_FLUJO"
                        class="w-full p-2 rounded bg-slate-400 text-white border-gray-300 py-2 px-4">
                        @foreach ($flujos as $flujo)
                            <option value="{{ $flujo['ID_FLUJO'] }}"
                                {{ old('ID_FLUJO') == $flujo['ID_FLUJO'] ? 'selected' : '' }}>
                                {{ $flujo['NOMBRE_ESTADO'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('ID_FLUJO')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Estado</label>
                    <select id="estado" name="ID_ESTADO"
                        class="w-full p-2 rounded bg-slate-400 text-white border-gray-300 py-2 px-4">
                        @foreach ($estados as $estado)
                            <option value="{{ $estado['ID_ESTADO'] }}"
                                {{ old('ID_ESTADO') == $estado['ID_ESTADO'] ? 'selected' : '' }}>
                                {{ $estado['TIPO_ESTADO'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('ID_ESTADO')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('objetivoEconomico') }}">
                        <button type="button"
                            class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600 transition">Cancelar</button>
                    </a>
                    <button type="submit"
                        class=" py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition">Procesar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
