<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        $data = array("data"=>$barang);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi'   => 'required',
            'barang'    => 'required',
        ]);
        
        $barangbaru = Barang::create([
            'deskripsi'  => $request->deskripsi,
            'barang'   => $request->barang,
        ]);

        $data = array("data"=>$barangbaru);
        return response()->json($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $barang = Barang::find($id);
        
        if(!$barang){
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }else{
            $data=array("data"=>$barang);
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::find($id);

        $request->validate([
            'deskripsi'   => 'required',
            'barang'    => 'required',
        ]);
        
        if (!$barang) {
            return response()->json(['status' => 'Barang tidak ditemukan'], 404);
        }else{
            $barang->update([
                'deskripsi'=>$request->deskripsi,
                'barang'=>$request->barang,
            ]);

        return response()->json(['status' => 'Barang berhasil diubah'], 200);          
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['status' => 'Barang tidak ditemukan'], 404);
        }
        
        try {
            $barang->delete();
            return response()->json(['status' => 'Barang berhasil dihapus'], 200);
        } catch (\Illuminate\Database\QueryException) {
            // Tangkap pengecualian spesifik dari database (termasuk constraints foreign key)
            return response()->json(['status' => 'Barang tidak dapat dihapus'], 500);
        }
    
    }
}