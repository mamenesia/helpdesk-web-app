@extends(Auth::user()->roles->contains('id',1 ) ? 'layout.layout' : 'layouts.app')

@section("title","Submission")

@section("content")
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='initial-scale=1'>
        <title>@yield('title')</title>
        @vite('resources/css/app.css', 'resources/js/app.js')
    </head>
    <!-- component -->
    <body class="antialiased font-sans ">
        <div class='mx-auto container flex flex-wrap items-center min-w-7xl py-8'>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow ">
                <div class='container mx-auto flex flex-wrap items-center'>
                    <div class='flex w-full content-center justify-start md:w-1/2 '>
                        @if (Auth::user()->roles->contains('id', 2 ))
                        <a class='pr-3' href='{{route('user.submissionsaya')}}' title="Back">
                        @else
                        <a class='pr-3' href='{{route('user.daftarsubmission')}}' title="Back">
                            @endif
                            <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="white"/>
                                <path d="M14.5 17L9.5 12L14.5 7" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div class='flex w-full content-center md:justify-end md:w-1/2'>
                        <a>
                            <h5 class="mb-2 text-2xl font-bold text-end tracking-tight text-gray-900">Submission #{{$submission->id}}</h5>
                        </a>
                        <a class='px-2 pt-1'>
                            @if ($submission->status === 'New')
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{$submission->status}}</span>
                                </span>
                            @elseif ($submission->status === 'Progress')
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{$submission->status}}</span>
                                </span>
                            @elseif ($submission->status === 'Sudah Ditetapkan')
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{$submission->status}}</span>
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-200 border-0">
                <div class= 'flex flex-col'>
                    <a class="mb-3 text-3xl font-normal text-gray-900">{{$submission->nomor_ppkb}}</a>
                    <a class="mb-3 text-xl font-normal text-gray-600">PPKB Ke: {{$submission->ppkb_ke}}</a>
                    <div class='overflow-x-auto flex flex-wrap'>
                        <a class="block w-full sm:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 ">Service Code</h5>
                            <p class="font-normal text-md text-gray-700 ">{{$submission->service_code}}</p>
                        </a>
                        <a class="block w-full sm:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 ">Nama Kapal</h5>
                            <p class="font-normal text-md text-gray-700 ">{{$submission->nama_kapal}}</p>
                        </a>
                        <a class="block w-full sm:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 ">Keagenan</h5>
                            <p class="font-normal text-md text-gray-700 ">{{$submission->keagenan}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        
    </body>
</html>
@endsection