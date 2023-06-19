@extends('layout.app')

@section('content')
    <div class="container p-5 mx-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/mitra">Mitra</a></li>
              <li class="breadcrumb-item active" aria-current="page"> {{ $partner['partner_name'] }} </li>
            </ol>
        </nav>
        
        <div class="row mb-3">
            <div class="col-9">
                <h4 class="fw-bold">Tentang Kami</h4>
                <p class="text-justify">{{ $partner['description'] }}</p>
            </div>
            <div class="col-3 d-flex float-end">
                <img src="http://localhost:5000/api/admin/partner/avatar/{{ $partner['id'] }}?token={{session('token')}}" style="width: 100%" class="rounded">
            </div>
        </div>

        <table class="table">
            <tbody>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>: &nbsp; {{ $partner['partner_name'] }} </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: &nbsp;
                        <a href="{{$partner['link_google_map']}}" target="_blank" rel="noopener noreferrer">{{ $partner['address'] }}</a>                       
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: &nbsp; 
                        <a href="mailto:{{ $partner['email'] }}" >{{ $partner['email'] }} </a>
                    </td>
                </tr>                
                <tr>
                    <td>Nomor Telepon</td>
                    <td>: &nbsp; {{ $partner['phone_number'] }} </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection