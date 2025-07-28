<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopularProduk;
use Illuminate\View\View;

class PopularProdukController extends Controller
{
    public function index(): View
    {
        $popularProduk = PopularProduk::with('produk')->get();

        return view('popular_produk.index', [
            'popularProduk' => $popularProduk
        ]);
    }

    public function show($id): View
    {
        $popularProduk = PopularProduk::with('produk')->findOrFail($id);

        return view('popular_produk.show', [
            'popularProduk' => $popularProduk
        ]);
    }

    public function adminIndex()
    {
        return view('admin.produk.index'); // Sesuaikan dengan file view admin
    }
}
