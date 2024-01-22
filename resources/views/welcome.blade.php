@extends("layout.layout")

@section("title","Welcome")

@section("content")

    <body>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-left">
            <div class="py-2 px-10 mx-10 my-60 space-y-8">
                <h1 class="text-7xl font-bold text-gray-700 tracking-wide leading-snug">Help Desk Support</h1>
                <p class="text-black leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>
                <div>
                    <a href="/ajukan" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md mt-5">Ajukan Topik</a>
                </div>
            </div>
            <div class="py-2 px-5 my-20 space-y-8">
                <img src="https://i.postimg.cc/BbcSCzMh/home.png" alt="home" class="w-full h-auto ">
            </div>
        </div>
    </body>

@endsection