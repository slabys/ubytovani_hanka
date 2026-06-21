@php
    $section = \App\Models\PageContent::get('sluzby', \App\Filament\Schemas\SluzbySection::defaults());
@endphp

<section id="{{ $section['anchor'] ?? 'sluzby' }}" class="bg-[#faf8f3] py-24 lg:py-32">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-16 lg:mb-20">
            @if(!empty($section['subheading']))
                <p class="font-['DM_Sans'] text-xs font-light tracking-[0.4em] uppercase text-[#c9a96e] mb-4">
                    {{ $section['subheading'] }}
                </p>
            @endif
            <h2 class="font-['Cormorant_Garamond'] text-5xl lg:text-6xl font-light text-[#1c1a14] tracking-wide">
                {{ $section['heading'] }}
            </h2>
            <div class="mt-6 mx-auto w-16 h-px bg-[#c9a96e]/40"></div>
        </div>

        {{-- Items grid --}}
        @if(!empty($section['items']))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($section['items'] as $item)
                    <div class="border border-[#c9a96e]/20 bg-[#f2ede3] p-8 flex flex-col gap-4 hover:border-[#c9a96e]/50 transition-colors duration-300">
                        @if(!empty($item['icon']))
                            <span class="text-4xl leading-none">{{ $item['icon'] }}</span>
                        @endif
                        <h3 class="font-['Cormorant_Garamond'] text-2xl font-light text-[#1c1a14]">
                            {{ $item['title'] }}
                        </h3>
                        @if(!empty($item['description']))
                            <div class="font-['DM_Sans'] text-sm font-light text-[#1c1a14]/60 leading-relaxed [&_a]:text-[#c9a96e] [&_ul]:list-disc [&_ul]:pl-4 [&_ol]:list-decimal [&_ol]:pl-4">
                                {!! $item['description'] !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
