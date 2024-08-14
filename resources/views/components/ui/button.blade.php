@props(['text', 'btnType' => 'primary'])

@php
    $btnClass = match ($btnType) {
        'primary' => 'bg-white',
        'secondary' => 'text-white bg-[#3d3d3d]',
        default => 'text-white bg-[#3d3d3d]',
    }; 
@endphp

<button type="button" {{ $attributes->class(['inline-flex h-12 border-2  rounded-sm px-6 py-1 items-center flex-wrap font-outfit font-medium border-[#141414] shadow-[0px_3px_0px_1px_#141414,0px_0px_0px_1px_#141414] ' . $btnClass]) }}>
    <span class="inline-flex">{{ $text  }}</span>
</button>