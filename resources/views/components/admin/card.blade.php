<div class="bg-white rounded-2xl p-6 shadow border">
    @if(isset($title))
        <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wide">
            {{ $title }}
        </h3>
    @endif

    {{ $slot }}
</div>