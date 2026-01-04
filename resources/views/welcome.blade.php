<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Gadgetify') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-navy-900 text-slate-50 antialiased font-sans selection:bg-blue-500 selection:text-white overflow-x-hidden">
        
        <!-- Background Effects -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <div class="absolute top-[-10%] right-[-5%] w-[40vw] h-[40vw] bg-blue-600/10 rounded-full blur-[100px] animate-pulse-slow"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[40vw] h-[40vw] bg-cyan-500/10 rounded-full blur-[100px] animate-pulse-slow" style="animation-delay: 2s"></div>
        </div>

        <div class="relative z-10 min-h-screen flex flex-col justify-center text-white">
            
            <!-- Navbar -->
            <nav class="absolute top-0 w-full p-6 flex justify-between items-center z-50">
                <div class="text-2xl font-bold font-montserrat tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400">
                    GADGETIFY
                </div>
                <div class="space-x-6">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-white/10 hover:bg-white/20 border border-white/10 rounded-full transition-all backdrop-blur-md">Register</a>
                        @endif
                    @endauth
                </div>
            </nav>

            <!-- Hero Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20 pb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-300 text-xs font-semibold tracking-wide uppercase mb-8 backdrop-blur-sm animate-float">
                    <span class="w-2 h-2 rounded-full bg-blue-400 mr-2 animate-pulse"></span>
                    Next Gen Tech Store
                </div>
                
                <h1 class="text-5xl md:text-7xl font-extrabold font-montserrat tracking-tight mb-6">
                    <span class="block text-white drop-shadow-lg">Upgrade Your</span>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-cyan-400 to-teal-300 animate-gradient-x">Digital Reality</span>
                </h1>
                
                <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400 font-light leading-relaxed">
                    Experience the future of electronics. Premium gadgets, curated for the modern enthusiast. 
                    Same-day shipping on all cyber-decks and neural-links.
                </p>
                
                <div class="mt-10 flex justify-center gap-6">
                    <a href="{{ route('products.index') }}" class="group relative px-8 py-4 bg-blue-600 text-white font-bold rounded-full overflow-hidden shadow-lg shadow-blue-600/40 transition-all hover:scale-105 hover:shadow-blue-600/60">
                        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer"></div>
                        <span class="relative flex items-center">
                            Shop Now 
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </a>
                    
                    <a href="#features" class="px-8 py-4 bg-slate-800/50 text-slate-300 font-semibold rounded-full border border-slate-700 hover:bg-slate-800 hover:text-white transition-all backdrop-blur-md">
                        Learn More
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div id="features" class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-sm hover:bg-slate-800/60 hover:border-blue-500/30 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">High Performance</h3>
                    <p class="text-slate-400 text-sm">Top-tier hardware verified for maximum efficiency and speed.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-sm hover:bg-slate-800/60 hover:border-cyan-500/30 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Secure Payments</h3>
                    <p class="text-slate-400 text-sm">Encrypted transactions ensuring your credits are always safe.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-sm hover:bg-slate-800/60 hover:border-purple-500/30 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Fast Shipping</h3>
                    <p class="text-slate-400 text-sm">Global delivery network. Drone drops available in select sectors.</p>
                </div>
            </div>

            <footer class="mt-auto py-8 text-center text-slate-600 text-sm">
                &copy; {{ date('Y') }} Gadgetify Systems. All rights reserved.
            </footer>
        </div>
    </body>
</html>
