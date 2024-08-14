@props(['labelName' => '', 'type' => 'text'])


<div class="flex items-stretch max-h-16">
    <label for="presupuesto-search" class="hidden"> {{ $labelName }} </label>
    <input type="{{ $type }}" name="presupuesto-search" id="presupuesto-search" placeholder="{{ $labelName }}"
        {{ $attributes->class(['border-solid border-2 border-gray-400 rounded-sm py-3 pl-8 pr-12 font-outfit font-normal']) }} />
</div>