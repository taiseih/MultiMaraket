<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('オーナー一覧') }}
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
                    @endif
                      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                            <tr>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">発送先住所</th>
                              <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                              <th class="w-10 title-font tracking-wider bg-gray-100 rounded-tr rounded-br"></th>
                              <th class="w-10 title-font tracking-wider bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="md:px-4 py-3">{{ $users->name }}</td>
                              <td class="md:px-4 py-3">{{ $users->email }}</td>
                              <td class="md:px-4 py-3">{{ $users->address }}</td>
                              <td class="md:px-4 py-3">{{ $users->created_at->diffForHumans() }}</td>
                              <td class="w-28">
                                <button onclick="location.href='{{ route('user.edit', ['user' => $users->id ])}}'" class="text-white bg-indigo-400 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-500 rounded ">編集する</button>                                                      </td>
                             </td>
                          </tr>
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