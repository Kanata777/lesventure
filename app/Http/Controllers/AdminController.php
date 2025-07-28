<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class AdminController extends Controller
{
    public function admin()
    {
        $data = Produk::all(); // ambil semua produk
        return view('admin.dashboard', compact('data'));
    }
}
