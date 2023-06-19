url = "http://localhost:5000/api/";

//Register
function login(){
    const request = new XMLHttpRequest();
    request.open("GET", url + "provinsi");
    request.send();
    request.onload = ()=>{
        if (request.status === 200){
            var data = JSON.parse(request.response);
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
}

//menampilkan daftar provinsi
const request = new XMLHttpRequest();
request.open("GET", url + "provinsi");
request.send();
request.onload = ()=>{
    if (request.status === 200){
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
    request.onload = ()=>{
        if (request.status === 200){
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
    request.onload = ()=>{
        if (request.status === 200){
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
    request.onload = ()=>{
        if (request.status === 200){
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


    
