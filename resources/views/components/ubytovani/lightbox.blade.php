@props(['title'])

<div
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="open = false"
    @click.self="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-[#0a1a10]/95 backdrop-blur-sm p-4"
    style="display: none"
>
    {{-- Close --}}
    <button
        @click="open = false"
        class="absolute top-6 right-6 text-[#f5f0e8]/60 hover:text-[#f5f0e8] transition-colors"
        aria-label="Zavřít"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    {{-- Image --}}
    <div class="relative max-w-4xl w-full">
        <img
            :src="images[current]"
            :alt="'{{ $title }} - ' + (current + 1)"
            class="w-full max-h-[80vh] object-contain"
        >

        {{-- Prev (desktop) --}}
        <button
            x-show="images.length > 1"
            @click="prev"
            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-12 text-[#f5f0e8]/60 hover:text-[#c9a96e] transition-colors hidden lg:block"
            aria-label="Předchozí"
        >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Next (desktop) --}}
        <button
            x-show="images.length > 1"
            @click="next"
            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-12 text-[#f5f0e8]/60 hover:text-[#c9a96e] transition-colors hidden lg:block"
            aria-label="Další"
        >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Counter + mobile nav --}}
        <div class="flex items-center justify-center gap-6 mt-4">
            <button x-show="images.length > 1" @click="prev" class="text-[#f5f0e8]/60 hover:text-[#c9a96e] transition-colors lg:hidden" aria-label="Předchozí">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <span x-show="images.length > 1" class="font-['DM_Sans'] text-xs tracking-[0.2em] text-[#f5f0e8]/40">
                <span x-text="current + 1"></span> / <span x-text="images.length"></span>
            </span>
            <button x-show="images.length > 1" @click="next" class="text-[#f5f0e8]/60 hover:text-[#c9a96e] transition-colors lg:hidden" aria-label="Další">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</div>
