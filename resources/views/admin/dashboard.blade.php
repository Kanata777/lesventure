    @extends('layout')
    @section('title', 'Dashboard')
    @section('konten')

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
            <a href="/admin" class="navbar-item {{ request()->is('/') ? 'has-text-primary' : '' }}">Beranda</a>
            <a href="/admin/produk" class="navbar-item {{ request()->is('admin/produk') ? 'has-text-primary' : '' }}">Sewa Alat Camping</a>
            <a href="/admin/porter" class="navbar-item {{ request()->is('admin/porter') ? 'has-text-primary' : '' }}">Sewa Porter</a>
            <a href="/admin/kabar" class="navbar-item {{ request()->is('admin/kabar') ? 'has-text-primary' : '' }}">Kabar Petualang</a>
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

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="notification is-success is-light" style="margin-top: 5rem; margin-left: 1.5rem; margin-right: 1.5rem;">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="notification is-danger is-light" style="margin-top: 1rem; margin-left: 1.5rem; margin-right: 1.5rem;">
            <button class="delete"></button>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Hero Section --}}
    <section class="hero hero-custom" style="position: relative; margin-top: 3.5rem;">
        <div class="hero-body has-text-centered">
            <div class="container" style="padding-top: 30px;">
                <h1 class="title is-2 has-text-white has-text-weight-bold animate__animated animate__fadeInDown animate__delay-0.3s">
                    Lestari Adventure
                </h1>
                <h2 class="subtitle is-4 has-text-white animate__animated animate__fadeInUp animate__delay-1s" style="padding-top: 10px;">
                    Sewa Alat Camping & Porter Terpercaya
                </h2>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


    {{-- Produk Populer --}}
    <section id="produk" class="section has-background-white">
        <div class="container">
            <h2 class="title is-4 has-text-centered mb-6 has-text-black has-text-weight-bold animate__animated animate__fadeInUp animate__delay-1s">Produk Populer</h2>

            @if(session('success'))
                <div class="notification is-success is-light">
                    <button class="delete"></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="columns is-multiline is-variable is-4">
                @foreach ($data as $item)
                <div class="column is-one-quarter">
                    <div class="box product-box" style="position: relative; padding: 1rem; background-color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease; transform: scale(1);">
                        
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="position: absolute; top: 0.5rem; right: 0.5rem;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete is-small" onclick="return confirm('Yakin ingin menghapus produk ini?')"></button>
                        </form>
                        <a href="/admin/ubah/{{ $item->id }}?from=dashboard" style="display: block;">
                            <figure class="image mb-3" style="overflow: hidden;">
                               <img src="{{ asset($item->gambar_produk) }}" alt="{{ $item->nama_produk }}" style="transition: transform 0.3s ease; transform: scale(1);">
                            </figure>
                            <h3 class="title is-6">{{ $item->nama_produk }}</h3>
                            <p class="mb-2">Stok: {{ $item->stok }}</p>
                            <p class="mb-2">Status: {{ $item->status }}</p>
                            <p class="mb-2">
                                Mulai dari
                                <strong class="has-text-black">
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </strong>
                            </p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Burger Menu Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Navbar burger
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }

            // Tombol 'x' untuk menutup notifikasi manual
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });

            // Auto close notifikasi setelah 3 detik
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach((notif) => {
                setTimeout(() => {
                    notif.style.transition = 'opacity 0.5s ease';
                    notif.style.opacity = '0';
                    setTimeout(() => notif.remove(), 500); // hapus setelah transisi selesai
                }, 3000);
            });
        });
    </script>

    <script>
        function showConfirmation(deleteUrl) {
            document.getElementById('deleteForm').action = deleteUrl;
            document.getElementById('confirmBox').style.display = 'block';
        }

        function hideConfirmation() {
            document.getElementById('confirmBox').style.display = 'none';
        }
    </script>



    @endsection