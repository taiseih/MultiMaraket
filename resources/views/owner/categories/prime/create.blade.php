<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('カテゴリー登録') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-12 mx-auto">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">オーナー登録</h1>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            {{-- バリデーション --}}
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('owner.categories.prime.store') }}">
                @csrf
            <div class="-m-2">
              <div class="p-2 w-1/2 mx-auto" >
                <div class="relative">
                  <label for="name" class="leading-7 text-sm text-gray-600">大カテゴリー名</label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>

              <div class="p-2 w-1/2 mx-auto">
                <div class="relative">
                  <label for="number" class="leading-7 text-sm text-gray-600">ソート番号</label>
                  <input type="number" id="sort" name="sort" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
             
              <div class="p-2 w-full flex justify-around mt-4">
                <button type="button" onclick="location.href='{{ route('owner.categories.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>                        
              </div>
              
            </div>
        </form>
          </div>
        </div>
      </section>
</x-app-layout>
