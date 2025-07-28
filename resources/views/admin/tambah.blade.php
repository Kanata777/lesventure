@extends('layout')

@section('title', 'Tambah Produk')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Tambah Produk</h1>

        @if(session('success'))
            <div class="notification is-success is-light">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label class="label">Nama Produk</label>
                <div class="control">
                    <input type="text" name="nama_produk" class="input" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Harga</label>
                <div class="control">
                    <input type="number" name="harga" class="input" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Stok</label>
                <div class="control">
                    <input type="number" name="stok" class="input" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Status</label>
                <div class="control">
                    <div class="select">
                        <select name="status" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Kategori</label>
                <div class="control">
                    <div class="select">
                        <select name="kategori" required>
                            <option value="Tenda">Tenda</option>
                            <option value="Pole">Pole</option>
                            <option value="Sepatu">Sepatu</option>
                            <option value="Baju">Baju</option>
                            <option value="Tas">Tas</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Gambar Produk</label>
                <div class="control">
                    <input type="file" name="gambar_produk" class="input">
                </div>
            </div>

            <div class="field mt-4">
                <button class="button is-primary">Simpan</button>
                <a href="/admin" class="button is-light">Kembali ke Halaman Awal</a>
            </div>
        </form>
    </div>
</section>
@endsection
