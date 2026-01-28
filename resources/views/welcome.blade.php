<x-layout>
    {{-- 1. META TAGS SEO & SOSMED --}}
    <x-slot:meta>
        {{-- SEO Standar --}}
        <meta name="description"
            content="IYES Indonesia (Indonesian Youth & Education Society) adalah organisasi kepemudaan yang berfokus pada pemberdayaan pemuda, pendidikan, dan sosial di Riau dan Indonesia.">
        <meta name="keywords"
            content="IYES Indonesia, Organisasi Pemuda Riau, Edukasi, Sosial, Volunteer Pekanbaru, Komunitas Pemuda">
        <meta name="author" content="IYES Indonesia">
        <meta name="robots" content="index, follow">

        {{-- Open Graph (Agar cantik saat share di WA/FB/IG) --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="Beranda - IYES INDONESIA">
        <meta property="og:description"
            content="Bersama memberdayakan pemuda dan memajukan pendidikan Indonesia. Bergabunglah dengan gerakan kami.">
        <meta property="og:image" content="{{ asset('images/hero-bg.jpg') }}"> {{-- Ganti dengan path logo/foto banner
        utama --}}
    </x-slot:meta>

    {{-- 2. JUDUL TAB BROWSER --}}
    <x-slot:title>Beranda - IYES INDONESIA</x-slot:title>

    {{-- Hero Section --}}
    @php
        $heroSlides = 
        [
            [
                'img' => asset('images/hero-bg.jpg'),
                'alt' => 'Kegiatan Pemuda IYES di bidang pendidikan',
            ],
            [
                'img' => asset('images/hero-bg2.jpg'),
                'alt' => 'Kolaborasi internasional IYES Indonesia',
            ],
            [
                'img' => asset('images/hero-bg3.jpg'),
                'alt' => 'Program sosial dan lingkungan IYES',
            ],
        ];
    @endphp

    <section
        x-data="{
            active: 0,
            total: {{ count($heroSlides) }},
            start() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.total
                }, 4000)
            }
        }"
        x-init="start"
        class="relative h-screen min-h-[640px] overflow-hidden bg-iyes-primary"
        aria-label="Hero IYES Indonesia"
    >

        {{-- Background Slider --}}
        <div class="absolute inset-0 z-0">

            @foreach($heroSlides as $index => $slide)
                <img
                    src="{{ $slide['img'] }}"
                    alt="{{ $slide['alt'] }}"

                    {{-- LCP IMAGE --}}
                    @if($index === 0)
                        fetchpriority="high"
                        loading="eager"
                    @else
                        loading="lazy"
                    @endif

                    decoding="async"
                    width="1920"
                    height="1080"

                    class="absolute inset-0 w-full h-full object-cover object-center
                        transition-opacity duration-1000 ease-in-out"

                    :class="active === {{ $index }} ? 'opacity-100' : 'opacity-0'"
                >
            @endforeach

            {{-- Overlay --}}
            <div
                class="absolute inset-0 bg-gradient-to-r
                    from-iyes-primary/95 via-iyes-primary/80 to-transparent z-10"
                aria-hidden="true"
            ></div>
        </div>

        {{-- CONTENT --}}
        <div class="relative z-20 max-w-7xl mx-auto px-6 pt-24 h-full flex items-center">
            <div class="max-w-3xl">

            {{-- Heading --}}
            <h1 
                class="text-white font-extrabold leading-tight
                       text-4xl sm:text-5xl md:text-6xl xl:text-7xl
                       animate-fade-in-up"
            >
                IYES
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300">
                    INDONESIA
                </span>
            </h1>

            {{-- Description --}}
            <p 
                class="mt-6 text-white/90 text-lg sm:text-xl md:text-2xl 
                       max-w-2xl leading-relaxed animate-fade-in-up animation-delay-200"
            >
                Mewadahi pemuda untuk berkontribusi aktif dalam isu pendidikan, perdamaian, lingkungan, dan sosial melalui aksi kolektif berkelanjutan.
            </p>

            {{-- CTA --}}
            <div 
                class="mt-10 flex flex-col sm:flex-row gap-4 animate-fade-in-up animation-delay-400"
            >
                <a 
                    href="#programs"
                    class="inline-flex items-center justify-center px-8 py-3.5
                           bg-iyes-accent text-white font-bold rounded-lg
                           shadow-lg hover:shadow-xl hover:-translate-y-0.5
                           transition-all duration-300"
                >
                    Lihat Program
                </a>

                <a 
                    href="https://instagram.com/iyes.indonesia"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center px-8 py-3.5
                           bg-white/10 backdrop-blur-md text-white font-bold rounded-lg
                           border border-white/20 hover:bg-white/20
                           transition-colors duration-300"
                >
                    Jadi Volunteer
                </a>
            </div>

            {{-- Focus Areas --}}
            <ul 
                class="mt-12 flex flex-wrap gap-6 text-white/85 text-sm font-medium tracking-wide
                       animate-fade-in-up animation-delay-600"
            >
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-iyes-accent rounded-full"></span> Pendidikan
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-400 rounded-full"></span> Lingkungan
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-400 rounded-full"></span> Sosial
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-yellow-400 rounded-full"></span> SDGs
                </li>
            </ul>



            </div>
        </div>
    </section>

    {{-- Visi Kami --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

                <div class="order-2 md:order-1">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-8 h-0.5 bg-iyes-accent"></span>
                        <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Tentang Kami</span>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-extrabold text-iyes-primary mb-6 leading-tight">
                        Visi Kami Untuk <br>Masa Depan Indonesia
                    </h2>

                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        Menjadi platform terdepan yang menghubungkan pemuda Indonesia dengan peluang global, menciptakan
                        pemimpin yang berkarakter, berwawasan luas, dan peduli terhadap isu-isu sosial berkelanjutan.
                    </p>

                    <ul class="space-y-5 mb-10">
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mt-1 mr-4">
                                <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-iyes-primary text-lg">Pemberdayaan Pemuda</span>
                                <span class="text-slate-500 text-sm">Meningkatkan kapasitas soft-skill &
                                    hard-skill.</span>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mt-1 mr-4">
                                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <span class="block font-bold text-iyes-primary text-lg">Kolaborasi Global</span>
                                <span class="text-slate-500 text-sm">Jejaring internasional untuk dampak lokal.</span>
                            </div>
                        </li>
                    </ul>

                    <a href="{{ route('pages.about') }}"
                        class="group inline-flex items-center gap-2 px-6 py-3 bg-iyes-primary text-white font-bold rounded-lg hover:bg-slate-800 transition-all duration-300 shadow-lg shadow-blue-900/20">
                        Selengkapnya Tentang IYES
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="order-1 md:order-2">
                    <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                        <img src="{{asset('images/visi-misi.png')}}"
                            class="w-full h-[450px] object-cover transition-transform duration-700 group-hover:scale-105"
                            alt="Kolaborasi Tim IYES">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Program --}}
    <section id="programs" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="w-8 h-0.5 bg-iyes-accent"></span>
                <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Program Kami</span>
                <span class="w-8 h-0.5 bg-iyes-accent"></span>
            </div>

            <h2 class="text-3xl md:text-4xl font-extrabold text-iyes-primary mb-6 tracking-tight leading-tight">
                Inisiatif Unggulan IYES
            </h2>

            <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
                Jelajahi berbagai inisiatif kami yang dirancang khusus untuk memberdayakan potensi pemuda dan
                menciptakan dampak positif berkelanjutan.
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($programs->take(3) as $program)
                <article
                    class="group flex flex-col h-full bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                    <div class="relative h-60 overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->name }}" loading="lazy"
                            decoding="async"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
                        </div>
                    </div>

                    <div class="flex flex-col flex-grow p-8">
                        <h3
                            class="text-xl font-bold text-iyes-primary mb-3 leading-snug group-hover:text-iyes-accent transition-colors">
                            <a href="{{ route('programs.show', $program->slug) }}">
                                {{ $program->name }}
                            </a>
                        </h3>

                        <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                            {{ $program->brief_description }}
                        </p>

                        <div class="mt-auto pt-6 border-t border-slate-50">
                            <a href="{{ route('programs.show', $program->slug) }}"
                                class="inline-flex items-center text-iyes-accent font-bold text-sm hover:underline decoration-2 underline-offset-4 group/link">
                                Selengkapnya
                                <svg class="w-4 h-4 ml-1 transition-transform group-hover/link:translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('programs.index') }}"
                class="inline-block px-8 py-3 bg-iyes-primary text-white font-bold rounded-lg shadow-lg hover:bg-slate-800 hover:-translate-y-0.5 transition-all duration-300">
                Lihat Semua Program
            </a>
        </div>
    </section>

    {{-- Berita --}}
    <section id="news" class="py-24 bg-white border-t border-slate-50">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-xs">Media & Publikasi</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight">Kabar Terbaru</h2>
            </div>
            <a href="{{ route('posts.index') }}"
                class="group inline-flex items-center font-bold text-iyes-primary hover:text-iyes-accent transition-colors">
                Arsip Berita
                <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-12">
            @foreach($latestPosts as $post)
                <article class="group flex flex-col h-full">
                    <a href="{{ route('posts.index') }}" class="block relative aspect-[16/9] rounded-2xl overflow-hidden bg-gray-100 mb-5 shadow-sm">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" loading="lazy"
                            decoding="async"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        <span
                            class="absolute top-4 left-4 bg-white px-3 py-1 rounded-lg text-xs font-bold text-iyes-primary shadow-sm">
                            {{ $post->category->name ?? 'Berita' }}
                        </span>
                    </a>

                    <div class="flex flex-col flex-grow">
                        <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-3">
                            <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('d M Y') }}</time>
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <span>{{ $post->author ?? 'Tim Redaksi IYES' }}</span>
                        </div>

                        <h3
                            class="text-xl font-bold text-iyes-primary leading-snug mb-3 group-hover:text-iyes-accent transition-colors line-clamp-2">
                            <a href="#">{{ $post->title }}</a>
                        </h3>

                        <p class="text-slate-500 text-sm line-clamp-2 mb-4 leading-relaxed">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>

                        <a href="{{ route('posts.index') }}"
                            class="mt-auto inline-flex text-sm font-bold text-iyes-accent hover:underline decoration-2 underline-offset-4">
                            Baca Selengkapnya
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Testimonial --}}
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="w-8 h-0.5 bg-iyes-accent"></span>
                <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Testimoni</span>
                <span class="w-8 h-0.5 bg-iyes-accent"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight mb-6">
                Apa Kata Mereka?
            </h2>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Cerita pengalaman nyata dari alumni, volunteer, dan mitra yang telah berkolaborasi bersama IYES
                Indonesia.
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials->take(3) as $testi)
                <article
                    class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col items-center text-center h-full">

                    <div class="relative mb-6">
                        <div class="absolute inset-0 bg-iyes-accent/10 rounded-full blur-lg transform scale-90"></div>
                        <img src="{{ asset('storage/' . $testi->photo) }}"
                            class="relative w-20 h-20 rounded-full object-cover border-4 border-white shadow-md"
                            alt="{{ $testi->name }}" loading="lazy">
                    </div>

                    <div class="mb-4">
                        <h4 class="font-bold text-iyes-primary text-lg leading-tight">{{ $testi->name }}</h4>
                        <p class="text-xs font-bold text-iyes-accent uppercase tracking-widest mt-1">
                            {{ $testi->role_or_company }}
                        </p>
                    </div>

                    <blockquote
                        class="text-slate-600 italic text-sm leading-relaxed flex-grow border-t border-slate-50 pt-4 w-full">
                        "{{ Str::limit(strip_tags($testi->content), 150) }}"
                    </blockquote>

                </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('pages.testimonials') }}"
                class="inline-flex items-center text-iyes-primary font-bold text-sm hover:text-iyes-accent transition-colors group">
                Lihat Cerita Alumni Lainnya
                <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- Mitra & Kolaborator --}}
    <section class="py-24 bg-white border-t border-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="w-8 h-0.5 bg-iyes-accent"></span>
                <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Jejaring Kami</span>
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
            $rows = $partners->splitIn(3); 
        @endphp

        <div class="relative w-full flex flex-col gap-10">
            <div
                class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none">
            </div>
            <div
                class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none">
            </div>

            @if($rows->isNotEmpty())
                <div class="flex items-center gap-16 animate-marquee whitespace-nowrap">
                    @for($i = 0; $i < 6; $i++) {{-- Loop 6x agar seamless --}}
                        @foreach($rows[0] as $partner)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                title="{{ $partner->name }}" loading="lazy"
                                class="h-14 w-auto max-w-[160px] object-contain hover:scale-110 transition-transform duration-300 flex-shrink-0">
                        @endforeach
                    @endfor
                </div>
            @endif

            @if($rows->count() > 1)
                <div class="flex items-center gap-16 animate-marquee whitespace-nowrap [animation-direction:reverse]">
                    @for($i = 0; $i < 6; $i++)
                        @foreach($rows[1] as $partner)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                title="{{ $partner->name }}" loading="lazy"
                                class="h-14 w-auto max-w-[160px] object-contain hover:scale-110 transition-transform duration-300 flex-shrink-0">
                        @endforeach
                    @endfor
                </div>
            @endif

        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-24 bg-slate-50">
        <div class="max-w-3xl mx-auto px-6">

            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Bantuan</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Pertanyaan Umum (FAQ)
                </h2>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Hal-hal yang sering ditanyakan seputar pendaftaran dan program IYES.
                </p>
            </div>

            <div class="space-y-4" x-data="{ selected: null }">

                <div
                    class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <button @click="selected !== 1 ? selected = 1 : selected = null"
                        class="w-full flex justify-between items-center p-5 text-left font-bold text-iyes-primary hover:bg-slate-50 transition-colors">
                        <span>Bagaimana cara mendaftar program?</span>
                        <svg :class="selected === 1 ? 'rotate-180' : ''"
                            class="w-5 h-5 text-iyes-accent transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 1" 
                        class="px-5 pb-5 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                        Anda bisa mendaftar melalui halaman detail program saat statusnya "Open Registration". Klik
                        tombol daftar dan isi formulir yang tersedia.
                    </div>
                </div>

                <div
                    class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <button @click="selected !== 2 ? selected = 2 : selected = null"
                        class="w-full flex justify-between items-center p-5 text-left font-bold text-iyes-primary hover:bg-slate-50 transition-colors">
                        <span>Apakah program IYES berbayar?</span>
                        <svg :class="selected === 2 ? 'rotate-180' : ''"
                            class="w-5 h-5 text-iyes-accent transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 2" 
                        class="px-5 pb-5 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                        Ada program yang Fully Funded (Gratis) melalui seleksi beasiswa, dan ada jalur Self-Funded.
                        Detailnya tertera di tiap panduan program.
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <button @click="selected !== 5 ? selected = 5 : selected = null"
                        class="w-full flex justify-between items-center p-5 text-left font-bold text-iyes-primary hover:bg-slate-50 transition-colors">
                        <span>Bagaimana cara mendapatkan update terbaru?</span>
                        <svg :class="selected === 5 ? 'rotate-180' : ''"
                            class="w-5 h-5 text-iyes-accent transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 5" 
                        class="px-5 pb-5 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                        Ikuti akun resmi IYES di media sosial atau kunjungi halaman Berita di website untuk update terbaru.
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <button @click="selected !== 4 ? selected = 4 : selected = null"
                        class="w-full flex justify-between items-center p-5 text-left font-bold text-iyes-primary hover:bg-slate-50 transition-colors">
                        <span>Apakah saya bisa menjadi mitra IYES?</span>
                        <svg :class="selected === 4 ? 'rotate-180' : ''"
                            class="w-5 h-5 text-iyes-accent transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="selected === 4" 
                        class="px-5 pb-5 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                        Ya, kami terbuka untuk kolaborasi. Silakan hubungi tim kami melalui halaman "Hubungi Kami" untuk informasi lebih lanjut.
                    </div>
                </div>



            </div>
        </div>
    </section>

    <script src="https://cdn.botpress.cloud/webchat/v3.4/inject.js"></script>
    <script src="https://files.bpcontent.cloud/2025/11/14/18/20251114182419-430RR4Q4.js" defer></script>
</x-layout>