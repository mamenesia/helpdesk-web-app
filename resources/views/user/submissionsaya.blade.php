@extends(Auth::user()->roles->contains('id',1 ) ? 'layout.layout' : 'layouts.app')

@section("title","My Tickets")

@section("content")
    <!-- component -->
        <body class="antialiased font-sans">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h1 class="text-5xl font-bold text-gray-900 py-4 text-left tracking-wide leading-snug pb-8">Submission Saya</h1>
                    </div>
                    <div class="flex flex-wrap">
                        <div class='flex'>
                            <a href='{{route('user.submission')}}' class="text-black text-md focus:ring-3 focus:ring-blue-300 font-bold rounded-lg px-5 py-2 mb-2 bg-stone-200 hover:bg-stone-300">+</a>
                        </div>
                        <div class='flex px-2'>
                            <div class="px-2">
                                <button class="text-black text-md focus:ring-3 focus:ring-blue-300 font-semibold rounded-lg px-5 py-2 mb-2 bg-blue-200 hover:bg-blue-300 " type="button" data-drawer-target="drawer-form" data-drawer-show="drawer-form" aria-controls="drawer-form">
                                Export
                                </button>
                            </div>

                            <!-- drawer component -->
                            <div id="drawer-form" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80" tabindex="-1" aria-labelledby="drawer-form-label">
                                <h3 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase">
                                    Export
                                </h3>
                                <button type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center" >
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close menu</span>
                                </button>
                                <form action="{{ url('submissions/export/' . Auth::id()) }}" method="GET">
                                    <div class='mb-6'>
                                        <label for='date' class='block mb-2 text-sm font-medium text-gray-900 '>Dari Tanggal</label>
                                        <input type='date' id='date' name='from_date' required class='form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'/>
                                    </div>
                                    <div class='mb-6'>
                                        <label for='date' class='block mb-2 text-sm font-medium text-gray-900 '>Ke Tanggal</label>
                                        <input type='date' id='date' name='to_date' required class='form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5'/>
                                    </div>
                                    
                                    <button type="submit" class=" text-white justify-center flex items-center font-semibold bg-blue-500 hover:bg-blue-600 w-full focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 mb-2 ">
                                        Export
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-8 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                                    <tr>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            ID
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            No PPKB
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            PPKB Ke
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Service Code
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Nama Kapal
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Keagenan
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Status
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Tanggal Dibuat
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = $submission->firstItem() ?>
                                    @foreach ($submission as $item)
                                    <tr class="border-b border-gray-200 bg-white text-sm hover:bg-gray-50">
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->id}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <div class="flex items-center">
                                                <a href='{{ route('user.tampilkansubmission', ['id' => $item->id])}}' class="text-gray-900 font-semibold whitespace-no-wrap hover:underline">
                                                    {{$item->nomor_ppkb}}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->ppkb_ke}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{$item->service_code}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->nama_kapal}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->keagenan}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            @if ($item->status === 'New')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-gray-900">{{$item->status}}</span>
                                                </span>
                                            @elseif ($item->status === 'Progress')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-gray-900">{{$item->status}}</span>
                                                </span>
                                            @elseif ($item->status === 'Sudah Ditetapkan')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-gray-900">{{$item->status}}</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5">
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
        </body>

@endsection