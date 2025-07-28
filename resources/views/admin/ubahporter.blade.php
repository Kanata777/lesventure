@extends('layout')

@section('title', 'Ubah Data Porter')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Ubah Data Porter</h1>

        @if(session('success'))
            <div class="notification is-success is-light">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.porter.update', $porter->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label class="label">Nama</label>
                <div class="control">
                    <input class="input" type="text" name="nama" value="{{ old('nama', $porter->nama) }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Usia</label>
                <div class="control">
                    <input class="input" type="number" name="usia" value="{{ old('usia', $porter->usia) }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Jenis Kelamin</label>
                <div class="control">
                    <div class="select">
                        <select name="jenis_kelamin" required>
                            <option value="Laki-laki" {{ $porter->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $porter->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Lokasi</label>
                <div class="control">
                    <input class="input" type="number" name="id_lokasi" value="{{ old('id_lokasi', $porter->id_lokasi) }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">No HP</label>
                <div class="control">
                    <input class="input" type="text" name="no_hp" value="{{ old('no_hp', $porter->no_hp) }}">
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" value="{{ old('email', $porter->email) }}">
                </div>
            </div>

            <div class="field">
                <label class="label">Alamat</label>
                <div class="control">
                    <textarea class="textarea" name="alamat">{{ old('alamat', $porter->alamat) }}</textarea>
                </div>
            </div>

            <div class="field">
                <label class="label">Pengalaman</label>
                <div class="control">
                    <textarea class="textarea" name="pengalaman">{{ old('pengalaman', $porter->pengalaman) }}</textarea>
                </div>
            </div>

            <div class="field">
                <label class="label">Foto Porter</label>
                <div class="control">
                    <input type="file" name="foto" class="input">
                    @if($porter->foto)
                        <p class="mt-2"><img src="{{ asset($porter->foto) }}" width="150" alt="Foto Porter"></p>
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
