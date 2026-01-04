<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gadgetify') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-navy-900 text-slate-50 antialiased selection:bg-blue-500 selection:text-white font-sans" x-data="{ 
    mobileMenu: false, 
    searchQuery: '', 
    cartCount: {{ auth()->check() ? auth()->user()->cartItems()->sum('quantity') : 0 }},
    scrolled: false
}" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <div id="app" class="min-h-screen flex flex-col relative overflow-x-hidden">
        
        <!-- Cyberpunk Background Glows -->
        <div class="fixed inset-0 pointer-events-none z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-blue-600/10 rounded-full blur-[100px] animate-pulse-slow"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] bg-cyan-500/10 rounded-full blur-[100px] animate-pulse-slow" style="animation-delay: 1.5s"></div>
        </div>

        <!-- Desktop Navbar -->
        <nav :class="{ 'bg-navy-900/90 shadow-blue-500/10': scrolled, 'bg-transparent': !scrolled }" 
             class="fixed w-full top-0 z-50 transition-all duration-300 backdrop-blur-md border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="group relative">
                            <span class="text-2xl font-bold font-montserrat bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 tracking-wider group-hover:opacity-80 transition-opacity">
                                GADGETIFY
                            </span>
                            <div class="absolute -bottom-1 left-0 w-0 h-0.5 bg-cyan-400 transition-all group-hover:w-full box-shadow-glow"></div>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex space-x-8 items-center">
                        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Dashboard</x-nav-link>
                        <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">Products</x-nav-link>
                    </div>

                    <!-- Smart Search (Desktop) -->
                    <div class="hidden md:flex flex-1 max-w-md mx-8 relative" @click.away="searchQuery = ''">
                        <input x-model.debounce.300ms="searchQuery" 
                               type="text" 
                               class="w-full bg-navy-800/50 border border-slate-700/50 rounded-full py-2.5 pl-5 pr-12 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition-all shadow-lg"
                               placeholder="Search gadgets...">
                        
                        <div class="absolute right-3 top-2.5 text-slate-400">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>

                        <!-- Debounced Results Dropdown -->
                        <div x-show="searchQuery.length > 0" 
                             x-transition 
                             class="absolute top-12 left-0 w-full bg-navy-800/95 backdrop-blur-xl border border-slate-700 rounded-xl shadow-2xl z-50 overflow-hidden"
                             x-cloak>
                            <div class="p-3 border-b border-slate-700/50">
                                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold px-2">Quick Results</span>
                            </div>
                            <!-- Mock Results -->
                            <div class="max-h-60 overflow-y-auto">
                                <a href="#" class="block px-4 py-3 hover:bg-white/5 transition-colors flex items-center">
                                    <div class="w-8 h-8 rounded bg-slate-700 mr-3 animate-pulse"></div> <!-- Skeleton Img -->
                                    <div>
                                        <p class="text-sm font-medium text-white">Searching for "<span x-text="searchQuery"></span>"...</p>
                                        <p class="text-xs text-slate-500">View all results</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Icons -->
                    <div class="hidden md:flex items-center space-x-6">
                        @auth
                            <a href="{{ route('cart.index') }}" class="relative group text-slate-300 hover:text-cyan-400 transition-colors">
                                <span class="sr-only">Cart</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1 -right-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-lg"></span>
                            </a>
                            
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                                <button @click="open = !open" class="flex items-center space-x-2 text-slate-300 hover:text-white focus:outline-none">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 p-[2px]">
                                        <div class="w-full h-full rounded-full bg-navy-900 flex items-center justify-center text-xs font-bold">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-navy-800 border border-slate-700 rounded-lg shadow-xl py-2 z-50">
                                    <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white">My Orders</a>
                                    <div class="border-t border-slate-700/50 my-1"></div>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-red-400 hover:bg-white/5 hover:text-red-300">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Login</a>
                                <x-button href="{{ route('register') }}" class="py-2 px-4 text-xs">Register</x-button>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow pt-24 pb-24 md:pb-12 z-10 px-4 sm:px-6 lg:px-8 relative">
            <div class="max-w-7xl mx-auto">
                 @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-navy-900 border-t border-slate-800 py-12 pb-24 md:pb-12">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-slate-500 font-medium">&copy; {{ date('Y') }} Gadgetify. Designed for the Future.</p>
            </div>
        </footer>

        <!-- Mobile Bottom Navigation (Sticky) -->
        <div class="md:hidden fixed bottom-0 left-0 w-full bg-navy-900/90 backdrop-blur-lg border-t border-slate-700/50 z-50 pb-[env(safe-area-inset-bottom)]">
            <div class="flex justify-around items-center h-16 px-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center space-y-1 w-full h-full text-slate-400 hover:text-cyan-400 {{ request()->routeIs('home') ? 'text-cyan-400' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-[10px] font-medium">Home</span>
                </a>
                
                <a href="{{ route('products.index') }}" class="flex flex-col items-center justify-center space-y-1 w-full h-full text-slate-400 hover:text-cyan-400 {{ request()->routeIs('products.index') ? 'text-cyan-400' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    <span class="text-[10px] font-medium">Shop</span>
                </a>

                @auth
                <a href="{{ route('cart.index') }}" class="relative flex flex-col items-center justify-center space-y-1 w-full h-full text-slate-400 hover:text-cyan-400 {{ request()->routeIs('cart.index') ? 'text-cyan-400' : '' }}">
                    <div class="relative p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1 -right-1 bg-cyan-500 text-white text-[10px] font-bold px-1 rounded-full"></span>
                    </div>
                    <span class="text-[10px] font-medium">Cart</span>
                </a>

                <div x-data="{ open: false }" class="relative w-full h-full">
                    <button @click="open = !open" class="flex flex-col items-center justify-center space-y-1 w-full h-full text-slate-400 hover:text-cyan-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="text-[10px] font-medium">Profile</span>
                    </button>
                    <!-- Mobile Menu Dropup -->
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute bottom-full left-0 w-full bg-navy-800/95 backdrop-blur-xl border-t border-slate-700/50 rounded-t-2xl shadow-2xl p-4 mb-2 z-50">
                        <div class="flex items-center space-x-3 mb-4 p-2 bg-white/5 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-white font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <a href="{{ route('orders.history') }}" class="block px-4 py-3 text-slate-300 hover:bg-white/5 rounded-lg mb-2">My Orders</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-3 text-red-400 hover:bg-white/5 rounded-lg">Logout</a>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="flex flex-col items-center justify-center space-y-1 w-full h-full text-slate-400 hover:text-cyan-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    <span class="text-[10px] font-medium">Login</span>
                </a>
                @endauth
            </div>
        </div>
        
        <!-- Forms -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</body>
</html>

