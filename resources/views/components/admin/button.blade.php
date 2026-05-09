@props(['variant' => 'primary'])

@php
$styles = [
    'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white',
];
@endphp

<button {{ $attributes->merge([
    'class' => "px-3 py-1.5 text-xs rounded-lg transition {$styles[$variant]}"
]) }}>
    {{ $slot }}
</button>