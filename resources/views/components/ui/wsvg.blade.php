@props(['name' => '', 'color' => 'currentColor', 'size' => 'sm'])

@php
    $svgPath = resource_path("assets/svgs/{$name}.svg");
    $svgContents = file_get_contents($svgPath);
    if (isset($color) && $color != 'currentColor') {
        $svgContents = preg_replace('/fill="[^"]*"/', 'fill="' . $color . '"', $svgContents);
    }

    $size = match ($size) {
        'sm' => ' h-[1rem] max-h-[1rem]',
        'md' => ' h-[1.5rem] max-h-[1.5rem]',
        'lg' => ' h-[1.75rem] max-h-[1.75rem]',
        default => ' h-[1rem] max-h-[1rem]',
    }; 
@endphp

<i {{ $attributes->class(['flex items-stretch', $size]) }}>
    {!! $svgContents !!}
</i>