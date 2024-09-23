@extends('layouts.main-dashboard.main')

@section('container')
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Ubah Data Budidaya</h1>
            </div>
        </div>
        <p class="text-orange-500 text-center font-semibold font-poppins text-sm">"Pastikan semua data terisi ya :D"</p>

        <main class="p-6">
            <div class="bg-white rounded-lg shadow shadow-sky-200 p-4">
                <form action="{{ route('budidaya.update', $budidaya->id_budidaya) }}" method="POST">
                    @method('put')
                    @csrf
                    
                    <div class="p-3">
                        <label for="id_budidaya" class="block mb-3 text-gray-700 text-sm font-bold">Kode budidaya</label>
                        <input type="text" name="id_budidaya" id="id_budidaya" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('id_budidaya') is-invalid @enderror" value="{{ $budidaya->id_budidaya }}">
                        @error('id_budidaya')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="p-3">
                        <label for="nama_budidaya" class="block mb-3 text-gray-700 text-sm font-bold">Nama budidaya</label>
                        <input type="text" name="nama_budidaya" id="nama_budidaya" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('nama_budidaya') is-invalid @enderror" value="{{ $budidaya->nama_budidaya }}">
                        @error('nama_budidaya')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="p-3">
                        <label for="id_ikan" class="block mb-3 text-gray-700 text-sm font-bold">Jenis Ikan</label>
                        <select id="id_ikan" name="id_ikan" class="w-full p-2 border-2 focus:border-sky-300 focus:outline-none rounded-md text-sky-400" required>
                            {{-- <option value="Senin" {{ old('id_ikan', $ikan->id) == $ikan->id ? 'selected' : '' }}>$ikan->nama_ikan</option> --}}
                            @foreach ($ikans as $ikan)
                                @if (old('id_ikan', $ikan->id) == $ikan->id)
                                    <option value="{{ $ikan->id }}">{{ $ikan->nama_ikan }}</option>     
                                @else
                                    <option value="{{ $ikan->id }}">{{ $ikan->nama_ikan }}</option>
                                @endif  
                            @endforeach
                        </select>
                    </div>
    
                    <div class="p-3">
                        <label for="id_pakan" class="block mb-3 text-gray-700 text-sm font-bold">Jenis Pakan</label>
                        <select id="id_pakan" name="id_pakan" class="w-full p-2 border-2 focus:border-sky-300 focus:outline-none rounded-md text-sky-400" required>
                            @foreach ($pakans as $pakan)
                                @if (old('id_pakan', $pakan->id) == $pakan->id)
                                    <option value="{{ $pakan->id }}">{{ $pakan->nama_pakan }}</option>     
                                @else
                                    <option value="{{ $pakan->id }}">{{ $pakan->nama_oakan }}</option>
                                @endif  
                            @endforeach
                        </select>
                    </div>
    
                    <div class="p-3">
                        <label for="jumlah_tebar_ikan" class="block mb-3 text-gray-700 text-sm font-bold">Jumlah Tebar Ikan</label>
                        <input type="text" name="jumlah_tebar_ikan" id="jumlah_tebar_ikan" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('jumlah_tebar_ikan') is-invalid @enderror" value="{{ $budidaya->jumlah_tebar_ikan }}">
                        @error('jumlah_tebar_ikan')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="p-3">
                        <label for="bobot_awal_ikan" class="block mb-3 text-gray-700 text-sm font-bold">Bobot Awal Keseluruhan Ikan</label>
                        <input type="text" name="bobot_awal_ikan" id="bobot_awal_ikan" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('bobot_awal_ikan') is-invalid @enderror" value="{{ $budidaya->bobot_awal_ikan }}">
                        @error('bobot_awal_ikan')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="p-3">
                        <label for="lama_budidaya" class="block mb-3 text-gray-700 text-sm font-bold">Estimasi Lama Budidaya</label>
                        <input type="text" name="lama_budidaya" id="lama_budidaya" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('lama_budidaya') is-invalid @enderror" value="{{ $budidaya->lama_budidaya }}">
                        @error('lama_budidaya')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="p-3">
                        <label for="tanggal_tebar" class="block mb-3 text-gray-700 text-sm font-bold">Tanggal Mulai budidaya</label>
                        <input type="date" name="tanggal_tebar" id="tanggal_tebar" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('tanggal_tebar') is-invalid @enderror" value="{{ $budidaya->tanggal_tebar }}">
                        @error('tanggal_tebar')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="px-3">
                        <a href="{{ route('budidaya.index') }}" class="inline-block bg-slate-400 text-white py-2 px-4 rounded-full hover:font-bold hover:bg-grey-400 cursor-pointer">Batal</a>
                        <button type="submit" class="bg-blue-400 text-white py-2 px-4 rounded-full hover:font-bold hover:bg-sky-400 cursor-pointer">Edit</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection