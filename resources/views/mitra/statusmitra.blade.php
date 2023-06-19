@extends('layout.app')

@section('content')
    <div class="container py-3 mx-auto">
        <div class="d-flex gap-3 my-4 justify-content-center">
            <div class="card col-12 col-lg-8">
                <div class="card-header bg-success text-white fw-bold">
                    Informasi Akun Mitra
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>{{ $partner['partner_name'] }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $partner['address'] }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi Perusahaan</td>
                            <td>{{ $partner['description'] }}</td>
                        </tr>
                        <tr>
                            <td>Status Akun</td>
                            <td>{{ $partner['account_status'] == 0 ? 'Permintaan sedang diproses' : 'Permintaan telah disetujui' }}
                            </td>
                        </tr>
                    </table>
                    <div class="">
                        <div class="col-6">
                            {{-- <p>Catatan : <br>
                            Segera lakukan pembayaran untuk membuka jasa pada platfrom kami!.</p> --}}
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            {{-- <button class="btn btn-primary float-end me-5 w-50 fw-bold">Buka Jasa</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($partner['account_status'] == 1)
            <div class="d-flex border-0 shadow-sm gap-3 my-4 justify-content-center">
                <a href="/dashboard" class="col-12 col-lg-8 btn btn-success d-inline-block">Dashboard</a>
            </div>
        @endif
    </div>

    @if (session('success'))
        <script>
            // Menampilkan pemberitahuan dengan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Mendaftar!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
@endsection
