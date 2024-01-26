@extends("layouts.app")

@section("title","Daftar Topik")

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
                        <a class='pr-3' href='{{route('user.tiketsaya')}}'>
                            <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="white"/>
                                <path d="M14.5 17L9.5 12L14.5 7" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a class="pt-1 pr-3" href='/tiket/$id'>
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="white"/>
                                <path d="M21.3687 13.5827C21.4144 13.3104 21.2306 13.0526 20.9583 13.0069C20.686 12.9612 20.4281 13.1449 20.3825 13.4173L21.3687 13.5827ZM12 20.5C7.30558 20.5 3.5 16.6944 3.5 12H2.5C2.5 17.2467 6.75329 21.5 12 21.5V20.5ZM3.5 12C3.5 7.30558 7.30558 3.5 12 3.5V2.5C6.75329 2.5 2.5 6.75329 2.5 12H3.5ZM12 3.5C15.3367 3.5 18.2252 5.4225 19.6167 8.22252L20.5122 7.77748C18.9583 4.65062 15.7308 2.5 12 2.5V3.5ZM20.3825 13.4173C19.7081 17.437 16.2112 20.5 12 20.5V21.5C16.7077 21.5 20.6148 18.0762 21.3687 13.5827L20.3825 13.4173Z" fill="#000000"/>
                                <path d="M20.4716 2.42157V8.07843H14.8147" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div class='flex w-full content-center md:justify-end md:w-1/2'>
                        <a>
                            <h5 class="mb-2 text-2xl font-bold text-end tracking-tight text-gray-900">Tiket #{{$tiket->id}}</h5>
                        </a>
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-200 border-0">
                <div class= 'flex flex-col'>
                    <div class= 'flex flex-wrap justify-between'>
                        <a class="mb-3 text-3xl font-normal text-gray-900">{{$tiket->judul}}</a>
                        @if ($tiket->prioritas)
                            <a class="text-gray-900 whitespace-no-wrap text-end">{{$tiket->prioritas->nama_prioritas}}</a>
                        @else
                            <a class="text-gray-900 font-semibold whitespace-no-wrap text-end">Not Set</a>
                        @endif
                    </div>
                    <a class="mb-3 text-xl font-normal text-gray-600">{{$tiket->deskripsi}}</a>
                    <a class="mb-3 text-sm font-normal text-gray-500">Pengaju: {{$tiket->pengaju}}</a>
                    <a class="mb-3 text-sm font-normal text-gray-500">Aplikasi: {{$tiket->aplikasi}}</a>
                    <a class="mb-3 text-sm font-normal text-gray-500">Divisi: {{$tiket->divisi->nama_divisi}}</a>
                    <a class="mb-3 text-sm font-normal text-gray-500">Status: {{$tiket->status->nama_status}}</a>
                </div>
            </div>
        </div>
        <div class='mx-auto container flex flex-wrap items-center min-w-7xl overflow-auto h-[500px] '>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow divide-y">
                <div class='pb-4'>
                    <form method="POST" action='{{route('user.reply')}}'>
                        @csrf
                        <input type="hidden" id="tiket_id" name="tiket_id" value="{{ $tiket->id }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                        <label for="chat" class="sr-only">Your message</label>
                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg">
                            <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                            </button>
                            <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>
                            </button>
                            <textarea name='balasan' id="balasan" rows="2" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Your message..."></textarea>
                                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                                <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div class='pt-4'>
                    @foreach ($tiket->balasan as $balasan)
                    <ol class="relative border-s border-gray-200">                  
                        <li class="mb-10 ms-6">            
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                                
                            </span>
                            <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex">
                                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{$balasan->created_at}}</time>
                                <div class="text-sm font-normal text-gray-500 flex flex-col">
                                    <a class='text-gray-900 font-semibold pb-2'> {{$balasan->user->nama}}</a> 
                                    <a>{{$balasan->balasan}}</a>
                                </div>
                            </div>
                        </li>
                    </ol>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            const chat = document.getElementById('chat');
            chat.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"
        </script>
    </body>
</html>
@endsection