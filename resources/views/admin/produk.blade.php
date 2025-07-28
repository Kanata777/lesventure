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
            <a href="/admin" class="navbar-item {{ request()->is('admin') ? 'has-text-primary' : '' }}">Beranda</a>
            <a href="/admin/produk" class="navbar-item {{ request()->is('admin/produk') ? 'has-text-primary' : '' }}">Sewa Alat Camping</a>
            <a href="/admin/porter" class="navbar-item {{ request()->is('admin/porter') ? 'has-text-primary' : '' }}">Sewa Porter</a>
            <a href="/admin/kabar" class="navbar-item {{ request()->is('admin/kabar') ? 'has-text-primary' : '' }}">Kabar Petualang</a>
            <a href="/admin/chat" class="navbar-item {{ request()->is('admin/chat') ? 'has-text-primary' : '' }}">Chat</a>
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
<section class="hero is-medium" style="background-color: #fef6f1;">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-half">
                    <h1 class="title is-2 has-text-weight-bold" style="color: #264d2c;">
                        Admin <br> Jomok <br> Terbaik Anda
                    </h1>
                    <p class="mt-4" style="color: #555;">Tersedia berbagai macam pilihan paket untuk perjalanan anda</p>
                </div>
                <div class="column is-half has-text-centered">
                    <img src="/gambar/contoh-header-produk.png" alt="Tenda dan perlengkapan" style="max-height: 300px;">
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
                <div class="columns is-vcentered is-mobile mb-5">
    <div class="column is-6">
        <a href="/admin/tambah?from=dashboard" style="display: block;">
            <span class="icon"><i class="fas fa-plus"></i></span>
            <span>Tambah Produk</span>
        </a>
    </div>
    <div class="column is-6">
        <form method="GET" action="{{ route('produk') }}" class="field has-addons is-justify-content-flex-end">
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
    </div>
</div>


                {{-- Daftar Produk --}}
                <div class="columns is-multiline">
                    @forelse ($produk as $item)
                    <div class="column is-6-tablet is-4-desktop">
                        <a href="/admin/ubah/{{ $item->id }}?from=dashboard" style="display: block;">
                            <div class="box has-text-centered" style="border-radius: 12px;">
                                <div style="height: 180px; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset($item->gambar_produk) }}" alt="{{ $item->nama_produk }}"
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <p class="mt-3 has-text-weight-bold">{{ $item->nama_produk }}</p>
                                <p class="has-text-success">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
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
