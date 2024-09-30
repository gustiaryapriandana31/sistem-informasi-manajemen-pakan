@extends('layouts.main-dashboard.main')

@section('container')

    @if (session()->has('success'))
        <div class="alert-notif absolute top-0 left-0 md:left-[25%] bg-opacity-90 md:bg-opacity-70 w-full md:w-1/2 h-10 rounded-md bg-green-500 text-white font-semibold p-10 text-center text-xl leading-[25%]" role="alert">
            {{ session('success') }}
        </div> 
    @endif
    
    <section class="w-screen">
        <div class="min-h-screen flex-1 bg-white mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-12 md:pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2"><i class="fa-solid fa-fish-fins pr-3"></i>Daftar Budidaya</h1>
                </div>
            </div>
    
            <div class="p-6">
                @auth
                    <a href="/budidaya/create" class="mb-3 inline-block p-2 rounded-md bg-blue-500 text-white font-bold text-base">Tambah Data <i class="ml-2 fa-solid fa-plus"></i></a>
                @endauth
                @foreach ($budidayas as $budidaya)
                    <div class="relative flex flex-col md:flex-row justify-between items-center bg-blue-500 shadow-lg p-5 rounded-md my-3">
                        <section class="text-white font-poppins">
                            <h1 class="text-lg md:text-xl md:mb-3 mb-1 font-bold text-yellow-400">
                                {{ $budidaya->nama_budidaya }} 
                                <span class="md:static absolute -top-2 right-1 p-2 text-white text-xs rounded-full ml-3 {{ $budidaya->panen == null ? 'bg-gray-400' : 'bg-green-400' }}">
                                    {{ $budidaya->panen == null ? 'Belum panen' : 'Sudah panen' }}
                                </span>
                            </h1>
                            <p class="font-semibold text-sm">{{ \Carbon\Carbon::parse($budidaya->tanggal_tebar)->locale('id')->translatedFormat('d F Y') }} - {{ $budidaya->panen == null ? '???' : \Carbon\Carbon::parse($budidaya->panen->tanggal_panen)->locale('id')->translatedFormat('d F Y') }}</p>
                            <div class="mt-4">
                                <a href="{{ route('budidaya.show', $budidaya->id_budidaya) }}" class="bg-sky-400 px-3 py-1 rounded-md"><i class="mr-2 fa-solid fa-eye"></i>Detail</a>
                                @auth
                                    <a href="/budidaya/{{ $budidaya->id_budidaya }}/edit" class="bg-yellow-400 px-3 py-1 rounded-md"><i class="mr-2 fa-solid fa-pen-to-square"></i>Edit</a>
                                    <form action="{{ route('budidaya.show', $budidaya->id_budidaya) }}" method="post" class="inline-block">
                                        @method('delete')
                                        @csrf
                                        <button class="bg-red-400 text-xs p-2 rounded-md" onclick="return confirm('Yakin Ingin Menghapus Data Ini?')">
                                            <i class="mr-2 fa-solid fa-trash"></i>Hapus
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </section>
                        <main class="hidden md:visible text-white font-semibold grid grid-cols-3 gap-8">
                            <div class="md:text-center">
                                <h5>Jumlah Tebar Awal</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">{{ $budidaya->jumlah_tebar_ikan }} ekor</p>
                            </div>
                            <div class="md:text-center">
                                <h5>Bobot Awal Tebar</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">{{ $budidaya->bobot_awal_ikan }} kg</p>
                            </div>
                            <div class="md:text-center">
                                <h5>Bobot Ikan Akhir</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">
                                    {{ $budidaya->panen == null ? '-' : $budidaya->panen->bobot_akhir_ikan . ' kg' }}
                                </p>
                            </div>
                        </main>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
