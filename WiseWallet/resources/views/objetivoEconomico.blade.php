@extends('layouts.app')

@section('titulo')
    Objetivos Financieros
@endsection

@section('contenido')
    <section class="hidden sm:grid grid-cols-3 gap-6 justify-items-center">
        <div></div>

        <div>
            <div class="porcentajes" style="--porcentaje: 50; --color: forestgreen">
                <svg width="150" heigth="150">
                    <circle r="68" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                    <circle r="68" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                </svg>
                <span>50%</span>
            </div>
        </div>

        <div class="w-full max-w-80">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-gray-400 space-y-2">
                <h2 class="text-3xl font-medium text-center text-white">
                    2
                </h2>
                <h4 class="text-xl font-bold text-center text-white">
                    {{ __('Total de Objetivos') }}
                </h4>
            </div>
        </div>

        <div class="w-full max-w-96">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-gray-400 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Objetivos Cumplidos') }}
                </h3>
                <p class="text-xl font-medium text-center text-white">
                    1
                </p>
            </div>
        </div>

        <div></div>

        <div class="w-full max-w-80">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-gray-400 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Objetivos Fallidos') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    0
                </p>
            </div>
        </div>
    </section>

    <section class="flex flex-col gap-4">

        <section x-data="{ open: false, filtro: '', search: '', confirmacionEliminar: '', nuevo_objetivo: '' }" class="flex flex-col gap-5 py-5">
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
                    <button @click="open=true"
                        class="w-full py-2 px-4 bg-gray-200 hover:bg-gray-300 transition text-gray-900 flex items-center rounded-full">
                        Aplicar Filtros <img src="https://cdn-icons-png.flaticon.com/512/151/151861.png" alt=""
                            width="15px" height="15px" class="ml-2">
                    </button>
                </div>

                <div></div>
                <div>
                    <button @click="nuevo_objetivo=true"
                        class="w-full py-2 px-4 text-gray-900 flex items-center bg-blue-300 rounded-full hover:bg-blue-400 transition">
                        Agregar un objetivo <img src="https://cdn-icons-png.flaticon.com/512/6711/6711415.png"
                            alt="" width="25px" height="25px" class="ml-2">
                    </button>
                </div>

            </div>
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
            <div x-show="nuevo_objetivo" style="display: none"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <form x-on:submit.prevent="nuevo_objetivo = false"
                    class="bg-[#e9edfb] p-6 rounded-lg shadow-lg w-full max-w-md">
                    <h3 class="text-xl font-bold mb-4 text-center">Registro de Objetivos Económicos</h3>
                    <div class="mb-4">
                        <label for="nombre_objetivo" class="block text-sm font-medium text-gray-700">Nombre del
                            Objetivo</label>
                        <input type="text" id="nombre_objetivo" name="nombre_objetivo" class="border border-gray-300 rounded w-full py-2 px-4"/>
                    </div>
                    <div class="mb-4">
                        <label for="fecha_tope" class="block text-sm font-medium text-gray-700">Fecha Tope</label>
                        <input type="date" id="fecha_tope" name="fecha_tope" x-model="fecha_tope"
                            class="border border-gray-300 rounded w-full py-2 px-4">
                    </div>
                    <div class="mb-4">
                        <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                        <input type="number" id="monto" name="monto" x-model="monto"
                            class="border border-gray-300 rounded w-full py-2 px-4">
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="border border-gray-300 rounded w-full py-2 px-4"></textarea>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="nuevo_objetivo = false"
                            class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600 transition">Cancelar</button>
                        <button type="button" @click="nuevo_objetivo = false"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition">Procesar</button>
                    </div>
                </form>
            </div>

            @php
                $objetivos = [
                    [
                        'nombre_objetivo' => 'Vacaciones Guanacaste',
                        'fecha_tope' => '2024-011-02',
                        'monto' => 50000,
                        'decripcion' => 'Ir dos noches al hotel conchal',
                    ],
                    [
                        'nombre_objetivo' => 'Curso de ingles',
                        'fecha_tope' => '2024-09-24',
                        'monto' => 204000,
                        'decripcion' => 'Pagar la próximo bimestre de ingles',
                    ],
                ];
            @endphp

            <div class="col-span-full">
                <div class="divide-y divide-gray-600 w-3/4 mx-auto bg-white shadow-md rounded-lg">
                    @foreach ($objetivos as $objetivo)
                        <div class="py-4 px-4 flex justify-between items-center">
                            <div class="flex-1">
                                <div class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    Objectivo: <span
                                        class="font-bold text-gray-700">{{ $objetivo['nombre_objetivo'] }}</span>
                                </div>
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha Tope: <span
                                        class="font-normal text-gray-700">{{ $objetivo['fecha_tope'] }}</span>
                                </div>
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto: <span class="font-normal text-gray-700">{{ $objetivo['monto'] }}</span>
                                </div>
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción: <span
                                        class="font-normal text-gray-700">{{ $objetivo['decripcion'] }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <div class="flex flex-col space-y-2">
                                    <a href="#"
                                        class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                                        <span>Ver Más Info</span>
                                        <img src="https://cdn-icons-png.flaticon.com/512/151/151861.png" alt=""
                                            width="15px" height="15px" class="ml-2">
                                    </a>
                                    <a href="#"
                                        class="flex items-center bg-green-400 text-white px-3 py-1 rounded-full hover:bg-green-600 transition">
                                        <span>En Progreso</span>
                                        <img src="https://cdn-icons-png.flaticon.com/512/4909/4909732.png" alt=""
                                            width="20px" height="20px" class="ml-2">
                                    </a>
                                </div>
                                <div class="flex flex-col space-y-2">
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
                        </div>
                    @endforeach
                </div>
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


            <div class="col-span-full mt-4">

            </div>

        </section>

    </section>
@endsection
