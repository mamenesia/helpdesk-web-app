@extends(Auth::check() && Auth::user()->roles->contains('id',1 ) ? 'layout.layout' : 'layouts.app')

@section("title","Welcome")

@section("content")

    <body>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left max-w-full mx-32">
            <div class="py-2 px-10 mx-10 my-60 space-y-8">
                <h1 class="text-7xl pb-3 font-bold text-gray-700 tracking-wide leading-snug">Help Desk Support</h1>
                
                <div>
                    @if (Auth::check() && Auth::user()->roles->contains('id',1))
                        <a href="{{route('tiket.ajukan')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md mt-5">Ajukan Topik</a>
                    @elseif (Auth::check() && Auth::user()->roles->contains('id',[2,3]))
                        <a href="{{route('user.ajukan')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md mt-5">Ajukan Topik</a>
                    @else
                        <a href="{{route('login')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md mt-5">Ajukan Topik</a>
                    @endif
                </div>
            </div>
            <div class="py-2 px-5 my-20 space-y-8">
                <img src="https://i.postimg.cc/BbcSCzMh/home.png" alt="home" class="w-full h-auto ">
            </div>
        </div>
    </body>

@endsection