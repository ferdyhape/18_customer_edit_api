 @extends('mitra.dashboard.layouts.main')
@section('title', 'Aktivasi Mitra')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Partner List</h1> --}}

        <!-- DataTales Example -->
        <div class="card border-0 shadow mb-4" >
            <div class="card-header d-flex justify-content-beetwen">
                <p class="mb-0">Aktivasi Akun Mitra</p>
                <p class="ml-auto">Status Mitra : <span> 
                        @if ($partner['account_status'] == 0)
                            <span>dalam proses aktivasi</span>
                        @else
                            <span>Aktif</span>
                        @endif
                    </span></p>
            </div>
            <div class="card-body d-inline-flex">   
                {{-- Paket 1 Bulan --}}
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-paket border-left-primary h-100 py-2" 
                        @if ($partner['account_status'] == 0)
                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                        @else
                            
                        @endif >
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Paket 1 Bulan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 250.000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                {{-- End  --}}

                {{-- Paket 6 Bulan --}}
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-paket border-left-warning h-100 py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Paket 6 Bulan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 500.000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                {{-- End  --}}

                {{-- Paket 6 Bulan --}}
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-paket border-left-danger h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Paket 12 Bulan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 800.000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                 {{-- End  --}}
                  
            </div>
            <div class="ms-5 mb-5">
                @if ($partner['account_status'] == 0)
                    <i>* Lakukan Pembayaran untuk mengaktifkan</i>
                @else
                    
                @endif
              </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran Aktivasi</h1> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Bayar Melalui:</label>
                    <table class="table table-bordered">
                        <thead>
                            <th>Nama Bank</th>
                            <th>Nomor Rekening</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BRI</td>
                                <td>0987654321234</td>
                            </tr>
                            <tr>
                                <td>BCA</td>
                                <td>0987654321234</td>
                            </tr>
                            <tr>
                                <td>ShopeePay</td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td>Dana</td>
                                <td>081234567890</td>
                            </tr>
                        </tbody>
                    </table>
            <form action="" method="POST">
                @csrf
                    <div>
                        <label for="bukti" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Kirim</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        {{-- End Modal --}}
    </div>

@endsection
