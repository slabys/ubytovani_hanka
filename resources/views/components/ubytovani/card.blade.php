@props(['item'])

@php
    $gallery = array_values(array_filter($item['gallery'] ?? []));
    $thumbnail = $gallery[0] ?? null;
@endphp

<div
    x-data="{
        open: false,
        current: 0,
        sliding: false,
        animClass: '',
        images: {{ Js::from(array_map(fn($p) => asset('storage/' . $p), $gallery)) }},
        go(index, dir) {
            if (this.sliding) return;
            this.sliding = true;
            this.animClass = dir === 'next' ? 'lb-slide-out-left' : 'lb-slide-out-right';
            setTimeout(() => {
                this.current = index;
                this.animClass = dir === 'next' ? 'lb-slide-in-right' : 'lb-slide-in-left';
                setTimeout(() => { this.animClass = ''; this.sliding = false; }, 250);
            }, 200);
        },
        prev() { this.go((this.current - 1 + this.images.length) % this.images.length, 'prev') },
        next() { this.go((this.current + 1) % this.images.length, 'next') },
    }"
    x-init="$watch('open', val => document.body.style.overflow = val ? 'hidden' : '')"
    class="group relative flex flex-col border border-[#c9a96e]/20 hover:border-[#c9a96e]/50 bg-[#faf8f3] transition-colors duration-500"
>
    {{-- Thumbnail --}}
    <div class="relative overflow-hidden aspect-[4/3] bg-[#e8e0d0]">
        @if($thumbnail)
            <img
                src="{{ asset('storage/' . $thumbnail) }}"
                alt="{{ $item['title'] }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
            >
            @if(count($gallery) > 1)
                <button
                    @click="open = true; current = 0"
                    class="absolute inset-0 flex items-end justify-end p-4 bg-gradient-to-t from-[#1c1a14]/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                    aria-label="Zobrazit galerii"
                >
                    <span class="flex items-center gap-2 font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#f5f0e8] bg-[#1c1a14]/80 backdrop-blur-sm px-3 py-2 border border-[#c9a96e]/30">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ count($gallery) }} fotografií
                    </span>
                </button>
            @endif
        @else
            <div class="w-full h-full flex items-center justify-center">
                <div class="w-12 h-12 border border-[#c9a96e]/30 rotate-45"></div>
            </div>
        @endif

        {{-- Price badge --}}
        @if(!empty($item['price']))
            <div class="absolute top-4 right-4 bg-[#1c1a14]/90 backdrop-blur-sm border border-[#c9a96e]/30 px-4 py-2">
                <span class="font-['DM_Sans'] text-xs font-light tracking-[0.15em] uppercase text-[#c9a96e]">
                    {{ $item['price'] }}
                </span>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-8 flex flex-col flex-1">
        <h3 class="font-['Cormorant_Garamond'] text-3xl font-light text-[#1c1a14] mb-4">
            {{ $item['title'] }}
        </h3>
        @if(!empty($item['description']))
            <div class="font-['DM_Sans'] text-sm font-light text-[#1c1a14]/60 leading-relaxed flex-1 [&_ul]:list-disc [&_ul]:pl-4 [&_ol]:list-decimal [&_ol]:pl-4 [&_strong]:font-medium [&_strong]:text-[#1c1a14]/80 [&_a]:text-[#c9a96e] [&_a]:underline">
                {!! $item['description'] !!}
            </div>
        @endif
    </div>

    {{-- Corner accents --}}
    <div class="absolute bottom-0 left-0 w-8 h-8 border-b border-l border-[#c9a96e]/20 group-hover:border-[#c9a96e]/60 transition-colors duration-500"></div>
    <div class="absolute bottom-0 right-0 w-8 h-8 border-b border-r border-[#c9a96e]/20 group-hover:border-[#c9a96e]/60 transition-colors duration-500"></div>

    <x-ubytovani.lightbox :title="$item['title']" />
</div>
