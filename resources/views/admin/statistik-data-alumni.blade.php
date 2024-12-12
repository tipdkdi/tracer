@extends('template')

@section('content')

<!-- Form Row Start -->
<!-- Text Content Start -->
<section class="scroll-section" id="textContent">
    <div class="card mb-5">
        <div class="card-body d-flex flex-column">
            <h3 class="card-title mb-1">Periode</h3>
            <div class="row">
                <div class="col-md-12">

                    <select class="form-select" id="periode">
                        <option value="">Pilih Periode</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>
            <h3 class="card-title my-2">Filter</h3>
            <div class="row">

                <div class="col-md-12 mb-3">
                    <select class="form-select" id="jenis">
                        <option value="">Pilih Filter</option>
                        <option value="kelamin">Jenis Kelamin</option>
                        <option value="tahun-mengisi">Tahun Mengisi</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="fakultas">
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="prodi">
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-warning" id="filter">Filter</button>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Text Content End -->
<section class="scroll-section" id="formRow" style="display:none">
    <div class="card mb-5">
        <div class="card-body">
            <h2>Rekap</h2>
            <!-- <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="show-data-table">

                </tbody>
            </table> -->

            <h2>Diagram</h2>
            <div id="showDiagram" class="col-sm-12" style="height: 500px;"></div>
        </div>
    </div>
</section>
<!-- Form Row End -->

@endsection
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    let fakultas = document.querySelector("#fakultas")
    let prodi = document.querySelector("#prodi")
    setDefaultPilihan(fakultas, 'fakultas')
    setDefaultPilihan(prodi, 'prodi')

    getFakultas();
    async function getFakultas() {
        // response = await fetch('https://sia.iainkendari.ac.id/data-fakultas')
        response = await fetch('https://sia2.iainkendari.ac.id/data-fakultas')
        responseMessage = await response.json()
        console.log(responseMessage);
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

        // let response = await fetch(`https://sia.iainkendari.ac.id/data-prodi/${fakultas.options[fakultas.selectedIndex].value}`)
        let response = await fetch(`https://sia2.iainkendari.ac.id/data-prodi/${fakultas.options[fakultas.selectedIndex].value}`)
        let responseMessage = await response.json()
        let fragment = document.createDocumentFragment();

        responseMessage.forEach(function(data, i) {
            let option = document.createElement('option');
            option.innerText = `${data.prodi}`
            option.value = data.idprodi
            fragment.appendChild(option);
        })
        prodi.appendChild(fragment)
    })
    document.querySelector("#filter").addEventListener('click', async function() {

        if (periode.value == "")
            return alert('pilih periode')
        let url = "{{route('get.user.periode',':periode')}}"
        url = url.replace(':periode', periode.value)
        let send = await fetch(url)
        let response = await send.json()

        let jenis = document.querySelector('#jenis')
        let dataId = []
        let dataUser = response;
        dataUser.forEach(function(data) {
            dataId.push(data.user.name);
        });
        let dataWhere = {};
        if (fakultas.options[fakultas.selectedIndex].value != "" && fakultas.options[fakultas.selectedIndex].value != "semua")
            dataWhere["tb_mstprodi.idfakultas"] = fakultas.options[fakultas.selectedIndex].value;
        if (prodi.options[prodi.selectedIndex].value != "" && fakultas.options[fakultas.selectedIndex].value != "semua")
            dataWhere["tb_data.idprodi"] = prodi.options[prodi.selectedIndex].value;
        let dataSend = new FormData()
        if (jenis.options[jenis.selectedIndex].value == "kelamin") {
            document.querySelector("#formRow").style.display = 'block'

            // document.querySelector("#formRow").style.display = 'block'

            dataSend.append('iddata', JSON.stringify(dataId))
            dataSend.append('where', JSON.stringify(dataWhere))
            // response = await fetch('https://sia.iainkendari.ac.id/get-total-data', {
            response = await fetch('https://sia2.iainkendari.ac.id/get-total-data', {
                method: "POST",
                body: dataSend
            })
            responseMessage = await response.json()
            console.log(responseMessage);
            google.charts.load('current', {
                'packages': ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                let jawaban = []
                var options = {}
                if (fakultas.options[fakultas.selectedIndex].value != "" && fakultas.options[fakultas.selectedIndex].value != "semua") {
                    let title = ""
                    if (prodi.options[prodi.selectedIndex].value != "" && prodi.options[prodi.selectedIndex].value != "semua") {
                        title = `${prodi.options[prodi.selectedIndex].innerText} (${fakultas.options[fakultas.selectedIndex].innerText})`
                    } else {
                        title = `${fakultas.options[fakultas.selectedIndex].innerText}`
                    }
                    jawaban = [
                        ['Task', title]
                    ]
                    options = {
                        title: title,
                        sliceVisibilityThreshold: 0,
                        pieHole: 0.4,
                    };

                } else {
                    jawaban = [
                        ['Task', "Semua Fakultas"]
                    ]
                    options = {
                        title: "Semua Fakultas",
                        sliceVisibilityThreshold: 0,
                        pieHole: 0.4,
                    };

                }
                responseMessage.data.map(function(data) {
                    let kelamin = (data.kelamin == "P") ? "Perempuan" : "Laki - Laki"
                    jawaban.push([kelamin, parseInt(data.total)])
                });
                console.log(jawaban);
                var data = google.visualization.arrayToDataTable(
                    jawaban
                );
                var chart = new google.visualization.PieChart(document.getElementById('showDiagram'));
                chart.innerHTML = ""
                chart.draw(data, options);
            }
        } else if (jenis.options[jenis.selectedIndex].value == "tahun-mengisi") {
            // document.querySelector("#formRow").style.display = 'block'

            // document.querySelector("#formRow").style.display = 'none'
            document.querySelector("#formRow").style.display = 'block'

            // document.querySelector("#formRow").style.display = 'block'

            dataSend.append('iddata', JSON.stringify(dataId))
            dataSend.append('where', JSON.stringify(dataWhere))
            // response = await fetch('https://sia.iainkendari.ac.id/get-id-data', {
            response = await fetch('https://sia2.iainkendari.ac.id/get-id-data', {
                method: "POST",
                body: dataSend
            })
            responseMessage = await response.json()

            dataId = []
            responseMessage.data.forEach(function(data) {
                dataId.push(data.iddata);
            });
            // console.log(dataId);
            dataSend = new FormData()
            dataSend.append('iddata', JSON.stringify(dataId))
            dataSend.append('periode', periode.value)
            response = await fetch('{{route("admin.get.users")}}', {
                method: "POST",
                body: dataSend
            })
            responseMessage = await response.json()
            let usersid = []
            console.log(responseMessage);
            responseMessage.forEach(function(data) {
                usersid.push(data.id)
            })
            console.log(usersid);
            dataSend = new FormData()
            dataSend.append('usersId', JSON.stringify(usersid))
            response = await fetch('{{route("admin.get.tahun.mengisi")}}', {
                method: "POST",
                body: dataSend
            })
            responseMessage = await response.json()
            console.log(responseMessage);

            // document.getElementById('showDiagram').innerHTML = ""
            google.charts.load('current', {
                'packages': ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                let jawaban = []
                var options = {}

                jawaban = [
                    ['Task', "Tahun Mengisi"]
                ]
                options = {
                    title: "Tahun Mengisi",
                    sliceVisibilityThreshold: 0,
                    pieHole: 0.4,
                };


                responseMessage.map(function(data) {
                    jawaban.push([`${data.tahun}`, parseInt(data.total)])
                });
                console.log(jawaban);
                var data = google.visualization.arrayToDataTable(
                    jawaban
                );
                var chart = new google.visualization.PieChart(document.getElementById('showDiagram'));
                chart.innerHTML = ""
                chart.draw(data, options);
            }
        } else {
            return alert('pilih fiter terlebih dahulu')
        }

    })

    function setDefaultPilihan(pilihan, text) {
        pilihan.innerHTML = ""
        let optionPilih = document.createElement('option');
        optionPilih.innerText = `Pilih ${text}`
        optionPilih.value = ""
        pilihan.appendChild(optionPilih)
        let optionSemua = document.createElement('option');
        optionSemua.innerText = `semua ${text}`
        optionSemua.value = "semua"
        pilihan.appendChild(optionSemua)
    }

    function setStatistikData() {

    }
</script>
@endsection