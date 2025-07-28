@extends('layout')

@section('title', 'Ubah Produk')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Ubah Produk</h1>

        @if(session('success'))
            <div class="notification is-success is-light">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label class="label">Nama Produk</label>
                <div class="control">
                    <input class="input" type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Harga</label>
                <div class="control">
                    <input class="input" type="number" name="harga" value="{{ old('harga', $produk->harga) }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Stok</label>
                <div class="control">
                    <input class="input" type="number" name="stok" value="{{ old('stok', $produk->stok) }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Status</label>
                <div class="control">
                    <div class="select">
                        <select name="status" required>
                            <option value="tersedia" {{ $produk->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak" {{ $produk->status == 'tidak' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Kategori</label>
                <div class="control">
                    <div class="select">
                        <select name="kategori" required>
                            <option value="Tenda" {{ $produk->kategori == 'Tenda' ? 'selected' : '' }}>Tenda</option>
                            <option value="Pole" {{ $produk->kategori == 'Pole' ? 'selected' : '' }}>Pole</option>
                            <option value="Sepatu" {{ $produk->kategori == 'Sepatu' ? 'selected' : '' }}>Sepatu</option>
                            <option value="Baju" {{ $produk->kategori == 'Baju' ? 'selected' : '' }}>Baju</option>
                            <option value="Tas" {{ $produk->kategori == 'Tas' ? 'selected' : '' }}>Tas</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Gambar Produk</label>
                <div class="control">
                    <input type="file" name="gambar_produk" class="input">
                    @if($produk->gambar_produk)
                        <p class="mt-2"><img src="{{ asset($produk->gambar_produk) }}" width="150" alt="Gambar Produk"></p>
                    @endif
                </div>
            </div>

            <div class="field mt-4">
                <div class="control">
                    <button class="button is-primary" type="submit">Simpan Perubahan</button>
                    <a href="/admin" class="button is-light">Kembali ke Halaman Awal</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
