<x-layout>
    <x-slot:title>
        Program Kerja - IYES Indonesia
    </x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Inisiatif Kami</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Program Unggulan
                </h1>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                    Berbagai kegiatan berdampak yang kami rancang untuk pengembangan pemuda dan masyarakat.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
                <article class="group flex flex-col h-full bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    
                    <div class="relative h-64 overflow-hidden bg-slate-200">
                        <img src="{{ asset('storage/' . $program->thumbnail) }}" 
                             alt="{{ $program->name }}" 
                             loading="lazy" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                    </div>

                    <div class="flex flex-col flex-grow p-8">
                        <h3 class="text-xl font-bold text-iyes-primary mb-3 leading-snug group-hover:text-iyes-accent transition-colors">
                            <a href="{{ route('programs.show', $program->slug) }}">
                                {{ $program->name }}
                            </a>
                        </h3>
                        
                        <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                            {{ $program->brief_description }}
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50 flex justify-between items-center">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Program IYES</span>
                            <a href="{{ route('programs.show', $program->slug) }}" class="inline-flex items-center text-iyes-accent font-bold text-sm hover:underline decoration-2 underline-offset-4 group/link">
                                Detail Program
                                <svg class="w-4 h-4 ml-1 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

        </div>
    </div>
</x-layout>