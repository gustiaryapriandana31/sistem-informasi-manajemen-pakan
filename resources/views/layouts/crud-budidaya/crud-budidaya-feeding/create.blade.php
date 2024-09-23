@extends('layouts.main-dashboard.main')

@section('container')
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Catat Data <span class="italic">Feeding</span></h1>
            </div>
        </div>
        <p class="text-orange-500 text-center font-semibold font-poppins text-sm">"Pastikan semua data terisi ya :D"</p>

        <main class="p-6">
            <div class="bg-white rounded-lg shadow shadow-sky-200 p-4">
                <form action="{{ route('feeding.store', [$budidaya->id_budidaya]) }}" method="POST">
                    @csrf
                
                    <h1>{{ $budidaya->nama_budidaya }} || {{ $budidaya->id_budidaya }}  </h1>
    
                    <div class="p-3">
                        <label for="berat_pakan" class="block mb-3 text-gray-700 text-sm font-bold">Berat pakan</label>
                        <input type="text" name="berat_pakan" id="berat_pakan" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('berat_pakan') is-invalid @enderror" value="{{ old('berat_pakan') }}">
                        @error('berat_pakan')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <div class="p-3">
                        <label for="jangka_waktu" class="block mb-3 text-gray-700 text-sm font-bold">Pilih jangka waktu</label>
                        <select id="jangka_waktu" name="jangka_waktu" class="w-full p-2 border-2 focus:border-sky-300 focus:outline-none rounded-md text-sky-400" required>
                            <option value="--" {{ old('jangka_waktu') == '--' ? 'selected' : '' }}>--</option>
                            <option value="Sehari" {{ old('jangka_waktu') == 'Sehari' ? 'selected' : '' }}>Sehari</option>
                            <option value="Seminggu" {{ old('jangka_waktu') == 'Seminggu' ? 'selected' : '' }}>Seminggu</option>
                            <option value="Sebulan" {{ old('jangka_waktu') == 'Sebulan' ? 'selected' : '' }}>Sebulan</option>
                        </select>
                    </div>
    
                    <div class="p-3">
                        <label for="tanggal_feeding" class="block mb-3 text-gray-700 text-sm font-bold">Tanggal pemberian pakan</label>
                        <input type="date" name="tanggal_feeding" id="tanggal_feeding" class="w-full border-b-2 focus:outline-none focus:border-b-sky-300 p-3 rounded-md text-sky-400 @error('tanggal_feeding') is-invalid @enderror" value="{{ old('tanggal_feeding') }}">
                        @error('tanggal_feeding')
                            <p class="text-orange-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="px-3">
                       <a href="{{ route('budidaya.show', $budidaya->id_budidaya) }}" class="inline-block bg-slate-400 text-white py-2 px-4 rounded-full hover:font-bold hover:bg-grey-400 cursor-pointer">Batal</a>
                        <button type="submit" class="bg-blue-400 text-white py-2 px-4 rounded-full hover:font-bold hover:bg-sky-400 cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection


