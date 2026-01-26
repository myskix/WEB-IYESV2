<x-layout>
    <x-slot:title>
        {{ $program->name }} - Program IYES
    </x-slot:title>

    <section class="relative h-[60vh] min-h-[400px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-slate-900/30"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center text-white pt-20 animate-fade-in-up">
            <span class="inline-block py-1 px-3 rounded-full bg-iyes-accent/90 text-white text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm shadow-lg">
                Program Unggulan
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-6 leading-tight drop-shadow-md">
                {{ $program->name }}
            </h1>
            <p class="text-lg md:text-xl text-slate-100 max-w-2xl mx-auto leading-relaxed font-light drop-shadow-sm">
                {{ $program->brief_description }}
            </p>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8">
                <div class="prose prose-lg prose-slate max-w-none 
                            prose-headings:text-iyes-primary prose-headings:font-bold 
                            prose-a:text-iyes-accent prose-a:no-underline hover:prose-a:underline
                            prose-img:rounded-2xl prose-img:shadow-lg prose-img:w-full
                            prose-li:marker:text-iyes-accent">
                    {!! $program->description !!}
                </div>

                @if(!empty($program->focus_areas) && is_array($program->focus_areas))
                    <div class="mt-10 mb-10">
                        <h3 class="text-xl font-bold text-iyes-primary mb-6 flex items-center gap-2">
                            <i class="fas fa-bullseye text-iyes-accent"></i>
                            Fokus Utama
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($program->focus_areas as $focus)
                            <div class="bg-slate-50 border border-slate-100 p-4 rounded-xl flex flex-col items-center text-center hover:shadow-md transition-all group">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-iyes-accent text-xl mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="{{ $focus['icon'] }}"></i>
                                </div>
                                <span class="font-bold text-slate-700 text-sm">{{ $focus['title'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-12 p-8 bg-slate-50 rounded-2xl border border-slate-100 text-center">
                    <h3 class="text-xl font-bold text-iyes-primary mb-2">Tertarik Bergabung?</h3>
                    <p class="text-slate-500 mb-6">Pantau terus jadwal pendaftaran edisi terbaru kami.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 px-8 py-3 bg-iyes-primary text-white font-bold rounded-lg shadow-lg hover:bg-slate-800 transition-all hover:-translate-y-1">
                        <i class="fab fa-whatsapp text-lg"></i>
                        Hubungi Admin
                    </a>
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="sticky top-24">
                    <h3 class="text-2xl font-bold text-iyes-primary mb-8 flex items-center gap-3 border-b border-slate-100 pb-4">
                        <span class="w-1.5 h-8 bg-iyes-accent rounded-full"></span>
                        Jejak Pelaksanaan
                    </h3>

                    @if($program->editions->count() > 0)
                        <div class="relative pl-6 border-l-2 border-slate-100 space-y-12">
                            
                            @foreach($program->editions as $edition)
                            <div class="relative pl-6 group">
                            <div class="absolute -left-[31px] top-1.5 w-5 h-5 rounded-full ring-4 ring-white transition-colors duration-300 {{ $edition->status === 'open_registration' ? 'bg-green-500 animate-pulse' : 'bg-iyes-accent group-hover:bg-iyes-primary' }}"></div>
                            
                            <div class="flex items-center justify-between mb-1">
                                <a href="{{ route('programs.edition', ['slug' => $program->slug, 'year' => $edition->year]) }}" class="text-xs font-bold text-slate-400 uppercase tracking-widest hover:text-iyes-accent transition-colors">
                                    Tahun {{ $edition->year }}
                                </a>
                                
                                @php
                                    $statusColors = [
                                        'upcoming' => 'bg-blue-100 text-blue-700',
                                        'open_registration' => 'bg-green-100 text-green-700',
                                        'ongoing' => 'bg-orange-100 text-orange-700',
                                        'completed' => 'bg-slate-100 text-slate-600',
                                    ];
                                    $statusLabel = [
                                        'upcoming' => 'Segera Hadir',
                                        'open_registration' => 'Buka Pendaftaran',
                                        'ongoing' => 'Sedang Berjalan',
                                        'completed' => 'Selesai',
                                    ];
                                @endphp
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $statusColors[$edition->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $statusLabel[$edition->status] ?? $edition->status }}
                                </span>
                            </div>

                            <h4 class="text-lg font-bold text-iyes-primary leading-tight hover:text-iyes-accent transition-colors">
                                <a href="{{ route('programs.edition', ['slug' => $program->slug, 'year' => $edition->year]) }}">
                                    {{ $edition->name }}
                                </a>
                            </h4>
                            
                            <div class="flex items-center gap-2 text-sm text-slate-500 mt-1 mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $edition->location }}
                            </div>

                            </div>
                            @endforeach

                        </div>
                    @else
                        <div class="text-center p-6 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                            <p class="text-sm text-slate-500 italic">Belum ada riwayat edisi untuk program ini.</p>
                        </div>
                    @endif
                </div>
            </aside>

        </div>
    </section>
</x-layout>