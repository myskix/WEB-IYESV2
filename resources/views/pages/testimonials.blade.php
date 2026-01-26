<x-layout>
    <x-slot:meta>
        <meta name="description" content="Cerita dan pengalaman para alumni, volunteer, dan mitra IYES Indonesia.">
        <meta property="og:title" content="Cerita Alumni & Testimoni - IYES Indonesia">
    </x-slot:meta>

    <x-slot:title>Cerita Alumni - IYES Indonesia</x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- 1. HEADER SECTION --}}
            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Suara Komunitas</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Apa Kata Mereka?
                </h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                    Dengarkan pengalaman langsung dari alumni, volunteer, dan mitra yang telah berkolaborasi bersama IYES Indonesia.
                </p>
            </div>

            {{-- 2. FILTER KATEGORI (Pills) --}}
            <div class="flex flex-wrap justify-center gap-3 mb-16">
                {{-- Tombol 'Semua' --}}
                <a href="{{ route('pages.testimonials') }}" 
                   class="px-5 py-2.5 rounded-full text-sm font-bold border transition-all duration-300
                   {{ !$currentCategory ? 'bg-iyes-primary text-white border-iyes-primary shadow-lg shadow-blue-900/20' : 'bg-white text-slate-500 border-slate-200 hover:border-iyes-primary hover:text-iyes-primary' }}">
                    Semua
                </a>

                {{-- Loop Kategori dari Model --}}
                @foreach($categories as $key => $label)
                    <a href="{{ route('pages.testimonials', ['category' => $key]) }}" 
                       class="px-5 py-2.5 rounded-full text-sm font-bold border transition-all duration-300
                       {{ $currentCategory == $key ? 'bg-iyes-primary text-white border-iyes-primary shadow-lg shadow-blue-900/20' : 'bg-white text-slate-500 border-slate-200 hover:border-iyes-primary hover:text-iyes-primary' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- 3. GRID TESTIMONI & MODAL --}}
            <div x-data="{ 
                modalOpen: false,
                activeItem: { name: '', role: '', category: '', photo: '', content: '' },
                openModal(name, role, category, photo, contentId) {
                    this.activeItem.name = name;
                    this.activeItem.role = role;
                    this.activeItem.category = category;
                    this.activeItem.photo = photo;
                    // Ambil konten HTML dari hidden div berdasarkan ID
                    this.activeItem.content = document.getElementById(contentId).innerHTML;
                    this.modalOpen = true;
                    document.body.classList.add('overflow-hidden'); // Matikan scroll body
                },
                closeModal() {
                    this.modalOpen = false;
                    document.body.classList.remove('overflow-hidden'); // Hidupkan scroll body
                }
            }" @keydown.escape.window="closeModal()">

                @if($testimonials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
                        @foreach($testimonials as $item)
                        <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full relative group overflow-hidden">
                            
                            <div class="absolute top-4 right-6 text-9xl font-serif text-slate-50 opacity-50 transition-colors -z-0 pointer-events-none">
                                ”
                            </div>

                            <div class="flex-grow mb-6 relative z-10">
                                <div class="text-slate-600 leading-relaxed italic line-clamp-4">
                                    {!! strip_tags($item->content) !!} 
                                </div>
                                
                                {{-- Tombol Baca Selengkapnya --}}
                                <button @click="openModal('{{ addslashes($item->name) }}', '{{ addslashes($item->role_or_company) }}', '{{ $item->category }}', '{{ asset('storage/' . $item->photo) }}', 'raw-content-{{ $item->id }}')" 
                                    class="inline-flex items-center gap-1 text-sm font-bold text-iyes-accent mt-3 hover:underline focus:outline-none">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>

                                {{-- HIDDEN CONTENT: Menyimpan HTML asli untuk ditampilkan di modal --}}
                                <div id="raw-content-{{ $item->id }}" class="hidden">
                                    {!! $item->content !!}
                                </div>
                            </div>

                            <div class="flex items-center gap-4 mt-auto relative z-10 border-t border-slate-50 pt-6">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden border-2 border-white shadow-md">
                                    <img src="{{ asset('storage/' . $item->photo) }}" 
                                         alt="{{ $item->name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold text-iyes-primary text-base leading-tight">
                                        {{ $item->name }}
                                    </h4>
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 mt-1">
                                        <span class="text-xs font-bold text-iyes-accent uppercase tracking-wide">
                                            {{ $item->role_or_company }}
                                        </span>
                                        <span class="hidden sm:inline-block w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span class="text-[10px] text-slate-400 px-2 py-0.5 bg-slate-100 rounded-md">
                                            {{ $item->category }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-12 relative z-10">
                        {{ $testimonials->withQueryString()->links() }}
                    </div>

                @else
                    {{-- Empty State --}}
                    <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-300">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="far fa-comment-dots text-slate-300 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-600">Belum ada cerita di kategori ini.</h3>
                        <a href="{{ route('pages.testimonials') }}" class="px-6 py-2 bg-slate-100 text-slate-600 rounded-full text-sm font-bold hover:bg-slate-200 transition mt-4 inline-block">
                            Lihat Semua Cerita
                        </a>
                    </div>
                @endif

                {{-- MODAL COMPONENT (Hidden by default) --}}
                <div x-show="modalOpen" style="display: none;" 
                     class="fixed inset-0 z-[999] flex items-center justify-center px-4 py-6 sm:px-6"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="closeModal()"></div>

                    <div class="relative bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-full"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200 transform"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                        
                        <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-slate-50/50">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-full border-2 border-white shadow-md overflow-hidden">
                                    <img :src="activeItem.photo" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-800" x-text="activeItem.name"></h3>
                                    <p class="text-sm font-bold text-iyes-accent" x-text="activeItem.role"></p>
                                </div>
                            </div>
                            <button @click="closeModal()" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="p-8 overflow-y-auto">
                            <div class="mb-4 text-iyes-primary/20">
                                <i class="fas fa-quote-left text-4xl"></i>
                            </div>
                            <div class="prose prose-slate prose-lg max-w-none text-slate-600 leading-relaxed" x-html="activeItem.content"></div>
                        </div>

                        <div class="p-6 border-t border-slate-100 bg-slate-50 flex justify-between items-center">
                            <span class="px-3 py-1 bg-white border border-slate-200 rounded-full text-xs font-bold text-slate-500 shadow-sm" x-text="activeItem.category"></span>
                            <button @click="closeModal()" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            @once
                <script src="//unpkg.com/alpinejs" defer></script>
            @endonce

        </div>
    </div>
</x-layout>