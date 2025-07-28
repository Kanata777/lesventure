@extends('layout')

@section('title', 'Masuk')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Masuk</h1>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="notification is-success is-light">
                <button class="delete"></button>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="notification is-danger is-light">
                <button class="delete"></button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label class="label">Nama</label>
                <div class="control">
                    <input class="input" type="text" name="nama" value="{{ old('nama') }}" required autofocus>
                </div>
            </div>

            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password" name="password" required>
                </div>
            </div>

            <div class="field mt-4">
                <div class="control">
                    <button class="button is-primary" type="submit">Masuk</button>
                </div>
            </div>
        </form>

        <p class="mt-3">
            <a href="{{ route('password.request') }}">Lupa password?</a>
        </p>
    </div>
</section>
@endsection
