@extends('layout')

@section('judul', 'Detail Produk')

@section('konten')
<section class="section">
    <div class="container">
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="notification is-success is-light">
                <button class="delete"></button>
                {{ session('success') }}
                <a href="{{ url('/keranjang') }}" class="button is-link is-small ml-4">Lihat Keranjang</a>
            </div>
        @endif

        {{-- Notifikasi Gagal --}}
        @if(session('error'))
            <div class="notification is-danger is-light">
                <button class="delete"></button>
                {{ session('error') }}
            </div>
        @endif

        {{-- Error Validasi --}}
        @if($errors->any())
            <div class="notification is-danger is-light">
                <button class="delete"></button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="columns">
            <!-- Gambar Produk -->
            <div class="column is-6">
                <figure class="image is-4by3">
                    <img src="{{ asset($produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" style="object-fit: contain; max-height: 400px;">
                </figure>
            </div>

            <!-- Info Produk -->
            <div class="column is-6">
                <h1 class="title is-3">{{ $produk->nama_produk }}</h1>

                <p class="subtitle is-5 has-text-weight-semibold">
                    Harga Satuan:
                    <span class="has-text-primary" id="harga-satuan" data-harga="{{ $produk->harga }}">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                </p>

                <p><strong>Kategori:</strong> {{ ucfirst($produk->kategori) }}</p>
                <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                <p><strong>Status:</strong> {{ ucfirst($produk->status) }}</p>

                @if($produk->deskripsi)
                <div class="mt-4">
                    <h2 class="title is-5">Deskripsi Produk</h2>
                    <p>{{ $produk->deskripsi }}</p>
                </div>
                @endif

                <!-- Form keranjang -->
                <form method="POST" action="{{ route('keranjang_detail.store') }}" class="mt-5">
                    @csrf
                    <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                    <div class="field is-grouped is-align-items-center">
                        <label class="label mr-3">Jumlah:</label>
                        <div class="control">
                            <button type="button" class="button is-info" id="btn-minus">-</button>
                        </div>
                        <div class="control">
                            <input
                                type="number"
                                name="jumlah"
                                id="jumlah"
                                class="input"
                                min="1"
                                max="{{ $produk->stok }}"
                                value="1"
                                style="width: 80px; text-align: center;"
                                required>
                        </div>
                        <div class="control">
                            <button type="button" class="button is-info" id="btn-plus">+</button>
                        </div>
                    </div>

                    <p class="mt-3">
                        Harga Total:
                        <strong class="has-text-primary" id="harga-total">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </strong>
                    </p>

                   <div class="mt-4">
                        @auth
                            <form method="POST" action="{{ route('keranjang_detail.store') }}">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <button type="submit" class="button is-primary">Tambah ke Keranjang</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="button is-warning">Login untuk Tambah ke Keranjang</a>
                        @endauth

                        <a href="/produk" class="button is-light ml-3">← Kembali ke Halaman Produk</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<!-- Script untuk interaksi jumlah dan total harga -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hargaSatuan = parseInt(document.getElementById('harga-satuan').dataset.harga);
        const jumlahInput = document.getElementById('jumlah');
        const hargaTotal = document.getElementById('harga-total');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');
        const stokMaks = parseInt(jumlahInput.max);

        function updateHargaTotal() {
            let jumlah = parseInt(jumlahInput.value) || 1;
            jumlah = Math.max(1, Math.min(jumlah, stokMaks));
            jumlahInput.value = jumlah;
            const total = hargaSatuan * jumlah;
            hargaTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        btnPlus.addEventListener('click', function() {
            let jumlah = parseInt(jumlahInput.value) || 1;
            if (jumlah < stokMaks) {
                jumlahInput.value = jumlah + 1;
                updateHargaTotal();
            }
        });

        btnMinus.addEventListener('click', function() {
            let jumlah = parseInt(jumlahInput.value) || 1;
            if (jumlah > 1) {
                jumlahInput.value = jumlah - 1;
                updateHargaTotal();
            }
        });

        jumlahInput.addEventListener('input', updateHargaTotal);
        updateHargaTotal(); // inisialisasi

        // Notification close
        document.querySelectorAll('.notification .delete').forEach(function(el) {
            el.addEventListener('click', function () {
                el.parentNode.remove();
            });
        });
    });
</script>
@endsection
