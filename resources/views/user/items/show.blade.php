<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品の詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:justify-around">
                        {{-- tailblocks --}}
                        <section class="text-gray-600 body-font overflow-hidden">
                            <div class="container px-5 py-24 mx-auto">
                                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                                <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                                    <h2 class="text-gray-900 text-3xl title-font font-medium mb-4">{{$product->shop->name}}</h2>
                                    <div class="flex mb-4">
                                        <h1 class="text-gray-900 title-font font-medium mb-4">{{$product->name}}</h1>
                                    </div>
                                    <p class="leading-relaxed mb-4">{{$product->information}}</p>
                                    
                                    <div class="w-full flex justify-around items-center">
                                    <div class="title-font font-medium text-2xl text-gray-900">{{number_format($product->price)}}<span class="text-sm text-gray-700">円(税込)</span></div>
                                    <div class="flex items-center">
                                    <span class="mr-3">数量</span>
                                    <div class="relative">
                                    <select class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                        <option>SM</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                    </select>
                                    </div>
                                    </div>
                                    <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                                    </div>
                                    
                                </div>
                                  <div class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded">
                                         @if (empty($product->imageFirst->filename ?? ''))
                                            <img src="{{ asset('images/no-image.png') }}">
                                        @else
                                            <img src="{{ asset('storage/products/'. $product->imageFirst->filename) }}">
                                    @endif
                                    </div>
                                    <div class="md:w-1/2"></div>
                                </div>
                            </div>
                        </section>
                        {{-- end tailblocks --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
