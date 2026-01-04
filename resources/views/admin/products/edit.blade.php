@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-slate-800 shadow-xl rounded-lg border border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-700 bg-slate-800/50 backdrop-blur-sm">
            <h2 class="text-xl font-bold text-white">{{ __('Edit Product') }}</h2>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Name') }}</label>
                    <input id="name" type="text" class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('name') border-red-500 focus:ring-red-500 @enderror" name="name" value="{{ old('name', $product->name) }}" required autofocus>
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Description') }}</label>
                    <textarea id="description" rows="4" class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('description') border-red-500 focus:ring-red-500 @enderror" name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Price') }}</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-slate-500">$</span>
                            <input id="price" type="number" step="0.01" class="w-full bg-slate-900 border border-slate-600 rounded-lg pl-8 pr-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('price') border-red-500 focus:ring-red-500 @enderror" name="price" value="{{ old('price', $product->price) }}" required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Stock') }}</label>
                        <input id="stock" type="number" class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('stock') border-red-500 focus:ring-red-500 @enderror" name="stock" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image_path" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Image') }}</label>
                        
                    @if($product->image_path)
                        <div class="mb-3 flex items-start space-x-4 p-4 bg-slate-900 rounded-lg border border-slate-700">
                             <img src="{{ asset('storage/' . $product->image_path) }}" alt="Current Image" class="h-24 w-24 object-cover rounded-md border border-slate-600">
                             <div>
                                 <p class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-1">Current Image</p>
                                 <p class="text-sm text-slate-300">New uploads will replace this image.</p>
                             </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-center w-full">
                        <label for="image_path" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-600 border-dashed rounded-lg cursor-pointer bg-slate-900 hover:bg-slate-800 transition-colors @error('image_path') border-red-500 @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-slate-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-slate-500">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                            </div>
                            <input id="image_path" type="file" class="hidden" name="image_path" />
                        </label>
                    </div> 
                    @error('image_path')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="sr-only peer" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        <span class="ml-3 text-sm font-medium text-slate-300">{{ __('Active Product') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-semibold rounded-lg shadow-lg shadow-purple-500/30 transform hover:-translate-y-0.5 transition-all">
                        {{ __('Update Product') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
