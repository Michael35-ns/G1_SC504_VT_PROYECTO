@extends('layouts.app')

@section('titulo')
    Más Acciones
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
                <p class="text-xl font-medium text-center text-white italic">
                    ₡1.090.340,00
                </p>
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

        <section x-data="{ OpenVerInfo: true }" class="flex flex-col gap-5 py-5">
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
                    <button class="w-full py-2 px-4 bg-cyan-600 text-white rounded-full">
                        Aplicar Filtros
                    </button>
                </div>
                <div>
                    <button class="w-full py-2 px-4 bg-cyan-400 text-white rounded-full">
                        Crear categoria
                    </button>
                </div>
                <div>
                    <button class="w-full py-2 px-4 bg-cyan-400 text-white rounded-full">
                        Crear Gasto
                    </button>
                </div>
            </div>

            <div class="col-span-full">
                <div class="divide-y divide-gray-600 w-3/4 mx-auto bg-white shadow-md rounded-lg">
                    <div class="py-4 px-4 flex justify-between items-center">
                        <div class="flex-1">
                            <div class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Categoria: <span></span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha: <span class="font-normal text-gray-700"></span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto: <span class="font-normal text-gray-700"></span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo de gasto: <span></span>
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
                            <button
                                class="flex items-center bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">
                                <span>Eliminar</span>
                                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt=""
                                    width="20px" height="20px" class="ml-2">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ver más informacion del Gasto --}}
            <div x-show="OpenVerInfo" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-xl font-bold mb-4">Detalles del gasto</h2>
                    <div class="mb-2">
                        <strong>Categoria:</strong>
                        <span class="text-gray-900">{{ $gastoTabla['TIPO_TRANSACCION'] }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Fecha:</strong> <span
                            class="text-gray-900">{{ \Carbon\Carbon::parse($gastoTabla['FECHA_GASTO'])->format('d/m/Y') }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Monto:</strong>
                        <span class="text-gray-900"> ₡ {{ number_format($gastoTabla['MONTO_GASTO']) }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Descripción:</strong>
                        <span class="text-gray-900">{{ $gastoTabla['DESCRIPCION_GASTO'] }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Tipo de gasto:</strong>
                        <span class="text-gray-900">{{ $gastoTabla['NOMBRE_ESTADO'] }}</span>
                    </div>
                    <br></br>
                    <a href="{{ route('Gasto') }}"
                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Cerrar</a>
                </div>
            </div>
        </section>
    </section>
@endsection
