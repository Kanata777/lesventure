@extends('layout')

@section('judul', 'Hubungi Kami')

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

{{-- Konten Utama --}}
<section class="section" style="margin-top: 80px; background-color: #f7faff;">
  <div class="container">
    <div class="has-text-centered mb-6">
      <h1 class="title is-3 has-text-weight-bold has-text-dark">📞 Hubungi Kami</h1>
      <h2 class="subtitle is-4 has-text-weight-semibold has-text-grey-dark">
        Tim Support Kami Siap Membantu Anda 💬
      </h2>
    </div>

    <div class="columns is-centered">
      {{-- Sidebar Topik --}}
      <div class="column is-4">
        <div class="box" style="border-radius: 14px; background-color: #eef3f8; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
          <h2 class="title is-5 has-text-weight-bold mb-4 has-text-dark">
            🗂️ Tentang Kami
          </h2>
          <aside class="menu">
            <ul class="menu-list">
              @php
                $topics = [
                  '🔧 Integrasi Teknis & Development',
                  '💰 Informasi Layanan Disbursement',
                  '📝 Registrasi dan Info Layanan',
                  '➕ Penambahan Metode Pembayaran',
                ];
              @endphp
              @foreach ($topics as $topic)
                <li>
                  <a href="#" class="has-text-weight-semibold has-text-link is-flex is-align-items-center"
                     style="padding: 10px 12px; border-radius: 8px; transition: background 0.3s;"
                     onmouseover="this.style.background='#dde6f0'" onmouseout="this.style.background='transparent'">
                    {{ $topic }}
                  </a>
                </li>
              @endforeach
            </ul>
          </aside>
        </div>
      </div>

      {{-- Informasi Kontak --}}
      <div class="column is-7">
        <div class="box" style="border-radius: 14px; background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
          <p class="mb-4 has-text-black has-text-weight-semibold">
            📌 Silakan memulai dengan memilih topik di samping sesuai dengan kebutuhan Anda,
            untuk membantu kami memberikan jawaban yang tepat dan lebih cepat.
          </p>
          <p class="mb-4 has-text-black has-text-weight-semibold">
            📨 Apabila Anda membutuhkan bantuan lebih lanjut dari tim kami, silakan informasikan
            pertanyaan Anda melalui form yang disediakan di subtopik.
          </p>
          <p class="has-text-black has-text-weight-bold">
            🕒 Tim kami akan membantu membalas melalui email pada hari
            <strong class="has-text-primary">Senin–Jumat pukul 08.00–21.00 WIB</strong>.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>


{{-- Chat Box --}}
<style>
  .chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 360px;
    max-height: 520px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
    border-radius: 14px;
    overflow: hidden;
    font-weight: bold;
    font-family: 'Segoe UI', sans-serif;
    z-index: 999;
    background: #fff;
  }

  .chat-header {
    background-color: #205c3b;
    color: white;
    padding: 14px 18px;
    font-size: 1.1rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
  }

  .chat-header .icon {
    font-size: 1.2rem;
  }

  .chat-body {
    background: #f7f7f7;
    max-height: 320px;
    overflow-y: auto;
    padding: 12px;
  }

  .chat-input {
    border-top: 1px solid #ddd;
    padding: 12px;
    background: white;
  }

  .chat-input input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-weight: bold;
  }

  .chat-message {
    margin-bottom: 14px;
    display: flex;
    align-items: flex-end;
  }

  .chat-message.agent {
    flex-direction: row;
  }

  .chat-message.user {
    flex-direction: row-reverse;
  }

  .chat-avatar {
    width: 32px;
    height: 32px;
    background-color: #205c3b;
    border-radius: 50%;
    color: white;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 8px;
    font-weight: bold;
  }

  .chat-bubble {
    padding: 10px 14px;
    border-radius: 16px;
    max-width: 75%;
    font-weight: bold;
    line-height: 1.4;
  }

  .chat-bubble.user {
    background-color: #007bff;
    color: white;
    border-bottom-right-radius: 0;
  }

  .chat-bubble.agent {
    background-color: #e8e8e8;
    color: black;
    border-bottom-left-radius: 0;
  }
</style>

<div class="chat-widget" id="chatWidget">
  <div class="chat-header" onclick="toggleChat()">
    💬 Chat dengan Kami
    <span class="icon">🔽</span>
  </div>
  <div class="chat-body" id="chatMessages">
    <div class="chat-message agent">
      <div class="chat-avatar">CS</div>
      <div class="chat-bubble agent">Halo! Ada yang bisa kami bantu? 😊</div>
    </div>
  </div>
  <div class="chat-input">
    <form onsubmit="sendMessage(event)">
      <input type="text" id="chatInput" placeholder="Ketik pesan Anda di sini..." />
    </form>
  </div>
</div>

<script>
  function toggleChat() {
    const body = document.querySelector('.chat-body');
    const input = document.querySelector('.chat-input');
    const icon = document.querySelector('.chat-header .icon');
    const isHidden = body.style.display === 'none';
    body.style.display = isHidden ? 'block' : 'none';
    input.style.display = isHidden ? 'block' : 'none';
    icon.textContent = isHidden ? '🔽' : '🔼';
  }

  function sendMessage(e) {
    e.preventDefault();
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (message === '') return;

    const container = document.getElementById('chatMessages');

    const userMessage = document.createElement('div');
    userMessage.className = 'chat-message user';
    userMessage.innerHTML = `
      <div class="chat-avatar">👤</div>
      <div class="chat-bubble user">${message}</div>
    `;
    container.appendChild(userMessage);

    input.value = '';

    // Auto response (dummy), bisa diganti AJAX atau Firebase nanti
    setTimeout(() => {
      const agentMessage = document.createElement('div');
      agentMessage.className = 'chat-message agent';
      agentMessage.innerHTML = `
        <div class="chat-avatar">CS</div>
        <div class="chat-bubble agent">Terima kasih! Tim kami akan segera merespons. 📧</div>
      `;
      container.appendChild(agentMessage);
      container.scrollTop = container.scrollHeight;
    }, 1000);

    container.scrollTop = container.scrollHeight;
  }
</script>

@endsection
