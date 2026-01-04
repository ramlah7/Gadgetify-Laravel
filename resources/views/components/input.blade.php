@props(['disabled' => false, 'label' => '', 'error' => null])

<div class="mb-4">
    @if($label)
        <label {{ $attributes->whereStartsWith('id') ? 'for='.$attributes->get('id') : '' }} class="block text-sm font-medium text-slate-300 mb-2">
            {{ $label }}
        </label>
    @endif

    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-navy-900/50 border ' . ($error ? 'border-red-500 focus:ring-red-500' : 'border-slate-700 focus:ring-blue-500') . ' rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:border-transparent transition-all shadow-inner']) !!}>

    @if($error)
        <p class="mt-1 text-xs text-red-400">{{ $error }}</p>
    @endif
</div>
