<?php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use App\Models\Feeding;
use App\Models\Ikan;
use App\Models\Pakan;
use Illuminate\Http\Request;

class BudidayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_sudah_panen()
    {
        $budidaya = Budidaya::with(['ikan', 'panen'])->latest()->get();
        $budidaya = $budidaya->load(['feedings', 'panen']);
        $budidaya = $budidaya->where('panen', '!=', null);
        
        return view('layouts.crud-budidaya.index', [
            'budidayas' => $budidaya
        ]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index_belum_panen()
    {
        $budidaya = Budidaya::with(['ikan', 'panen'])->latest()->get();
        $budidaya = $budidaya->load(['feedings', 'panen']);

        $budidaya = $budidaya->where('panen', null);
        
        return view('layouts.crud-budidaya.index', [
            'budidayas' => $budidaya
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.crud-budidaya.create', [
            'ikans' => Ikan::all(),
            'pakans' => Pakan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([                 
                'id_budidaya' => 'required',
                'nama_budidaya' => 'required',
                'id_ikan' => 'required',
                'id_pakan' => 'required',
                'jumlah_tebar_ikan' => 'required|numeric',
                'bobot_awal_ikan' => 'required|numeric',
                'lama_budidaya' => 'required',
                'tanggal_tebar' => 'required|date', 
            ], [
                'nama_budidaya.required' => 'Nama Budidaya harus diisi ya.',
                'lama_budidaya.unique' => 'Lama Budidaya harus diisi ya.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator);
        }
        

        // Simpan data ke dalam tabel budidayas
        Budidaya::create($validatedData);

        // Tambahkan pesan sukses atau redirect sesuai kebutuhan aplikasi Anda
        return redirect(route('budidaya.index.belum.panen'))->with('success', 'Data Budidaya Berhasil Disimpan.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Budidaya $budidaya)
    {
        // Eager loading relasi feedings dan panen
        $budidaya = $budidaya->load(['feedings', 'panen']);

        $epValue = $this->calculateEP($budidaya);
        $fcrValue = $this->calculateFCR($budidaya);
        $fcrReverseValue = $this->calculateFCRReverse($budidaya);
        $sumOfFeeding = $this->sumOfFeeding($budidaya);

        $recommendationBasedOnFCRResult = $this->recomendationBasedOnFCRResult($budidaya->ikan->nama_ikan, $fcrValue);
        $recommendationBasedOnEPResult = $this->recomendationBasedOnEPResult($epValue);
        
        // Kirim data ke view
        return view('layouts.crud-budidaya.show', [
            'title' => 'Detail ' . $budidaya->nama_budidaya,
            'budidaya' => $budidaya,
            'nilai_ep' => $epValue,
            'nilai_fcr' => $fcrValue,
            'nilai_fcr_reverse' => $fcrReverseValue,
            'sum_of_feeding' => $sumOfFeeding,
            'recommendation_based_on_fcr_result' => $recommendationBasedOnFCRResult,
            'recommendation_based_on_ep_result' => $recommendationBasedOnEPResult
        ]);

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budidaya $budidaya)
    {  
        return view('layouts.crud-budidaya.edit', [
            'title' => 'Detail ' . $budidaya->nama_budidaya,
            'budidaya' => $budidaya,
            'ikans' => Ikan::all(),
            'pakans' => Pakan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budidaya $budidaya)
    {
        try {
            $validatedData = $request->validate([                 
                'id_budidaya' => 'required',
                'nama_budidaya' => 'required',
                'id_ikan' => 'required',
                'id_pakan' => 'required',
                'jumlah_tebar_ikan' => 'required|numeric',
                'bobot_awal_ikan' => 'required|numeric',
                'lama_budidaya' => 'required',
                'tanggal_tebar' => 'required|date', 
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator);
        }
        
        // Perbarui data puasa berdasarkan id_budidaya
        Budidaya::where('id_budidaya', $budidaya->id_budidaya)
                ->update($validatedData); 

        // Tambahkan pesan sukses atau redirect sesuai kebutuhan aplikasi Anda
        return redirect(route('budidaya.index.belum.panen'))->with('success', 'Data Budidaya Berhasil Diperbarui.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budidaya $budidaya)
    {
        Budidaya::destroy($budidaya->id_budidaya); // perintah untuk delete dari database table Post
        return redirect(route('budidaya.index.sudah.panen'))->with('success', 'Data Budidaya Berhasil Dihapus.');
    }

    public function calculateEP($budidaya) {

         // Eager loading relasi feedings dan panen
        $budidaya = $budidaya->load(['feedings', 'panen']);

        if($budidaya->feedings->isEmpty() || $budidaya->panen === null) {
            $epValue = 0;
        } else{
            // Menghitung nilai EP
            $epValue = 0;
            $epValue += ($budidaya->panen->bobot_akhir_ikan - $budidaya->bobot_awal_ikan) / $budidaya->feedings->sum('berat_pakan') * 100;
        }

        return $epValue;     
    }
    
    public function calculateFCR($budidaya) {

         // Eager loading relasi feedings dan panen
        $budidaya = $budidaya->load(['feedings', 'panen']);

        if($budidaya->feedings->isEmpty() || $budidaya->panen === null) {
            $fcrValue = 0;
        } else{
            // Menghitung nilai FCR
            $fcrValue = 0;
            $fcrValue += $budidaya->feedings->sum('berat_pakan') / ($budidaya->panen->bobot_akhir_ikan - $budidaya->bobot_awal_ikan);
        }

        return $fcrValue;     
    }
    
    public function calculateFCRReverse($budidaya) {

         // Eager loading relasi feedings dan panen
        $budidaya = $budidaya->load(['feedings', 'panen']);

        if($budidaya->feedings->isEmpty() || $budidaya->panen === null) {
            $fcrReverseValue = 0;
        } else{
             // Menghitung nilai FCR Reverse
            $fcrReverseValue = 0;
            $fcrReverseValue += ($budidaya->panen->bobot_akhir_ikan - $budidaya->bobot_awal_ikan) / $budidaya->feedings->sum('berat_pakan');
        }

        return $fcrReverseValue;     
    }

    public function sumOfFeeding($budidaya) {
        $budidaya = $budidaya->load(['feedings', 'panen']);
        $sumOfFeeding = $budidaya->feedings->sum('berat_pakan');
        return $sumOfFeeding;
    }

    public function recomendationBasedOnFCRResult($ikan, $fcrValue) {
        if($ikan === "Ikan Lele") {
            if($fcrValue < 1.0) {
                return "Sangat Baik, pertahankan kualitas pakan";
            } else if($fcrValue >= 1.0 && $fcrValue <= 1.5) {
                return "Baik, pertahankan kualitas pakan dan sebisanya untuk ditingkatkan hingga mencapai nilai FCR setidaknya 1.0 atau dibawahnya";
            } else if($fcrValue > 1.5) {
                return "Tidak Baik, tingkatkan kualitas pakan, perhatikan kualitasnya";
            } else {
                return "Tidak Diketahui | Pastikan nilai FCR tidak negatif";
            }
        } else if($ikan === "Ikan Nila") {
            if($fcrValue < 1.1) {
                return "Sangat Baik, pertahankan kualitas pakan";
            } else if($fcrValue >= 1.1 && $fcrValue <= 1.6) {
                return "Baik, pertahankan kualitas pakan dan sebisanya untuk ditingkatkan hingga mencapai nilai FCR setidaknya 1.0 atau dibawahnya";
            } else if($fcrValue > 1.6) {
                return "Tidak Baik, tingkatkan kualitas pakan, perhatikan kualitasnya";
            } else {
                return "Tidak Diketahui | Pastikan nilai FCR tidak negatif";
            }
        } else if($ikan === "Ikan Mas") {
             if($fcrValue < 1.5) {
                return "Sangat Baik, pertahankan kualitas pakan";
            } else if($fcrValue >= 1.5 && $fcrValue <= 2.0) {
                return "Baik, pertahankan kualitas pakan dan sebisanya untuk ditingkatkan hingga mencapai nilai FCR setidaknya 1.0 atau dibawahnya";
            } else if($fcrValue > 2.0) {
                return "Tidak Baik, tingkatkan kualitas pakan, perhatikan kualitasnya";
            } else {
                return "Tidak Diketahui | Pastikan nilai FCR tidak negatif";
            }
        } else if($ikan === "Ikan Karnivora") {
             if($fcrValue < 1.2) {
                return "Sangat Baik, pertahankan kualitas pakan";
            } else if($fcrValue >= 1.2 && $fcrValue <= 2.0) {
                return "Baik, pertahankan kualitas pakan dan sebisanya untuk ditingkatkan hingga mencapai nilai FCR setidaknya 1.0 atau dibawahnya";
            } else if($fcrValue > 2.0) {
                return "Tidak Baik, tingkatkan kualitas pakan, perhatikan kualitasnya";
            } else {
                return "Tidak Diketahui | Pastikan nilai FCR tidak negatif";
            }
        } else {
            return "Pastikan Ikannya ada dan Pastikan nilai FCR tidak negatif";
        }
    }

    public function recomendationBasedOnEPResult($epValue) {
        if($epValue > 50) {
            return "Sangat Baik, tingkatkan terus";
        } else if($epValue <= 50) {
            return "Tidak Baik, perbaiki frekuensi pemberian pakan dan gunakan pakan yang berkualitas, yang gampang dicerna oleh ikan. Perhatikan juga kualitas air dan suhu air. Selain itu juga beri vitamin dan mineral yang cukup sebagai suplemen ikan";
        } else {
            return "Tidak Diketahui | Pastikan nilai EP tidak negatif";
        }
    }
}