@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-blue-500/20 rounded-full blur-3xl -z-10 animate-pulse-slow"></div>
        <h1 class="text-4xl md:text-6xl font-black font-montserrat bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 tracking-tighter mb-4 drop-shadow-[0_0_15px_rgba(59,130,246,0.5)]">
            NEXT GEN GEAR
        </h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg font-light tracking-wide">
            Upgrade your reality with our curated collection of high-performance tech.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="col-span-full h-96 flex flex-col items-center justify-center text-center">
                <div class="bg-navy-800/50 backdrop-blur rounded-3xl p-10 border border-slate-700 shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/10 to-transparent opacity-50"></div>
                    <svg class="h-20 w-20 mx-auto text-slate-600 mb-6 group-hover:text-cyan-500 transition-colors duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    <p class="text-2xl text-white font-bold mb-2">System Empty</p>
                    <p class="text-slate-400">No signals detected. Check back later.</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="mt-16 mb-8 flex justify-center">
        <div class="bg-navy-800/80 backdrop-blur rounded-xl border border-slate-700/50 p-2 shadow-lg">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection


