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
                        <a class='pr-3' href='{{route('user.daftarsubmission')}}'>
                            <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="white"/>
                                <path d="M14.5 17L9.5 12L14.5 7" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a class="pt-1 pr-3" href='/submission/$id'>
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="white"/>
                                <path d="M21.3687 13.5827C21.4144 13.3104 21.2306 13.0526 20.9583 13.0069C20.686 12.9612 20.4281 13.1449 20.3825 13.4173L21.3687 13.5827ZM12 20.5C7.30558 20.5 3.5 16.6944 3.5 12H2.5C2.5 17.2467 6.75329 21.5 12 21.5V20.5ZM3.5 12C3.5 7.30558 7.30558 3.5 12 3.5V2.5C6.75329 2.5 2.5 6.75329 2.5 12H3.5ZM12 3.5C15.3367 3.5 18.2252 5.4225 19.6167 8.22252L20.5122 7.77748C18.9583 4.65062 15.7308 2.5 12 2.5V3.5ZM20.3825 13.4173C19.7081 17.437 16.2112 20.5 12 20.5V21.5C16.7077 21.5 20.6148 18.0762 21.3687 13.5827L20.3825 13.4173Z" fill="#000000"/>
                                <path d="M20.4716 2.42157V8.07843H14.8147" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
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