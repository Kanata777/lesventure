@extends('layout')

@section('title', 'Pembayaran Pending')

@section('konten')
<div class="section">
    <div class="container">
        <h1 class="title is-warning">⌛ Pembayaran Tertunda</h1>
        <p>Pembayaran Anda sedang diproses. Silakan cek kembali nanti.</p>
        <a href="{{ route('dashboard') }}" class="button is-link mt-4">Kembali ke Dashboard</a>
    </div>
</div>
@endsection
