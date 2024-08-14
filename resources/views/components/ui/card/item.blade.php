@props(['title' => 'Título', 'actionIcon', 'icon' => 'fa-circle-empty'])

<div
    class="flex border-4 border-black flex-wrap max-w-[295px] min-w-[250px] rounded-[7px] justify-around px-3 pt-2 pb-7 items-center">
    <x-ui.wsvg :name="$icon" :size="'md'"></x-ui.wsvg>
    <p class="w-[60%] flex flex-wrap font-outfit relative">
        <strong class="w-full overflow-x-hidden whitespace-nowrap text-ellipsis text-xl">{{ $title }}</strong>
        <span
            class="bg-slate-950 bg-opacity-80 text-white absolute left-[0%] bottom-[-1.75rem] rounded-full px-3 py-1 text-xs">
            Proceso
        </span>
    </p>
    @if (isset($actionIcon))
        <span class="inline-block px-6 py-3"></span>
    @else
        <button class="rounded-full px-4 py-2 hover:bg-gray-600" type="button">
            <x-ui.wsvg :name="'fa-ellipsis-vertical'" :size="'md'"></x-ui.wsvg>
        </button>
    @endif
    <div class="w-full flex flex-wrap justify-between font-outfit">
        {{ $slot }}
    </div>
</div>