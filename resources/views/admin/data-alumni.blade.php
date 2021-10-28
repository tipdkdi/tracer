@extends('template')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

</script>
<!-- Form Row Start -->

<section class="scroll-section" id="formRow">

    <div class="card mb-5">
        <div class="card-body">
            <h2>Daftar Alumni yang telah masuk Sistem</h2>
            <table class="table table-striped table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">PRODI</th>
                        <th scope="col">JENIS KELAMIN</th>
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
    showData()
    async function showData() {
        let dataSend = new FormData()
        let dataId = []
        let dataUser = @json($dataUser);
        dataUser.forEach(function(data) {
            dataId.push(data.name);
        });
        console.log(dataId);
        dataSend.append('iddata', JSON.stringify(dataId))
        response = await fetch('https://sia.iainkendari.ac.id/alumni/tracer/data-alumni', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        let fragment = document.createDocumentFragment();
        let showDataTable = document.querySelector("#show-data-table")

        responseMessage.data.forEach(function(data, i) {
            let tr = document.createElement('tr');
            let nomor = document.createElement('td');
            nomor.innerText = i + 1
            let nim = document.createElement('td');
            nim.innerText = data.nim
            let nama = document.createElement('td');
            nama.innerText = data.nama
            let prodi = document.createElement('td');
            prodi.innerText = data.prodi
            let kelamin = document.createElement('td');
            kelamin.innerText = data.kelamin
            tr.appendChild(nomor)
            tr.appendChild(nim)
            tr.appendChild(nama)
            tr.appendChild(prodi)
            tr.appendChild(kelamin)
            fragment.appendChild(tr);
        })
        showDataTable.appendChild(fragment)

        console.log(responseMessage);
    }
</script>
@endsection