<x-layout>
    {{-- SEO META TAGS --}}
    <x-slot:meta>
        <meta name="description" content="Profil IYES Indonesia - Organisasi nirlaba yang mewadahi pemuda untuk mengatasi isu pendidikan, sosial, dan lingkungan melalui kolaborasi multipihak sejak 2014.">
        <meta name="keywords" content="Profil IYES Indonesia, Visi Misi IYES, Sejarah IYES, NGO Pemuda Indonesia, Pendidikan, Sosial, Lingkungan">
        <meta property="og:title" content="Profil Organisasi - IYES Indonesia">
        <meta property="og:description" content="Kenali sejarah, visi, misi, dan nilai-nilai perjuangan IYES Indonesia.">
        <meta property="og:image" content="{{ asset('images/visi-misi.png') }}">
        <meta property="og:type" content="article">
    </x-slot:meta>

    <x-slot:title>Profil Organisasi - IYES Indonesia</x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- 1. HEADER SECTION (Style Berita) --}}
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Tentang Kami</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Profil Organisasi
                </h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
                    Mengenal sejarah, nilai, dan dedikasi IYES Indonesia dalam memberdayakan pemuda untuk masa depan bangsa.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                {{-- KONTEN UTAMA (Kiri - 8 Kolom) --}}
                <div class="lg:col-span-8 space-y-12">
                    
                    {{-- Deskripsi & Gambar Utama --}}
                    <article class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 md:p-10">
                        <figure class="mb-8 rounded-xl overflow-hidden bg-slate-100">
                            <img src="{{ asset('images/visi-misi.png') }}" 
                                 onerror="this.src='https://placehold.co/800x400/e2e8f0/475569?text=IYES+Activity'"
                                 alt="Kegiatan IYES Indonesia" 
                                 class="w-full h-auto object-cover hover:scale-105 transition-transform duration-700">
                        </figure>

                        <h2 class="text-2xl font-bold text-iyes-primary mb-6">Siapa Kami?</h2>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-justify">
                            <p>
                                <strong>Indonesian Youth Education & Social (IYES)</strong> adalah organisasi nirlaba yang berdedikasi untuk mewadahi pemuda Indonesia dalam mengatasi permasalahan pendidikan, perdamaian, lingkungan, dan isu sosial lainnya.
                            </p>
                            <p>
                                Kami percaya bahwa perubahan besar dimulai dari aksi kolektif. Oleh karena itu, IYES hadir untuk mendorong kolaborasi antara pemuda dengan pemerintah, sektor swasta, akademisi, dan masyarakat sipil demi menciptakan dampak yang berkelanjutan.
                            </p>
                        </div>
                    </article>

                    {{-- Visi & Misi --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 md:p-10">
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold text-iyes-primary mb-4 flex items-center gap-3">
                                <span class="w-1.5 h-8 bg-iyes-accent rounded-full"></span>
                                Visi Kami
                            </h2>
                            <div class="bg-slate-50 p-6 rounded-xl border-l-4 border-iyes-accent italic text-slate-700 font-medium text-lg">
                                "Menjadi organisasi yang menjembatani pemuda dalam mengatasi isu-isu pendidikan, sosial dan lingkungan, serta mendorong adanya kolaborasi multipihak."
                            </div>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold text-iyes-primary mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-8 bg-iyes-primary rounded-full"></span>
                                Misi Kami
                            </h2>
                            <ul class="space-y-4">
                                @php
                                    $missions = [
                                        "Memfasilitasi pemuda mengembangkan ide dengan prinsip kerelawanan.",
                                        "Meningkatkan kemampuan pemuda untuk berdampak nyata pada isu sosial.",
                                        "Mengembangkan kemitraan strategis dengan berbagai pemangku kepentingan.",
                                        "Mendukung implementasi Tujuan Pembangunan Berkelanjutan (SDGs).",
                                        "Menjamin transparansi & akuntabilitas program berbasis teknologi."
                                    ];
                                @endphp
                                @foreach($missions as $index => $misi)
                                <li class="flex gap-4">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-iyes-primary text-white text-xs font-bold flex items-center justify-center mt-1">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-slate-600">{{ $misi }}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Sejarah Singkat (Timeline Vertikal Simple) --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 md:p-10">
                        <h2 class="text-2xl font-bold text-iyes-primary mb-8">Jejak Langkah</h2>
                        <div class="relative border-l-2 border-slate-100 ml-3 space-y-8">
                            
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-slate-200 border-4 border-white shadow-sm"></div>
                                <span class="text-xs font-bold text-iyes-accent uppercase tracking-wider mb-1 block">Inisiasi</span>
                                <h3 class="text-lg font-bold text-slate-800">Berawal di Nepal</h3>
                                <p class="text-slate-500 text-sm mt-1">Ide lahir saat pendiri mengikuti 7th UNESCO International Youth Peace Ambassador.</p>
                            </div>

                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-slate-200 border-4 border-white shadow-sm"></div>
                                <span class="text-xs font-bold text-iyes-accent uppercase tracking-wider mb-1 block">Project Awal</span>
                                <h3 class="text-lg font-bold text-slate-800">Child Team Project</h3>
                                <p class="text-slate-500 text-sm mt-1">Komunitas awal yang dibentuk sebagai wujud rencana aksi sosial konkret.</p>
                            </div>

                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-iyes-primary border-4 border-white shadow-sm"></div>
                                <span class="text-xs font-bold text-iyes-accent uppercase tracking-wider mb-1 block">24 April 2014</span>
                                <h3 class="text-lg font-bold text-slate-800">IYES Resmi Berdiri</h3>
                                <p class="text-slate-500 text-sm mt-1">Disahkan sebagai organisasi berbadan hukum dan mulai memperluas dampak.</p>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- SIDEBAR (Kanan - 4 Kolom) --}}
                <aside class="lg:col-span-4 space-y-8 sticky top-24">
                    
                    {{-- Widget: Fokus Kami --}}
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <h4 class="font-bold text-iyes-primary mb-4 flex items-center gap-2 border-b border-slate-50 pb-3">
                            <i class="fas fa-bullseye text-iyes-accent"></i> Fokus Utama
                        </h4>
                        <div class="grid grid-cols-2 gap-3">
                            @php
                                $focus = [
                                    ['label' => 'Pendidikan', 'icon' => 'fas fa-graduation-cap', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                    ['label' => 'Sosial', 'icon' => 'fas fa-users', 'color' => 'text-green-500', 'bg' => 'bg-green-50'],
                                    ['label' => 'Lingkungan', 'icon' => 'fas fa-leaf', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50'],
                                    ['label' => 'SDGs', 'icon' => 'fas fa-globe', 'color' => 'text-orange-500', 'bg' => 'bg-orange-50'],
                                ];
                            @endphp
                            @foreach($focus as $f)
                            <div class="{{ $f['bg'] }} p-4 rounded-xl text-center hover:shadow-md transition-all cursor-default">
                                <i class="{{ $f['icon'] }} {{ $f['color'] }} text-2xl mb-2 block"></i>
                                <span class="text-xs font-bold text-slate-700">{{ $f['label'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Widget: CTA Tim --}}
                    <div class="bg-iyes-primary text-white p-8 rounded-2xl shadow-lg text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-iyes-accent opacity-20 rounded-full -ml-12 -mb-12"></div>
                        
                        <h4 class="text-xl font-bold mb-3 relative z-10">Kenali Tim Kami</h4>
                        <p class="text-blue-100 text-sm mb-6 relative z-10">Lihat orang-orang hebat di balik pergerakan IYES Indonesia.</p>
                        
                        <a href="{{ route('board-members.index') }}" class="inline-block w-full py-3 bg-white text-iyes-primary font-bold rounded-xl hover:bg-slate-100 transition-colors relative z-10">
                            Lihat Struktur
                        </a>
                    </div>

                    {{-- Widget: Info Kontak (Clickable & Compact) --}}
                    <a href="/hubungi-kami" class="block bg-white p-2 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-iyes-primary/30 transition-all group">
                        <div class="flex justify-between items-center mb-1 border-b border-slate-50 p-2">
                            <h4 class="font-bold text-iyes-primary group-hover:text-iyes-accent transition-colors">
                                Hubungi Kami
                            </h4>
                            <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-iyes-accent transition-colors">
                                <i class="fas fa-arrow-right text-xs text-slate-400 group-hover:text-white transform group-hover:translate-x-0.5 transition-all"></i>
                            </div>
                        </div>
                        
                    </a>

                </aside>

            </div>
        </div>
    </div>
</x-layout>