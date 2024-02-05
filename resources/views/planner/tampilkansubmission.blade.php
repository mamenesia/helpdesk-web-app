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
                        
                        <form method="POST" action="{{ route('submission.close', ['id' => $submission->id]) }}" title="Mark as done">
                            @csrf
                            <button type="submit" title="Mark as done">
                                <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="24" height="24" fill="white"/>
                                    <path d="M5 13.3636L8.03559 16.3204C8.42388 16.6986 9.04279 16.6986 9.43108 16.3204L19 7" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('submission.reopen', ['id' => $tiket->id]) }}" title="Reopen">
                            @csrf
                            <button class="pt-1 pl-2" type="submit" title="Reopen">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="24" height="24" fill="white"/>
                                    <path d="M2.5 12C2.5 12.2761 2.72386 12.5 3 12.5C3.27614 12.5 3.5 12.2761 3.5 12H2.5ZM3.5 12C3.5 7.30558 7.30558 3.5 12 3.5V2.5C6.75329 2.5 2.5 6.75329 2.5 12H3.5ZM12 3.5C15.3367 3.5 18.2252 5.4225 19.6167 8.22252L20.5122 7.77748C18.9583 4.65062 15.7308 2.5 12 2.5V3.5Z" fill="#000000"/>
                                    <path d="M20.4716 2.42157V8.07843H14.8147" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21.5 12C21.5 11.7239 21.2761 11.5 21 11.5C20.7239 11.5 20.5 11.7239 20.5 12L21.5 12ZM20.5 12C20.5 16.6944 16.6944 20.5 12 20.5L12 21.5C17.2467 21.5 21.5 17.2467 21.5 12L20.5 12ZM12 20.5C8.66333 20.5 5.77477 18.5775 4.38328 15.7775L3.48776 16.2225C5.04168 19.3494 8.26923 21.5 12 21.5L12 20.5Z" fill="#000000"/>
                                    <path d="M3.52844 21.5784L3.52844 15.9216L9.18529 15.9216" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
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