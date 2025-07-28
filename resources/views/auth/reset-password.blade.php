@extends('layout')

@section('title', 'Reset Password')

@section('konten')
<section class="section">
    <div class="container">
        <h1 class="title is-4">Reset Password</h1>

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

        <form method="POST" action="{{ route('password.reset') }}">
            @csrf
            <div class="field">
                <label class="label">Nama</label>
                <div class="control">
                    <input class="input" type="text" name="nama" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Password Baru</label>
                <div class="control">
                    <input class="input" type="password" name="password_baru" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Konfirmasi Password Baru</label>
                <div class="control">
                    <input class="input" type="password" name="password_baru_confirmation" required>
                </div>
            </div>

            <div class="field is-grouped mt-4">
                <div class="control">
                    <button class="button is-primary" type="submit">Buat Password Baru</button>
                </div>
                <div class="control">
                    <a href="{{ route('login') }}" class="button is-light">Kembali ke Login</a>
                </div>
            </div>
        </form>

    </div>
</section>
@endsection
