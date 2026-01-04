<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-50 antialiased selection:bg-purple-500 selection:text-white">
    <div id="app" class="min-h-screen flex flex-col">
        <nav class="sticky top-0 z-50 bg-slate-900/95 backdrop-blur-md border-b border-purple-900/50 shadow-lg shadow-purple-900/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-400 tracking-wider hover:opacity-80 transition-opacity flex items-center gap-2" href="{{ url('/') }}">
                            GADGETIFY <span class="text-xs px-2 py-0.5 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 font-medium tracking-wide">ADMIN</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                         <ul class="flex items-center space-x-4 mb-0 pl-0 list-none">
                            <li class="nav-item">
                                <a class="text-slate-300 hover:text-white hover:bg-slate-800 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.products*') ? 'bg-slate-800 text-white' : '' }}" href="{{ route('admin.products.index') }}">Products</a>
                            </li>
                         </ul>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <div class="flex items-center space-x-4">
                        <ul class="flex items-center space-x-4 mb-0 pl-0 list-none">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a class="text-slate-300 hover:text-white transition-colors px-3 py-2 rounded-md text-sm font-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li>
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="relative group">
                                    <button class="flex items-center space-x-2 text-slate-300 hover:text-white focus:outline-none">
                                        <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold shadow-lg shadow-purple-600/50">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium hidden sm:inline-block">{{ Auth::user()->name }}</span>
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div class="absolute right-0 mt-2 w-48 bg-slate-800 rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                                        <a class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none hidden">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow py-8 bg-slate-900 border-l border-slate-800 relative">
             <!-- Background elements for depth -->
             <div class="absolute top-0 right-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
                <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600/5 rounded-full blur-3xl"></div>
             </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
        
        <footer class="bg-slate-900 border-t border-slate-800 py-6 mt-auto">
             <div class="max-w-7xl mx-auto px-4 text-center text-slate-600 text-sm">
                 &copy; {{ date('Y') }} Gadgetify Admin Panel.
             </div>
        </footer>
    </div>
</body>
</html>
