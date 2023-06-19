@extends('layout.app')

@section('content')
    <div class="container p-5 mb-3">
        <div class="col-lg-6 col-sm-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="/register" method="POST" autocomplete="off">
                        @csrf
                        <h3 class="mb-3 text-center fw-bold">Daftar</h3>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama</label>
                            <input type="text" id="username"
                                class="form-control @error('username') is-invalid  @enderror" value="{{ old('username') }}"
                                name="username" autofocus required>
                            @error('username')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" id="email" class="form-control" aria-describedby="email"
                                name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_phone" class="form-label">Nomor Handphone (+62)</label>
                            <input type="text" id="no_phone" class="form-control" aria-describedby="no_phone"
                                name="no_phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            {{ $message }}
                        </div>
                        <button type="submit" id="submitData" class="btn btn-primary w-100">Daftar</button>
                    </form>
                    <p class="mt-3 text-center">Sudah punya akun?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>
        </div>
        <script></script>
    @endsection
