@props(['percentage' => '0%', 'caption', 'desc', 'desc2'])

@php
    $pattern = '/^\d+(\.\d+)?%$/';
    if (!isset($percentage))
        $percentage = '0%';
    if (!preg_match($pattern, $percentage))
        $percentage = '0%'; 
@endphp
<div {{ $attributes->class(["w-full flex flex-wrap justify-between font-outfit"]) }}>
    @if (isset($desc))
        <p class="text-gray-300 text-sm">
            <span class="text-gray-900">{{ $desc }}</span>
            @if (isset($desc2))
                <span>{{' / ' . $desc2}}</span>
            @endif
        </p>
    @endif
    <span class="text-sm">{{ $percentage }}</span>
    <div
        class="w-full pt-4 my-1 rounded-full bg-gray-400 relative 
                before:content-[''] before:absolute before:left-[0%] before:top-0 before:bottom-0 before:w-[{{$percentage}}] before:bg-gray-900 before:rounded-full">
    </div>
    @if (isset($caption))
        <small class="text-gray-700 text-xs">{{ $caption }}</small>
    @endif
</div>