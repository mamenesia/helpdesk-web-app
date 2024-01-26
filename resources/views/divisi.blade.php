@extends("layout.layout")

@section("title","Daftar Divisi")

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
        <body class="antialiased font-sans">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h1 class="text-5xl font-bold text-gray-900 py-4 text-center tracking-wide leading-snug">Daftar Divisi</h1>
                    </div>
                    <div class="my-2 flex sm:flex-row flex-col">
                        

                    </div>
                    <div class="-mx-8 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto flex flex-wrap">
                        @foreach ($divisi as $divisi)
                            <div class="w-full sm:w-1/3 p-2">
                                <div class="bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 p-6">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$divisi->nama_divisi}}</h5>
                                    <p class="font-normal text-gray-700">{{$divisi->nama_divisi}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div> 
                </div>
            </div>
        </body>

@endsection