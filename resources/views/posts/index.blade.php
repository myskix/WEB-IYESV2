<x-layout>
    <x-slot:title>
        Berita & Artikel - IYES Indonesia
    </x-slot:title>

    <div class="bg-slate-50 min-h-screen py-24">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="text-center mb-12">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                    <span class="text-iyes-accent font-bold uppercase tracking-widest text-sm">Media Center</span>
                    <span class="w-8 h-0.5 bg-iyes-accent"></span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-iyes-primary tracking-tight">
                    Kabar & Wawasan Terbaru
                </h1>
                <p class="text-slate-500 mt-4 max-w-2xl mx-auto">
                    Temukan cerita inspiratif, update kegiatan, dan artikel edukatif seputar kepemudaan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                
                <div class="lg:col-span-3">
                    
                    @if($posts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($posts as $post)
                            <article class="flex flex-col h-full bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
                                <a href="{{ route('posts.show', $post->slug) }}" class="relative aspect-[16/10] overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                                         alt="{{ $post->title }}" 
                                         loading="lazy"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    
                                    <span class="absolute top-4 left-4 bg-white/95 px-3 py-1 rounded-lg text-xs font-bold text-iyes-primary shadow-sm border-l-2 border-iyes-accent">
                                        {{ $post->category->name ?? 'Umum' }}
                                    </span>
                                </a>

                                <div class="flex flex-col flex-grow p-6">
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-3 font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <time>{{ $post->published_at->format('d M Y') }}</time>
                                    </div>

                                    <h3 class="text-lg font-bold text-iyes-primary mb-3 leading-snug group-hover:text-iyes-accent transition-colors line-clamp-2">
                                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    
                                    <p class="text-slate-500 text-sm line-clamp-3 mb-4 flex-grow leading-relaxed">
                                        {{ Str::limit(strip_tags($post->content), 100) }}
                                    </p>
                                    
                                    <div class="mt-auto pt-4 border-t border-slate-50 flex justify-between items-center">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author) }}&background=random" alt="Author">
                                            </div>
                                            <span class="text-xs text-slate-500 font-medium">{{ Str::limit($post->author, 10) }}</span>
                                        </div>
                                        <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-bold text-iyes-accent hover:underline">
                                            Baca →
                                        </a>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $posts->links() }} 
                        </div>

                    @else
                        <div class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl border border-dashed border-slate-300">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-600">Belum ada artikel ditemukan.</h3>
                            <p class="text-slate-400 text-sm mt-1">Coba kata kunci lain atau reset filter.</p>
                            <a href="{{ route('posts.index') }}" class="mt-4 px-5 py-2 bg-slate-100 text-slate-600 rounded-full text-sm font-bold hover:bg-slate-200 transition">
                                Reset Semua Filter
                            </a>
                        </div>
                    @endif
                </div>

                <aside class="space-y-8">
                    
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm sticky top-24">
                        <h4 class="font-bold text-iyes-primary mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-iyes-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Cari Artikel
                        </h4>
                        <form action="{{ route('posts.index') }}" method="GET" class="relative">
                            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                            @if(request('tag')) 
                                @foreach((array)request('tag') as $t)
                                    <input type="hidden" name="tag[]" value="{{ $t }}">
                                @endforeach
                            @endif
                            
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." 
                                   class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-iyes-accent/20 focus:border-iyes-accent outline-none text-sm transition font-medium">
                            <button type="submit" class="absolute right-3 top-3 text-slate-400 hover:text-iyes-accent transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>

                        <div class="mt-8">
                            <h4 class="font-bold text-iyes-primary mb-4 flex justify-between items-center">
                                Kategori
                                @if(request('category'))
                                    <a href="{{ route('posts.index') }}" class="text-[10px] text-red-500 hover:underline font-normal uppercase tracking-wide">Clear</a>
                                @endif
                            </h4>
                            <ul class="space-y-2">
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('posts.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}" 
                                       class="flex justify-between items-center group p-2 rounded-lg hover:bg-slate-50 transition-colors {{ request('category') == $cat->slug ? 'bg-orange-50' : '' }}">
                                        <span class="text-sm font-medium {{ request('category') == $cat->slug ? 'text-iyes-accent' : 'text-slate-600 group-hover:text-iyes-primary' }}">
                                            {{ $cat->name }}
                                        </span>
                                        <span class="text-xs bg-slate-100 text-slate-500 py-0.5 px-2 rounded-md group-hover:bg-white group-hover:shadow-sm transition-all font-bold">
                                            {{ $cat->posts_count }}
                                        </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-8">
                            <h4 class="font-bold text-iyes-primary mb-4">Topik Populer</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($tags as $tag)
                                    @php
                                        // Cek apakah tag ini sedang aktif
                                        $isActive = in_array($tag->slug, (array)request('tag'));
                                        
                                        // Logic untuk toggle tag (klik lagi = hapus)
                                        $currentTags = (array)request('tag');
                                        if ($isActive) {
                                            $newTags = array_diff($currentTags, [$tag->slug]);
                                        } else {
                                            $newTags = array_merge($currentTags, [$tag->slug]);
                                        }
                                        $params = array_merge(request()->except(['tag', 'page']), ['tag' => $newTags]);
                                    @endphp
                                    
                                    <a href="{{ route('posts.index', $params) }}" 
                                       class="text-xs px-3 py-1.5 rounded-lg border font-medium transition-all duration-300 
                                       {{ $isActive ? 'bg-iyes-accent text-white border-iyes-accent shadow-md shadow-orange-200' : 'bg-white text-slate-500 border-slate-200 hover:border-iyes-accent hover:text-iyes-accent' }}">
                                       #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </div>
</x-layout>