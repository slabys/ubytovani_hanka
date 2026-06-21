@props(['title'])

<style>
@keyframes lbSlideOutLeft  { from { transform: translateX(0);     opacity: 1; } to { transform: translateX(-60%); opacity: 0; } }
@keyframes lbSlideOutRight { from { transform: translateX(0);     opacity: 1; } to { transform: translateX(60%);  opacity: 0; } }
@keyframes lbSlideInRight  { from { transform: translateX(60%);  opacity: 0; } to { transform: translateX(0);     opacity: 1; } }
@keyframes lbSlideInLeft   { from { transform: translateX(-60%); opacity: 0; } to { transform: translateX(0);     opacity: 1; } }
.lb-slide-out-left  { animation: lbSlideOutLeft  200ms ease-in  forwards; }
.lb-slide-out-right { animation: lbSlideOutRight 200ms ease-in  forwards; }
.lb-slide-in-right  { animation: lbSlideInRight  250ms ease-out forwards; }
.lb-slide-in-left   { animation: lbSlideInLeft   250ms ease-out forwards; }
</style>

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
    class="fixed inset-0 z-50 flex flex-col bg-[#1c1a14]/97 backdrop-blur-sm"
    style="display: none"
>
    {{-- Close --}}
    <div class="absolute top-4 right-4 z-10">
        <button
            @click="open = false"
            class="flex items-center gap-2 bg-[#1c1a14]/70 hover:bg-[#c9a96e] text-[#f5f0e8] hover:text-[#1c1a14] border border-[#f5f0e8]/20 hover:border-[#c9a96e] px-4 py-2 transition-all duration-200"
            aria-label="Zavřít"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span class="font-['DM_Sans'] text-xs tracking-[0.15em] uppercase hidden sm:inline">Zavřít</span>
        </button>
    </div>

    {{-- Image area --}}
    <div
        class="relative flex-1 flex items-center justify-center overflow-hidden"
        @touchstart="touchStartX = $event.changedTouches[0].screenX"
        @touchend="
            let diff = touchStartX - $event.changedTouches[0].screenX;
            if (Math.abs(diff) > 40) { diff > 0 ? next() : prev() }
        "
        x-data="{ touchStartX: 0 }"
    >
        <img
            :src="images[current]"
            :alt="'{{ $title }} - ' + (current + 1)"
            :class="animClass"
            class="max-w-full max-h-full w-auto h-auto object-contain"
            style="max-height: calc(100vh - 64px)"
        >

        {{-- Prev --}}
        <button
            x-show="images.length > 1"
            @click.stop="prev"
            class="absolute left-2 lg:left-4 top-1/2 -translate-y-1/2 w-8 h-8 lg:w-12 lg:h-12 flex items-center justify-center bg-[#1c1a14]/60 hover:bg-[#1c1a14]/90 text-[#f5f0e8]/70 hover:text-[#c9a96e] transition-all"
            aria-label="Předchozí"
        >
            <svg class="w-4 h-4 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Next --}}
        <button
            x-show="images.length > 1"
            @click.stop="next"
            class="absolute right-2 lg:right-4 top-1/2 -translate-y-1/2 w-8 h-8 lg:w-12 lg:h-12 flex items-center justify-center bg-[#1c1a14]/60 hover:bg-[#1c1a14]/90 text-[#f5f0e8]/70 hover:text-[#c9a96e] transition-all"
            aria-label="Další"
        >
            <svg class="w-4 h-4 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    {{-- Counter --}}
    <div x-show="images.length > 1" class="h-12 flex items-center justify-center shrink-0">
        <span class="font-['DM_Sans'] text-xs tracking-[0.2em] text-[#f5f0e8]/40">
            <span x-text="current + 1"></span> / <span x-text="images.length"></span>
        </span>
    </div>
</div>
