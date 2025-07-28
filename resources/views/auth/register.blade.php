@extends('layout')

@section('title', 'Daftar User')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Daftar User</h1>

        {{-- Notifikasi berhasil --}}
        @if (session('success'))
            <div class="notification is-success is-light">
                <button class="delete"></button>
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="field">
                <label class="label">Nama</label>
                <div class="control">
                    <input class="input" type="text" name="nama" value="{{ old('nama') }}" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password" name="password" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Konfirmasi Password</label>
                <div class="control">
                    <input class="input" type="password" name="password_confirmation" required>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary">Daftar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
