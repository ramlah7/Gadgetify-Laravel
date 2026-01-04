@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 h-full flex justify-center items-center py-12">
    <div class="w-full max-w-md">
        <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl border border-slate-700/50 shadow-2xl overflow-hidden">
            <div class="bg-slate-900/50 px-8 py-6 border-b border-slate-700/50">
                <h2 class="text-2xl font-bold text-white text-center">{{ __('Create Account') }}</h2>
                <p class="text-slate-400 text-center text-sm mt-1">Join the Gadgetify community</p>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Name') }}</label>
                        <input id="name" type="text" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 focus:ring-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
                        @error('name')
                            <span class="text-red-400 text-xs mt-1 block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 focus:ring-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                        @error('email')
                            <span class="text-red-400 text-xs mt-1 block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 focus:ring-red-500 @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                        @error('password')
                            <span class="text-red-400 text-xs mt-1 block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="password-confirm" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5">
                        {{ __('Register') }}
                    </button>

                    <div class="mt-6 text-center text-slate-500 text-sm">
                        Already have an account? <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

