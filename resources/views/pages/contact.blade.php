<x-layout>
    <x-slot:meta>
        <meta name="description" content="Hubungi IYES Indonesia. Kami terbuka untuk kolaborasi, pertanyaan, dan saran. Kunjungi kantor kami di Pekanbaru atau hubungi via WhatsApp/Email.">
        <meta property="og:title" content="Hubungi Kami - IYES Indonesia">
    </x-slot:meta>

    <x-slot:title>Hubungi Kami - IYES Indonesia</x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Kontak</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Mari Terhubung
                </h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                    Punya ide kolaborasi atau pertanyaan seputar program kami? Jangan ragu untuk menyapa tim IYES Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 overflow-hidden bg-white rounded-3xl shadow-xl border border-slate-100">
                
                {{-- KOLOM KIRI: INFO KONTAK --}}
                <div class="lg:col-span-5 p-8 md:p-12 bg-iyes-primary text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-iyes-accent opacity-20 rounded-full -ml-10 -mb-10 blur-xl"></div>

                    <h3 class="text-2xl font-bold mb-8 relative z-10">Informasi Kantor</h3>

                    <div class="space-y-8 relative z-10">
                        {{-- Alamat --}}
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-xl text-iyes-accent"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Alamat</h4>
                                <p class="text-blue-100 text-sm leading-relaxed">
                                    Perumahan Wadya Graha III, Blok G5, Delima,<br>
                                    Pekanbaru, Provinsi Riau.
                                </p>
                            </div>
                        </div>

                        {{-- Email (UPDATED) --}}
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-xl text-iyes-accent"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Email</h4>
                                <a href="mailto:indonesianyouth.es@gmail.com" class="text-blue-100 text-sm hover:text-white hover:underline transition-colors break-all">
                                    indonesianyouth.es@gmail.com
                                </a>
                                <p class="text-xs text-blue-300 mt-1">Senin - Jumat (09:00 - 17:00 WIB)</p>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="pt-8 border-t border-white/10">
                            <h4 class="font-bold text-lg mb-4">Ikuti Kami</h4>
                            <div class="flex gap-4">
                                <a href="https://instagram.com/iyes_indonesia" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-iyes-accent transition-all transform hover:-translate-y-1">
                                    <i class="fab fa-instagram text-white"></i>
                                </a>
                                <a href="https://linkedin.com/company/iyes-indonesia" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-iyes-accent transition-all transform hover:-translate-y-1">
                                    <i class="fab fa-linkedin-in text-white"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-iyes-accent transition-all transform hover:-translate-y-1">
                                    <i class="fab fa-youtube text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: ACTION & MAPS --}}
                <div class="lg:col-span-7 p-8 md:p-12">
                    
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Kirim Pesan Cepat</h3>
                    
                    {{-- Tombol Direct Action --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20IYES,%20saya%20ingin%20bertanya..." target="_blank" 
                           class="flex items-center justify-center gap-3 p-4 rounded-xl border border-green-200 bg-green-50 hover:bg-green-100 hover:shadow-md transition-all group">
                            <i class="fab fa-whatsapp text-2xl text-green-600 group-hover:scale-110 transition-transform"></i>
                            <div class="text-left">
                                <span class="block text-xs font-bold text-green-600 uppercase tracking-wider">WhatsApp</span>
                                <span class="block font-bold text-slate-800">Chat Admin</span>
                            </div>
                        </a>

                        {{-- Tombol Email (UPDATED) --}}
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=indonesianyouth.es@gmail.com&su=Halo%20IYES" target="_blank" 
                           class="flex items-center justify-center gap-3 p-4 rounded-xl border border-blue-200 bg-blue-50 hover:bg-blue-100 hover:shadow-md transition-all group">
                            <i class="fas fa-envelope-open-text text-2xl text-blue-600 group-hover:scale-110 transition-transform"></i>
                            <div class="text-left">
                                <span class="block text-xs font-bold text-blue-600 uppercase tracking-wider">Email</span>
                                <span class="block font-bold text-slate-800">Kirim Surel</span>
                            </div>
                        </a>
                    </div>

                    {{-- Embed Google Maps --}}
                    <div class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 h-[300px] w-full bg-slate-100 relative group">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-400 text-sm">
                            <i class="fas fa-map-marked-alt mr-2"></i> Memuat Peta...
                        </div>
                        
                        <iframe src="https://maps.google.com/maps?q=0.4578832,101.4554366&hl=id&z=14&output=embed" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="relative z-10">
                        </iframe>
                    </div>
                    <p class="text-xs text-slate-400 mt-3 text-center">
                        *Klik peta untuk membuka di Google Maps
                    </p>

                </div>

            </div>
        </div>
    </div>
</x-layout>