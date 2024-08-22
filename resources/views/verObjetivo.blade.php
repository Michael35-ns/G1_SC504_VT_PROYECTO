@extends('layouts.app')

@section('titulo')
    Más Acciones
@endsection

@section('contenido')
    {{-- Ver más informacion del ingreso --}}
    <div class="fixed inset-0 flex items-center justify-center ml-20">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Detalles del Ingreso</h2>
            <div class="space-y-4">
                @foreach ($objetivos as $objetivo)
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-semibold text-gray-700">Categoría:</span>
                        <span class="text-gray-900">{{ $objetivo['NOMBRE_OBJETIVO'] }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-semibold text-gray-700">Fecha:</span>
                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($objetivo['FECHA_TOPE'])->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-semibold text-gray-700">Descripción:</span>
                        <span class="text-gray-900">{{ $objetivo['DESCRIPCION_OBJETIVO'] }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-semibold text-gray-700">Monto:</span>
                        <span class="text-gray-900"> ₡ {{ number_format($objetivo['MONTO_OBJETIVO']) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Estado:</span>
                        <span class="text-gray-900">{{ $objetivo['TIPO_ESTADO'] }}</span>
                    </div>
                    <hr class="my-4">
                @endforeach
            </div>
            <a href="{{ route('objetivoEconomico') }}"
                class="mt-6 inline-block py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Volver</a>
        </div>
    </div>
    
@endsection
