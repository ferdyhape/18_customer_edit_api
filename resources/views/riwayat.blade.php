@extends('layout.app')

@section('content')
    <div class="container py-4 mx-auto">
        <div class="row my-3">
            @if (count($calls) == 0)
                <p class="text-center">Belum ada riwayat panggilan</p>
            @else
                <div class="my-2">
                    @foreach ($calls as $call)
                        <div class="card border-0 shadow col-12 col-lg-10 mx-auto mb-3">
                            <div class="card-body d-lg-flex flex-lg-row d-sm-flex flex-sm-column">
                                <div class="col-lg-3 col-xl-3 col-sm-12 col-xs-12 text-center">
                                    <img src="http://localhost:5000/api/user/partner/avatar/{{ $call['partner_id'] }}?token={{ session('token') }}"
                                        alt="img-fluid" style="width: 100%; height:200px; object-fit:cover">
                                </div>
                                <div
                                    class="ps-3 col-xl-6 col-lg-6 col-sm-12 col-xs-12 d-flex flex-column py-4 px-3 py-sm-3">
                                    <div class="d-flex fw-bold mb-3">
                                        <div class="bg-success text-white px-3 py-2 rounded-pill">
                                            <i class="bi bi-gear-fill me-3 fs-6 my-auto"></i>
                                            {{ $call['partner']['partner_name'] }}
                                        </div>
                                    </div>
                                    <p class="mb-2"><strong>Keterangan:</strong> {{ $call['message'] }}</p>

                                    <p class="text-muted">{{ $call['address'] }}</p>
                                </div>
                                <div
                                    class="col-lg-3 col-xl-3 col-sm-12 col-xs-12 d-flex flex-column justify-content-center px-3 gap-2">
                                    <div class="mb-2">
                                        <p class="my-0">
                                            {{ \Carbon\Carbon::parse($call['created_at'])->format('Y-m-d H:i:s') }}
                                        </p>
                                        <h6 class="my-0 text-muted fw-semibold">{{ $call['progres']['progres'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


        </div>
    </div>
@endsection
