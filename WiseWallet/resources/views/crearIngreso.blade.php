@extends('layouts.app')

@section('titulo')
    Transacciones
@endsection

@section('contenido')
    <section class="hidden sm:grid grid-cols-3 gap-6 justify-items-center">
        <div></div>

        <div>
            <div class="porcentajes" style="--porcentaje: 75">
                <svg width="150" heigth="150">
                    <circle r="68" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                    <circle r="68" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                </svg>
                <span>75%</span>
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
                    {{ __('Ingresos Totales') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    ₡1.090.340,00
                </p>
            </div>
        </div>

        <div></div>

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



    <section class="flex flex-col gap-4">

        <nav class="text-center font-normal space-x-4">
            <span
                class="rounded-full w-24 py-1 px-2 text-center font-light {{ request()->routeIs('crearIngreso') ? 'bg-cyan-600 text-white shadow' : 'text-gray-900' }}">
                <a href="{{ route('crearIngreso') }}">
                    {{ __('Ingresos') }}
                </a>
            </span>
            <span>
                /
            </span>
            <span
                class="rounded-full w-24 py-1 px-2 text-center font-light {{ request()->routeIs('crearGasto') ? 'bg-cyan-600 text-white shadow' : 'text-gray-900' }}">
                <a href="{{ route('crearGasto') }}">
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

        <section x-data="{ open: false, filtro: '', search: '', confirmacionEliminar: '', OpenRegistrarIngreso: false }" class="flex flex-col gap-5 py-5">
            <div class="flex gap-4 justify-center items-center">

                <div class="flex w-60 rounded-full bg-gray-200">
                    <input type="search" name="buscar" id="buscar" placeholder="Buscar"
                        class="w-full border-none bg-transparent px-4 py-1 text-gray-900 outline-none focus:outline-none" />
                    <button class="m-2 rounded px-4 py-2">
                        <img src="https://cdn-icons-png.flaticon.com/256/25/25313.png" alt="lupa" width="20px"
                            height="20px">
                    </button>
                </div>

                <div class="ml-4">
                    <button @click="open=true" class="w-full py-2 px-4 bg-cyan-600 text-white rounded-lg">
                        Aplicar Filtros
                    </button>
                </div>

                <div></div>

                {{-- Crear ingreso --}}
                <div>
                    <button @click="OpenRegistrarIngreso=true" class="w-full py-2 px-4 bg-cyan-400 text-white rounded">
                        Crear Ingreso
                    </button>
                </div>

            </div>

            {{-- Formulario oculto --}}
            <div x-show="open" style="display: none"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <form x-on:submit.prevent="document.getElementById('searchForm').submit()" id="searchForm"
                    action="{{ route('buscarIngresos') }}" method="POST"
                    class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                    @csrf
                    <h3 class="text-lg font-semibold mb-4">Aplicar Filtros</h3>
                    <div class="mb-4">
                        <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                        <input type="text" id="search" name="search" x-model="search"
                            class="border border-gray-300 rounded w-full py-2 px-4">
                    </div>
                    <div class="mb-4">
                        <label for="filtro" class="block text-sm font-medium text-gray-700">Filtrar por</label>
                        <select id="filtro" name="filtro" x-model="filtro"
                            class="border border-gray-300 rounded w-full py-2 px-4">
                            <option value="">Filtrar por...</option>
                            <option value="fecha">Fecha</option>
                            <option value="monto">Monto</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="open = false" class="py-2 px-4 bg-gray-300 rounded">Cancelar</button>
                        <button type="submit" class="py-2 px-4 bg-cyan-600 text-white rounded">Aplicar</button>
                    </div>
                </form>
            </div>


            {{-- Lista de resultados --}}
            <div class="col-span-full">
                <div class="divide-y divide-gray-600 w-3/4 mx-auto bg-white shadow-md rounded-lg">
                    @foreach ($ingresos as $ingreso)
                        <div class="py-4 px-4 flex justify-between items-center">
                            <div class="flex-1">
                                <div class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Categoria: <span class="font-bold text-gray-700">{{ $ingreso['categoria'] }}</span>
                                </div>
                                <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha: <span class="font-normal text-gray-700">{{ $ingreso['fecha'] }}</span>
                                </div>
                                <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción: <span
                                        class="font-normal text-gray-700">{{ $ingreso['decripcion'] }}</span>
                                </div>
                                <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto: <span class="font-normal text-gray-700">{{ $ingreso['monto'] }}</span>
                                </div>
                                <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado: <span class="font-normal text-gray-700">{{ $ingreso['estado'] }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="#"
                                    class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition gap-2">
                                    <span>Ver Más</span>
                                    <x-icons.ver class="!w-5 !h-5" />
                                </a>
                                <a href="#"
                                    class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                                    <span>Actualizar</span>
                                    <img src="https://cdn-icons-png.flaticon.com/512/1827/1827933.png" alt=""
                                        width="20px" height="20px" class="ml-2">
                                </a>
                                <button @click="confirmacionEliminar=true"
                                    class="flex items-center bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">
                                    <span>Eliminar</span>
                                    <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt=""
                                        width="20px" height="20px" class="ml-2">
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            {{-- Popup Crear Ingreso --}}
            <div x-show="OpenRegistrarIngreso" style="display: none"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <form x-on:submit.prevent="document.getElementById('searchForm').submit()" id="searchForm"
                    action="{{ route('buscarIngresos') }}" method="POST"
                    class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl">
                    @csrf
                    <h3 class="text-lg font-semibold mb-4">Agregar Ingreso</h3>
                    <div class="mb-4">
                        <label for="NombreIngreso" class="block text-sm text-gray-700">Nombre del ingreso</label>
                        <input type="text" id="NombreIngreso" name="NombreIngreso" x-model="NombreIngreso"
                            class="border border-gray-300 rounded w-full py-2 px-4">
                    </div>
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select id="categoria" name="categoria" class="border border-gray-300 rounded w-full py-2 px-4">
                            <option value="Emprendimiento">Emprendimiento</option>
                            <option value="Trabajo">Trabajo</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="border border-gray-300 rounded w-full py-2 px-4"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-calendario.calendario />
                    </div>
                    <div class="mb-4">
                        <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                        <input type="number" id="monto" name="monto"
                            class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1 font-medium border-gray-300 text-gray-700">Monto Activo</label>
                        <select class="w-full p-2 rounded bg-slate-400 text-white border-gray-300 py-2 px-4">
                            <option class="text-white" value="mensual">Mensual</option>
                            <option class="text-white" value="anual">Anual</option>
                            <option class="text-white" value="semanal">Semanal</option>
                            <option class="text-white" value="diario">Diario</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="OpenRegistrarIngreso = false"
                            class="py-2 px-4 bg-red-500  text-white rounded">Cancelar</button>
                        <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded">Agregar</button>
                    </div>
                </form>
            </div>

            <div x-show="confirmacionEliminar" style="display: none"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-gray-950 text-white p-6 rounded-lg shadow-lg w-full max-w-sm text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3817/3817209.png" alt="confirmación" width="60px"
                        height="60px" class="mx-auto mb-4">
                    <p class="text-lg mb-4">¿Estás seguro que quieres eliminar este ingreso?</p>
                    <div class="flex justify-center space-x-4">
                        <button @click="confirmacionEliminar = false"
                            class="py-2 px-4 bg-blue-500 text-white rounded-lg w-24">No</button>
                        <button @click="confirmacionEliminar = false"
                            class="py-2 px-4 bg-red-500 text-white rounded-lg w-24">Eliminar</button>
                    </div>
                </div>
            </div>


            {{-- Paginación de la lista --}}
            <div class="col-span-full mt-4">
                {{-- Aquí puedes agregar los controles de paginación --}}
            </div>

        </section>

    </section>
@endsection
