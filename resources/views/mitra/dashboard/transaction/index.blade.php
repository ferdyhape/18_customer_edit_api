@extends('mitra.dashboard.layouts.main')
@section('title', 'Transaction')
@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card border-0 shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between py-auto">
                    <p class="my-auto">Transaction List</p>
                    <div class="btn btn-primary btn-sm px-4 border-0 shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row btn-group p-3" role="group" id="package_list" aria-label="Basic radio toggle button group">
                                            @foreach($packages as $package)
                                                <input type="radio" value="{{ $package['id']}}" class="btn-check" name="options" id="{{ $package['id']}}" onclick="chooseOption('{{ json_encode($package) }}')" autocomplete="off">
                                                <label class="btn " for="{{ $package['id']}}">
                                                    <div class="row">
                                                        <div class="shadow card card-paket h-100 border-left-primary">
                                                            <div class="card-body">
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col mr-2">
                                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $package['package_name']}}</div>
                                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@toRP($package['price'])</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        {{-- <div class="col text-start">{{ $package['package_name']}}</div>
                                                        <div class="col-4 text-start">{{ $package['price']}}</div> --}}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                                        <button type="button" class="btn btn-primary" onclick="openModal2()">lanjutkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModal1Label">Konfirmasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#exampleModal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Paket</td>
                                                <td id="packageInput"></td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td id="price"></td>
                                            </tr>
                                            <tr>
                                                <td>Pilih tanggal mulai</td>
                                                <td><input type="date" id="date_start"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="closeModal2()" data-bs-dismiss="modal" data-bs-target="#exampleModal1" >Close</button>
                                    <button type="button" class="btn btn-primary" id="order" onclick="orderNow()">Beli Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Id</th>
                                <th>Package</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($transaction['updated_at'])->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $transaction['id'] }}</td>
                                    <td>{{ $transaction['package_name']}}</td>
                                    <td>@toRP($transaction['price'])</td>
                                    <td>
                                        @if(is_null($transaction['payment_proof']))
                                            Pemesanan belum dibayar
                                        @else
                                            @if(!is_null($transaction['status'] ))
                                                @if($transaction['status'] == 1)
                                                    Pembayaran diterima
                                                @else
                                                    Pembayaran ditolak
                                                @endif
                                            @else
                                                Menunggu persetujuan
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn btn-sm btn-primary btn-icon shadow-sm" onclick="editModal('{{ json_encode($transaction) }}')">Detail</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" id="updateTransaksi" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="detailModalLabel">Detail Transaksi</h1>
                                <button type="button" class="btn-close" onclick="closeEditModal()"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Paket</td>
                                            <td id="packageDetail"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td id="priceDetail"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Mulai</td>
                                            <td id="dateStartDetail"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Berakhir</td>
                                            <td id="dateEndDetail"></td>
                                        </tr>
                                        <tr id="buktiBayar">
                                            <td>Bukti Bayar</td>
                                            <td ><button type="button" class="btn btn-info" id="buktiBayarDetail" target="_blank" rel="noopener noreferrer" onclick="getPaymentProof()"> Lihat Bukti Bayar </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="mustPayment">
                                    <label for="" class="form-label">Silahkan lakukan pembayaran pada no rekening berikut : </label>
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
                                    <tr class="mb-3">
                                        <label for="formFile" class="form-label">Upload Bukti pembayaran</label>
                                        <input class="form-control" required type="file" id="formFile" name="avatar">
                                    </tr>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="save" >Simpan</button>
                                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        url = "http://localhost:5000/api/user/"
        
        function openModal2() {
            $('#exampleModal1').modal('show');
            $('#exampleModal').modal('hide');
            
            document.getElementById('packageInput').innerHTML
        }

        function closeModal2() {
            $('#exampleModal1').modal('hide');
            $('#exampleModal').modal('show');
        }

        function orderNow(){
            $('#exampleModal1').modal('hide');
            const xhr = new XMLHttpRequest();
            xhr.open("POST", url + "partner/transaction");
            xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            xhr.setRequestHeader("Authorization", "Bearer {{session('token')}}");

            let data = {
                "package_id" : document.getElementById('order').value,
                "package_name": document.getElementById('packageInput').value,
                "price": document.getElementById('price').value,
                "date_start": document.getElementById('date_start').value
            };
            console.log(data);
            xhr.send(JSON.stringify(data));
            document.getElementById('order').action = 'dashboard/transaction';
        }
        function chooseOption(packagejsn) {
            const package = JSON.parse(packagejsn);
            document.getElementById('packageInput').innerHTML = package.package_name
            document.getElementById('packageInput').value = package.package_name
            document.getElementById('price').innerHTML = package.price
            document.getElementById('price').value = package.price
            document.getElementById('order').value = package.id
        }

        function editModal(transactionjsn){
            $('#detailModal').modal('show');
            const transaction = JSON.parse(transactionjsn);
            document.getElementById('packageDetail').innerHTML = transaction.package_name
            document.getElementById('priceDetail').innerHTML = transaction.price
            document.getElementById('dateStartDetail').innerHTML = transaction.date_start
            document.getElementById('dateEndDetail').innerHTML = transaction.date_end
            document.getElementById('updateTransaksi').action = "/dashboard/transaction/update/" + transaction.id

            if(transaction.payment_proof != null){
                document.getElementById("formFile").disabled = true;
                document.getElementById("buktiBayarDetail").disabled = false;
                document.getElementById("buktiBayarDetail").value = transaction.id;
                document.getElementById("save").style.visibility = "collapse";
                document.getElementById("mustPayment").style.visibility = "collapse";
                document.getElementById("buktiBayar").style.visibility = "visible";
            } else{
                document.getElementById("formFile").disabled = false;
                document.getElementById("buktiBayarDetail").disabled = true;
                document.getElementById("save").style.visibility = "visible";
                document.getElementById("mustPayment").style.visibility = "visible";
                document.getElementById("buktiBayar").style.visibility = "collapse";
            }

        }
        function closeEditModal(){
            $('#detailModal').modal('hide');
        }
        function getPaymentProof(){
            window.open(url + "payment_proof/" + document.getElementById("buktiBayarDetail").value);
        }

    </script>
@endsection
