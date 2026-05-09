@props(['variant' => 'blue'])

@php
$styles = [
    'blue' => 'bg-blue-100 text-blue-700',
];
@endphp

<span class="px-3 py-1 text-xs font-semibold rounded-full {{ $styles[$variant] }}">
    {{ $slot }}
</span>