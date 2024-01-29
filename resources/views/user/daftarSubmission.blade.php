@extends(Auth::user()->role_id == 1 ? 'layout.layout' : 'layouts.app')

@section("title","Daftar Submission")

@section("content")
    <!-- component -->

            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h1 class="text-5xl font-bold text-gray-900 py-4 text-center tracking-wide leading-snug">Daftar Submission</h1>
                    </div> 
                    <div class='flex'>
                        <a href='{{route('user.submission')}}' class="text-black text-md focus:ring-3 focus:ring-blue-300 font-bold rounded-lg px-5 py-2 mb-2 bg-stone-200 hover:bg-stone-300">+</a>
                        <!-- drawer init and show -->
                        <div class="px-2">
                            <button class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-3 focus:ring-blue-300 font-bold rounded-lg text-sm px-8 py-2.5 mb-2 " type="button" data-drawer-target="drawer-form" data-drawer-show="drawer-form" aria-controls="drawer-form">
                            Filters
                            </button>
                        </div>

                        <!-- drawer component -->
                        <div id="drawer-form" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80" tabindex="-1" aria-labelledby="drawer-form-label">
                            <h3 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase">
                                Filters
                            </h3>
                            <button type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center" >
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            <span class="sr-only">Close menu</span>
                            </button>
                            <form action='' method='GET' class="mb-6">
                                <div class="mb-6">
                                    <label for="search_filter" class="block mb-2 text-sm font-medium text-gray-900 ">Search</label>
                                    <input type="text" id="search_filter" name='search_filter' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Search">
                                </div>
                                <div class='mb-6'>
                                    <label for='date' class='block mb-2 text-sm font-medium text-gray-900 '>Tanggal</label>
                                    <input type='date' id='date' name='date' value='' class='form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'/>
                                </div>
                                <div class="mb-6">
                                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Status</label>
                                    <select id="status" name='status' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="all">All</option>
                                        <option value="open">Open</option>
                                        <option value="pending">Pending</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class=" text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 ">
                                    Filter
                                </button>
                            </form>
                        </div>
                        
                    </div>
                    <div class="-mx-8 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            No PPKB
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            PPKB Ke
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Service Code
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Nama Kapal
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Keagenan
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Tanggal Dibuat
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = $submission->firstItem() ?>
                                    @foreach ($submission as $item)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->id}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <form method="POST" action="{{ route('submission.update', ['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Progress">
                                                    <button type="submit" class="text-gray-900 whitespace-no-wrap hover:underline">
                                                        {{$item->nomor_ppkb}}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->ppkb_ke}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{$item->service_code}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class='text-gray-900 whitespace-no-wrap'>{{$item->nama_kapal}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class='text-gray-900 whitespace-no-wrap'>{{$item->keagenan}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if ($item->status === 'New')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{$item->status}}</span>
                                                </span>
                                            @elseif ($item->status === 'Progress')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{$item->status}}</span>
                                                </span>
                                            @elseif ($item->status === 'Done')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{$item->status}}</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->created_at->format('Y-m-d')}}</p>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-5 py-5 bg-white border-t flex flex-col items-center">
                                {{ $submission->withQueryString()->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
       
@endsection