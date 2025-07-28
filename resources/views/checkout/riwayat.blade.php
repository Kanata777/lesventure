@extends('layout')

@section('title', 'Riwayat Pembayaran')

@section('konten')
<section class="section" style="margin-top: 4rem;">
    <div class="container">
        <h1 class="title is-4">Riwayat Pembayaran</h1>

        <table class="table is-striped is-fullwidth mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Status</th>
                    <th>Waktu Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <ul>
                            @foreach ($keranjangDetails[$order->id] ?? [] as $item)
                                <li>
                                    {{ $item->nama_produk }} - {{ $item->jumlah }}x (Rp{{ number_format($item->total_harga, 0, ',', '.') }})
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <span class="tag is-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="has-text-centered">Tidak ada riwayat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
