@extends(Auth::user()->roles->contains('id',1 ) ? 'layout.layout' : 'layouts.app')

@section("title","Ajukan PPKB")

@section("content")

    <body>
        <h1 class="text-5xl font-bold text-gray-900 py-4 text-center tracking-wide leading-snug">Pengajuan Submission</h1>
        <form action='{{route('user.storeppkb')}}' method='POST'>
            @csrf
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-60 pb-10">
                <div class="col-span-full">
                    <label for="nomor_ppkb" class="block text-sm font-medium leading-6 text-gray-900">Nomor PPKB:</label>
                    <div class="mt-2">
                        <input required type="text" name="nomor_ppkb" value="{{ Session::get('nomor_ppkb')}}" id="nomor_ppkb" autocomplete="nomor_ppkb" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="ppkb_ke" class="block text-sm font-medium leading-6 text-gray-900">PPKB Ke:</label>
                    <div class="mt-2">
                        <input required type="text" name="ppkb_ke" value="{{ Session::get('ppkb_ke')}}" id="ppkb_ke" autocomplete="pengaju" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="service_code" class="block text-sm font-medium leading-6 text-gray-900">Service Code:</label>
                    <div class="mt-2">
                        <select id="service_code" name="service_code" autocomplete="service_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Pindah</option>
                            <option>Tambat</option>
                            <option>Perpanjangan</option>
                            <option>Keberangkatan</option>
                            <option>Labuh</option>
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="nama_kapal" class="block text-sm font-medium leading-6 text-gray-900">Nama Kapal:</label>
                    <div class="mt-2">
                        <input required type="text" name="nama_kapal" value="{{ Session::get('nama_kapal')}}" id="nama_kapal" autocomplete="nama_kapal" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="divisi" class="block text-sm font-medium leading-6 text-gray-900">Keagenan:</label>
                    <div class="mt-2">
                        <input required type="text" name="keagenan" value="{{ Session::get('keagenan')}}" id="keagenan" autocomplete="keagenan" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                
                <div>
                    <button type='submit' name='submit' class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md mt-5">Ajukan</button>
                </div>
            </div>
        </form>
    </body>

@endsection