@extends('layout')

@section('judul', 'Porter Kami')

@section('konten')

{{-- Style untuk dropdown --}}
<style>
    select {
        background-color: #1a1a1a;
        color: white;
        border-radius: 6px;
        padding: 6px;
        border: 1px solid #444;
    }
    select option {
        background-color: #1a1a1a;
        color: white;
    }
    select option:checked {
        background-color: #1d4ed8;
    }
</style>

{{-- Navbar --}}
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
        <a href="/kabar" class="navbar-item {{ request()->is('kabar') ? 'has-text-primary' : '' }}">Kabar Petualang</a>
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

{{-- Hero --}}
<section class="hero is-medium" style="background-color: #fef6f1;">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-vcentered">
        <div class="column is-half">
          <h1 class="title is-2 has-text-weight-bold" style="color: #264d2c;">
            Pilih Porter <br> Terbaik Anda
          </h1>
          <p class="mt-4" style="color: #555;">Terdapat banyak pilihan porter dengan segudang pengalaman</p>
        </div>
        <div class="column is-half has-text-centered">
          <img src="/gambar/header-porter.jpg" alt="Porter Gunung" style="max-height: 300px;">
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Filter & Search --}}
<section class="section" style="background-color: #fdfdfc;">
  <div class="container">
    <div class="columns is-mobile is-vcentered is-justify-content-space-between mb-5">
      <div class="column is-flex is-justify-content-flex-end is-align-items-center">
        <form action="{{ url()->current() }}" method="GET" class="field is-grouped">
          <p class="control">
            <span class="select">
              <select name="lokasi" onchange="this.form.submit()">
                <option value="">Semua Lokasi</option>
                @foreach ($lokasiList as $lokasi)
                  <option value="{{ $lokasi->id }}" {{ request('lokasi') == $lokasi->id ? 'selected' : '' }}>
                    {{ $lokasi->nama_lokasi }}
                  </option>
                @endforeach
              </select>
            </span>
          </p>
          <p class="control has-icons-left">
            <input class="input" type="text" name="search" placeholder="Pencarian Porter" value="{{ request('search') }}">
            <span class="icon is-left"><i class="fas fa-search"></i></span>
          </p>
        </form>
      </div>
      <a href="{{ route('admin.tambahporter') }}" class="button is-primary">
                    + Tambah Porter
    </a>
    </div>

    @php $totalPorter = collect($portersByLokasi)->flatten(1)->count(); @endphp

    @if ($totalPorter === 0)
      <div class="notification is-warning has-text-centered">
        Porter tidak ditemukan.
      </div>
    @else
      @foreach ($portersByLokasi as $lokasiNama => $porters)
        @if (request('lokasi') || $porters->count() > 0)
          <div class="mb-5">
            <div class="columns is-multiline">
              @foreach ($porters as $porter)
                <div class="column is-6-tablet is-4-desktop">
                  <div class="box has-text-centered" style="border-radius: 12px;">
                    <div style="height: 180px; display: flex; align-items: center; justify-content: center;">
                      <img src="{{ asset($porter->foto) }}" alt="{{ $porter->nama }}" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                    </div>
                    <p class="mt-3 has-text-weight-bold">{{ $porter->nama }}</p>
                    <p>{{ $porter->alamat }}</p>
                    <p>{{ $porter->usia }} Tahun</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      @endforeach
    @endif
  </div>
</section>
@endsection
