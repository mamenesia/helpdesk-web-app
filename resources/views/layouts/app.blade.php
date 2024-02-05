<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @vite('resources/css/app.css', 'resources/js/app.js')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container mx-auto flex flex-wrap items-center">
                    <div class='flex w-full md:w-1/2 justify-center md:justify-start'>
                        <a href="/">
                            <img src="https://i.ibb.co/F06pPM6/FA-PELINDO-LOGO-WARNA-1.png" alt="logo" class="h-16 w-auto py-2">
                        </a>
                    </div>
                    <div class='flex w-full pt-2 content-center md:w-1/2 justify-end'>
                        <!-- Right Side Of Navbar -->
                        <ul class="flex md:flex-none items-end">
                            @if (Auth::check())
                            <li class="mr-3 group/item">
                                <a class="inline-block py-2 px-4 text-black no-underline">Submission</a>
                                <ul class="group/edit group-hover/item:visible absolute invisible text-blue-200 shadow-lg">
                                    <li><a class="text-black hover:text-blue-400 py-2 pl-4 pr-8 block bg-white" href="{{route("user.submission")}}">Ajukan Submission</a></li>
                                    <li><a class="rounded-b text-black hover:text-blue-400 py-2 px-4 block bg-white" href="{{route('user.daftarsubmission')}}">Daftar Submission</a></li>
                                    
                                </ul>
                            </li>
                            
                            <!-- Authentication Links -->

                                <li class="mr-3 group/item">
                                    <a class="text-black no-underline inline-block py-2 px-4 bg-white" href="#">
                                        <span>{{ Auth::user()->nama }}</span>
                                    </a>
                                    <ul class="group/edit group-hover/item:visible absolute invisible text-blue-200 shadow-lg">
                                        <li><a class="text-black hover:text-blue-400 py-2 pl-4 pr-8 block bg-white" href="{{route('user.tiketsaya')}}">Tiket Saya</a></li>
                                        <li><a class="rounded-b text-black hover:text-blue-400 py-2 px-4 block bg-white" href="{{route('user.submissionsaya')}}">Submission Saya</a></li>
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

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
