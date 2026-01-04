@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb & Progress -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="flex items-center space-x-2 text-slate-400 text-sm mb-4 md:mb-0">
            <a href="{{ route('products.index') }}" class="hover:text-cyan-400 transition-colors">Shop</a>
            <span class="text-slate-600">/</span>
            <span class="text-white">Cart</span>
        </div>
        
        <!-- Checkout Progress Bar -->
        @if (!$cartItems->isEmpty())
        <div class="flex items-center space-x-4">
            <div class="flex items-center text-cyan-400">
                <div class="w-6 h-6 rounded-full bg-cyan-500/20 border border-cyan-500 flex items-center justify-center text-xs font-bold mr-2 shadow-[0_0_10px_rgba(34,211,238,0.5)]">1</div>
                <span class="text-sm font-semibold tracking-wide">Review & Shipping</span>
            </div>
            <div class="w-12 h-px bg-slate-700"></div>
            <div class="flex items-center text-slate-600">
                <div class="w-6 h-6 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-xs font-bold mr-2">2</div>
                <span class="text-sm font-medium">Complete</span>
            </div>
        </div>
        @endif
    </div>

    @if ($cartItems->isEmpty())
        <div class="min-h-[60vh] flex flex-col items-center justify-center text-center">
            <div class="bg-navy-800/50 backdrop-blur-md rounded-3xl p-12 border border-slate-700/50 relative overflow-hidden group max-w-lg w-full">
                <div class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative z-10">
                    <div class="w-24 h-24 mx-auto bg-slate-800/50 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-10 h-10 text-slate-500 group-hover:text-cyan-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Your Cart is Empty</h2>
                    <p class="text-slate-400 mb-8">Looks like you haven't initiated any heavy logistics yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold transition-all shadow-lg shadow-blue-500/20 transform hover:-translate-y-1">
                        Initialize Shopping Protocol
                        <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items List -->
            <div class="lg:col-span-2">
                <div class="bg-navy-800/60 backdrop-blur-md rounded-2xl border border-slate-700/50 overflow-hidden shadow-xl">
                    <div class="p-6 border-b border-white/5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            Inventory Items 
                            <span class="ml-3 px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-400 text-xs border border-blue-500/20">{{ $cartItems->sum('quantity') }}</span>
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-navy-900/50 text-slate-400 uppercase text-xs font-semibold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Product</th>
                                    <th class="px-6 py-4 text-center">Price</th>
                                    <th class="px-6 py-4 text-center">Qty</th>
                                    <th class="px-6 py-4 text-right">Total</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/50">
                                @foreach ($cartItems as $item)
                                    <tr class="group hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0 w-20 h-20 rounded-xl bg-navy-900 overflow-hidden border border-slate-700">
                                                    @if($item->product && $item->product->image_path)
                                                        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-slate-600">
                                                            <svg class="w-8 h-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-bold text-white group-hover:text-cyan-400 transition-colors text-lg">
                                                        {{ $item->product ? $item->product->name : 'Item Removed' }}
                                                    </div>
                                                    <div class="text-xs text-slate-500 mt-1 uppercase tracking-wider">ID: {{ $item->product_id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center text-slate-300 font-mono">
                                            ${{ number_format($item->product->price ?? 0, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-slate-300">
                                            <div class="inline-flex items-center px-3 py-1 bg-navy-900 rounded-lg border border-slate-700">
                                                {{ $item->quantity }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold text-blue-400 font-mono">
                                            ${{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-500 hover:text-red-400 hover:bg-red-500/10 p-2 rounded-lg transition-colors group/trash" title="Remove Item">
                                                    <svg class="w-5 h-5 group-hover/trash:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Summary & Checkout -->
            <div class="lg:col-span-1">
                <div class="bg-navy-800/60 backdrop-blur-md rounded-2xl border border-slate-700/50 p-6 sticky top-28 shadow-xl">
                    <h2 class="text-lg font-bold text-white mb-6 uppercase tracking-wider border-b border-slate-700/50 pb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Order Summary
                    </h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center text-slate-300">
                            <span>Subtotal</span>
                            <span class="font-mono">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-300">
                            <span>Shipping</span>
                            <span class="text-green-400 text-sm font-bold bg-green-500/10 px-2 py-0.5 rounded border border-green-500/20">FREE</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mb-8 text-2xl font-bold text-white pt-6 border-t border-slate-700/50">
                        <span>Total</span>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400 font-mono">${{ number_format($total, 2) }}</span>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="shipping_address" class="block text-xs font-bold text-cyan-400 uppercase tracking-widest mb-2">Shipping Destination</label>
                            <div class="relative">
                                <textarea class="w-full bg-navy-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all shadow-inner resize-none" id="shipping_address" name="shipping_address" rows="3" placeholder="Enter delivery coordinates..." required></textarea>
                                <div class="absolute bottom-3 right-3 text-slate-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full group relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                            <div class="relative z-10 flex items-center justify-center space-x-2">
                                <span>CONFIRM SEQUENCE</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full bg-white/20 -translate-x-full group-hover:skew-x-12 transition-transform duration-700"></div>
                        </button>
                    </form>
                    
                    <div class="mt-6 flex justify-center space-x-4 opacity-50 grayscale hover:grayscale-0 transition-all duration-300">
                        <!-- Mock Payment Icons -->
                        <div class="h-6 w-10 bg-slate-700 rounded"></div>
                        <div class="h-6 w-10 bg-slate-700 rounded"></div>
                        <div class="h-6 w-10 bg-slate-700 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection


