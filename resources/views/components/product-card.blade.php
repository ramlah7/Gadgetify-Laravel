@props(['product'])

<div x-data="{ loading: true, hover: false }" 
     x-init="setTimeout(() => loading = false, 800)" 
     @mouseenter="hover = true" 
     @mouseleave="hover = false"
     class="relative group h-full">

    <!-- Skeleton Loader -->
    <div x-show="loading" class="h-full bg-navy-800 border border-slate-800 rounded-2xl p-4 overflow-hidden animate-pulse">
        <div class="w-full h-48 bg-slate-700/50 rounded-xl mb-4"></div>
        <div class="h-4 bg-slate-700/50 rounded w-3/4 mb-3"></div>
        <div class="h-4 bg-slate-700/50 rounded w-1/2 mb-4"></div>
        <div class="h-10 bg-slate-700/50 rounded-lg w-full"></div>
    </div>

    <!-- Actual Card -->
    <div x-show="!loading" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100" 
         class="h-full bg-navy-800/60 backdrop-blur-md rounded-2xl border border-slate-700/50 shadow-lg overflow-hidden flex flex-col transition-all duration-300 hover:border-cyan-500/50 hover:shadow-cyan-500/20 hover:-translate-y-1 block relative z-10"
         x-cloak>
        
        <!-- Image Container -->
        <a href="{{ route('products.show', $product) }}" class="relative w-full h-56 overflow-hidden bg-navy-900/50 p-6 flex items-center justify-center block">
            <div class="absolute inset-0 bg-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 radial-gradient"></div>
            
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" 
                     alt="{{ $product->name }}" 
                     loading="lazy"
                     class="relative z-10 max-h-full max-w-full object-contain transition-transform duration-500 transform group-hover:scale-110 group-hover:drop-shadow-glow">
            @else
                 <div class="relative z-10 text-slate-600">
                    <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                 </div>
            @endif

            <!-- Quick View Badge -->
            <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-20">
                <span class="bg-black/70 backdrop-blur text-white text-[10px] px-3 py-1 rounded-full uppercase tracking-widest font-bold">View Details</span>
            </div>
        </a>

        <!-- Content -->
        <div class="p-5 flex-grow flex flex-col">
            <a href="{{ route('products.show', $product) }}">
                <h5 class="text-lg font-bold text-white mb-1 leading-tight group-hover:text-cyan-400 transition-colors">{{ $product->name }}</h5>
            </a>
            
            <!-- Description -->
            <p class="text-slate-400 text-sm mb-4 line-clamp-2 leading-relaxed flex-grow">{{ $product->description }}</p>

            <div class="mt-auto">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 font-montserrat">${{ number_format($product->price, 2) }}</span>
                    <span class="text-xs text-slate-500 font-medium px-2 py-1 bg-slate-800 rounded border border-slate-700">Stock: {{ $product->stock }}</span>
                </div>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <x-button class="w-full text-sm py-2.5 font-semibold group-hover:shadow-cyan-500/25">
                        <div class="flex items-center justify-center space-x-2">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                             <span>Add to Cart</span>
                        </div>
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</div>
