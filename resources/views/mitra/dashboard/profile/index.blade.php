@extends('mitra.dashboard.layouts.main')
@section('title', 'Profile')
@section('content')
    <div class="container px-3">
        <form action="/dashboard/editProfilePartner/{{ $userData['partner_id'] }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card border-0 shadow mb-4">
                <div class="card-header  d-flex align-items-center justify-content-between">
                    <p class="mb-0">Profil Mitra</p>
                    <div class="d-flex justify-content-end gap-3">
                        <div class="form-check form-switch my-auto">
                            <input class="form-check-input" type="checkbox" role="switch" id="operational_status_toogle"
                                {{ $partner['operational_status'] == '0' ? '' : 'checked' }}>
                            <label class="form-check-label"
                                for="operational_status_toogle">{{ $partner['operational_status'] == '0' ? 'Close' : 'Open' }}</label>
                        </div>
                        <div class="float-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center mt-3 ">
                        <div class="col-4   ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('partner_name') is-invalid @enderror"
                                    id="partner_name" name="partner_name" placeholder="{{ $partner['partner_name'] }}">
                                <label for="partner_name">Nama Mitra</label>
                                @error('partner_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="{{ $partner['email'] }}">
                                <label for="email">Email Perusahaan</label>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number" placeholder="{{ $partner['phone_number'] }}">
                                <label for="phone_number">No. Telepon</label>
                                @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <select name="category" class="form-select mb-3" aria-label="Default select example">
                                <option selected>Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" name="avatar">
                            </div>

                        </div>
                        <div class="col-7">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('affress') is-invalid @enderror"
                                    id="address" name="address" placeholder="Alamat" value="{{ old('address') }}">
                                <label for="address">Alamat</label>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <select name="province" id="province" onclick="getCity()" class="form-select mb-3"
                                aria-label="Default select example">
                                <option>Pilih Provinsi</option>
                            </select>
                            <select name="city" id="city" onclick="getDistrict()" class="form-select mb-3"
                                aria-label="Default select example">
                                <option>Pilih Kota / Kabupaten</option>
                            </select>
                            <select name="district" id="district" onclick="getVillage()" class="form-select mb-3"
                                aria-label="Default select example">
                                <option>Pilih Kecamatan</option>
                            </select>
                            <select name="village" id="village" class="form-select mb-3"
                                aria-label="Default select example">
                                <option>Pilih Kelurahan / Desa</option>
                            </select>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('affress') is-invalid @enderror"
                                    id="gmap" name="gmap" placeholder="Link Google Map">
                                <label for="#gmap">Link Google Map</label>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Deskripsi</label>
                                <textarea name="desc" id="desc" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ url('dashboard/profile/update_operational_status') }}" method="POST"
            id="form_toogle_operational_status" style="display: none !important">
            @csrf
            <input type="hiden" value="{{ $partner['operational_status'] }}" name="operational_status">
        </form>


        <script>
            const checkbox = document.getElementById('operational_status_toogle');
            checkbox.addEventListener('click', function() {
                const form = document.getElementById('form_toogle_operational_status');
                form.submit();
            });

            url = "http://143.198.213.176/api/";

            //menampilkan daftar provinsi
            const request = new XMLHttpRequest();
            request.open("GET", url + "provinsi");
            request.send();
            request.onload = () => {
                if (request.status === 200) {
                    var data = JSON.parse(request.response);
                    // var html = "<selected>";
                    // for(var i = 0; i < data.provinsi.length; i++ ){
                    //     html += "<option>"+ data.provinsi[i].province +'</option>'
                    // }
                    // document.getElementById('province').innerHTML = html;
                    data.provinsi.forEach((item) => {
                        let o = document.createElement('option');
                        o.text = item.province;
                        o.value = item.id;
                        province.appendChild(o);
                    });

                    console.log(request.status + request.statusText);
                } else {
                    console.log(request.status);
                }
            }

            //menampilkan daftar kota
            function getCity() {
                document.getElementById('city').innerHTML = "";
                document.getElementById('district').innerHTML = "";
                document.getElementById('village').innerHTML = "";
                const request = new XMLHttpRequest();
                request.open("GET", url + "kota/" + document.getElementById('province').value);
                request.onload = () => {
                    if (request.status === 200) {
                        data = JSON.parse(request.response);
                        data.kota.forEach((item) => {
                            let o = document.createElement('option');
                            o.text = item.city;
                            o.value = item.id;
                            city.appendChild(o);
                        });
                        console.log(request.status + request.statusText);
                    } else {
                        console.log(request.status);
                    }
                }
                request.send();
            }

            //menampilkan daftar kecamatan
            function getDistrict() {
                document.getElementById('district').innerHTML = "";
                document.getElementById('village').innerHTML = "";
                const request = new XMLHttpRequest();
                request.open("GET", url + "kecamatan/" + document.getElementById('city').value);
                request.onload = () => {
                    if (request.status === 200) {
                        data = JSON.parse(request.response);
                        data.kecamatan.forEach((item) => {
                            let o = document.createElement('option');
                            o.text = item.district;
                            o.value = item.id;
                            district.appendChild(o);
                        });
                        console.log(request.status + request.statusText);
                    } else {
                        console.log(request.status);
                    }
                }
                request.send();
            }

            //menampilkan daftar kecamatan
            function getVillage() {
                document.getElementById('village').innerHTML = "";
                const request = new XMLHttpRequest();
                request.open("GET", url + "kelurahan/" + document.getElementById('district').value);
                request.onload = () => {
                    if (request.status === 200) {
                        data = JSON.parse(request.response);
                        data.kelurahan.forEach((item) => {
                            let o = document.createElement('option');
                            o.text = item.village;
                            o.value = item.id;
                            village.appendChild(o);
                        });
                        console.log(request.status + request.statusText);
                    } else {
                        console.log(request.status);
                    }
                }
                request.send();
            }
        </script>
    @endsection
