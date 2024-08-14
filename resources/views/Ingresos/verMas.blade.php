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
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="font-semibold text-gray-700">Categoría:</span>
                    <span class="text-gray-900">{{ $ingresoTabla['TIPO_TRANSACCION'] }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="font-semibold text-gray-700">Fecha:</span>
                    <span
                        class="text-gray-900">{{ \Carbon\Carbon::parse($ingresoTabla['FECHA_INGRESO'])->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="font-semibold text-gray-700">Descripción:</span>
                    <span class="text-gray-900">{{ $ingresoTabla['DESCRIPCION_INGRESO'] }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="font-semibold text-gray-700">Monto:</span>
                    <span class="text-gray-900"> ₡ {{ number_format($ingresoTabla['MONTO_INGRESO']) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Estado:</span>
                    <span class="text-gray-900">{{ $ingresoTabla['TIPO_ESTADO'] }}</span>
                </div>
            </div>
            <a href="{{ route('Ingreso') }}"
                class="mt-6 inline-block py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Volver</a>
            <form action="{{ route('eliminarIngreso', $ingresoTabla['ID_INGRESO']) }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="mt-6 ml-2 inline-block py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <span>Eliminar</span>
                </button>
            </form>
        </div>
    </div>
@endsection
