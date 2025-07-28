<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function adminIndex()
    {
        return view('admin.chat.index'); // Sesuaikan dengan file view admin
    }
}
