@extends('layouts.main-dashboard.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert-notif absolute top-0 left-0 md:left-[25%] bg-opacity-90 md:bg-opacity-70 w-full md:w-1/2 h-10 rounded-md bg-green-500 text-white font-semibold p-10 text-center text-xl leading-[25%]" role="alert">
            {{ session('success') }}
        </div> 
    @endif

    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Detail Data Budidaya {{ $budidaya->nama_budidaya }}</h1>
            </div>
        </div>

        <main class="p-6">
            <div class="flex flex-row justify-between bg-orange-200 p-5 rounded-md my-2">
                <div>
                    <h1 class="text-2xl font-bold font-roboto text-blue-400">{{ $budidaya->nama_budidaya }}</h1>
                    <p class="text-gray-400 font-semibold font-poppins text-sm">Tanggal mulai budidaya : {{ \Carbon\Carbon::parse($budidaya->tanggal_tebar)->locale('id')->translatedFormat('d F Y') }}</p>
                    <p class="text-gray-400 font-semibold font-poppins text-sm">Jumlah ikan yang ditebar : {{ $budidaya->jumlah_tebar_ikan }} ekor</p>
                    <p class="text-gray-400 font-semibold font-poppins text-sm">Bobot awal ikan : {{ $budidaya->bobot_awal_ikan }} kg</p>
                    <p class="text-gray-400 font-semibold font-poppins text-sm">Nama ikan : {{ $budidaya->ikan->nama_ikan }}</p>
                    <p class="text-gray-400 font-semibold font-poppins text-sm">Nama pakan : {{ $budidaya->pakan->nama_pakan }}</p>
                </div>
                <div class="">
                    <a href="{{ route('budidaya.index') }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Kembali</a>
                </div>
            </div>
         
            <section class="flex flex-row gap-10 items-center">
                <div class="basis-2/3">
                    @auth
                        <a href="{{ route('feeding.create', [$budidaya->id_budidaya]) }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Catat Feeding</a>
                        <a href="{{ route('panen.create', [$budidaya->id_budidaya]) }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Catat Hasil Panen</a>
                    @endauth
                    <table class="mx-auto bg-amber-100/80 my-5 text-left table-auto w-full">
                        <thead class="border border-slate-800 p-4 md:text-base text-[0.77rem] text-center font-bold font-poppins">
                            <th className="md:py-2 md:px-5 bg-orange-300/80 border border-slate-600 md:text-base text-xs">
                                Nama Ikan
                            </th>
                            <th className="md:py-2 md:px-5 bg-orange-300/80 border border-slate-600 md:text-base text-xs">
                                Nama Pakan
                            </th>
                            <th className="md:py-2 md:px-5 bg-orange-300/80 border border-slate-600 md:text-base text-xs">
                                Tanggal Feeding
                            </th>
                            <th className="md:py-2 md:px-5 bg-orange-300/80 border border-slate-600 md:text-base text-xs">
                                Berat Pakan
                            </th>
                        </thead>
                        <tbody class="border border-slate-500">
                            @foreach ($budidaya->feedings as $feeding)
                                <tr class="text-center">
                                    <td className="border border-slate-600 p-1 md:text-base text-xs" colSpan={colSpan}>
                                        {{ $feeding->budidaya->ikan->nama_ikan}}
                                    </td>
                                    <td className="border border-slate-600 p-1 md:text-base text-xs" colSpan={colSpan}>
                                        {{ $feeding->budidaya->pakan->nama_pakan}}
                                    </td>
                                    <td className="border border-slate-600 p-1 md:text-base text-xs" colSpan={colSpan}>
                                        {{ \Carbon\Carbon::parse($feeding->tanggal_feeding)->locale('id')->translatedFormat('d F Y')}}
                                    </td>
                                    <td className="border border-slate-600 p-1 md:text-base text-xs" colSpan={colSpan}>
                                        {{ $feeding->berat_pakan}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="basis-1/3 shadow-md p-3 rounded-md my-5 w-full">
                    <h1 class="text-2xl font-bold font-roboto text-orange-400">Laporan Hasil Panen</h1>
                    <h4 class="text-base font-semibold font-roboto text-blue-400">{{ $budidaya->nama_budidaya }}</h4>

                    @if($budidaya->panen)
                        <p class="text-gray-400 font-semibold font-poppins text-sm">Tanggal panen : {{ \Carbon\Carbon::parse($budidaya->panen->tanggal_panen)->locale('id')->translatedFormat('d F Y') }}</p>
                        <p class="text-gray-400 font-semibold font-poppins text-sm">Berat akhir ikan : {{ $budidaya->panen->bobot_akhir_ikan }} kg</p>
                        <p class="text-orange-400 font-semibold font-poppins text-sm">Nilai EP : {{ round($nilai_ep, 2) }}%</p>
                        <p class="text-yellow-400 font-semibold font-poppins text-sm">Nilai FCR : {{ round($nilai_fcr, 2) }}</p>
                        <p class="text-gray-700 font-semibold font-poppins text-sm">* Jadi, dibutuhkan {{ round($nilai_fcr, 2) }} kg pakan untuk menghasilkan 1kg ikan </p>
                        <p class="text-gray-700 font-semibold font-poppins text-sm">* Diketahui bahwa 1 kg pakan dapat menghasilkan {{ round($nilai_fcr_reverse, 2) }} ons ikan</p>
                    @else
                        <p class="text-red-500 font-semibold font-poppins text-sm">Data panen belum diisi.</p>
                    @endif
                </div>
            </section>
        </main>
    </div>
@endsection

