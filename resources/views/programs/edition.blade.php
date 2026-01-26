<x-layout>
    <x-slot:title>{{ $edition->name }} - IYES Indonesia</x-slot:title>

    <section class="relative h-[60vh] min-h-[400px] flex items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 z-0">
            @if($edition->thumbnail)
                <img src="{{ asset('storage/' . $edition->thumbnail) }}" alt="{{ $edition->name }}" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->name }}" class="w-full h-full object-cover">
            @endif
            
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-slate-900/40"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center text-white pt-20 animate-fade-in-up">
            
            <a href="{{ route('programs.show', $program->slug) }}" class="inline-flex items-center gap-2 text-slate-300 hover:text-white transition-colors mb-6 text-sm font-bold border border-white/20 px-4 py-1.5 rounded-full backdrop-blur-sm hover:bg-white/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke {{ $program->name }}
            </a>

            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight drop-shadow-md">
                {{ $edition->name }}
            </h1>
            
            <p class="text-xl md:text-2xl text-iyes-accent font-bold tracking-widest uppercase drop-shadow-sm">
                Edisi Tahun {{ $edition->year }}
            </p>
        </div>
    </section>

    <div class="bg-slate-50 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8 space-y-12">
                
                {{-- Tentang Edisi Ini --}}
                @if($edition->description)
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <h3 class="text-xl font-bold text-iyes-primary mb-6">Tentang Edisi Ini</h3>
                    <div class="prose prose-slate max-w-none">
                        {!! $edition->description !!}
                    </div>
                </div>
                @endif

                {{-- Pencapaian --}}
                @if(!empty($edition->achievements) && is_array($edition->achievements))
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($edition->achievements as $achieve)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm text-center hover:-translate-y-1 transition-transform duration-300">
                        <div class="text-3xl md:text-4xl font-extrabold text-iyes-accent mb-1">
                            {{ $achieve['number'] }}
                        </div>
                        <div class="text-xs md:text-sm font-bold text-slate-600 uppercase tracking-wide">
                            {{ $achieve['label'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Galeri Dokumentasi --}}
                @if(!empty($edition->gallery) && is_array($edition->gallery))
                <div>
                    <h3 class="text-xl font-bold text-iyes-primary mb-6 flex items-center gap-2">
                        <i class="fas fa-images text-iyes-accent"></i> Galeri Dokumentasi
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($edition->gallery as $photo)
                        <div class="group relative aspect-square bg-slate-200 rounded-xl overflow-hidden cursor-pointer">
                            <img src="{{ asset('storage/' . $photo) }}" 
                                 alt="Dokumentasi {{ $edition->name }}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <aside class="lg:col-span-4 space-y-8">
                
                {{-- Detail Pelaksanaan --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="font-bold text-iyes-primary mb-6 border-b border-slate-50 pb-4">
                        Detail Pelaksanaan
                    </h3>
                    <div class="space-y-5">
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase">Lokasi</span>
                            <div class="flex items-start gap-3 mt-1">
                                <i class="fas fa-map-marker-alt text-iyes-accent mt-1"></i>
                                <span class="font-bold text-slate-700">{{ $edition->location }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase">Waktu</span>
                            <div class="flex items-start gap-3 mt-1">
                                <i class="far fa-calendar-alt text-iyes-accent mt-1"></i>
                                <div class="font-bold text-slate-700">
                                    @if($edition->start_date)
                                        {{ \Carbon\Carbon::parse($edition->start_date)->format('d M') }} - 
                                        {{ \Carbon\Carbon::parse($edition->end_date)->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kata Alumni --}}
                @if(!empty($edition->testimonials) && is_array($edition->testimonials))
                <div>
                    <h3 class="font-bold text-iyes-primary mb-4 flex items-center gap-2">
                        <i class="fas fa-quote-right text-iyes-accent"></i> Kata Alumni
                    </h3>
                    <div class="space-y-4">
                        @foreach($edition->testimonials as $testi)
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative group hover:shadow-md transition-all">
                            <div class="text-6xl text-slate-100 font-serif absolute top-0 right-4 pointer-events-none">”</div>
                            
                            <p class="text-sm text-slate-600 italic leading-relaxed relative z-10 mb-4">
                                "{{ $testi['quote'] }}"
                            </p>
                            
                            <div class="flex items-center gap-3 border-t border-slate-50 pt-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-iyes-primary to-slate-800 text-white flex items-center justify-center text-xs font-bold">
                                    {{ substr($testi['name'], 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800">{{ $testi['name'] }}</p>
                                    <p class="text-[10px] text-slate-500">{{ $testi['role'] ?? 'Peserta' }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Edisi Lainnya --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="font-bold text-iyes-primary mb-4 text-sm uppercase tracking-wide">Edisi Lainnya</h3>
                    <ul class="space-y-2">
                        @foreach($program->editions as $otherEdition)
                        <li>
                            <a href="{{ route('programs.edition', ['slug' => $program->slug, 'year' => $otherEdition->year]) }}" 
                               class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition-colors {{ $otherEdition->id == $edition->id ? 'bg-orange-50 border border-orange-100' : '' }}">
                                <span class="text-sm font-bold {{ $otherEdition->id == $edition->id ? 'text-iyes-accent' : 'text-slate-600' }}">
                                    {{ $otherEdition->year }}
                                </span>
                                <span class="text-xs text-slate-400 truncate w-24 text-right">{{ $otherEdition->location }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </aside>

        </div>
    </div>
</x-layout>