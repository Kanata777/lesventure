@extends('layout')

@section('title', 'Pembayaran Gagal')

@section('konten')
<div class="section">
    <div class="container">
        <h1 class="title is-danger">❌ Pembayaran Gagal</h1>
        <p>Maaf, pembayaran Anda gagal. Silakan coba lagi.</p>
        <a href="{{ route('dashboard') }}" class="button is-danger mt-4">Coba Lagi</a>
    </div>
</div>
@endsection
