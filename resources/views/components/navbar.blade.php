@php
    $navItems = \App\Models\PageContent::get('nav_items', [
        ['label' => 'Domů', 'anchor' => 'home'],
        ['label' => 'Ubytování', 'anchor' => 'ubytovani'],
        ['label' => 'Galerie', 'anchor' => 'galerie'],
        ['label' => 'Kontakt', 'anchor' => 'kontakt'],
    ]);
@endphp

<nav
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 0 })"
    :class="scrolled ? 'bg-[#0e2218]/95 backdrop-blur-md shadow-[0_1px_0_0_rgba(201,169,110,0.15)]' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
>
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="#home" class="flex items-center gap-3 group">
                <div class="w-8 h-8 border border-[#c9a96e]/60 rotate-45 flex items-center justify-center shrink-0 group-hover:border-[#c9a96e] transition-colors duration-300">
                    <div class="w-2 h-2 bg-[#c9a96e] rotate-0"></div>
                </div>
                <span class="font-['Cormorant_Garamond'] text-xl font-semibold tracking-widest text-[#f5f0e8] uppercase leading-none">
                    Ubytování<br>
                    <span class="text-[#c9a96e] text-sm tracking-[0.3em]">Hanka</span>
                </span>
            </a>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-8">
                @foreach($navItems as $item)
                    <a
                        href="#{{ $item['anchor'] }}"
                        class="relative font-['DM_Sans'] text-sm font-light tracking-[0.15em] uppercase text-[#f5f0e8]/80 hover:text-[#c9a96e] transition-colors duration-300 after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-px after:bg-[#c9a96e] hover:after:w-full after:transition-all after:duration-300"
                    >{{ $item['label'] }}</a>
                @endforeach
            </div>

            {{-- Mobile hamburger --}}
            <button
                @click="open = !open"
                class="md:hidden flex flex-col gap-[5px] p-2 group"
                aria-label="Menu"
            >
                <span
                    :class="open ? 'rotate-45 translate-y-[7px]' : ''"
                    class="block w-6 h-px bg-[#f5f0e8] transition-all duration-300 origin-center"
                ></span>
                <span
                    :class="open ? 'opacity-0 scale-x-0' : ''"
                    class="block w-4 h-px bg-[#c9a96e] transition-all duration-300"
                ></span>
                <span
                    :class="open ? '-rotate-45 -translate-y-[7px]' : ''"
                    class="block w-6 h-px bg-[#f5f0e8] transition-all duration-300 origin-center"
                ></span>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-[#0e2218]/98 backdrop-blur-md border-t border-[#c9a96e]/10"
        @click.away="open = false"
    >
        <div class="px-6 py-6 flex flex-col gap-5">
            @foreach($navItems as $item)
                <a
                    href="#{{ $item['anchor'] }}"
                    @click="open = false"
                    class="font-['DM_Sans'] text-sm font-light tracking-[0.2em] uppercase text-[#f5f0e8]/80 hover:text-[#c9a96e] transition-colors duration-300 py-1 border-b border-[#c9a96e]/10"
                >{{ $item['label'] }}</a>
            @endforeach
        </div>
    </div>
</nav>
