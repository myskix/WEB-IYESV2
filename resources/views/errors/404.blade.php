<x-layout>
    <x-slot:title>Halaman Tidak Ditemukan</x-slot:title>
    <div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-6">
        <h1 class="text-9xl font-extrabold text-slate-200">404</h1>
        <h2 class="text-2xl font-bold text-iyes-primary mt-4">Ups! Halaman tidak ditemukan.</h2>
        <p class="text-slate-500 mt-2 mb-8">Mungkin link rusak atau halaman sudah dipindahkan.</p>
        <a href="{{ route('pages.contact') }}" class="px-6 py-3 bg-iyes-accent text-white rounded-full font-bold hover:bg-orange-600 transition">
            Kembali ke Beranda
        </a>
    </div>
</x-layout>