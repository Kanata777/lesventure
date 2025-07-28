@extends('layout')

@section('title', 'Pembayaran Berhasil')

@section('konten')
<div class="section">
    <div class="container">
        <h1 class="title is-4 has-text-success">🎉 Pembayaran Berhasil!</h1>
        <p>Terima kasih, pesanan Anda telah diproses.</p>
        <a href="{{ route('dashboard') }}" class="button is-link mt-4">Kembali ke Dashboard</a>
    </div>
</div>
@endsection
