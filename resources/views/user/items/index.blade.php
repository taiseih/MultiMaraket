<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        @foreach ($products as $product)
                            <div class="w-1/4 p-2 md:p-4">
                                <a href="{{ route('user.items.show', ['item' => $product->id]) }}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">
                                    <div class="border rounded-md:p-4">
                                            @if (empty($product->filename ?? ''))
                                                <img src="{{ asset('images/no-image.png') }}">
                                            @else
                                                <img src="{{ asset('storage/products/'. $product->filename) }}">
                                            @endif
                                    </div>
                                </a>
                                <div class="p-6">
                                    {{-- $productのcategoryはProductモデルのcategoryメソッドから取得 --}}
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ $product->category }}</h2>
                                    <h1 class="title-font text-lg font-medium text-gray-700 mb-3">{{$product->name}}</h1>
                                    <p class="leading-relaxed mb-3 text-gray-700 md:text-sm">{{number_format($product->price).'円（税込）'}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
