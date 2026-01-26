<x-layout>
    <x-slot:title>Struktur Pengurus - IYES Indonesia</x-slot:title>

    <div class="bg-slate-100 bg min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- 1. HEADER & FILTER --}}
            <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
                
                <div class="text-center md:text-left w-full md:w-auto">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-4">
                        <span class="w-8 h-0.5 bg-iyes-accent"></span>
                        <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Tim Kami</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight">
                        Struktur Pengurus
                    </h1>
                    <p class="text-slate-500 mt-2">
                        Dedikasi untuk kemajuan pemuda Indonesia.
                    </p>
                </div>

                <div class="w-full md:w-auto">
                    <form action="{{ route('board-members.index') }}" method="GET" class="flex items-center gap-3 bg-white p-2 rounded-xl border border-slate-200 shadow-sm">
                        <label for="period" class="text-sm font-bold text-slate-500 pl-2">Periode:</label>
                        <select name="period" id="period" onchange="this.form.submit()" 
                                class="bg-slate-50 border-none text-iyes-primary font-bold text-sm rounded-lg focus:ring-2 focus:ring-iyes-accent cursor-pointer py-2 pl-3 pr-8">
                            @foreach($periods as $period)
                                <option value="{{ $period }}" {{ $currentPeriod == $period ? 'selected' : '' }}>
                                    {{ $period }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            {{-- 2. CONTENT LOOP --}}
            @if($groupedMembers->count() > 0)
                
                @foreach($groupedMembers as $division => $membersInGroup)
                    
                    <div class="text-center mb-10 mt-16 first:mt-0">
                        <h2 class="text-xl md:text-2xl font-bold text-iyes-primary inline-block relative pb-2 px-6 border-b-2 border-slate-200">
                            {{ $division }}
                        </h2>
                    </div>

                    {{-- Ubah Grid jadi Flex agar card rata tengah --}}
                    <div class="flex flex-wrap justify-center gap-8">
                        
                        @foreach($membersInGroup as $member)
                        {{-- Card Item (Lebar diset fixed sm:w-72 agar rapi) --}}
                        <div class="w-full sm:w-72 group bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center flex flex-col items-center">
                            
                            <div class="relative w-32 h-32 mb-6">
                                <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-iyes-primary to-iyes-accent p-1">
                                    <div class="w-full h-full rounded-full bg-white p-1">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                                 alt="{{ $member->name }}" 
                                                 loading="lazy"
                                                 class="w-full h-full rounded-full object-cover transition-all duration-500">
                                                 {{-- Grayscale dihapus di sini --}}
                                        @else
                                            <div class="w-full h-full rounded-full bg-slate-200 flex items-center justify-center text-slate-400 font-bold text-2xl">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($member->linkedin_url)
                                    <div class="absolute bottom-0 right-0 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                                        <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" 
                                        class="w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center text-iyes-accent hover:bg-iyes-accent hover:text-white transition-colors">
                                            <i class="fab fa-linkedin-in text-xs"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="w-full">
                                <h3 class="text-lg font-bold text-iyes-primary group-hover:text-iyes-accent transition-colors">
                                    {{ $member->name }}
                                </h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-1 mb-3">
                                    {{ $member->position }}
                                </p>
                                
                                @if($member->is_founder)
                                    <span class="inline-block px-2 py-0.5 bg-iyes-accent text-white text-[10px] font-bold rounded-full mb-3">
                                        FOUNDER
                                    </span>
                                @endif
                                
                                <div class="w-8 h-1 bg-slate-100 mx-auto rounded-full group-hover:bg-iyes-accent/50 transition-colors"></div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                @endforeach

            @else
                {{-- Empty State --}}
                <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-200">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users-slash text-slate-300 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-600">Data Tidak Ditemukan</h3>
                    <p class="text-slate-400 text-sm">Belum ada data pengurus untuk periode {{ $currentPeriod }}.</p>
                </div>
            @endif

        </div>
    </div>
</x-layout>