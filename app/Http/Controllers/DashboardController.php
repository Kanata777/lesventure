<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // ← tambahkan ini untuk tipe View
use App\Models\Produk; // Pastikan model ini memang ada
use App\Models\News;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        $data = Produk::with('popularProduk')->get();
        $news = News::all();

        return view('dashboard', [
            'data' => $data,
            'news' => $news
        ]);
    }
}
