@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="text-slate-400 hover:text-cyan-400 transition-colors flex items-center mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Products
        </a>
    </div>

    <div class="bg-navy-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Image Section -->
            <div class="bg-navy-900/50 p-8 lg:p-12 flex items-center justify-center relative group">
                <div class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 radial-gradient"></div>
                
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                         alt="{{ $product->name }}" 
                         class="relative z-10 w-full max-w-md object-contain drop-shadow-2xl transition-transform duration-500 transform group-hover:scale-105 group-hover:drop-shadow-glow">
                @else
                    <div class="relative z-10 text-slate-600">
                        <svg class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Details Section -->
            <div class="p-8 lg:p-12 flex flex-col justify-center">
                <div class="mb-6">
                    <h1 class="text-3xl lg:text-4xl font-bold font-montserrat text-white mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 font-montserrat">
                            ${{ number_format($product->price, 2) }}
                        </span>
                        @if($product->stock > 0)
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-semibold uppercase tracking-wide border border-green-500/20">
                                In Stock ({{ $product->stock }})
                            </span>
                        @else
                            <span class="px-3 py-1 bg-red-500/10 text-red-400 rounded-full text-xs font-semibold uppercase tracking-wide border border-red-500/20">
                                Out of Stock
                            </span>
                        @endif
                    </div>
                </div>

                <div class="prose prose-invert prose-slate max-w-none mb-8">
                    <p class="text-slate-300 leading-relaxed">{{ $product->description }}</p>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-end gap-4 mb-6">
                        <div class="flex-1 max-w-[100px]">
                            <label for="quantity" class="block text-sm font-medium text-slate-400 mb-2">Quantity</label>
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product->stock }}" 
                                   class="w-full bg-navy-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-center font-bold">
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-bold rounded-xl shadow-lg shadow-blue-600/20 transform transition-all hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center font-montserrat uppercase tracking-wider"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                    </button>
                    
                    @if (session('success'))
                        <div class="mt-4 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                     @if (session('error'))
                        <div class="mt-4 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
