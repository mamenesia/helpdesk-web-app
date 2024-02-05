@extends(Auth::user()->roles->contains('id',1 ) ? 'layout.layout' : 'layouts.app')

@section("title","My Tickets")

@section("content")
    <!-- component -->
        <body class="antialiased font-sans">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h1 class="text-5xl font-bold text-gray-900 py-4 text-left tracking-wide leading-snug pb-8">Tiket Saya</h1>
                    </div>
                    <div class='flex'>
                        <a href='{{route('user.ajukan')}}' class="text-black text-md focus:ring-3 focus:ring-blue-300 font-bold rounded-lg px-5 py-2 mb-2 bg-stone-200 hover:bg-stone-300">+</a>
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
                                            Judul
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Pengaju
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Aplikasi
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Tanggal Dibuat
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Prioritas
                                        </th>
                                        <th
                                            scope="col" class="px-5 py-3 ">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = $tikets->firstItem() ?>
                                    @foreach ($tikets as $item)
                                    <tr class="border-b border-gray-200 bg-white text-sm hover:bg-gray-50">
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->ticket_id}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <div class="flex items-center">
                                                <a href='{{ route('user.tampilkan', ['id' => $item->id])}}' class="text-gray-900 font-semibold whitespace-no-wrap hover:underline">
                                                    {{$item->judul}}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->pengaju}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{$item->aplikasi}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$item->created_at->format('Y-m-d')}}</p>
                                        </td>
                                        <td class="px-5 py-5">
                                            @if ($item->prioritas)
                                                @if ($item->prioritas->nama_prioritas === 'Rendah')
                                                    <p class="text-green-700 whitespace-no-wrap">{{$item->prioritas->nama_prioritas}}</p>
                                                @elseif ($item->prioritas->nama_prioritas === 'Sedang')
                                                    <p class="text-yellow-400 whitespace-no-wrap">{{$item->prioritas->nama_prioritas}}</p>
                                                @elseif ($item->prioritas->nama_prioritas === 'Tinggi')
                                                    <p class="text-red-700 whitespace-no-wrap">{{$item->prioritas->nama_prioritas}}</p>
                                                @else
                                                    <p class="text-red-700 whitespace-no-wrap">{{$item->prioritas->nama_prioritas}}</p>
                                                @endif
                                            @else
                                                <p class="text-gray-900 font-semibold whitespace-no-wrap">Not Set</p>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5">
                                            @if ($item->status->nama_status === 'Open')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-gray-900">{{$item->status->nama_status}}</span>
                                                </span>
                                            @elseif ($item->status->nama_status === 'Pending')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-gray-900">{{$item->status->nama_status}}</span>
                                                </span>
                                            @elseif ($item->status->nama_status === 'Closed')
                                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-gray-900">{{$item->status->nama_status}}</span>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-5 py-5 bg-white border-t flex flex-col items-center">
                                {{ $tikets->withQueryString()->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        </body>

@endsection