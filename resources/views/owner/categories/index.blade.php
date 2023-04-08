<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('カテゴリー') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">

                <section class="text-gray-600 body-font">
                    <div class="container md:px-5 mx-auto">
                        @if (session('message'))
                        <div class="bg-indigo-400 text-white mx-auto w-1/4 py-2" >
                         {{ session('message') }}
                        </div>
                        @elseif (session('alert'))
                        <div class="bg-red-400 text-white mx-auto w-1/4 py-2" >
                          {{ session('alert') }} 
                        </div>
                    @endif
                      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">大カテゴリー</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ソート番号</th>
                              <th class="w-48 title-font tracking-wider bg-gray-100 rounded-tr rounded-br text-center">                            
                                <button onclick="location.href='{{ route('owner.categories.prime.create') }}'" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>                        
                                </th>
                              <th class="w-10 title-font tracking-wider bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($primeCategories as $primeCategory)
                            <tr>
                            <td class="md:px-4 py-3">{{ $primeCategory->id }}</td>
                            <td class="md:px-4 py-3">{{ $primeCategory->name }}</td>
                            <td class="md:px-4 py-3">{{ $primeCategory->sort_order }}</td>
                          </tr>
                              @endforeach 
                          </tbody>
                        </table>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">小カテゴリー</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">大カテゴリーID</th>
                              <th class="w-48 title-font tracking-wider bg-gray-100 rounded-tr rounded-br text-center">                            
                                <button onclick="location.href='{{ route('owner.categories.second.create') }}'" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>                        
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($secondCategories as $secondCategory)
                            <tr>
                            <td class="md:px-4 py-3">{{ $secondCategory->id }}</td>
                            <td class="md:px-4 py-3">{{ $secondCategory->name }}</td>
                            <td class="md:px-4 py-3">{{ $secondCategory->primary_category_id }}</td>
                          </tr>
                              @endforeach
                          </tbody>
                        </table>
                      </div>
                      
                    </div>
                  </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
