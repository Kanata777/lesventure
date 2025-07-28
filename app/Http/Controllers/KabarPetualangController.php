<?php

namespace App\Http\Controllers;

use App\Models\KabarPetualang;
use App\Models\Gunung;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class KabarPetualangController extends Controller
{
    // Menampilkan daftar kabar petualang
    public function list()
    {
        $berita = KabarPetualang::with(['gunung', 'lokasi'])->get();
        return view('kabar_petualang.list', compact('berita'));
    }

    public function show($id)
    {
        $berita = KabarPetualang::with('gunung.lokasi')->findOrFail($id);
        return view('kabar_petualang.detail', compact('berita'));
    }


    // Menampilkan form tambah data
    public function create()
    {
        $gunung = Gunung::all();
        $lokasiList = Lokasi::all();
        return view('kabar_petualang.create', compact('gunung', 'lokasi'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_gunung' => 'required|exists:gunung,id',
            'id_lokasi' => 'required|exists:lokasi,id',
        ]);

        KabarPetualang::create([
            'id_gunung' => $request->id_gunung,
            'id_lokasi' => $request->id_lokasi,
        ]);

        return redirect()->route('kabar.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $berita = KabarPetualang::findOrFail($id);
        $gunung = Gunung::all();
        $lokasi = Lokasi::all();
        return view('kabar_petualang.edit', compact('berita', 'gunung', 'lokasi'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_gunung' => 'required|exists:gunung,id',
            'id_lokasi' => 'required|exists:lokasi,id',
        ]);

        $berita = KabarPetualang::findOrFail($id);
        $berita->update([
            'id_gunung' => $request->id_gunung,
            'id_lokasi' => $request->id_lokasi,
        ]);

        return redirect()->route('kabar.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $berita = KabarPetualang::findOrFail($id);
        $berita->delete();

        return redirect()->route('kabar.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function adminIndex()
    {
        $berita = KabarPetualang::with(['gunung', 'lokasi'])->latest()->get();
        return view('admin.kabar', compact('berita'));
    }


}
