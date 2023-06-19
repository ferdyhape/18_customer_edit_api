@extends('layout.app')

@section('content')
    <div class="container d-flex justify-content-center p-5">
        <div class="card w-50">
            <div class="card-body m-3">
                <form method="POST" action="/updatePassword" enctype="multipart/form-data">
                    @csrf
                    <h5 class="text-center fw-bold mb-3">Ubah Password</h5>
                    <div class="col-12">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control my-1 @error('password') is-invalid @enderror" id="inputPassword" placeholder="password" name="password" required>
                        @error('password')
                        <div id="passwordHelp" class="form-text">{{ $message }}</div>
                        @enderror
                        <label for="inputPasswordConfirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control my-1 @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" placeholder="password confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                        <div id="passwordConfirmationHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3 d-flex float-end">
                        <button class="btn btn-secondary me-2">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection