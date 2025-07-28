@extends('layout')

@section('judul', 'Detail Gunung')

@section('konten')

{{-- Konten Utama --}}
<section class="section" style="margin-top: 80px; background-color: #f7faff;">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class="box" style="border-radius: 14px; background-color: white;">
          <figure class="mb-5" style="border-radius: 12px; overflow: hidden;">
            <img src="{{ $berita->gunung->gambar }}" alt="{{ $berita->gunung->nama_gunung }}" style="width: 100%; height: auto; object-fit: cover; border-radius: 12px;">
          </figure>

         <h1 class="title is-3 has-text-centered has-text-weight-bold mb-4" style="color: #1a3e2e;">
            {{ strtoupper($berita->gunung->nama_gunung) }}
          </h1>


         <div class="content px-4 py-2" style="font-size: 1.1rem;">
            <p class="has-text-black has-text-weight-bold">📍 Lokasi:
              <span class="has-text-black has-text-weight-bold">
                {{ $berita->gunung->lokasi->nama_lokasi ?? 'Tidak Diketahui' }}
              </span>
            </p>
            <p class="has-text-black has-text-weight-bold">⛰️ Ketinggian:
              <span class="has-text-black has-text-weight-bold">
                {{ $berita->gunung->ketinggian }} <small>MDPL</small>
              </span>
            </p>
            <p class="has-text-black has-text-weight-bold">📝 Deskripsi:</p>
            <p class="has-text-justified has-text-black has-text-weight-bold" style="line-height: 1.6;">
              {{ $berita->gunung->deskripsi ?? 'Belum ada deskripsi.' }}
            </p>
          </div>


          <div class="has-text-centered mt-5">
            <a href="{{ route('kabar_petualang.list') }}" class="button is-link is-light is-medium">
              ← Kembali ke Daftar
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
