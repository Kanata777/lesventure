<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeranjangDetail;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangDetailController extends Controller
{
    // Menampilkan semua item dalam keranjang
    public function list()
    {
        $keranjang = KeranjangDetail::with('produk')->get();
        return view('keranjang.list', compact('keranjang'));
    }

    // Menambahkan item ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->id_produk);
        $totalHarga = $produk->harga * $request->jumlah;

        // Ambil keranjang pertama yang ada, atau buat baru (tanpa syarat total_harga)
        $keranjang = Keranjang::firstOrCreate([]);

        // Tambahkan ke keranjang_detail
        KeranjangDetail::create([   
            'id_keranjang' => $keranjang->id,
            'id_produk' => $produk->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Menghapus item dari keranjang
    public function destroy($id)
    {
        $keranjangDetail = KeranjangDetail::findOrFail($id);
        $keranjangDetail->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function destroyDetail($idKeranjang)
    {
        KeranjangDetail::where('id_keranjang', $idKeranjang)->delete();

        return redirect()->back()->with('success_detail', 'Semua isi keranjang berhasil dihapus.');
    }
    
}
