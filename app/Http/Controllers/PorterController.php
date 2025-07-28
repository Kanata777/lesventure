<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Porter;
use App\Models\Lokasi;
use Illuminate\View\View;

class PorterController extends Controller
{
    public function list(Request $request): View
    {
        // Ambil semua lokasi untuk dropdown
        $lokasiList = Lokasi::all();

        $portersByLokasi = collect();

        // Jika user memilih lokasi tertentu
        if ($request->filled('lokasi')) {
            $lokasi = Lokasi::find($request->lokasi);

            // Jika lokasi ditemukan
            if ($lokasi) {
                $query = Porter::where('id_lokasi', $lokasi->id);

                if ($request->filled('search')) {
                    $query->where('nama', 'like', '%' . $request->search . '%');
                }

                $porters = $query->get();

                $portersByLokasi->put($lokasi->nama_lokasi, $porters);
            }
        } else {
            // Jika tidak memilih lokasi, ambil semua provinsi dan 1 porter (jika ada)
            foreach ($lokasiList as $lokasi) {
                $query = Porter::where('id_lokasi', $lokasi->id);

                if ($request->filled('search')) {
                    $query->where('nama', 'like', '%' . $request->search . '%');
                }

                $porters = $query->get();

                // Tetap simpan semua lokasi (bisa kosong), Blade akan tangani logika tampilan
                $portersByLokasi->put($lokasi->nama_lokasi, $porters);
            }
        }
        $allPorters = $portersByLokasi->flatten(1)->unique('id')->values();

        return view('porter.list', [
            'lokasiList' => $lokasiList,
            'portersByLokasi' => $portersByLokasi,
            'allPorters' => $allPorters,
        ]);
    }

    public function adminIndex(Request $request): View
    {
        // Ambil semua lokasi untuk dropdown
        $lokasiList = Lokasi::all();
        $portersByLokasi = collect();

        if ($request->filled('lokasi')) {
            $lokasi = Lokasi::find($request->lokasi);

            if ($lokasi) {
                $query = Porter::where('id_lokasi', $lokasi->id);

                if ($request->filled('search')) {
                    $query->where('nama', 'like', '%' . $request->search . '%');
                }

                $porters = $query->get();
                $portersByLokasi->put($lokasi->nama_lokasi, $porters);
            }
        } else {
            // Ambil semua porter dikelompokkan berdasarkan lokasi
            foreach ($lokasiList as $lokasi) {
                $query = Porter::where('id_lokasi', $lokasi->id);

                if ($request->filled('search')) {
                    $query->where('nama', 'like', '%' . $request->search . '%');
                }

                $porters = $query->get();
                $portersByLokasi->put($lokasi->nama_lokasi, $porters);
            }
        }

        return view('admin.porter', [
            'lokasiList' => $lokasiList,
            'portersByLokasi' => $portersByLokasi,
        ]);
}
    public function ubah($id)
    {
        $porter = Porter::findOrFail($id);
        return view('admin.ubahporter', compact('porter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'usia' => 'required|integer|min:10|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_lokasi' => 'required|integer|exists:lokasi,id',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $porter = Porter::findOrFail($id);

        $porter->nama = $request->nama;
        $porter->usia = $request->usia;
        $porter->jenis_kelamin = $request->jenis_kelamin;
        $porter->id_lokasi = $request->id_lokasi;
        $porter->no_hp = $request->no_hp;
        $porter->email = $request->email;
        $porter->alamat = $request->alamat;
        $porter->pengalaman = $request->pengalaman;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('porter', 'public'); // simpan di storage/app/public/porter
            $porter->foto = 'storage/' . $path;
        }

        $porter->save();

        return redirect()->back()->with('success', 'Data porter berhasil diperbarui.');
    }
    public function tambah()
    {
        return view('admin.tambahporter');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'usia' => 'required|integer|min:10|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_lokasi' => 'required|integer|exists:lokasi,id',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        $porter = new Porter();
        $porter->nama = $request->nama;
        $porter->usia = $request->usia;
        $porter->jenis_kelamin = $request->jenis_kelamin;
        $porter->id_lokasi = $request->id_lokasi;
        $porter->no_hp = $request->no_hp;
        $porter->email = $request->email;
        $porter->alamat = $request->alamat;
        $porter->pengalaman = $request->pengalaman;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('porter', 'public');
            $porter->foto = 'storage/' . $path;
        }

        $porter->save();

        return redirect()->back()->with('success', 'Data porter berhasil ditambahkan.');
    }

    
}
