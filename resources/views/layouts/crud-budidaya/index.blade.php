@extends('layouts.main-dashboard.main')

@section('container')

    @if (session()->has('success'))
        <div class="alert-notif absolute top-0 left-0 md:left-[25%] bg-opacity-90 md:bg-opacity-70 w-full md:w-1/2 h-10 rounded-md bg-green-500 text-white font-semibold p-10 text-center text-xl leading-[25%]" role="alert">
            {{ session('success') }}
        </div> 
    @endif
    
    <section class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Daftar Budidaya</h1>
            </div>
        </div>

        <div class="p-6">
            @auth
                <a href="{{ route('budidaya.create') }}" class="mb-3 inline-block p-2 rounded-md bg-blue-500 text-white font-bold text-base">Tambah Data +</a>
            @endauth
            @foreach ($budidayas as $budidaya)
                <div class="flex flex-row justify-between bg-blue-700 shadow-lg p-5 rounded-md my-3">
                    <div class="">
                        <h1 class="text-2xl font-bold font-roboto text-white">{{ $budidaya->nama_budidaya }}</h1>
                        <p class="text-gray-400 font-semibold font-poppins text-sm">Tanggal mulai budidaya :  {{ \Carbon\Carbon::parse($budidaya->tanggal_tebar)->locale('id')->translatedFormat('d F Y') }}</p>
                        <p class="text-gray-400 font-semibold font-poppins text-sm">Jumlah ikan yang ditebar : {{ $budidaya->jumlah_tebar_ikan }} ekor</p>
                        <p class="text-gray-400 font-semibold font-poppins text-sm">Bobot awal ikan : {{ $budidaya->bobot_awal_ikan }} kg</p>
                    </div>
                    <div class="">
                        <a href="{{ route('budidaya.show', $budidaya->id_budidaya) }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Detail</a>
                        @auth
                            <a href="/budidaya/{{ $budidaya->id_budidaya }}/edit" class="bg-yellow-400 text-white px-3 py-1 rounded-md">Edit</a>
                            <form action="{{ route('budidaya.show', $budidaya->id_budidaya) }}" method="post" class="mt-2 inline-block">
                                @method('delete')
                                @csrf
                                <button class="bg-red-400 text-white font-poppins font-semibold text-xs p-2 rounded-lg" onclick="return confirm('Yakin Ingin Menghapus Data Ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
