<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザー情報編集') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font relative bg-white">
        <div class="container px-5 py-12 mx-auto">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ユーザー情報編集</h1>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            {{-- バリデーション --}}
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
              @method('PUT')
                @csrf
            <div class="-m-2">
              <div class="p-2 w-1/2 mx-auto" >
                <div class="relative">
                  <label for="name" class="leading-7 text-sm text-gray-600">ユーザー名</label>
                  <input type="text" id="name" name="name" value="{{ $user->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
              <div class="p-2 w-1/2 mx-auto">
                <div class="relative">
                  <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                  <input type="email" id="email" name="email" value="{{ $user->email }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>

             <div class="p-2 w-1/2 mx-auto">
                <div class="relative">
                  <label for="text" class="leading-7 text-sm text-gray-600">発送先住所</label>
                  <input type="text" id="address" name="address" value="{{ $user->address }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>

              <div class="p-2 w-full flex justify-around mt-4">
                <button type="button" onclick="location.href='{{ route('user.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集を完了する</button>                        
              </div>
              
            </div>
        </form>
          </div>
        </div>
      </section>
</x-app-layout>
