@extends('mitra.dashboard.layouts.main')
@section('title', 'Pesanan')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Partner List</h1> --}}

        <!-- DataTales Example -->
        <div class="card border-0 shadow mb-4">
            <div class="card-header">
                <p class="mb-0">Pesanan Masuk</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Customer Name</th>
                                <th>No. Telepon</th>
                                <th>Address</th>
                                <th>Location</th>
                                <th>Problems</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $order['user']['username'] }}</td>
                                    <td><a href="https://wa.me/{{ $order['user']['no_phone'] }}" target="_blank" rel="noopener noreferrer">{{ $order['user']['no_phone'] }}</a></td>
                                    <td>{{ $order['address'] }}</td>
                                    <td><a href="{{ $order['link_google_map'] }}" target="_blank">Here</a></td>
                                    <td> {{ $order['message'] }} </td>
                                    <td class="d-inline-flex">
                                        @if ($order['order_status'] < 6)
                                            <button class="btn btn-success me-2"data-toggle="modal"
                                                data-target="#editProgres{{ $order['id'] }}">{{ $order['progres']['progres'] }}</button>
                                            {{-- <button class="btn btn-danger"><i class="fas fa-times"></i></button>                                         --}}
                                        @else
                                            {{ $order['progres']['progres'] }}
                                        @endif
                                    </td>
                                </tr>
                                {{-- modal edit --}}
                                <div class="modal fade" id="editProgres{{ $order['id'] }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-0">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Edit Partner</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="/dashboard/updateProgres/{{ $order['id'] }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="">
                                                            <div class="form-group">
                                                                <label for="editPartnerName">Status Sekarang</label>
                                                                <input id="editPartnerName" style="width: 100%"
                                                                    class="form-control @error('partner_name') is-invalid @enderror"
                                                                    type="text" name="partner_name"
                                                                    placeholder="{{ $order['progres']['progres'] }}"
                                                                    disabled>
                                                                @error('partner_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editEmail">Ubah Status Menjadi</label>
                                                                <select name="progres" class="form-select mb-3"
                                                                    aria-label="Default select example" required>
                                                                    @foreach ($progress as $progres)
                                                                        <option value="{{ $progres['id'] }}">
                                                                            {{ $progres['progres'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm shadow-sm"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">Cancel</span>
                                                    </button>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm shadow-sm">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
