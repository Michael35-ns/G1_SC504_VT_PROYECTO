@extends('layouts.app')

@section('titulo')
    Transacciones
@endsection

@section('contenido')
    <section class="hidden sm:grid grid-cols-3 gap-6 justify-items-center">
        <div></div>

        <div>
            <div class="porcentajes" style="--porcentaje: 75;  --color:blue;">
                <svg width="150" heigth="150">
                    <circle r="68" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                    <circle r="68" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                </svg>
                <span>75%</span>
            </div>
        </div>

        <div>
        </div>

        <div class="w-full max-w-96">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Ingresos Totales') }}
                </h3>
                <a href="{{ route('Ingreso', $resultado['SUMA_TOTAL']) }}"
                    class=" ml-28 text-xl font-medium text-center text-white italic">
                    ₡{{ number_format($resultado['SUMA_TOTAL'], 2, ',', '.') }}
                </a>
            </div>
        </div>

        <div class="w-full max-w-96">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Dinero restante') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    ₡334.000,00
                </p>
            </div>
        </div>

        <div class="w-full max-w-96">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Gastos Totales') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    ₡756.340,00
                </p>
            </div>
        </div>

    </section>

    <section class="flex flex-col gap-4 mt-16">

        <nav class="text-center font-normal space-x-4">
            <span
                class="rounded-full w-24 py-1 px-2 text-center font-light {{ request()->routeIs('Ingreso') ? 'bg-cyan-600 text-white shadow' : 'text-gray-900' }}">
                <a href="{{ route('Ingreso') }}">
                    {{ __('Ingresos') }}
                </a>
            </span>
            <span>
                /
            </span>
            <span
                class="rounded-full w-24 py-1 px-2 text-center font-light {{ request()->routeIs('Gasto') ? 'bg-cyan-600 text-white shadow' : 'text-gray-900' }}">
                <a href="{{ route('Gasto') }}">
                    {{ __('Gasto') }}
                </a>
            </span>
        </nav>

        @php
            $ingresos = [
                [
                    'categoria' => 'Emprendimiento',
                    'fecha' => '2024-07-01',
                    'decripcion' => 'Venta de producto A',
                    'monto' => 1500,
                    'estado' => 'Activo',
                ],
                [
                    'categoria' => 'Trabajo',
                    'fecha' => '2024-07-01',
                    'decripcion' => 'Servicio de consultoría',
                    'monto' => 2000,
                    'estado' => 'Activo',
                ],
                [
                    'categoria' => 'Emprendimiento',
                    'fecha' => '2024-07-01',
                    'decripcion' => 'Venta de producto B',
                    'monto' => 3000,
                    'estado' => 'Activo',
                ],
            ];
        @endphp

        <section x-data="{ open: false, OpenCategoria: '', OpenCrearCategoria: '', OpenEliminarCategoria: '', OpenRegistrarIngreso: false, OpenEditarIngreso: false }" class="flex flex-col gap-5 py-5 items-center justify-center">
            <div class="flex gap-4 justify-center items-center">

                <div>
                    <button @click="OpenCategoria=true" class="w-full py-2 px-4 bg-cyan-400 text-white rounded-full">
                        Crear categoria
                    </button>
                </div>
                {{-- Crear ingreso --}}
                <div>
                    <button @click="OpenRegistrarIngreso=true" class="w-full py-2 px-4 bg-cyan-400 text-white rounded-full">
                        Crear Ingreso
                    </button>
                </div>

            </div>

            {{-- Lista de resultados --}}
            <div class="flex flex-col items-center justify-center gap-4 w-3/4">
                <div class="h-auto w-full">
                    <form id="searchForm" action="{{ route('Ingreso') }}" method="GET"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 items-center justify-center">
                        @csrf
                        <div>
                            <label for="fecha_inicial" class="block text-sm font-medium text-gray-700">Fecha Inicial</label>
                            <input type="date" id="fecha_inicial" name="fecha_inicial" required
                                class="mt-1 border border-gray-300 rounded-lg w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-cyan-600"
                                value="{{ $fechaInicio }}">
                        </div>
                        <div>
                            <label for="fecha_final" class="block text-sm font-medium text-gray-700">Fecha Final</label>
                            <input type="date" id="fecha_final" name="fecha_final" required
                                class="mt-1 border border-gray-300 rounded-lg w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-cyan-600"
                                value="{{ $fechaFin }}">
                        </div>
                        <div>
                            <label for="monto_min" class="block text-sm font-medium text-gray-700">Monto Mínimo</label>
                            <input type="text" id="monto_min" name="monto_min" required
                                class="mt-1 border border-gray-300 rounded-lg w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-cyan-600"
                                value="{{ $montoMin }}">
                        </div>
                        <div>
                            <label for="monto_max" class="block text-sm font-medium text-gray-700">Monto Máximo</label>
                            <input type="text" id="monto_max" name="monto_max" required
                                class="mt-1 border border-gray-300 rounded-lg w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-cyan-600"
                                value="{{ $montoMax }}">
                        </div>
                        <div>
                            <button type="submit"
                                class="bg-green-600 text-white rounded-lg hover:bg-green-700 px-4 py-2 w-full">
                                Filtrar
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('Ingreso') }}"
                                class="bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 px-4 py-2 w-full">
                                Resetear filtros
                            </a>
                        </div>
                    </form>
                </div>
                <div class="divide-y divide-gray-600 mx-auto bg-white shadow-md rounded-lg w-full">
                    @foreach ($ingresosTabla as $ingresoTabla)
                        @if ($ingresoTabla['ID_ESTADO'] == 1)
                            <div class="py-4 px-4 flex justify-between items-center">
                                <div class="flex-1">
                                    <div
                                        class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                                        Categoría: <span
                                            class="font-bold text-gray-700">{{ $ingresoTabla['TIPO_TRANSACCION'] }}</span>
                                    </div>
                                    <div
                                        class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha: <span class="font-normal text-gray-700">
                                            {{ $ingresoTabla['FECHA_INGRESO'] }}
                                        </span>
                                    </div>
                                    <div
                                        class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripción: <span
                                            class="font-normal text-gray-700">{{ $ingresoTabla['DESCRIPCION_INGRESO'] }}</span>
                                    </div>
                                    <div
                                        class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Monto: <span
                                            class="font-normal text-gray-700">{{ $ingresoTabla['MONTO_INGRESO'] }}</span>
                                    </div>
                                    <div
                                        class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Frecuencia: <span
                                            class="font-normal text-gray-700">{{ $ingresoTabla['NOMBRE_ESTADO'] }}</span>
                                    </div>
                                    <div
                                        class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado: <span
                                            class="font-normal text-gray-700">{{ $ingresoTabla['TIPO_ESTADO'] }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('editarIngresoFormulario', $ingresoTabla['ID_INGRESO']) }}"
                                        class="flex items-center bg-green-500 text-white px-3 py-1 rounded-full hover:bg-green-600 transition">
                                        <span>Actualizar</span>
                                        <img src="https://cdn-icons-png.flaticon.com/512/1827/1827933.png" alt=""
                                            width="20px" height="20px" class="ml-2">
                                    </a>
                                    <a href="{{ route('verMasForm', $ingresoTabla['ID_INGRESO']) }}"
                                        class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition gap-2">
                                        <span>...</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Popup Crear Ingreso --}}
            <div x-show="OpenRegistrarIngreso" style="display: none"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <form action="{{ route('registrarIngresos') }}" method="POST"
                    class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl">
                    @csrf
                    <h3 class="text-lg font-semibold mb-4">Agregar Ingreso</h3>
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select id="categoria" name="id_transaccion"
                            class="border border-gray-300 rounded w-full py-2 px-4">
                            @foreach ($categorias as $categoria)
                                @if ($categoria['ID_TIPO_CATEGORIA'] == 1)
                                    <option value="{{ $categoria['ID_TRANSACCION'] }}"
                                        {{ old('id_transaccion') == $categoria['ID_TRANSACCION'] ? 'selected' : '' }}>
                                        {{ $categoria['TIPO_TRANSACCION'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('id_transaccion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="border border-gray-300 rounded w-full py-2 px-4">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del ingreso</label>
                        <input type="date" id="fecha" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}"
                            class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                        @error('fecha_ingreso')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                        <input type="number" id="monto" name="monto_ingreso" value="{{ old('monto_ingreso') }}"
                            class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                        @error('monto_ingreso')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Frecuencia</label>
                        <select id="flujo" name="id_flujo"
                            class="w-full p-2 rounded bg-slate-400 text-white border-gray-300 py-2 px-4">
                            @foreach ($flujos as $flujo)
                                @if ($flujo['TIPO_ESTADO'] === 'TRANSACCION')
                                    <option value="{{ $flujo['ID_FLUJO'] }}"
                                        {{ old('id_flujo') == $flujo['ID_FLUJO'] ? 'selected' : '' }}>
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
                        <button type="button" @click="OpenRegistrarIngreso = false"
                            class="py-2 px-4 bg-red-500 text-white rounded">Cancelar</button>
                        <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded">Agregar</button>
                    </div>
                </form>
            </div>

            <div x-show="OpenCategoria" style="display: none" x-transition
                class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg w-full max-w-sm text-center">
                    <p class="text-lg mb-4">Categorías:</p>
                    <div class="flex justify-center space-x-4">
                        <button @click="OpenCrearCategoria = true; OpenCategoria = false"
                            class="py-2 px-4 bg-blue-500 text-white rounded-lg w-24">Crear</button>
                        <button @click="OpenEliminarCategoria = true; OpenCategoria = false"
                            class="py-2 px-4 bg-red-400 text-white rounded-lg w-24">Eliminar</button>
                        <button @click="OpenCategoria = false"
                            class="py-2 px-4 bg-red-500 text-white rounded-lg w-24 hover:bg-red-600 transition">Cerrar</button>
                    </div>
                </div>
            </div>

            <div x-show="OpenCrearCategoria" style="display: none" x-transition
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-xl font-bold mb-4">Crear una nueva categoría de gasto</h2>
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría:</label>
                        <input type="text" id="categoria" name="categoria"
                            class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    </div>
                    <button @click="OpenCrearCategoria = false"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Agregar</button>
                    <button @click="OpenCrearCategoria = false"
                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Cerrar</button>
                </div>
            </div>

            <div x-show="OpenEliminarCategoria" style="display: none" x-transition
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-xl font-bold mb-4">Eliminar una categoría de gasto</h2>
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría:</label>
                        <select id="categoria" name="categoria" class="border border-gray-300 rounded w-full py-2 px-4">
                            <option value="Emprendimiento">Universidad</option>
                            <option value="Trabajo">Fiesta</option>
                        </select>
                    </div>
                    <button @click="OpenEliminarCategoria = false"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Eliminar</button>
                    <button @click="OpenEliminarCategoria = false"
                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Cerrar</button>
                </div>
            </div>

            {{-- Paginación de la lista --}}
            <div class="col-span-full mt-4">
                {{-- Aquí puedes agregar los controles de paginación --}}
            </div>

        </section>

    </section>
@endsection
