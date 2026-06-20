@php
    $section = \App\Models\PageContent::get('ubytovani', [
        'anchor'    => 'ubytovani',
        'heading'   => 'Ubytování',
        'subheading' => 'Vyberte si z našich možností',
        'items'     => [],
    ]);
@endphp

<section id="{{ $section['anchor'] ?? 'ubytovani' }}" class="bg-[#0a1a10] py-24 lg:py-32">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-16 lg:mb-24">
            @if(!empty($section['subheading']))
                <p class="font-['DM_Sans'] text-xs font-light tracking-[0.4em] uppercase text-[#c9a96e] mb-4">
                    {{ $section['subheading'] }}
                </p>
            @endif
            <h2 class="font-['Cormorant_Garamond'] text-5xl lg:text-6xl font-light text-[#f5f0e8] tracking-wide">
                {{ $section['heading'] }}
            </h2>
            <div class="mt-6 mx-auto w-16 h-px bg-[#c9a96e]/40"></div>
        </div>

        {{-- Items --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            @foreach($section['items'] ?? [] as $item)
                <x-ubytovani.card :item="$item" />
            @endforeach
        </div>

    </div>
</section>
