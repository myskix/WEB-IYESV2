<x-layout>
    <x-slot:title>
        Annual Report - IYES Indonesia
    </x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Transparansi</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight mb-4">
                    Laporan Tahunan
                </h1>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                    Dokumentasi perjalanan, capaian kinerja, dan dampak yang telah kami ciptakan setiap tahunnya.
                </p>
            </div>

            @if($reports->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($reports as $report)
                    <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">
                        
                        <div class="relative aspect-[3/4] bg-slate-200 overflow-hidden border-b border-slate-50 flex items-center justify-center">
                            @if($report->cover_image)
                                <img src="{{ asset('storage/' . $report->cover_image) }}" 
                                    alt="Cover {{ $report->title }}" 
                                    loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="text-slate-400 flex flex-col items-center">
                                    <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-xs font-bold uppercase tracking-widest">No Cover</span>
                                </div>
                            @endif
                            
                            @if($report->file_path)
                            <div class="absolute inset-0 bg-iyes-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                                <a href="{{ route('annual-report.download', $report->id) }}" class="flex flex-col items-center text-white gap-2">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="font-bold text-sm tracking-wide">DOWNLOAD PDF</span>
                                </a>
                            </div>
                            @endif

                            <div class="absolute top-0 left-0 bg-iyes-accent text-white px-4 py-1.5 rounded-br-xl font-bold text-sm shadow-md z-10">
                                {{ $report->year }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-bold text-iyes-primary text-lg leading-snug mb-2 group-hover:text-iyes-accent transition-colors">
                                {{ $report->title }}
                            </h3>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-3 mb-4 flex-grow">
                                {{ $report->description }}
                            </p>
                            
                            <a href="{{ route('annual-report.download', $report->id) }}" class="mt-auto w-full inline-flex justify-center items-center px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-600 text-sm font-bold hover:bg-iyes-primary hover:text-white hover:border-iyes-primary transition-colors gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Unduh Laporan
                            </a>
                        </div>

                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-slate-200">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Laporan</h3>
                    <p class="text-slate-400">Laporan tahunan akan segera dipublikasikan di sini.</p>
                </div>
            @endif

        </div>
    </div>
</x-layout>