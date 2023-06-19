@extends('layout.app')

@section('content')
    <div class="container py-4 mx-auto">

        <div class="alert border-0 alert-success alert-dismissible fade show" role="alert">
            <p id="greeting" class="mb-0">, {{ $user['username'] }}
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- SEARCH BAR --}}

        {{-- END SEARCH BAR --}}


        {{-- BANNER --}}
        <div id="carouselExampleControlsNoTouching" class="carousel slide mt-3" data-bs-touch="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="http://localhost:5000/api/user/banner/{{$banners[0]['id']}}?token={{session('token')}}" class="d-block w-100" alt="">
                    {{--<img src="{{ asset('assets/img/banner1.png') }}" class="d-block w-100" alt="">--}}
                </div>
                @for($i = 1; $i < count($banners); $i++ )
                <div class="carousel-item">
                    <img src="http://localhost:5000/api/user/banner/{{$banners[$i]['id']}}?token={{session('token')}}" class="d-block w-100" alt="...">
                </div>
                @endfor
                {{-- <div class="carousel-item">
                    <img src="{{ asset('assets/img/banner1.png') }}" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/banner2.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/banner3.png') }}" class="d-block w-100" alt="...">
                </div> --}}
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- END BANNER --}}

        <div class="d-flex justify-content-between mt-5">
            <h5 class="fw-bold">Mitra Kami</h5>
            <a href="{{ route('mitra') }}">Lihat semua&nbsp&nbsp<i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="d-flex justify-content-center p-2 row gy-4 gx-4 mt-3">
            @php
                // Sort the remaining partners by `created_at`
                usort($partners, function ($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });
            @endphp

            @foreach (array_slice($partners, 0, 6) as $partner)
                <div class="col-1 col-lg-3 feed feed-hover-animation" style="height: 200px">
                    <img src="http://localhost:5000/api/user/partner/avatar/{{ $partner['id'] }}?token={{ session('token') }}"
                        style="width: 100%; height: 100%; object-fit: cover;" alt="">
                    {{-- <img src="{{ asset('assets/img/feed1.png') }}" style="width: 100%; height: 100%;"alt=""> --}}
                </div>
            @endforeach


        </div>
        {{-- END FEED --}}

    </div>

    <script>
        // Mendapatkan elemen dengan ID "greeting"
        var greetingElement = document.getElementById("greeting");

        // Mendapatkan waktu saat ini
        var currentTime = new Date();
        var currentHour = currentTime.getHours();

        // Menentukan salam yang sesuai berdasarkan waktu saat ini
        var greeting;
        if (currentHour < 6) {
            greeting = "Selamat pagi";
        } else if (currentHour < 12) {
            greeting = "Selamat pagi";
        } else if (currentHour < 15) {
            greeting = "Selamat siang";
        } else if (currentHour < 18) {
            greeting = "Selamat sore";
        } else {
            greeting = "Selamat malam"
        }

        // Mengganti teks salam pada elemen
        greetingElement.innerText = greeting + ", " + greetingElement.innerText.split(", ")[1];
    </script>
@endsection
