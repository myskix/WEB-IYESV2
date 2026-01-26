<x-layout>
    <x-slot:meta>
        <meta name="description" content="Mitra kolaborasi IYES Indonesia. Bersama menciptakan dampak nyata melalui sinergi multipihak.">
        <meta property="og:title" content="Mitra & Kolaborasi - IYES Indonesia">
    </x-slot:meta>

    <x-slot:title>Mitra Kami - IYES Indonesia</x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- HEADER --}}
            <div class="text-center mb-20">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Jejaring Kami</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Kisah Sukses Kolaborasi
                </h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                    Bukti nyata dampak yang kita ciptakan bersama mitra-mitra hebat.
                </p>
            </div>

            {{-- BAGIAN 1: KISAH SUKSES (Dari Post Berita) --}}
            @if($stories->count() > 0)
                <div class="space-y-24 mb-32">
                @foreach($stories as $index => $story)             
                    @php
                        // LOGIC LINK: Cek apakah ada link eksternal?
                        $hasExternal = !empty($story->external_link);
                        $link = $hasExternal ? $story->external_link : route('posts.show', $story->slug);
                        $target = $hasExternal ? '_blank' : '_self';
                        $btnText = $hasExternal ? 'Kunjungi Tautan' : 'Lihat Berita';
                        $icon = $hasExternal ? 'fas fa-external-link-alt' : 'fas fa-arrow-right';
                    @endphp

                <div class="flex flex-col lg:flex-row items-center gap-12 group">
                    {{-- Gambar --}}
                    <div class="w-full lg:w-1/2 {{ $index % 2 == 0 ? 'lg:order-1' : 'lg:order-2' }}">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-100 group-hover:-translate-y-2 transition-transform duration-500">
                            <a href="{{ $link }}" target="{{ $target }}">
                                <img src="{{ asset('storage/' . $story->thumbnail) }}" 
                                        alt="{{ $story->title }}" 
                                        loading="lazy"
                                        class="w-full h-[300px] md:h-[400px] object-cover transform group-hover:scale-105 transition-transform duration-700">
                            </a>
                            {{-- Badge --}}
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-xs font-bold text-iyes-primary shadow-sm">
                                {{ $story->category->name ?? 'Kolaborasi' }}
                            </div>
                            
                            {{-- Icon Play jika Youtube (Opsional: Deteksi string youtube) --}}
                            @if($hasExternal && Str::contains($story->external_link, ['youtube', 'youtu.be']))
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-lg animate-pulse">
                                        <i class="fas fa-play text-white text-2xl ml-1"></i>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Teks --}}
                    <div class="w-full lg:w-1/2 {{ $index % 2 == 0 ? 'lg:order-2' : 'lg:order-1' }}">
                        <h2 class="text-2xl md:text-3xl font-bold text-iyes-primary mb-4 leading-tight group-hover:text-iyes-accent transition-colors">
                            <a href="{{ $link }}" target="{{ $target }}">
                                {{ $story->title }}
                            </a>
                        </h2>
                        <div class="text-slate-600 text-lg leading-relaxed mb-8 line-clamp-3">
                            {{ Str::limit(strip_tags($story->content), 200) }}
                        </div>
                        
                        <a href="{{ $link }}" target="{{ $target }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-slate-200 rounded-full font-bold text-slate-700 hover:border-iyes-primary hover:bg-iyes-primary hover:text-white transition-all duration-300">
                            {{ $btnText }}
                            <i class="{{ $icon }} text-xs"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                </div>
            @else
                <div class="text-center py-12 mb-20 bg-white rounded-2xl border border-dashed border-slate-300">
                    <p class="text-slate-400">Belum ada kisah kolaborasi yang ditampilkan.</p>
                </div>
            @endif


            {{-- BAGIAN 2: GALERI LOGO MITRA (Dari CMS Partner) --}}
            <section class="py-24 bg-white border-t border-slate-50 overflow-hidden">
                <div class="max-w-7xl mx-auto px-6 text-center mb-16">
                    <div class="flex items-center justify-center gap-2 mb-4">
                        <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight mb-4">
                        Mitra & Kolaborator
                    </h2>
                    <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                        Berkolaborasi untuk menciptakan dampak yang lebih luas.
                    </p>
                </div>
                
                @php
                    $rows = $partners->splitIn(2); 
                @endphp

                <div class="relative w-full flex flex-col gap-10">            
                    <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

                    @if($rows->isNotEmpty())
                    <div class="flex items-center gap-16 animate-marquee whitespace-nowrap">
                        @for($i = 0; $i < 6; $i++) {{-- Loop 6x agar seamless --}}
                            @foreach($rows[0] as $partner)
                                <img src="{{ asset('storage/' . $partner->logo) }}" 
                                    alt="{{ $partner->name }}"
                                    title="{{ $partner->name }}"
                                    loading="lazy"
                                    class="h-14 w-auto max-w-[160px] object-contain hover:scale-110 transition-transform duration-500 flex-shrink-0">
                            @endforeach
                        @endfor
                    </div>
                    @endif

                    @if($rows->count() > 1)
                    <div class="flex items-center gap-16 animate-marquee whitespace-nowrap [animation-direction:reverse]">
                        @for($i = 0; $i < 6; $i++) 
                            @foreach($rows[1] as $partner)
                                <img src="{{ asset('storage/' . $partner->logo) }}" 
                                    alt="{{ $partner->name }}"
                                    title="{{ $partner->name }}"
                                    loading="lazy"
                                    class="h-14 w-auto max-w-[160px] object-contain hover:scale-110 transition-transform duration-500 flex-shrink-0">
                            @endforeach
                        @endfor
                    </div>
                    @endif

                </div>
            </section>

        </div>
    </div>
</x-layout>