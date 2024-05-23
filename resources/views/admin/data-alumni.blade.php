@extends('template')

@section('content')
<!-- Text Content Start -->
<section class="scroll-section" id="textContent">
    <div class="card mb-5">
        <div class="card-body">

            <h4>Periode</h4>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <select class="form-select" id="periode" onchange="showData()">
                        <option value="">Pilih Periode</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>
            <h4>Filter</h4>
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select" id="fakultas">
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="prodi">
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="tahun-lulus">
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" id="filter">Filter</button>
                </div>
                <div class="col-md-3 my-3">
                    <button class="btn btn-info" id="cetak" onclick="goCetak()" disabled="disabled">cetak</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Text Content End -->
<section class="scroll-section" id="formRow">

    <div class="card mb-5">
        <div class="card-body">
            <h2>Daftar Alumni yang telah masuk Sistem</h2>
            <table class="table table-striped table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">TANGGAL LOGIN</th>
                        <th scope="col">NIM</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">FAKULTAS</th>
                        <th scope="col">PRODI</th>
                        <th scope="col">JENIS KELAMIN</th>
                        <th scope="col">DETAIL JAWABAN</th>
                    </tr>
                </thead>
                <tbody id="show-data-table">

                </tbody>
            </table>

        </div>
    </div>
</section>
<!-- Form Row End -->

@endsection
@section('js')
<script>
    // showData()

    function goCetak() {
        let url = "{{route('data.cetak',':periode')}}"
        url = url.replace(':periode', document.querySelector('#periode').value)
        window.location.href = url
    }
    async function showData() {
        const periode = document.querySelector('#periode');
        const cetak = document.querySelector('#cetak');
        if (periode.value == "") {
            cetak.disabled = true
            // cetak.disabled = false
            return alert('pilih periode')
        }
        cetak.disabled = false
        // cetak
        let url = "{{route('get.user.periode',':periode')}}"
        url = url.replace(':periode', periode.value)
        let send = await fetch(url)
        let response = await send.json()
        // return console.log(response)
        let dataSend = new FormData()
        let dataId = []
        let dataUser = response;
        let fragment = document.createDocumentFragment();
        let showDataTable = document.querySelector("#show-data-table")
        if (response.length == 0)
            return showDataTable.innerHTML = "<tr class='text-center'><td colspan='8'>Data tidak ada</td></tr>"
        showDataTable.innerHTML = ""
        dataUser.forEach(function(data) {
            dataId.push(data.user.name);
        });
        // console.log(dataId);
        dataSend.append('iddata', JSON.stringify(dataId))
        response = await fetch('https://sia.iainkendari.ac.id/alumni/tracer/data-alumni', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        dataSend = new FormData()

        dataSend.append('data', JSON.stringify(responseMessage.data))
        dataSend.append('periode', periode.value)
        response = await fetch('{{route("admin.get.alumni.data")}}', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        responseMessage.forEach(function(data, i) {
            let tr = document.createElement('tr');
            let nomor = document.createElement('td');
            nomor.innerText = i + 1
            let tglLogin = document.createElement('td');
            tglLogin.innerText = data.tanggal_login
            let nim = document.createElement('td');
            nim.innerText = data.nim
            let nama = document.createElement('td');
            nama.innerText = data.nama
            let namaFakultas = document.createElement('td');
            namaFakultas.innerText = data.nama_fakultas
            let prodi = document.createElement('td');
            prodi.innerText = data.prodi
            let kelamin = document.createElement('td');
            kelamin.innerText = data.kelamin
            let link = document.createElement('td');
            let linkDetail = document.createElement('a');
            linkDetail.innerText = "Detail"
            if (data.sesi_id == '-')
                linkDetail.innerText = "-"
            let url = "{{route('data.get.detail.jawaban',':sesiId')}}"
            url = url.replace(':sesiId', data.sesi_id)
            linkDetail.href = url
            link.appendChild(linkDetail)
            // kelamin.innerText = data.kelamin
            tr.appendChild(nomor)
            tr.appendChild(tglLogin)
            tr.appendChild(nim)
            tr.appendChild(nama)
            tr.appendChild(namaFakultas)
            tr.appendChild(prodi)
            tr.appendChild(kelamin)
            tr.appendChild(link)
            fragment.appendChild(tr);
        })
        showDataTable.appendChild(fragment)

        // console.log(responseMessage);
    }
    init()
    async function init() {

        let fakultas = document.querySelector("#fakultas")
        let prodi = document.querySelector("#prodi")
        let tahunLulus = document.querySelector("#tahun-lulus")
        // let prodi 
        setDefaultPilihan(fakultas, 'Fakultas')
        setDefaultPilihan(prodi, 'Prodi')
        setDefaultPilihan(tahunLulus, 'Tahun Lulus')
        response = await fetch('{{route("admin.get.filter")}}')
        responseMessage = await response.json()
        let fragment = document.createDocumentFragment();

        responseMessage.forEach(function(data, i) {
            let option = document.createElement('option');
            option.innerText = data.pilihan_jawaban
            option.value = data.pilihan_jawaban
            fragment.appendChild(option);
        })
        tahunLulus.appendChild(fragment)

        prodi.disabled = true
        getFakultas();
        async function getFakultas() {
            response = await fetch('https://sia.iainkendari.ac.id/data-fakultas')
            responseMessage = await response.json()
            // console.log(responseMessage);
            let fragment = document.createDocumentFragment();
            let showDataTable = document.querySelector("#show-data-table")

            responseMessage.forEach(function(data, i) {
                let option = document.createElement('option');
                option.innerText = `${data.singkatan} - Fakultas ${data.nama}`
                option.value = data.idfakultas
                fragment.appendChild(option);
            })
            fakultas.appendChild(fragment)
        }

        fakultas.addEventListener('change', async function() {
            setDefaultPilihan(prodi, 'prodi')
            if (fakultas.options[fakultas.selectedIndex].value == "semua" || fakultas.options[fakultas.selectedIndex].value == "")
                return prodi.disabled = true
            else
                prodi.disabled = false
            let fragment = document.createDocumentFragment();
            response = await fetch(`https://sia.iainkendari.ac.id/data-prodi/${fakultas.options[fakultas.selectedIndex].value}`)
            responseMessage = await response.json()
            responseMessage.forEach(function(data, i) {
                let option = document.createElement('option');
                option.innerText = `${data.singkatan} - ${data.prodi}`
                option.value = data.idprodi
                fragment.appendChild(option);
            })
            prodi.appendChild(fragment)
        })

    }

    document.querySelector("#filter").addEventListener('click', async function() {
        // alert("mantap")
        const periode = document.querySelector('#periode');
        if (periode.value == "")
            return alert('pilih periode')
        let dataWhere = {};
        if (fakultas.options[fakultas.selectedIndex].value != "" && fakultas.options[fakultas.selectedIndex].value != "semua")
            dataWhere["tb_mstprodi.idfakultas"] = fakultas.options[fakultas.selectedIndex].value;
        if (prodi.options[prodi.selectedIndex].value != "" && fakultas.options[fakultas.selectedIndex].value != "semua")
            dataWhere["tb_data.idprodi"] = prodi.options[prodi.selectedIndex].value;
        let tahunLulus = document.querySelector("#tahun-lulus")

        dataSend = new FormData()
        if (tahunLulus.options[tahunLulus.selectedIndex].value == "" || tahunLulus.options[tahunLulus.selectedIndex].value == "semua")
            dataSend.append('filter', '-')
        else
            dataSend.append('filter', tahunLulus.options[tahunLulus.selectedIndex].value)

        url = "{{route('admin.get.filterd.data',':periode')}}"
        url = url.replace(':periode', document.querySelector('#periode').value)
        response = await fetch(url, {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()

        // console.log(responseMessage);
        dataSend.append('where', JSON.stringify(dataWhere))
        dataSend.append('iddata', JSON.stringify(responseMessage))
        response = await fetch('https://sia.iainkendari.ac.id/get-id-data', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        dataSend = new FormData()

        dataSend.append('data', JSON.stringify(responseMessage.data))
        dataSend.append('periode', periode.value)
        response = await fetch('{{route("admin.get.alumni.data")}}', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);

        let fragment = document.createDocumentFragment();
        let showDataTable = document.querySelector("#show-data-table")
        showDataTable.innerHTML = ""
        responseMessage.forEach(function(data, i) {
            let tr = document.createElement('tr');
            let nomor = document.createElement('td');
            nomor.innerText = i + 1
            let tglLogin = document.createElement('td');
            tglLogin.innerText = data.tanggal_login
            let nim = document.createElement('td');
            nim.innerText = data.nim
            let nama = document.createElement('td');
            nama.innerText = data.nama
            let namaFakultas = document.createElement('td');
            namaFakultas.innerText = data.nama_fakultas
            let prodi = document.createElement('td');
            prodi.innerText = data.prodi
            let kelamin = document.createElement('td');
            kelamin.innerText = data.kelamin
            let link = document.createElement('td');
            let linkDetail = document.createElement('a');
            let url = "{{route('admin.get.detail.jawaban',':userId')}}"
            linkDetail.innerText = "Detail"
            url = url.replace(':userId', data.sesi_id)
            linkDetail.href = url
            link.appendChild(linkDetail)
            // kelamin.innerText = data.kelamin
            tr.appendChild(nomor)
            tr.appendChild(tglLogin)
            tr.appendChild(nim)
            tr.appendChild(nama)
            tr.appendChild(namaFakultas)
            tr.appendChild(prodi)
            tr.appendChild(kelamin)
            tr.appendChild(link)
            fragment.appendChild(tr);
        })
        showDataTable.appendChild(fragment)
    });





    function setDefaultPilihan(pilihan, text) {
        pilihan.innerHTML = ""
        let optionPilih = document.createElement('option');
        optionPilih.innerText = `Pilih ${text}`
        optionPilih.value = ""
        pilihan.appendChild(optionPilih)
        let optionSemua = document.createElement('option');
        optionSemua.innerText = `Semua ${text}`
        optionSemua.value = "semua"
        pilihan.appendChild(optionSemua)
    }
</script>
@endsection