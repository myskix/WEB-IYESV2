<x-layout>
    <x-slot:title>
        {{ $post->title }} - Berita IYES
    </x-slot:title>

    <x-slot:meta_description>
        {{ Str::limit(strip_tags($post->content), 150) }}
    </x-slot:meta_description>

    <div class="fixed top-0 left-0 h-1.5 bg-iyes-accent z-[100]" id="progressBar" style="width: 0%"></div>

    <article class="bg-white min-h-screen pt-24 pb-16">
        
        <div class="max-w-4xl mx-auto px-6 mb-10 text-center animate-fade-in-up">
            <div class="flex items-center justify-center gap-3 mb-6">
                <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}" class="bg-orange-50 text-iyes-accent px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-iyes-accent hover:text-white transition-colors">
                    {{ $post->category->name }}
                </a>
                <span class="text-slate-300">•</span>
                <span class="text-slate-500 text-sm font-medium">{{ $post->published_at->format('d F Y') }}</span>
            </div>
            
            <h1 class="text-3xl md:text-5xl font-extrabold text-iyes-primary leading-tight mb-8">
                {{ $post->title }}
            </h1>

            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden border-2 border-white shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name) }}&background=0F172A&color=fff" alt="{{ $post->author->name }}">
                </div>
                <div class="text-left">
                    <p class="text-sm font-bold text-slate-800">{{ $post->author->name }}</p>
                    <p class="text-xs text-slate-500 font-medium">Tim Redaksi IYES</p>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-6 mb-12">
            <div class="aspect-video rounded-2xl overflow-hidden shadow-xl shadow-slate-200 border border-slate-100">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover">
            </div>
            @if($post->caption)
                <p class="text-center text-slate-400 text-sm mt-3 italic">{{ $post->caption }}</p>
            @endif
        </div>

        <div class="max-w-3xl mx-auto px-6">
            <div class="prose prose-lg prose-slate max-w-none 
                        prose-headings:text-iyes-primary prose-headings:font-bold 
                        prose-p:leading-relaxed prose-p:text-slate-600
                        prose-a:text-iyes-accent prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-xl prose-img:shadow-md
                        prose-blockquote:border-l-4 prose-blockquote:border-iyes-accent prose-blockquote:bg-orange-50/50 prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:rounded-r-lg prose-blockquote:italic prose-blockquote:text-slate-700">
                {!! $post->content !!}
            </div>

            <div class="mt-16 pt-8 border-t border-slate-100">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    
                    <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('posts.index', ['tag' => $tag->slug]) }}" class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-lg hover:bg-slate-200 transition">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-slate-700">Bagikan:</span>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com/yourprofile" target="_blank"
                            class="w-9 h-9 rounded-full bg-[#E1306C] text-white flex items-center justify-center hover:-translate-y-1 hover:shadow-lg transition-all">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link disalin!');" class="w-9 h-9 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center hover:bg-slate-300 transition-all" title="Salin Link">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- Related Posts --}}
    @if($relatedPosts->count() > 0)
    <section class="py-16 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-2xl font-bold text-iyes-primary mb-8 flex items-center gap-3">
                <span class="w-1 h-6 bg-iyes-accent rounded-full"></span>
                Artikel Terkait
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                    <a href="{{ route('posts.show', $related->slug) }}" class="group bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $related->thumbnail) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="{{ $related->title }}">
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-2 py-1 rounded text-[10px] font-bold text-iyes-primary">
                                {{ $related->category->name }}
                            </span>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                <i class="far fa-calendar"></i> {{ $related->published_at->format('d M Y') }}
                            </div>
                            <h4 class="font-bold text-slate-800 text-lg leading-snug group-hover:text-iyes-accent transition line-clamp-2">
                                {{ $related->title }}
                            </h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <script>
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        };
    </script>
</x-layout>