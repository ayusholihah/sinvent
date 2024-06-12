<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();
        
        $barangMasukTotal = BarangMasuk::sum('qty_masuk');
        $barangKeluarTotal = BarangKeluar::sum('qty_keluar');

        $barangMasukData = BarangMasuk::orderBy('tgl_masuk')->pluck('qty_masuk', 'tgl_masuk')->toArray();
        $barangKeluarData = BarangKeluar::orderBy('tgl_keluar')->pluck('qty_keluar', 'tgl_keluar')->toArray();

        $dates = array_keys(array_merge($barangMasukData, $barangKeluarData));

        $qtyMasuk = $request->input('qty_masuk', $barangMasukTotal);

        return view('dashboard.index', compact('barangMasuk', 'barangKeluar', 'barangMasukTotal', 'barangKeluarTotal', 'barangMasukData', 'barangKeluarData', 'dates', 'qtyMasuk'));
    }

    public function update(Request $request) {
        $request->validate([
            'qty_masuk' => 'required|numeric|min:1',
        ]);

        $qtyMasuk = $request->input('qty_masuk');

        return redirect()->route('dashboard.index', ['qty_masuk' => $qtyMasuk]);
    }

    
}