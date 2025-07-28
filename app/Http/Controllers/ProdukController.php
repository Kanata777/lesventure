<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function list(Request $request)
    {
        $query = Produk::query();

        // Filter kategori (bisa lebih dari satu)
        if ($request->filled('kategori')) {
            $query->whereIn('kategori', $request->kategori);
        }

        // Pencarian berdasarkan nama_produk
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Ambil hasil akhir dengan pagination
        $produk = $query->paginate(9);

        // Ambil semua kategori unik
        $kategoriList = Produk::select('kategori')->distinct()->get();

        return view('produk.list', [
            'produk' => $produk,
            'kategoriList' => $kategoriList
        ]);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.detail', compact('produk'));
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    public function adminIndex(Request $request)
    {
        $query = Produk::query();

        // Filter kategori (bisa lebih dari satu)
        if ($request->filled('kategori')) {
            $query->whereIn('kategori', $request->kategori);
        }

        // Pencarian berdasarkan nama_produk
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Ambil hasil akhir dengan pagination
        $produk = $query->paginate(9);

        // Ambil semua kategori unik
        $kategoriList = Produk::select('kategori')->distinct()->get();

        return view('admin.produk', [
            'produk' => $produk,
            'kategoriList' => $kategoriList
        ]);
    }
     public function ubah($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.ubah', compact('produk'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak',
            'kategori' => 'required|in:Tenda,Pole,Sepatu,Baju,Tas',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->status = $request->status;
        $produk->kategori = $request->kategori;

        // ✅ Proses gambar jika diupload
        if ($request->hasFile('gambar_produk')) {
        $file = $request->file('gambar_produk');
        $path = $file->store('produk', 'public'); // ✅ simpan di storage/app/public/produk
        $produk->gambar_produk = 'storage/' . $path; // ✅ simpan path-nya agar bisa diakses browser
        }

        $produk->save();

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function tambah()
    {
        return view('admin.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak',
            'kategori' => 'required|in:Tenda,Pole,Sepatu,Baju,Tas',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = new Produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->status = $request->status;
        $produk->kategori = $request->kategori;

        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $path = $file->store('produk', 'public');
            $produk->gambar_produk = 'storage/' . $path;
        }

        $produk->save();
        return redirect()->back()->with('success', 'Produk berhasil ditambah.');
    }


}
