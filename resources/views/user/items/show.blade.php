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
                <div class="md:w-1/2">
                    <!-- Slider main container -->
                  <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                      <!-- Slides -->
                      <div class="swiper-slide">
                        @if ($product->imageFirst->filename !== null)
                          <img src="{{ asset('storage/products/' . $product->imageFirst->filename )}}">
                        @else
                        <img src="">
                        @endif
                      </div>
                      <div class="swiper-slide">
                        @if ($product->imageSecond->filename !== null)
                          <img src="{{ asset('storage/products/' . $product->imageSecond->filename )}}">
                        @else
                        <img src="">
                        @endif
                      </div>
                      <div class="swiper-slide">
                        @if ($product->imageThird->filename !== null)
                          <img src="{{ asset('storage/products/' . $product->imageThird->filename )}}">
                        @else
                        <img src="">
                        @endif
                      </div>
                      <div class="swiper-slide">
                        @if ($product->imageFourth->filename !== null)
                          <img src="{{ asset('storage/products/' . $product->imageFourth->filename )}}">
                        @else
                        <img src="">
                        @endif
                      </div>
                      
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                  </div>
                  </div>
                  <div class="md:w-1/2 ml-4">
                    <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">{{ $product->category->name }}</h2>
                    <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">{{ $product->name }}</h1>
                    <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                    <div class="flex justify-around items-center">
                      
                      
                        {{-- end tailblocks --}}
                        
                        <div class="flex justify-around w-full lg:py-6 mb-6 lg:mb-0"> 
                                  <div class="w-full flex justify-around items-center">
                          <div class=""><span class="title-font font-medium text-2xl text-gray-900">{{ number_format($product->price) }}</span><span class="text-sm text-gray-700">円(税込)</span></div>                                    
                          <form method="post" action="{{ route('user.cart.add') }}">
                            @csrf
                                  <div class="flex items-center">
                                  <span class="mr-3">数量</span>
                                  <div class="relative">
                                  <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                     @for ($i = 1; $i <= $quantity; $i++)
                                      <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                  </select>
                                  </div>
                                  </div>
                            
                              </div>
                                <button class="w-full m-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                              </form>
                             
                          </div>
                            @if (auth()->check())
                                @if ($userLike)
                                    <button id="like-button-{{$product->id}}" class="text-red-600" onclick="dislike({{$product->id}})"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                      </svg>
                                    </button>
                                @else
                                    <button id="like-button-{{$product->id}}" class="" onclick="like({{$product->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                @endif
                            @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-400 mt-8 "></div>
            <div class="mt-8 mb-4 text-center">ショップ情報</div>
            <div class="mb-4 text-center">{{ $product->shop->name }}</div>
            <div class="mb-4 text-center">
              @if ($product->shop->filename !== null)
                          <img class="mx-auto w-40 h-40 rounded-full object-cover" src="{{ asset('storage/shops/' . $product->shop->filename )}}">
                        @else
                        <img src="">
                        @endif
            </div>
            <div class="mb-4 text-center">
              <button data-micromodal-trigger="modal-1" href='javascript:;' type="button" class=" w-1/4 m-auto text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-700 rounded">詳細</button>
            </div>
        </div>
    </div>

    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
      <div class="modal__overlay z-50" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
          <header class="modal__header">
            <h2 class="text-xl text-gray-700" id="modal-1-title">
              {{ $product->shop->name }}
            </h2>
            <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <main class="modal__content" id="modal-1-content">
            <p>
              {{ $product->shop->information}}
            </p>
          </main>
          <footer class="modal__footer">
            <button type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
          </footer>
        </div>
      </div>
  </div>

    <script src="{{ mix('js/swiper.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script>
  function like(productId) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: `/like/${productId}`,
      type: "POST",
    })
      .done(function (data, status, xhr) {
        updateLikeButton(productId);
        console.log('いいねしました')
      })
      .fail(function (xhr, status, error) {
        console.log('false');
      });
  }

  function dislike(productId) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: `/dislike/${productId}`,
      type: "POST",
    })
      .done(function (data, status, xhr) {
        console.log('いいねを解除しました')
        updateLikeButton(productId);
      })
      .fail(function (xhr, status, error) {
        console.log('false');
      });
  }

  function updateLikeButton(productId) {
    const likeButton = $("#like-button-" + productId);


    if (likeButton.hasClass("text-red-600")) {
      likeButton.removeClass("text-red-600");
    } else {
      likeButton.addClass("text-red-600");
    }
  }
</script>
</x-app-layout>
