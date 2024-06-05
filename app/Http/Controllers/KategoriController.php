<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;


class KategoriController extends Controller
{
    public function index(Request $request)
    {
    /**
    * Display a listing of the resource.
    */

        $rsetKategori = DB::table('kategori')->select('id','deskripsi',DB::raw('ketKategorik(kategori) as ketkategori'))->paginate(10);
        return view('view_kategori.index',compact('rsetKategori'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aKategori = array('blank'=>'Pilih Kategori',
                            'M'=>'Barang Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai'
                            );
        return view('view_kategori.create',compact('aKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'deskripsi'   => 'required | unique:kategori',
            'kategori'    => 'required | in:M,A,BHP,BTHP',
        ]);

        // buat kategori baru
        Kategori::create([
            'deskripsi'  => $request->deskripsi,
	        'kategori'   => $request->kategori,
        ]);
        
        //redirect ke kategori index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);

        // $rsetKategori = Kategori::select('id','deskripsi','kategori',
        //     \DB::raw('(CASE
        //         WHEN kategori = "M" THEN "Modal"
        //         WHEN kategori = "A" THEN "Alat"
        //         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategori'))->where('id', '=', $id);

        return view('view_kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
        // $akategori = Kategori::all();
        $kategori = Kategori::find($id);

        // $selectedKategori = Kategori::find($kategori->kategori_id);
        return view('view_kategori.edit', compact('kategori'));
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate( [
            'deskripsi'              => 'required',
            'kategori'              => 'required',
            // 'spesifikasi'       => 'required',
            // 'stok'              => 'required',
            // 'kategori_id'       => 'required',
        ]);

        $kategori = Kategori::find($id);
            $kategori->update([
                'deskripsi'              => $request->deskripsi,
                'kategori'              => $request->kategori,
                // 'spesifikasi'       => $request->spesifikasi,
                // 'stok'              => $request->stok,
                // 'kategori_id'       => $request->kategori_id
            ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['gagal' => 'Data Gagal Dihapus! Data masih digunakan']);            
        } else {
        $rsetKategori = Kategori::find($id);
        $rsetKategori->delete();
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }

        //$rsetKategori = Kategori::find($id);
        //delete image
        // Storage::delete('public/foto/'. $rsetKategori->foto);

        //delete post
        //$rsetKategori->delete();

        //redirect to index
        //return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}