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

    <section class="sm:hidden flex flex-col items-center justify-center gap-4">
        <div>
            <div class="porcentajes" style="--porcentaje: 75">
                <svg width="150" heigth="150">
                    <circle r="65" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                    <circle r="65" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                </svg>
                <span>75%</span>
            </div>
        </div>
        <div class="w-full">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Dinero restante') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    ₡334.000,00
                </p>
            </div>
        </div>

        <div class="w-full">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Ingresos Totales') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    ₡1.090.340,00
                </p>
            </div>
        </div>
        <div class="w-full">
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

        <section x-data="{ open: false, filtro: '', search: '', confirmacionEliminar: '' }" class="flex flex-col gap-5 py-5">
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
                    <button type="button" class="w-full py-2 px-4 bg-cyan-400 text-white rounded">
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
                        <button type="button" @click="open = false"
                            class="py-2 px-4 bg-gray-300 rounded">Cancelar</button>
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
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha: <span class="font-normal text-gray-700">{{ $ingreso['fecha'] }}</span>
                                </div>
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción: <span
                                        class="font-normal text-gray-700">{{ $ingreso['decripcion'] }}</span>
                                </div>
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto: <span class="font-normal text-gray-700">{{ $ingreso['monto'] }}</span>
                                </div>
                                <div
                                    class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado: <span class="font-normal text-gray-700">{{ $ingreso['estado'] }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="#"
                                    class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                                    <span>Ver Más</span>
                                    <img src="https://cdn-icons-png.flaticon.com/512/151/151861.png" alt=""
                                        width="15px" height="15px" class="ml-2">
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

            <div x-show="confirmacionEliminar" style="display: none"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-gray-950 text-white p-6 rounded-lg shadow-lg w-full max-w-sm text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3817/3817209.png" alt="confirmación" width="60px"
                        height="60px" class="mx-auto mb-4">
                    <p class="text-lg mb-4">¿Estás seguro que quieres eliminar este ingreso?</p>
                    <div class="flex justify-center space-x-4">
                        <button @click="confirmacionEliminar = false" class="py-2 px-4 bg-blue-500 text-white rounded-lg w-24">No</button>
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


{{-- 
@section('grafico')

@endsection

@section('search')
<div class="relative w-full max-w-md mb-8">
    <input type="text"
        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-500"
        placeholder="Buscar...">
</div>
@endsection

@section('contenido')
    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        @if (session('success'))
            <div class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="absolute top-10 left-20 p-5 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-bold text-gray-700">Texto 1</h2>
            <p class="text-gray-500">Este es el texto 2</p>
        </div>

        <form action="{{ route('ingreso.store') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Titulo
                </label>
                <input id="titulo" name="titulo" type="text" placeholder="Titulo del ingreso"
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
                <textarea id="descripcion" name="descripcion" type="text" placeholder="Descripción del ingreso"
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
@endsection --}}
