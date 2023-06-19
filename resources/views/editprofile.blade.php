@extends('layout.app')

@section('content')
    <div class="container py-4 mx-auto d-flex justify-content-center">
        <div class="col-xs-12 col-xl-6 py-4">
            <div class="card border-0 shadow">
                <div class="card-body m-3">
                    <h5 class="fw-bold text-center mb-3">Edit Profil</h5>
                    <div class="input">
                        <form action="{{ url('/editProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" name="username" class="form-control mb-3" placeholder="{{ $user['username'] }}">
                                <label for="nohp" class="form-label">Nomor Handphone</label>
                                <input type="text" id="nohp" name="phone_number" class="form-control mb-3" placeholder="">
                                <label for="address" class="form-label d-block">Alamat</label>
                                <div class="d-flex mb-3">                                
                                    <button class="btn btn-warning d-inline-flex me-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"><i class="bi bi-geo-fill"></i></button>
                                    <textarea class="form-control d-inline-flex" id="exampleFormControlTextarea1" rows="1" placeholder="pilih dari peta" disabled readonly></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Alamat lengkap</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="address" placeholder="""></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto Profil</label>
                                    <input class="form-control" type="file" id="formFile" name="avatar">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5 text-center">
                            <button class="btn btn-secondary me-2">Batal</button>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
