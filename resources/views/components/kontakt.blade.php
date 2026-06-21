@php
    $section = \App\Models\PageContent::get('kontakt', [
        'anchor'    => 'kontakt',
        'heading'   => 'Kontakt',
        'subheading' => 'Rádi vám odpovíme na vaše dotazy',
        'phone'     => '',
        'email'     => '',
        'address'   => '',
    ]);

@endphp

<section id="{{ $section['anchor'] ?? 'kontakt' }}" class="bg-[#0e2218] py-24 lg:py-32">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-16 lg:mb-20">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">

            {{-- Contact info --}}
            <div class="flex flex-col gap-8">
                @if(!empty($section['phone']))
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 border border-[#c9a96e]/30 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-[#c9a96e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#c9a96e] mb-1">Telefon</p>
                            <a href="tel:{{ preg_replace('/\s+/', '', $section['phone']) }}" class="font-['Cormorant_Garamond'] text-xl text-[#f5f0e8] hover:text-[#c9a96e] transition-colors">
                                {{ $section['phone'] }}
                            </a>
                        </div>
                    </div>
                @endif

                @if(!empty($section['email']))
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 border border-[#c9a96e]/30 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-[#c9a96e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#c9a96e] mb-1">E-mail</p>
                            <a href="mailto:{{ $section['email'] }}" class="font-['Cormorant_Garamond'] text-xl text-[#f5f0e8] hover:text-[#c9a96e] transition-colors">
                                {{ $section['email'] }}
                            </a>
                        </div>
                    </div>
                @endif

                @if(!empty($section['address']))
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 border border-[#c9a96e]/30 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-[#c9a96e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#c9a96e] mb-1">Adresa</p>
                            <p class="font-['Cormorant_Garamond'] text-xl text-[#f5f0e8]">{{ $section['address'] }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Contact form --}}
            <div>
                @if(session('success'))
                    <div class="border border-[#c9a96e]/40 bg-[#c9a96e]/10 px-6 py-4 mb-6">
                        <p class="font-['DM_Sans'] text-sm text-[#c9a96e]">{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('kontakt.send') }}" class="flex flex-col gap-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label class="block font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#f5f0e8]/50 mb-2">Jméno *</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full bg-transparent border border-[#c9a96e]/20 focus:border-[#c9a96e]/60 px-4 py-3 font-['DM_Sans'] text-sm text-[#f5f0e8] outline-none transition-colors placeholder:text-[#f5f0e8]/20"
                            placeholder="Vaše jméno"
                        >
                        @error('name')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#f5f0e8]/50 mb-2">E-mail *</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full bg-transparent border border-[#c9a96e]/20 focus:border-[#c9a96e]/60 px-4 py-3 font-['DM_Sans'] text-sm text-[#f5f0e8] outline-none transition-colors placeholder:text-[#f5f0e8]/20"
                            placeholder="vas@email.cz"
                        >
                        @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#f5f0e8]/50 mb-2">Telefon *</label>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            class="w-full bg-transparent border border-[#c9a96e]/20 focus:border-[#c9a96e]/60 px-4 py-3 font-['DM_Sans'] text-sm text-[#f5f0e8] outline-none transition-colors placeholder:text-[#f5f0e8]/20"
                            placeholder="+420 123 456 789"
                        >
                        @error('phone')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block font-['DM_Sans'] text-xs tracking-[0.2em] uppercase text-[#f5f0e8]/50 mb-2">Zpráva *</label>
                        <textarea
                            name="message"
                            rows="5"
                            required
                            class="w-full bg-transparent border border-[#c9a96e]/20 focus:border-[#c9a96e]/60 px-4 py-3 font-['DM_Sans'] text-sm text-[#f5f0e8] outline-none transition-colors placeholder:text-[#f5f0e8]/20 resize-none"
                            placeholder="Váš dotaz nebo zpráva..."
                        >{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-3 font-['DM_Sans'] text-sm font-light tracking-[0.2em] uppercase text-[#0e2218] bg-[#c9a96e] px-8 py-4 hover:bg-[#f5f0e8] transition-colors duration-300"
                    >
                        Odeslat zprávu
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
