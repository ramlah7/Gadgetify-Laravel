@props(['type' => 'submit', 'variant' => 'primary', 'fullWidth' => false])

@php
    $baseClasses = 'inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-navy-900 transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $variants = [
        'primary' => 'bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white shadow-blue-500/20',
        'secondary' => 'bg-navy-700/50 backdrop-blur-md border border-navy-700 text-gray-300 hover:bg-navy-700 hover:text-white',
        'danger' => 'bg-red-600 hover:bg-red-500 text-white shadow-red-500/20',
    ];
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ($fullWidth ? ' w-full' : '');
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
