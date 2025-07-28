@extends('layout')

@section('title', 'Keranjang Sewa Produk')

@section('konten')
<section class="section" style="margin-top: 3rem;">

    <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarMenu" class="navbar-menu" style="width: 100%;">
        <div class="navbar-start" style="width: 33%;"></div>

        <div class="navbar-item is-flex is-justify-content-center" style="width: 34%;">
        <div class="is-flex is-justify-content-center">
            <a href="/" class="navbar-item {{ request()->is('/') ? 'has-text-primary' : '' }}">Beranda</a>
            <a href="/produk" class="navbar-item {{ request()->is('produk') ? 'has-text-primary' : '' }}">Sewa Alat Camping</a>
            <a href="/porter" class="navbar-item {{ request()->is('porter') ? 'has-text-primary' : '' }}">Sewa Porter</a>
            <a href="/kabar" class="navbar-item {{ request()->is('kabar') ? 'has-text-primary has-text-weight-bold' : '' }}">Kabar Petualang</a>
            <a href="/keranjang" class="navbar-item {{ request()->is('keranjang') ? 'has-text-primary' : '' }}">Keranjang</a>
            <a href="/chat" class="navbar-item {{ request()->is('chat') ? 'has-text-primary' : '' }}">Hubungi Kami</a>
        </div>
        </div>

        <div class="navbar-end" style="width: 33%; justify-content: flex-end;">
        <div class="navbar-item">
            @auth
            <span class="mr-3">Halo, {{ Auth::user()->nama }}</span>
            @endauth

            <div class="buttons">
            @guest
            <a href="/register" class="button is-light">Daftar</a>
            <a href="/login" class="button is-primary"><strong>Masuk</strong></a>
            @endguest

            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="button is-light">Logout</button>
            </form>
            @endauth
            </div>
        </div>
        </div>
    </div>
    </nav>

    <div class="container">
        <h1 class="title is-4 has-text-weight-bold mb-4">Keranjang</h1>

        @if(session('success'))
            <div class="notification is-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="columns">
            {{-- Kolom Kiri --}}
            <div class="column is-8">
                <div class="box" style="border-radius: 12px;">
                    <div class="is-flex is-justify-content-space-between is-align-items-center mb-4">
                        <label class="checkbox">
                            <input type="checkbox" id="pilihSemua" onclick="toggleSemua()">
                            <strong>Pilih Semua</strong> ({{ count($keranjang) }})
                        </label>
                    </div>

                    {{-- Daftar Produk --}}
                    @foreach ($keranjang as $item)
                        @php
                            $idKeranjang = $item->id ?? $item->id_keranjang ?? null;
                            $produk = $item->produk;
                            $hargaTotal = $produk->harga * $item->jumlah;
                        @endphp

                        <div class="box item-keranjang" data-harga="{{ $hargaTotal }}">
                            <div class="mb-2 is-flex is-align-items-center">
                                <input type="checkbox" class="checkbox-item" onclick="updateTotal()" checked>
                                <strong style="margin-left: 10px;">{{ $produk->nama_produk }}</strong>
                            </div>

                            <div class="is-flex">
                                <figure class="image is-96x96 mr-4">
                                    <img src="{{ $produk->gambar_produk }}" alt="{{ $produk->nama_produk }}" style="object-fit: cover; border-radius: 8px;">
                                </figure>

                                <div class="is-flex is-justify-content-space-between is-align-items-center" style="width: 100%;">
                                    <div>
                                        <p class="has-text-weight-semibold">{{ $produk->nama_produk }}</p>
                                        <p class="mt-1">
                                            <span class="has-text-danger has-text-weight-bold">
                                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                            </span>
                                            @if($produk->harga_coret ?? false)
                                                <span class="has-text-grey-light has-text-line-through ml-2">
                                                    Rp{{ number_format($produk->harga_coret, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="is-flex" style="gap: 0.75rem;">

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('keranjang.destroy', $idKeranjang) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button is-white is-small">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        {{-- Kontrol Jumlah --}}
                                        <div class="is-flex is-align-items-center quantity-control" 
                                            data-id="{{ $item->id }}" 
                                            data-stok="{{ $produk->stok }}" 
                                            data-jumlah="{{ $item->jumlah }}"
                                            style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                            
                                            <button type="button" class="button is-white is-small btn-minus">-</button>
                                            <span class="px-2 jumlah-text">{{ $item->jumlah }}</span>
                                            <button type="button" class="button is-white is-small btn-plus">+</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="column is-4">
                <div class="box" style="border-radius: 12px;">
                    <p class="has-text-weight-bold mb-3">Ringkasan Belanja</p>
                    <p class="mb-2">Total</p>
                    <p class="title is-4 has-text-weight-bold has-text-success" id="totalHarga">
                        Rp{{ number_format($keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah), 0, ',', '.') }}
                    </p>

                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" id="idKeranjang" value="{{ $keranjang->first()->id ?? '' }}">
                    
                    <div class="buttons">
                        <button class="button is-success" id="bayarBtn">Bayar Sekarang</button>
                        <a href="/riwayat" class="button is-light">Cek Riwayat Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

{{-- Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

{{-- Script --}}
<script>
    function toggleSemua() {
        const semua = document.getElementById('pilihSemua').checked;
        const checkboxes = document.querySelectorAll('.checkbox-item');
        checkboxes.forEach(cb => cb.checked = semua);
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        const items = document.querySelectorAll('.item-keranjang');

        items.forEach(item => {
            const checkbox = item.querySelector('.checkbox-item');
            const harga = parseInt(item.getAttribute('data-harga'));
            if (checkbox.checked) {
                total += harga;
            }
        });

        document.getElementById('totalHarga').innerText = formatRupiah(total);
    }

    function formatRupiah(angka) {
        return 'Rp' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Trigger Midtrans
   document.getElementById('bayarBtn').addEventListener('click', function (e) {
    e.preventDefault();

    let totalHargaText = document.getElementById('totalHarga').innerText.replace(/[Rp.]/g, '');
    let total = parseInt(totalHargaText);

    let idKeranjang = document.getElementById('idKeranjang').value;

    fetch("/checkout/token", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 
            total: total,
            id_keranjang: idKeranjang // kirim id keranjang ke backend
        })
    })
    .then(res => res.json())
    .then(data => {
        snap.pay(data.token, {
            onSuccess: function(result) {
                fetch("/checkout/simulate-callback", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        order_id: result.order_id 
                    })
                })
                .then(() => {
                    window.location.href = "/checkout/success";
                });
            },
            onPending: function(result) {
                window.location.href = "/checkout/pending";
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
            }
        });
    });
});



    document.addEventListener('DOMContentLoaded', updateTotal);
</script>
@endsection
