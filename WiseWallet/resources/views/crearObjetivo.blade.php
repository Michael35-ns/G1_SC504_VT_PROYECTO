@extends('layouts.app')

@section('titulo')
    Objetivos Financieros
@endsection

@section('contenido')
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 p-4">
        <form action="{{ url('/agregar-objetivo') }}" method="POST"" method="POST" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
            @csrf
            <h3 class="text-xl font-bold mb-4 text-center">Registro de Objetivos Económicos</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="nombre_objetivo" class="block text-sm font-medium text-gray-700">Nombre del Objetivo</label>
                    <input type="text" id="nombre_objetivo" name="nombre_objetivo"
                           class="border border-gray-300 rounded w-full py-2 px-4" required />
                </div>

                <div>
                    <label for="descripcion_objetivo" class="block text-sm font-medium text-gray-700">Descripción del Objetivo</label>
                    <textarea id="descripcion_objetivo" name="descripcion_objetivo"
                              class="border border-gray-300 rounded w-full py-2 px-4"></textarea>
                </div>

                <div>
                    <label for="monto_objetivo" class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" id="monto_objetivo" name="monto_objetivo"
                           class="border border-gray-300 rounded w-full py-2 px-4" required />
                </div>

                <div>
                    <label for="fecha_tope" class="block text-sm font-medium text-gray-700">Fecha Tope</label>
                    <input type="date" id="fecha_tope" name="fecha_tope"
                           class="border border-gray-300 rounded w-full py-2 px-4" required />
                </div>

                <div>
                    <label for="id_gastos" class="block text-sm font-medium text-gray-700">ID Gastos</label>
                    <input type="number" id="id_gastos" name="id_gastos"
                           class="border border-gray-300 rounded w-full py-2 px-4" />
                </div>

                <div>
                    <label for="id_estado" class="block text-sm font-medium text-gray-700">ID Estado</label>
                    <input type="number" id="id_estado" name="id_estado"
                           class="border border-gray-300 rounded w-full py-2 px-4" />
                </div>

                <div>
                    <label for="id_transaccion" class="block text-sm font-medium text-gray-700">ID Transacción</label>
                    <input type="number" id="id_transaccion" name="id_transaccion"
                           class="border border-gray-300 rounded w-full py-2 px-4" />
                </div>

                <div>
                    <label for="id_ingreso" class="block text-sm font-medium text-gray-700">ID Ingreso</label>
                    <input type="number" id="id_ingreso" name="id_ingreso"
                           class="border border-gray-300 rounded w-full py-2 px-4" />
                </div>

                <div>
                    <label for="id_presupuesto" class="block text-sm font-medium text-gray-700">ID Presupuesto</label>
                    <input type="number" id="id_presupuesto" name="id_presupuesto"
                           class="border border-gray-300 rounded w-full py-2 px-4" />
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="welcome"><button type="button" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600 transition">Cancelar</button></a>
                <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition">Procesar</button>
            </div>
        </form>
    </div>
@endsection
