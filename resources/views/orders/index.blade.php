@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center space-x-2 text-slate-400 text-sm mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Dashboard</a>
        <span>/</span>
        <span class="text-slate-200">History</span>
    </div>

    <h1 class="text-3xl font-bold text-white mb-8">Order History</h1>

    @if ($orders->isEmpty())
        <div class="bg-slate-800/50 backdrop-blur-md rounded-2xl p-12 text-center border border-slate-700/50">
            <div class="text-slate-500 mb-4">
                <svg class="w-16 h-16 mx-auto opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h2 class="text-xl font-medium text-white mb-2">No past orders</h2>
            <p class="text-slate-400 mb-6">You haven't purchased any gadgets yet.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium transition-all shadow-lg shadow-blue-600/20">
                Browse Products
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                <details class="group bg-slate-800/60 backdrop-blur-md rounded-xl border border-slate-700/50 overflow-hidden open:ring-1 open:ring-blue-500/50 transition-all">
                    <summary class="flex flex-col md:flex-row items-start md:items-center justify-between p-6 cursor-pointer hover:bg-slate-800/80 transition-colors list-none">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-slate-900 rounded-lg text-blue-400">
                                <svg class="w-6 h-6 group-open:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Order #{{ $order->id }}</h3>
                                <p class="text-slate-400 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex items-center space-x-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $order->status === 'completed' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-slate-700 text-slate-300 border border-slate-600' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                            <span class="text-xl font-bold text-white">
                                ${{ number_format($order->total_price, 2) }}
                            </span>
                        </div>
                    </summary>
                    
                    <div class="p-6 pt-0 border-t border-slate-700/50">
                        <div class="py-4 text-slate-300 text-sm">
                            <strong class="text-slate-500 uppercase text-xs tracking-wider">Shipping To:</strong> <br>
                            {{ $order->shipping_address }}
                        </div>

                        <div class="mt-4 bg-slate-900/50 rounded-lg overflow-hidden">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-900 text-slate-500 uppercase text-xs font-semibold">
                                    <tr>
                                        <th class="px-4 py-3">Product</th>
                                        <th class="px-4 py-3 text-center">Qty</th>
                                        <th class="px-4 py-3 text-center">Price</th>
                                        <th class="px-4 py-3 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800">
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="px-4 py-3 text-white">
                                                {{ $item->product ? $item->product->name : 'Product Deleted' }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-slate-400">{{ $item->quantity }}</td>
                                            <td class="px-4 py-3 text-center text-slate-400">${{ number_format($item->price_at_purchase, 2) }}</td>
                                            <td class="px-4 py-3 text-right text-white font-medium">${{ number_format($item->quantity * $item->price_at_purchase, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>
            @endforeach
        </div>
    @endif
</div>
@endsection

