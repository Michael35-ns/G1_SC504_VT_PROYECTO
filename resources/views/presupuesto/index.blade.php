@php
    $getItemJustifyClass = function (int $crrIdx) {
        return match ($crrIdx) {
            2 => 'justify-self-center',
            3 => 'justify-self-end',
            default => '',
        };
    };
@endphp
<x-layout>
    <div class="py-6 max-w-5xl mx-auto my-0">
        <h1 class="font-outfit text-4xl font-bold mb-6">Presupuesto</h1>
        <div class="presupuesto-actions-section flex items-start">
            <x-ui.input :labelName="'Buscar'" :type="'search'"></x-ui.input>
            <x-ui.button :text="'Agregar'" :btnType="'primary'" class="ml-3"></x-ui.button>
            <x-ui.button :text="'Filtrar'" :btnType="'secondary'" class="ml-auto"></x-ui.button>
        </div>
        <h2 class="mt-9 mb-3">Mis Presupuestos</h2>
        <div class="presupuesto-list">
            <ul class="grid grid-cols-[repeat(3,_1fr)] auto-rows-[minmax(170px,_200px)] items-center">
                @foreach ($presupuestos as $p)
                @php
                    static $listIdx = 0;
                    $listIdx++;
                    if ($listIdx > 3) {
                        $listIdx = 1;
                    };
                @endphp
                    <li class=" {{$getItemJustifyClass($listIdx)}}">
                        <x-ui.card.item>
                            <x-ui.progress-bar class="mt-7" :percentage="'40%'" :caption="'fechs: 05/11/2024'"
                                :desc="'BODY'" :desc2="$p->monto_total"></x-ui.progress-bar>
                        </x-ui.card.item>
                    </li>                
                @endforeach
            </ul>
        </div>
    </div>
</x-layout>