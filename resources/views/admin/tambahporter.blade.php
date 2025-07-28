@extends('layout')

@section('title', 'Tambah Porter')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Tambah Porter</h1>

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

        <form action="{{ route('admin.porter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label class="label">Nama</label>
                <div class="control">
                    <input type="text" name="nama" class="input" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Usia</label>
                <div class="control">
                    <input type="number" name="usia" class="input" min="10" max="100" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Jenis Kelamin</label>
                <div class="control">
                    <div class="select">
                        <select name="jenis_kelamin" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Lokasi</label>
                <div class="control">
                    <div class="select">
                        <select name="id_lokasi" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach (\App\Models\Lokasi::all() as $lokasi)
                                <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">No HP</label>
                <div class="control">
                    <input type="text" name="no_hp" class="input">
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input type="email" name="email" class="input">
                </div>
            </div>

            <div class="field">
                <label class="label">Alamat</label>
                <div class="control">
                    <textarea name="alamat" class="textarea"></textarea>
                </div>
            </div>

            <div class="field">
                <label class="label">Pengalaman</label>
                <div class="control">
                    <textarea name="pengalaman" class="textarea"></textarea>
                </div>
            </div>

            <div class="field">
                <label class="label">Foto</label>
                <div class="control">
                    <input type="file" name="foto" class="input">
                </div>
            </div>

            <div class="field mt-4">
                <button type="submit" class="button is-primary">Simpan</button>
                <a href="/admin" class="button is-light">Kembali ke Halaman Awal</a>
            </div>
        </form>
    </div>
</section>
@endsection
