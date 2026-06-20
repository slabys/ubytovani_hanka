@php
    $hero = \App\Models\PageContent::get('hero', [
        'anchor'      => 'home',
        'heading'     => 'Ubytování Hanka',
        'subheading'  => 'Frymburk u Lipna',
        'description' => 'Klidné ubytování v srdci jižních Čech, u krásné přírody Lipna.',
        'cta_label'   => 'Zobrazit ubytování',
        'cta_anchor'  => 'ubytovani',
        'image'       => null,
    ]);
@endphp

<section
    id="{{ $hero['anchor'] ?? 'home' }}"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
>
    {{-- Background image --}}
    @if($hero['image'])
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('storage/' . $hero['image']) }}')"
        ></div>
        <div class="absolute inset-0 bg-[#0a1a10]/60"></div>
    @else
        <div class="absolute inset-0 bg-gradient-to-b from-[#0e2218] via-[#0a1a10] to-[#0a1a10]"></div>
    @endif

    {{-- Decorative corner lines --}}
    <div class="absolute top-12 left-12 w-16 h-16 border-t border-l border-[#c9a96e]/30 hidden lg:block"></div>
    <div class="absolute top-12 right-12 w-16 h-16 border-t border-r border-[#c9a96e]/30 hidden lg:block"></div>
    <div class="absolute bottom-12 left-12 w-16 h-16 border-b border-l border-[#c9a96e]/30 hidden lg:block"></div>
    <div class="absolute bottom-12 right-12 w-16 h-16 border-b border-r border-[#c9a96e]/30 hidden lg:block"></div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">

        @if($hero['subheading'])
            <p class="font-['DM_Sans'] text-xs font-light tracking-[0.4em] uppercase text-[#c9a96e] mb-6">
                {{ $hero['subheading'] }}
            </p>
        @endif

        <h1 class="font-['Cormorant_Garamond'] text-6xl md:text-8xl font-light text-[#f5f0e8] leading-none tracking-wide mb-8">
            {{ $hero['heading'] }}
        </h1>

        @if($hero['description'])
            <p class="font-['DM_Sans'] text-base font-light text-[#f5f0e8]/60 max-w-xl mx-auto leading-relaxed mb-12">
                {{ $hero['description'] }}
            </p>
        @endif

        @if($hero['cta_label'])
            <a
                href="#{{ $hero['cta_anchor'] ?? 'ubytovani' }}"
                class="inline-flex items-center gap-3 font-['DM_Sans'] text-sm font-light tracking-[0.2em] uppercase text-[#0e2218] bg-[#c9a96e] px-8 py-4 hover:bg-[#f5f0e8] transition-colors duration-300"
            >
                {{ $hero['cta_label'] }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        @endif

    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[#f5f0e8]/30">
        <span class="font-['DM_Sans'] text-[10px] tracking-[0.3em] uppercase">Scroll</span>
        <div class="w-px h-10 bg-gradient-to-b from-[#c9a96e]/50 to-transparent"></div>
    </div>
</section>