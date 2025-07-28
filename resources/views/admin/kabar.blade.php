@extends('layout')

@section('judul', 'Kabar Petualang')

@section('konten')

{{-- Navbar tetap seperti sebelumnya --}}
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
        <a href="/admin" class="navbar-item {{ request()->is('/') ? 'has-text-primary' : '' }}">Beranda</a>
        <a href="/admin/produk" class="navbar-item {{ request()->is('admin/produk') ? 'has-text-primary' : '' }}">Sewa Alat Camping</a>
        <a href="/admin/porter" class="navbar-item {{ request()->is('admin/porter') ? 'has-text-primary' : '' }}">Sewa Porter</a>
        <a href="/admin/kabar" class="navbar-item {{ request()->is('admin/kabar') ? 'has-text-primary' : '' }}">Kabar Petualang</a>
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

{{-- Hero Section --}}
<section class="hero is-medium" style="background-image: url('/gambar/kabar-hero.jpg'); background-size: cover; background-position: center;">
  <div class="hero-body" style="background: rgba(255,255,255,0.85); border-bottom: 1px solid #ddd;">
    <div class="container">
      <h1 class="title is-2 has-text-weight-bold" style="color: #205c3b;">Kabar Petualang</h1>
      <p class="is-size-6" style="max-width: 800px; color: #333;">
        Indonesia memiliki banyak gunung yang menarik untuk didaki, menawarkan pemandangan alam yang indah dan tantangan bagi para pendaki. Selain itu, terdapat banyak tempat camping di sekitar gunung yang menyediakan suasana alam untuk beristirahat dan menikmati kegiatan outdoor. Popularitas mendaki dan camping semakin meningkat, seiring dengan kesadaran akan pentingnya menjaga kelestarian alam dan menikmati rekreasi yang sehat.
      </p>
    </div>
  </div>
</section>

{{-- Gunung Populer --}}
<section class="section" style="background-color: #fdfcf9;">
  <div class="container">

    {{-- Judul & Search --}}
    <div class="columns is-vcentered is-justify-content-space-between mb-5">
      <div class="column is-6">
        <h2 class="title is-4 has-text-weight-bold">Gunung Populer</h2>
      </div>
      <div class="column is-6">
        <form method="GET" action="{{ url()->current() }}" class="field has-addons is-justify-content-flex-end">
          <p class="control has-icons-left is-expanded">
            <input class="input" type="text" name="search" placeholder="Pencarian Gunung..." value="{{ request('search') }}" style="border-radius: 8px;">
            <span class="icon is-left"><i class="fas fa-search"></i></span>
          </p>
          <p class="control">
            <button type="submit" class="button" style="background-color: #205c3b; color: white;">Cari</button>
          </p>
        </form>
      </div>
    </div>

    {{-- Grid Gunung --}}
   @if($berita->isEmpty())
      <div class="notification is-warning has-text-centered">Data tidak ditemukan.</div>
    @else
      <div class="columns is-multiline">
        @foreach($berita as $item)
          <div class="column is-4-desktop is-6-tablet">
            <div class="box" style="border-radius: 12px;">
              <figure class="image is-4by3" style="border-radius: 8px; overflow: hidden;">
                <img 
                  src="{{ asset($item->gunung->gambar) }}" alt="{{ $item->gunung->nama }}" style="width: 100%; height: auto;">
              </figure>
              <div class="mt-3 has-text-centered">
                <p class="has-text-weight-bold" style="color: #205c3b;">
                  {{ $item->gunung->nama ?? 'Nama Gunung' }}
                </p>
                <p class="is-size-7"> 
                  {{ $item->gunung->lokasi->nama_lokasi ?? 'Lokasi Tidak Diketahui' }}
                </p>
                <p class="is-size-7">
                  {{ $item->gunung->ketinggian ?? '-' }} MDPL
                </p>

                {{-- Tombol Detail --}}
                <a href="{{ route('kabarpetualang.detail', $item->id) }}" 
                  class="button is-small mt-2" 
                  style="background-color: #205c3b; color: white;">
                  Detail
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif


  </div>
</section>

@endsection
