@extends('layouts.app')

@section('titulo')
    Transacciones
@endsection

@section('contenido')
        <section class="hidden sm:grid grid-cols-3 gap-6 justify-items-center">
            <div></div>

            <div >
                <div class="porcentajes" style="--porcentaje: 75">
                    <svg width="150" heigth="150">
                        <circle r="65" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                        <circle r="65" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                    </svg>
                    <span>75%</span>
                </div>
            </div>

            <div class="w-full max-w-96">
                <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                    <h3 class="text-3xl font-bold text-center text-white">
                        {{__('Dinero restante')}}
                    </h3>
                    <p class="text-xl font-medium text-center text-white italic">
                        ₡334.000,00
                    </p>
                </div>
            </div>

            <div class="w-full max-w-96">
                <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                    <h3 class="text-3xl font-bold text-center text-white">
                        {{__('Ingresos Totales')}}
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
                        {{__('Gastos Totales')}}
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
                        {{__('Dinero restante')}}
                    </h3>
                    <p class="text-xl font-medium text-center text-white italic">
                        ₡334.000,00
                    </p>
                </div>
            </div>

            <div class="w-full">
                <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                    <h3 class="text-3xl font-bold text-center text-white">
                        {{__('Ingresos Totales')}}
                    </h3>
                    <p class="text-xl font-medium text-center text-white italic">
                        ₡1.090.340,00
                    </p>
                </div>
            </div>
            <div class="w-full">
                <div class="w-full border-2 px-4 py-2 rounded-md shadow-md bg-cyan-700 space-y-2">
                    <h3 class="text-3xl font-bold text-center text-white">
                        {{__('Gastos Totales')}}
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

            {{-- TABLA Gastos --}}
            <div>
                
            </div>

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
