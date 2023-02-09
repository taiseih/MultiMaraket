<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ショップ情報') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('shopUpdate'))
                    <div class="bg-indigo-400 text-white mx-auto w-1/4 py-2" >
                        {{ session('shopUpdate') }}
                       </div>
                    @endif
                    @foreach ($shops as $shop)
                    <div class="w-1/2 p-4">
                        <a href="{{ route('owner.shops.edit', ['shop' => $shop->id]) }}">
                            <div class="border rounded-md p-4">
                                <div class="mb-4">
                                    @if ($shop->is_selling == true)
                                        <span class="border p-2 rounded-md bg-indigo-500 text-white">販売中</span>
                                    @else
                                        <span class="border p-2 rounded-md bg-red-400 text-white">停止中</span>
                                    @endif
                                </div>
                                <div class="text-xl">
                                    {{ $shop->name }}
                                </div>
                                @if (empty($shop->filename))
                                    <img src="{{ asset('images/no-image.png') }}">
                                @else
                                    <img src="{{ asset('storage/shops/'. $shop->filename) }}">
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    