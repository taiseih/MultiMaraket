<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('削除済みオーナー') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <section class="text-gray-600 body-font">
                    <div class="container px-5 mx-auto">
                       
                        @if (session('alert'))
                        <div class="bg-red-400 text-white mx-auto w-1/4 py-2" >
                          {{ session('alert') }} 
                        </div>
                        @elseif (session('recovery'))
                        <div class="bg-green-400 text-white mx-auto w-1/4 py-2" >
                          {{ session('recovery') }} 
                        </div>
                    @endif
                      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">失効日</th>
                              <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($expiredOwners as $owner)
                            <tr>
                              <td class="px-4 py-3">{{ $owner->name }}</td>
                              <td class="px-4 py-3">{{ $owner->email }}</td>
                              <td class="px-4 py-3">{{ $owner->deleted_at->diffForHumans() }}</td>
                          {{-- 完全削除ボタン --}}
                            <form id="delete_{{ $owner->id }}" method="POST" action="{{ route('admin.expired-owners.destroy', ['owner' => $owner->id ]) }}">
                              @csrf 
                            <td class="w-32">
                              <a href="#" data-id="{{ $owner->id }}" onclick="deleteButton(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded ">完全に削除</button>                                                      
                            </td>
                            </form>
                            {{-- 復旧ボタン --}}
                            <form method="POST" action="{{ route('admin.expired-owners.restore', ['owner' => $owner->id]) }}">
                                @csrf 
                              <td class="w-32">
                                <button type="submit" onclick="location.href='{{ route('admin.expired-owners.restore', ['owner' => $owner->id]) }}'" class="text-white bg-green-400 border-0 py-2 px-4 focus:outline-none hover:bg-green-500 rounded ">復旧</button>                                                      
                              </td>
                              </form>

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
    <script>
      function deleteButton(e) {
        'use strict';
        if(confirm('削除しても良いですか？')){
        document.getElementById('delete_' + e.dataset.id).submit();
      }
      }    
      </script>


</x-app-layout>
