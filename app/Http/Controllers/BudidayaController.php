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
    public function index()
    {
        return view('layouts.crud-budidaya.index', [
            'budidayas' => Budidaya::latest()->paginate(5)
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
        return redirect(route('budidaya.index'))->with('success', 'Data Budidaya Berhasil Disimpan.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Budidaya $budidaya)
    {
       // Eager loading relasi feedings dan panen
        $budidaya = $budidaya->load(['feedings', 'panen']);

        // Menghitung total pakan dari relasi feedings
        // $totalPakan = $budidaya->feedings->sum('berat_pakan');

        // Hitung EP Value
        // $epValue = ((($budidaya->panen->bobot_akhir + 100) - $budidaya->bobot_awal_ikan) / $totalPakan) * 100;

        // Kirim data ke view
        return view('layouts.crud-budidaya.show', [
            'title' => 'Detail ' . $budidaya->nama_budidaya,
            'budidaya' => $budidaya,
            // 'nilai_ep' => $epValue
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
        return redirect(route('budidaya.index'))->with('success', 'Data Budidaya Berhasil Diperbarui.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budidaya $budidaya)
    {
        Budidaya::destroy($budidaya->id_budidaya); // perintah untuk delete dari database table Post
        return redirect(route('budidaya.index'))->with('success', 'Data Budidaya Berhasil Dihapus.');
    }

    public function hitungEP() {
        
    }
}