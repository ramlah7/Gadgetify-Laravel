@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 h-full flex justify-center items-center py-12">
    <div class="w-full max-w-md">
        <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl border border-slate-700/50 shadow-2xl overflow-hidden">
            <div class="bg-slate-900/50 px-8 py-6 border-b border-slate-700/50">
                <h2 class="text-2xl font-bold text-white text-center">{{ __('Welcome Back') }}</h2>
                <p class="text-slate-400 text-center text-sm mt-1">Sign in to access your account</p>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 focus:ring-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                        @error('email')
                            <span class="text-red-400 text-xs mt-1 block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 focus:ring-red-500 @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        @error('password')
                            <span class="text-red-400 text-xs mt-1 block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <input class="w-4 h-4 rounded border-slate-600 bg-slate-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-800" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="ml-2 text-sm text-slate-400" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5">
                        {{ __('Login') }}
                    </button>
                    
                    <div class="mt-6 text-center text-slate-500 text-sm">
                        Don't have an account? <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

