@extends('layouts.app')

@section('titulo')
    Objetivos Financieros
@endsection

@section('contenido')
    <section class="hidden sm:grid grid-cols-3 gap-6 justify-items-center">
        <div></div>

        <div x-data="{ porcentaje: {{$porcentaje}}, color: 'forestgreen' }" class="flex items-center justify-center">
            <div class="porcentajes" :style="`--porcentaje: ${porcentaje}; --color: ${color}`">
                <svg width="150" height="150">
                    <circle r="68" cx="50%" cy="50%" pathlength="100" class="bg-circle" stroke="lightgray" stroke-width="12" fill="none" />
                    <circle r="68" cx="50%" cy="50%" pathlength="100" class="progress-circle" :style="`stroke-dasharray: ${porcentaje} 100`" stroke="forestgreen" stroke-width="12" fill="none" />
                </svg>
                <span x-text="`${porcentaje}%`"></span>
            </div>
        </div>
        

        <div class="w-full max-w-80">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-gray-400 space-y-2">
                <h2 class="text-3xl font-medium text-center text-white">
                    {{ $totalObjetivos }}
                </h2>
                <h4 class="text-xl font-bold text-center text-white">
                    {{ __('Total de Objetivos') }}
                </h4>
            </div>
        </div>

        <div class="w-full max-w-96">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-gray-400 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Objetivos Activos') }}
                </h3>
                <p class="text-xl font-medium text-center text-white">
                    {{ $objetivosActivos }}
                </p>
            </div>
        </div>

        <div></div>

        <div class="w-full max-w-80">
            <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-gray-400 space-y-2">
                <h3 class="text-3xl font-bold text-center text-white">
                    {{ __('Objetivos Inactivos') }}
                </h3>
                <p class="text-xl font-medium text-center text-white italic">
                    {{ $objetivosInactivos }}
                </p>
            </div>
        </div>
    </section>

    @if(session('status') === 'success')
        <div class="flex items-center justify-center">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-lg max-w-sm w-full">
                <span class="block sm:inline">El estado del objetivo se ha cambiado con éxito.</span>
            </div>
        </div>
    @elseif(session('status') === 'error')
        <div class="flex items-center justify-center">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-lg max-w-sm w-full">
                <span class="block sm:inline">Error al cambiar el estado del objetivo: {{ session('message') }}</span>
            </div>
        </div>
    @endif

    <section x-data="{ open: false, search: '', confirmacionEliminar: '', nuevo_objetivo: '' }" class="flex flex-col gap-5 py-5">
        <div class="flex gap-4 justify-center items-center">
            <form action="{{ route('buscarObjetivos') }}" method="GET" class="flex w-60 rounded-full bg-gray-200">
                <input type="search" name="buscar" id="buscar" placeholder="Buscar"
                    class="w-full border-none bg-transparent px-4 py-1 text-gray-900 outline-none focus:outline-none" />
                <button type="submit" class="m-2 rounded px-4 py-2">
                    <img src="https://cdn-icons-png.flaticon.com/256/25/25313.png" alt="lupa" width="20px" height="20px">
                </button>
            </form>
            <div></div>
            <a href="{{ route('crearObjetivoEconomico') }}" class="block">
                <button @click="nuevo_objetivo=true"
                    class="w-full py-2 px-4 text-gray-900 flex items-center bg-blue-300 rounded-full hover:bg-blue-400 transition">
                    Agregar un objetivo
                    <img src="https://cdn-icons-png.flaticon.com/512/6711/6711415.png"
                        alt="" width="25px" height="25px" class="ml-2">
                </button>
            </a>
        </div>

        <div class="col-span-full">
            <div class="divide-y divide-gray-600 w-3/4 mx-auto bg-white shadow-md rounded-lg">
                @forelse ($objetivos as $objetivo)
                    <div class="py-4 px-4 flex justify-between items-center">
                        <div class="flex-1">
                            <div class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Objetivo: <span class="font-bold text-gray-700">{{ $objetivo['NOMBRE_OBJETIVO'] }}</span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción: <span class="font-normal text-gray-700">{{ $objetivo['DESCRIPCION_OBJETIVO'] }}</span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha Tope: <span class="font-normal text-gray-700">{{ $objetivo['FECHA_TOPE'] }}</span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto: <span class="font-normal text-gray-700">{{ $objetivo['MONTO_OBJETIVO'] }}</span>
                            </div>
                            <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado: <span class="font-normal text-gray-700">{{ $objetivo['ID_ESTADO'] == 1 ? 'Inactivo' : 'Activo' }}</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="flex flex-col space-y-2">

                                <a href="{{ route('verObjetivo', ['id' => $objetivo['ID_OBJETIVO']]) }}"
                                    class="flex items-center bg-orange-400 text-white px-3 py-1 rounded-full hover:bg-orange-600 transition">
                                    <span>En Progreso</span>
                                    <img src="https://cdn-icons-png.flaticon.com/512/4909/4909732.png" alt=""
                                        width="20px" height="20px" class="ml-2">
                                </a>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('editarObjetivoEconomico', ['id' => $objetivo['ID_OBJETIVO']]) }}"
                                    class="flex items-center bg-blue-300 text-white px-3 py-1 rounded-full hover:bg-gray-600 transition">
                                    <span>Actualizar</span>
                                    <img src="https://cdn-icons-png.flaticon.com/512/1827/1827933.png" alt=""
                                        width="20px" height="20px" class="ml-2">
                                </a>
                                <a href="{{ route('cambiarEstadoObjetivo', ['id' => $objetivo['ID_OBJETIVO']]) }}"
                                    class="flex items-center {{ $objetivo['ID_ESTADO'] == 1 ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-3 py-1 rounded-full transition">
                                    <span>{{ $objetivo['ID_ESTADO'] == 1 ? 'Inactivar' : 'Activar' }}</span>
                                    <img src="{{ $objetivo['ID_ESTADO'] == 1 ? 'https://cdn-icons-png.flaticon.com/512/1214/1214428.png' : 'https://cdn-icons-png.flaticon.com/512/148/148766.png' }}" alt=""
                                        width="20px" height="20px" class="ml-2">
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-4 px-4 text-center">
                        <p class="text-gray-500">No se encontraron objetivos que coincidan con tu búsqueda.</p>
                    </div>
                @endforelse
            </div>
        </div>
            </div>
        </div>
    </section>
@endsection
