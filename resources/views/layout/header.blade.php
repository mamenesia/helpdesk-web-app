<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @vite('resources/css/app.css', 'resources/js/app.js')
    </head>
    <body>
        <header>
            <nav class="bg-white pt-2 pb-4 mt-0 w-full relative">
                <div class="container mx-auto flex flex-wrap items-center">
                    <div class="flex w-full md:w-1/2 justify-center md:justify-start">
                        <a href="/">
                            <img src="https://i.postimg.cc/d00WBTtr/logo.png" alt="logo" class="h-12 w-auto pt-2">
                        </a>
                    </div>
                    <div class="flex w-full pt-2 content-center md:w-1/2 md:justify-end">
                        <ul class="flex md:flex-none items-center">
                            <li class="mr-3">
                                <a class="py-2 px-4 text-black no-underline" href="{{url('/')}}">Home</a>
                            </li>
                            <li class="mr-3 group/item">
                                <a class="text-black no-underline inline-block py-2 px-4 " href="#">
                                    <span>Help Desk</span>
                                </a>
                                <ul class="group/edit group-hover/item:visible absolute invisible text-blue-200 shadow-lg">
                                    <li><a class="text-black hover:text-blue-400 py-2 pl-4 pr-8 block bg-white" href="{{route('tiket.ajukan')}}">Ajukan Topik</a></li>
                                    <li><a class="rounded-b text-black hover:text-blue-400 py-2 px-4 block bg-white" href="{{route('tiket.daftar')}}">Daftar Topik</a></li>
                                </ul>
                            </li>

                            <li class="mr-3 group/item">
                                <a class="text-black no-underline block py-2 px-4" href="#">Master</a>
                                <ul class="group/edit group-hover/item:visible absolute invisible text-blue-200 shadow-lg">
                                    <li><a class="text-black hover:text-blue-400 py-2 pl-4 pr-8 block bg-white" href="user">Daftar User</a></li>
                                    <li><a class="rounded-b text-black hover:text-blue-400 py-2 px-4 block bg-white" href="divisi">Daftar Divisi</a></li>
                                </ul>
                            </li>
                            <li class="mr-3">
                                <a class="inline-block py-2 px-4 text-black no-underline" href="#">Submission</a>
                            </li>

                            @if (Auth::check())
                            <li class="mr-3 group/item">
                                <a class="text-black no-underline inline-block py-2 px-4 " href="#">
                                    <span>{{ Auth::user()->nama }}</span>
                                </a>
                                <ul class="group/edit group-hover/item:visible absolute invisible text-blue-200 shadow-lg">
                                    <li><a class="text-black hover:text-blue-400 py-2 pl-4 pr-8 block bg-white" href="#">Profile</a></li>
                                    <li><a class="rounded-b text-black hover:text-blue-400 py-2 px-4 block bg-white" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>

