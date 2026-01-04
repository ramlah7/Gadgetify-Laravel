@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-4xl mx-auto">
        <!-- Welcome Hero -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 border border-slate-700/50 rounded-2xl p-8 mb-8 shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            
            <h1 class="text-3xl font-bold text-white mb-2 relative z-10">
                Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-slate-400 mb-6 relative z-10">Ready to explore the latest in high-end tech?</p>
            
            <div class="flex flex-wrap gap-4 relative z-10">
                <a href="{{ route('products.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2 rounded-full font-medium transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 flex items-center group-hover:px-8 duration-300">
                    Browse Store
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order History Card -->
            <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-blue-500/30 transition-all hover:bg-slate-800/80 group">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-white">Recent Orders</h2>
                    <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400 group-hover:text-blue-300 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <p class="text-slate-400 mb-4">Track your gadget purchases and view history.</p>
                <a href="{{ route('orders.history') }}" class="text-blue-400 hover:text-blue-300 font-medium inline-flex items-center transition-colors">
                    View History &rarr;
                </a>
            </div>

            <!-- Profile Settings Card -->
            <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-cyan-500/30 transition-all hover:bg-slate-800/80 group">
                 <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-white">Account Settings</h2>
                    <div class="p-2 bg-cyan-500/10 rounded-lg text-cyan-400 group-hover:text-cyan-300 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-slate-400 mb-4">Manage your delivery address and preferences.</p>
                <!-- Assuming a profile route exists or using a placeholder -->
                <span class="text-slate-500 cursor-not-allowed">Coming Soon</span>
            </div>
        </div>
        
        @if (session('status'))
            <div class="mt-8 p-4 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>
@endsection

