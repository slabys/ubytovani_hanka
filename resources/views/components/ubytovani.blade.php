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
            @foreach($section['items'] ?? [] as $index => $item)
                <div class="group relative flex flex-col border border-[#c9a96e]/10 hover:border-[#c9a96e]/30 transition-colors duration-500">

                    {{-- Image --}}
                    <div class="relative overflow-hidden aspect-[4/3] bg-[#0e2218]">
                        @if(!empty($item['image']))
                            <img
                                src="{{ asset('storage/' . $item['image']) }}"
                                alt="{{ $item['title'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="w-12 h-12 border border-[#c9a96e]/20 rotate-45"></div>
                            </div>
                        @endif

                        {{-- Price badge --}}
                        @if(!empty($item['price']))
                            <div class="absolute top-4 right-4 bg-[#0a1a10]/90 backdrop-blur-sm border border-[#c9a96e]/30 px-4 py-2">
                                <span class="font-['DM_Sans'] text-xs font-light tracking-[0.15em] uppercase text-[#c9a96e]">
                                    {{ $item['price'] }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="font-['Cormorant_Garamond'] text-3xl font-light text-[#f5f0e8] mb-4">
                            {{ $item['title'] }}
                        </h3>
                        @if(!empty($item['description']))
                            <div class="font-['DM_Sans'] text-sm font-light text-[#f5f0e8]/60 leading-relaxed flex-1 prose prose-invert prose-sm max-w-none">
                                {!! $item['description'] !!}
                            </div>
                        @endif
                    </div>

                    {{-- Corner accent --}}
                    <div class="absolute bottom-0 left-0 w-8 h-8 border-b border-l border-[#c9a96e]/20 group-hover:border-[#c9a96e]/60 transition-colors duration-500"></div>
                    <div class="absolute bottom-0 right-0 w-8 h-8 border-b border-r border-[#c9a96e]/20 group-hover:border-[#c9a96e]/60 transition-colors duration-500"></div>
                </div>
            @endforeach
        </div>

    </div>
</section>
