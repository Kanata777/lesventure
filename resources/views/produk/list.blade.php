@extends('layout')

@section('judul', 'Produk Kami')

@section('konten')

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

    <!-- Bagian Tengah -->
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

    <!-- Bagian Kanan -->
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
<section class="hero is-small" style="background-color: #fef6f1;">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-half">
                    <h1 class="title is-2 has-text-weight-bold" style="color: #264d2c;">
                        Temukan <br> Peralatan Camping <br> Terbaik Anda
                    </h1>
                    <p class="mt-4" style="color: #555;">Tersedia berbagai macam pilihan paket untuk perjalanan anda</p>
                </div>
                <div class="column is-half has-text-centered">
                    <img src="{{ asset('image/imagecamp.png') }}" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section Konten --}}
<section class="section" style="background-color: #fdfdfc;">
    <div class="container">
        <div class="columns">

            {{-- Sidebar Filter --}}
            <div class="column is-3">
                <div class="box">
                    <h2 class="title is-5 mb-4">Kategori</h2>
                    <form method="GET" action="{{ route('produk') }}">
                        {{-- Pertahankan search jika ada --}}
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @foreach ($kategoriList as $item)
                        <div class="field">
                            <label class="checkbox">
                                <input
                                    type="checkbox"
                                    name="kategori[]"
                                    value="{{ $item->kategori }}"
                                    {{ collect(request('kategori'))->contains($item->kategori) ? 'checked' : '' }}>
                                {{ ucfirst($item->kategori) }}
                            </label>
                        </div>
                        @endforeach
                        <div class="field mt-4">
                            <button type="submit" class="button is-success is-small">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Konten Produk --}}
            <div class="column is-9">

                {{-- Form pencarian --}}
                <form method="GET" action="{{ route('produk') }}" class="field has-addons mb-5 is-justify-content-flex-end">
                    {{-- Pertahankan kategori jika ada --}}
                    @foreach (request('kategori', []) as $kategori)
                        <input type="hidden" name="kategori[]" value="{{ $kategori }}">
                    @endforeach
                    <div class="control has-icons-left">
                        <input type="text" name="search" class="input" placeholder="Pencarian Produk" value="{{ request('search') }}">
                        <span class="icon is-left"><i class="fas fa-search"></i></span>
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-light">Cari</button>
                    </div>
                </form>

                {{-- Daftar Produk --}}
                <div class="columns is-multiline">
                    @forelse ($produk as $item)
                    <div class="column is-6-tablet is-4-desktop">
                        <a href="{{ route('produk.detail', $item->id) }}?from=produk">
                            <div class="box has-text-centered" style="border-radius: 12px;">
                                <div style="height: 180px; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset($item->gambar_produk) }}" alt="{{ $item->nama_produk }}"
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <p class="mt-3 has-text-weight-bold">{{ $item->nama_produk }}</p>
                                <p class="has-text-success">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('produk.detail', $item->id) }}?from=produk" class="button is-small is-success mt-2">Detail</a>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="column">
                        <p class="has-text-centered">Tidak ada produk yang tersedia.</p>
                    </div>
                    @endforelse
                </div>


                {{-- Pagination --}}
                <div class="mt-5">
                    {{ $produk->links() }}
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
