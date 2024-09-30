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
                    <h1 class="font-bold pl-2"><i class="fa-solid fa-eye pr-3"></i>Detail Data Budidaya {{ $budidaya->nama_budidaya }}</h1>
                </div>
            </div>
    
            <main class="p-6">
                <div class="">
                    <a href="{{ url()->previous() }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Kembali</a>
                </div>  
                <section class="p-5 rounded-md my-2 border border-gray-600">
                    <p class="text-blue-400 text-center text-2xl md:text-4xl font-bold font-roboto mb-5">{{ $budidaya->nama_budidaya }}</p>
                    <section class="flex flex-col md:flex-row justify-between items-center">
                        {{-- Report --}}
                        <main class="basis-1/2 shadow-md p-1 rounded-md w-full">
                            <h1 class="text-lg md:text-xl font-semibold font-roboto text-yellow-400">Laporan Awal Budidaya</h1>    
                            <table class="mx-auto my-5 text-left table-auto w-full md:text-base text-xs">
                                <tr>
                                    <td class="">
                                        Estimasi Waktu Budidaya
                                    </td>
                                    <td class="mr-4 block">
                                        :
                                    </td>
                                    <td>
                                        {{ $budidaya->lama_budidaya }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal Tebar
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($budidaya->tanggal_tebar)->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Ikan
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $budidaya->ikan->nama_ikan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Pakan
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $budidaya->pakan->nama_pakan }}
                                    </td>
                                </tr>
                            </table>

                            <hr class="border-2 border-orange-400 my-4">

                            <h1 class="text-lg md:text-xl font-semibold font-roboto text-orange-400">Laporan Hasil Panen</h1>    
                            @if($budidaya->panen)
                                <table class="mx-auto my-5 text-left table-auto w-full md:text-base text-xs">
                                    <tr>
                                        <td class="">
                                            Berat Total Pakan
                                        </td>
                                        <td class="mr-4 block">
                                            :
                                        </td>
                                        <td>
                                            {{ round($sum_of_feeding) }} kg
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tanggal Panen
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            {{ $budidaya->panen == null ? '???' : \Carbon\Carbon::parse($budidaya->panen->tanggal_panen)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Lama Hari Budidaya
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        @php
                                            // Mengonversi tanggal tebar menjadi objek Carbon
                                            $tanggal_tebar = \Carbon\Carbon::parse($budidaya->tanggal_tebar);
                                            
                                            // Memeriksa apakah tanggal panen tersedia
                                            $tanggal_panen = $budidaya->panen ? \Carbon\Carbon::parse($budidaya->panen->tanggal_panen) : null;

                                            // Menghitung lama hari budidaya
                                            $lama_budidaya = $tanggal_panen ? $tanggal_tebar->diffInDays($tanggal_panen) : '???';
                                        @endphp
                                        <td>
                                            {{ $lama_budidaya === '???' ? 'Belum panen' : $lama_budidaya . ' hari' }}
                                        </td>
                                    </tr>
                                </table>
                            @else
                                <p class="text-red-eb500 font-semibold font-poppins text-sm">Data panen belum diisi.</p>
                            @endif
                        </main>

                        {{-- Card --}}
                        <div class="basis-1/2 grid grid-cols-2 text-gray-600 font-semibold gap-8">
                            <div class="text-center mt-4 md:mt-0">
                                <h5>Jumlah Tebar Awal</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">{{ $budidaya->jumlah_tebar_ikan }} ekor</p>
                            </div>
                            <div class="text-center mt-4 md:mt-0">
                                <h5>Bobot Awal Tebar</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">{{ $budidaya->bobot_awal_ikan }} kg</p>
                            </div>
                            <div class="text-center">
                                <h5>Bobot Ikan Akhir</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">
                                    {{ $budidaya->panen == null ? '-' : $budidaya->panen->bobot_akhir_ikan . ' kg' }}
                                </p>
                            </div>
                            <div class="text-center">
                                <h5>Berat Total Pakan</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">{{ round($sum_of_feeding) }} kg</p>
                            </div>

                            <div class="text-center mt-0 md:mt-8">
                                <h5>Nilai Efisiensi Pakan</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">{{ round($nilai_ep, 2) }}%</p>
                            </div>
                            <div class="text-center mt-0 md:mt-8">
                                <h5>Nilai Rasio Konversi Pakan</h5>
                                <p class="mt-4 font-poppins text-lg md:text-2xl text-yellow-400 font-semibold">
                                    {{ round($nilai_fcr, 2) }}
                                </p>
                            </div>
                        </div>
                    </section>

                    <main class="basis-1/2 shadow-sm p-1 rounded-md w-full mt-3">
                        <h1 class="text-lg md:text-xl font-semibold font-roboto text-yellow-400">Kesimpulan dan Rekomendasi</h1>  
                        @if($budidaya->panen)
                            <p class="text-gray-700 font-semibold font-poppins text-sm">* Jadi, dibutuhkan {{ round($nilai_fcr, 2) }} kg pakan untuk menghasilkan 1 kg ikan </p>
                            <p class="text-gray-700 font-semibold font-poppins text-sm">* Diketahui bahwa 1 kg pakan dapat menghasilkan {{ round($nilai_fcr_reverse, 2) }} ons ikan</p>

                            <p class="text-green-400 text-sm font-poppins my-3"><span class="font-bold text-base">Nilai EP</span> untuk jenis ikan {{ $budidaya->ikan->nama_ikan }} tersebut {{ $recommendation_based_on_ep_result }}</p>
                            <p class="text-green-400 text-sm font-poppins"><span class="font-bold text-base">Nilai FCR</span> untuk jenis ikan {{ $budidaya->ikan->nama_ikan }} tersebut {{ $recommendation_based_on_fcr_result }}</p>
                            @else
                            <p class="text-red-eb500 font-semibold font-poppins text-sm">Data panen belum diisi.</p>
                        @endif
                    </main>
                </section>
             
                {{-- Feeding Table --}}
                <div class="w-full">
                    @auth
                        <a href="{{ route('feeding.create', [$budidaya->id_budidaya]) }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Catat Feeding</a>
                        <a href="{{ route('panen.create', [$budidaya->id_budidaya]) }}" class="bg-blue-400 text-white px-3 py-1 rounded-md">Catat Hasil Panen</a>
                    @endauth
                    <table class="mx-auto bg-amber-100/80 my-5 text-center md:text-left table-auto w-full border-collapse border border-slate-600">
                        <thead class="border border-slate-800 md:p-4 text-center font-bold font-poppins md:text-base text-xs">
                            <th className="md:py-2 md:px-5">
                                No
                            </th>
                            <th className="md:py-2 md:px-5">
                                Tanggal Feeding
                            </th>
                            <th className="md:py-2 md:px-5">
                                Berat Pakan
                            </th>
                            <th className="md:py-2 md:px-5">
                                Jangka Waktu Pemberian
                            </th>
                            <th className="md:py-2 md:px-5">
                                Total hari
                            </th>
                        </thead>
                        <tbody class="border border-slate-500 md:text-base text-xs">
                            @foreach ($budidaya->feedings as $feeding)
                            <tr class="text-center border border-slate-800">
                                    <td className="md:p-1">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td className="md:p-1">
                                        {{ \Carbon\Carbon::parse($feeding->tanggal_feeding)->locale('id')->translatedFormat('d F Y')}}
                                    </td>
                                    <td className="md:p-1">
                                        {{ $feeding->berat_pakan}}
                                    </td>
                                    <td className="md:p-1">
                                        {{ $feeding->jangka_waktu}}
                                    </td>
                                    <td className="md:p-1">
                                        {{ $feeding->jangka_waktu === 'Seminggu' ? '7 hari' : ($feeding->jangka_waktu === 'Sehari' ? '1 hari' : ($feeding->jangka_waktu === 'Sebulan' ? '28 hari' : '- hari')) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </section>
@endsection

