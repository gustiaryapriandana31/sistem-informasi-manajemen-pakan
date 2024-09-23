<?php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use Illuminate\Http\Request;
use App\Models\Feeding;

class FeedingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Budidaya $budidaya)
    {
        return view('layouts.crud-budidaya.crud-budidaya-feeding.create', [
            'title' => 'Feeding for ' . $budidaya->nama_budidaya,
            'budidaya' => Budidaya::where('id_budidaya', $budidaya->id_budidaya)->first()        
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Budidaya $budidaya)
    {
        try {
            $validatedData = $request->validate([                 
                'berat_pakan' => 'required',
                'jangka_waktu' => 'required',
                'tanggal_feeding' => 'required|date', 
            ], [
                'nama_budidaya.required' => 'Nama Budidaya harus diisi ya.',
                'lama_budidaya.unique' => 'Lama Budidaya harus diisi ya.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator);
        }

        $validatedData['id_budidaya'] = $budidaya->id_budidaya;
        

        // Simpan data ke dalam tabel budidayas
        Feeding::create($validatedData);

        // Tambahkan pesan sukses atau redirect sesuai kebutuhan aplikasi Anda
        return redirect()->route('budidaya.show', $budidaya->id_budidaya)->with('success', 'Data Feeding Berhasil Disimpan.'); 
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}