<nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/90 backdrop-blur-lg shadow-sm py-3' : 'bg-transparent py-6'"
     class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out border-b border-transparent hover:bg-white/95 group/nav">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            
            <a href="/" class="flex-shrink-0 flex items-center gap-3 group relative z-50">
                <img src="{{ asset('images/logo-iyes.svg') }}" 
                     class="h-10 w-auto object-contain " 
                     alt="IYES Logo"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">

                <div class="flex flex-col justify-center">
                    <span class="text-iyes-primary font-[1000] text-2xl tracking-tighter leading-none">
                        IYES INDONESIA
                    </span>

                </div>
            </a>

            <div class="hidden md:flex items-center gap-8">
                
                <a href="/" class="relative text-sm font-bold text-slate-600 hover:text-iyes-primary transition-colors group">
                    Beranda
                    <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-iyes-accent transition-all duration-300 group-hover:w-full"></span>
                </a>

                {{-- Tentang Kami --}}
                <div class="relative group h-full py-2">
                    <button class="flex items-center gap-1 text-sm font-bold text-slate-600 hover:text-iyes-primary transition-colors focus:outline-none">
                        Tentang Kami
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 text-gray-400 group-hover:text-iyes-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    
                    <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0 w-72 z-50">
                        <div class="bg-white rounded-xl shadow-xl ring-1 ring-black/5 p-2 overflow-hidden border border-slate-100">
                            
                            {{-- 1. Profil Organisasi --}}
                            <a href="{{ route('pages.about') }}" wire:navigate class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group/item">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover/item:bg-blue-600 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-building text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-700">Profil Organisasi</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">Visi, misi & sejarah</span>
                                </div>
                            </a>

                            {{-- 2. Struktur Pengurus --}}
                            <a href="{{ route('board-members.index') }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group/item">
                                <div class="w-8 h-8 rounded-full bg-orange-50 text-iyes-accent flex items-center justify-center group-hover/item:bg-iyes-accent group-hover/item:text-white transition-colors">
                                    <i class="fas fa-users text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-700">Struktur Pengurus</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">Kenali tim kami</span>
                                </div>
                            </a>

                            {{-- 3. Cerita Alumni (BARU) --}}
                            <a href="{{ route('pages.testimonials') }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group/item">
                                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover/item:bg-emerald-600 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-comment-dots text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-700">Cerita Alumni</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">Testimoni & pengalaman</span>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

                {{-- Program --}}
                <div class="relative group h-full py-2">
                    <button class="flex items-center gap-1 text-sm font-bold text-slate-600 hover:text-iyes-primary transition-colors focus:outline-none">
                        Program
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 text-gray-400 group-hover:text-iyes-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0 w-64 z-50">
                        <div class="bg-white rounded-xl shadow-xl ring-1 ring-black/5 p-2 overflow-hidden">

                            <a href="{{ route('programs.index') }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group/item">
                                <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center group-hover/item:bg-orange-600 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-layer-group text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-700">Semua Program</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">Inisiatif unggulan kami</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Media --}}
                <div class="relative group h-full py-2">
                    <button class="flex items-center gap-1 text-sm font-bold text-slate-600 hover:text-iyes-primary transition-colors focus:outline-none">
                        Media
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 text-gray-400 group-hover:text-iyes-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0 w-64 z-50">
                        <div class="bg-white rounded-xl shadow-xl ring-1 ring-black/5 p-2 overflow-hidden">
                            
                            <a href="{{ route('posts.index') }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group/item">
                                <div class="w-8 h-8 rounded-full bg-green-50 text-green-600 flex items-center justify-center group-hover/item:bg-green-600 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-newspaper text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-700">Berita</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">Update terbaru</span>
                                </div>
                            </a>

                            <a href="{{ route('annual-report.index') }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group/item">
                                <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center group-hover/item:bg-purple-600 group-hover/item:text-white transition-colors">
                                    <i class="fas fa-file-pdf text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-bold text-slate-700">Annual Report</span>
                                    <span class="block text-xs text-slate-400 mt-0.5">Laporan tahunan IYES</span>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>


                {{-- Mitra --}}
                <a href="{{ route('pages.partnership') }}" class="relative text-sm font-bold text-slate-600 hover:text-iyes-primary transition-colors group">
                    Mitra
                    <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-iyes-accent transition-all duration-300 group-hover:w-full"></span>
                

                {{-- Kontak --}}
                <a href="{{ route('pages.contact') }}" wire:navigate class="ml-4 px-6 py-2.5 text-sm font-bold text-white bg-iyes-primary rounded-full hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 shadow-md shadow-blue-900/20">
                    Hubungi Kami
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-700 hover:text-iyes-accent transition-colors focus:outline-none">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         x-collapse x-cloak 
         class="md:hidden bg-white border-t border-gray-100 shadow-xl absolute w-full left-0 top-full overflow-hidden">
        
        <div class="px-6 py-6 space-y-4">
            <a href="/" class="block text-base font-bold text-iyes-accent">Beranda</a>
            
            {{-- Tentang Kami --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full justify-between items-center text-base font-bold text-slate-600">
                    Tentang Kami
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-collapse class="mt-2 pl-4 border-l-2 border-gray-100 space-y-3">
                     <a href="{{ route('board-members.index') }}" class="block text-sm font-medium text-slate-500 hover:text-iyes-accent">Struktur Pengurus</a>
                     <a href="{{ route('pages.about') }}" class="block text-sm font-medium text-slate-500 hover:text-iyes-accent">Profil Organisasi</a>
                </div>
            </div>

            {{-- Program --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full justify-between items-center text-base font-bold text-slate-600">
                    Program
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-collapse class="mt-2 pl-4 border-l-2 border-gray-100 space-y-3">
                     <a href="{{ route('programs.index') }}" class="block text-sm font-medium text-slate-500 hover:text-iyes-accent">Semua Program</a>
                </div>
            </div>

            {{-- Media --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex w-full justify-between items-center text-base font-bold text-slate-600">
                    Media
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-collapse class="mt-2 pl-4 border-l-2 border-gray-100 space-y-3">
                     <a href="{{ route('posts.index') }}" class="block text-sm font-medium text-slate-500 hover:text-iyes-accent">Berita</a>
                     <a href="{{ route('annual-report.index') }}" class="block text-sm font-medium text-slate-500 hover:text-iyes-accent">Annual Report</a>
                </div>
            </div>

            {{-- Mitra --}}
            <a href="{{ route('pages.partnership') }}" class="block text-base font-bold text-iyes-accent">Mitra</a>
            
            
            <div class="pt-6 border-t border-gray-100">
                <a href="{{ route('pages.contact') }}" class="block w-full text-center py-3 bg-iyes-primary text-white font-bold rounded-lg shadow-md">
                    Hubungi Kami
                </a>
            </div>

        </div>
    </div>
</nav>