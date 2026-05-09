@props(['align' => 'left'])

<th class="px-5 py-4 text-{{ $align }}">
    {{ $slot }}
</th>