<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Transaction;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function token(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $orderId = 'ORDER-' . uniqid();

        Order::create([ 
            'user_id' => $user->id,
            'order_id' => $orderId,
            'total' => $request->total ?? 0, // total dummy jika belum ada
            'id_keranjang' => $request->id_keranjang,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->total ?? 0,
            ],
            'customer_details' => [
                'first_name' => $user->nama,
                'email' => $user->email ?? 'dummy@email.com',
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function pending()
    {
        return view('checkout.pending');
    }

    public function cekStatus(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Tidak login']);
        }

        $order = Order::where('user_id', $user->id)->latest()->first();

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan']);
        }

        try {
            $status = Transaction::status($order->order_id);
            $order->status = $status->transaction_status ?? 'unknown';
            $order->save();

            return response()->json(['status' => $order->status]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil status: ' . $e->getMessage()]);
        }
    }

    public function statusPage()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->latest()->first();

        return view('checkout.status', compact('order'));
    }
   public function riwayat()
    {
        // Ambil semua orders (riwayat transaksi)
        $riwayat = DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil detail keranjang berdasarkan id_keranjang yang tersimpan di orders
        $keranjangDetails = DB::table('orders')
            ->join('keranjang_detail', 'orders.id_keranjang', '=', 'keranjang_detail.id')
            ->join('produk', 'keranjang_detail.id_produk', '=', 'produk.id')
            ->select(
                'orders.id as order_id',
                'produk.nama_produk',
                'keranjang_detail.jumlah',
                'keranjang_detail.total_harga'
            )
            ->get()
            ->groupBy('order_id');

        return view('checkout.riwayat', compact('riwayat', 'keranjangDetails'));
    }


    public function simulateCallback(Request $request)
    {
        $orderId = $request->order_id;

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        // Simulasikan status settlement
        $order->status = 'settlement';
        $order->save();

        return response()->json([
            'message' => 'Status settlement disimpan ke database untuk order ID: ' . $orderId,
            'order' => $order
        ]);
    }

}
