@php
    $links = [
        "Presupuestos" => route("presupuestos.index"),
        "Agregar Presupuesto" => route("presupuestos.show", "123"),
    ];
    $tabNames= ['Información', 'Historial', 'Categorias']
@endphp
@vite('resources/css/presupuesto/presupuesto.show.css')
<x-layout>
    <div class="py-6 max-w-5xl mx-auto my-0">
        <!-- @if (isset($presupuestoId))
            <h1>Presupuesto ID: {{ $presupuestoId }}</h1>
        @endif -->
        <nav class="pb-4">
            <ul class="flex font-outfit text-gray-600 font-normal">
                @foreach ($links as $label => $link)
                    @if ($loop->last)
                        <li class="pl-1">
                            <a href="{{ $link }}">{{ $label}}</a>
                        </li>
                    @else
                        <li class="pl-1">
                            <a href="{{ $link }}">{{ $label . " / "}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <div>
            <div class="flex items-center justify-center p-8">
                <p>
                    GRAFICO
                </p>
            </div>
            <div>
                <!-- <ul>
                    <li>
                        <div>Desglose 1</div>
                    </li>
                    <li>
                        <div>Desglose 1</div>
                    </li>
                    <li>
                        <div>Desglose 1</div>
                    </li>
                </ul> -->
            </div>
        </div>
        <div id="preupuesto-info" class="flex flex-wrap items-center font-outfit">
            <h1 class="text-2xl font-bold text-center mx-auto mt-8 mb-3 relative">
                <span
                    class="bg-slate-950 bg-opacity-80 text-white absolute left-[0%] top-[-1.75rem] rounded-full px-3 py-1 text-xs">
                    Proceso
                </span>
                <strong>Cada en Cartago que frioooo!!</strong>
            </h1>
            <div id="presupuesto-actions" class="flex w-full pb-4">
                <select name="presupuesto-select" id="">
                    <option value="" disabled>Estado</option>
                    <option value="progress">Progreso</option>
                    <option value="open">Abierto</option>
                    <option value="close">Finalizado</option>
                </select>
                <x-ui.button :text="'Editar'" :btnType="'primary'" class="ml-auto"></x-ui.button>
                <x-ui.button :text="'Eliminar'" :btnType="'primary'" class="ml-3"></x-ui.button>
            </div>
            <x-ui.tabs :tabId="'presupuesto'" :tabNames="$tabNames" >
                <h2 class="mt-7 mb-3 font-outfit text-gray-950">Resumen</h2>
                <div id="Tab1" class="">
                    <h3>Tab 1</h3>
                    <p>Content for Tab 1.</p>
                </div>

                <div id="Tab2" class="">
                    <h3>Tab 2</h3>
                    <p>Content for Tab 2.</p>
                </div>

                <div id="Tab3" class="">
                    <h3>Tab 3</h3>
                    <p>Content for Tab 3.</p>
                </div>
            </x-ui.tabs>
        </div>
    </div>
</x-layout>