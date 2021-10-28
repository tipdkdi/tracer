@extends('template')

@section('content')

<!-- Form Row Start -->
<!-- Text Content Start -->
<section class="scroll-section" id="textContent">
    <div class="card mb-5">
        <div class="card-body d-flex flex-column">
            <h3 class="card-title mb-4">Statistik Kuisioner</h3>
            <select class="form-select" id="bagian">
                <option value="">Pilih Bagian</option>
                @foreach ($bagian as $item)
                <option value="{{$item->id}}">{{$item->step_kode ." - ". $item->step_nama}}</option>
                @endforeach
            </select>
            <div id="show-pertanyaan">

            </div>
        </div>
    </div>
</section>
<!-- Text Content End -->
<section class="scroll-section" id="formRow" style="display:none">

    <div class="card mb-5">
        <div class="card-body">
            <h2>Rekap</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pilihan Jawaban</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="show-data-table">

                </tbody>
            </table>

            <h2>Diagram</h2>
            <div>
                <label class="form-label d-block">Pilih Diagram</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diagram" id="pie" value="pie" />
                    <label class="form-check-label" for="pie">Pie</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diagram" id="bar" value="bar" />
                    <label class="form-check-label" for="bar">Bar</label>
                </div>
                <div class="form-check form-check-inline">
                    <button class="btn btn-primary" id="terapkan">Terapkan</button>
                </div>
            </div>
            <div id="showDiagram" class="col-sm-12" style="height: 500px;"></div>
        </div>
    </div>
</section>
<!-- Form Row End -->

@endsection
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    let bagian = document.querySelector("#bagian")
    bagian.addEventListener('change', async function() {
        document.querySelector("#formRow").style.display = 'none'

        // return alert("gg")
        let url = "{{route('admin.get.pertanyaan',':bagianId')}}"
        url = url.replace(':bagianId', `${bagian.options[bagian.selectedIndex].value}`)
        response = await fetch(url)
        responseMessage = await response.json()
        let showPertanyaan = document.querySelector("#show-pertanyaan")
        showPertanyaan.innerHTML = ""
        let select = document.createElement('select');
        select.className = "form-select mt-2"
        select.id = "pertanyaan"
        let option = document.createElement('option')
        option.innerText = "Pilih Pertanyaan"
        option.value = ""
        select.appendChild(option)
        responseMessage.forEach(function(data, i) {
            let option = document.createElement('option')
            option.innerText = data.pertanyaan
            option.value = data.id
            select.appendChild(option)
        });
        showPertanyaan.appendChild(select)
        console.log(responseMessage);
        let pertanyaan = document.querySelector("#pertanyaan")

        pertanyaan.addEventListener("change", async function() {
            let showDataTable = document.querySelector("#show-data-table")
            if (pertanyaan.options[pertanyaan.selectedIndex].value == "") {
                document.querySelector("#formRow").style.display = 'none'
                showDataTable.innerHTML = ""
                return

            }
            showDataTable.innerHTML = ""
            let url2 = "{{route('admin.get.count.pertanyaan',':pertanyaanId')}}"
            url2 = url2.replace(':pertanyaanId', `${pertanyaan.options[pertanyaan.selectedIndex].value}`)
            let response2 = await fetch(url2)
            responseMessage2 = await response2.json()
            console.log(responseMessage2.dataPertanyaan[0].jawaban_jenis);

            let fragment = document.createDocumentFragment();
            responseMessage2.dataPertanyaan[0].jawaban_jenis.forEach(function(data, i) {
                let tr = document.createElement('tr');
                let nomor = document.createElement('td');
                nomor.innerText = i + 1
                let pilihanJawaban = document.createElement('td');
                pilihanJawaban.innerText = data.pilihan_jawaban
                let total = document.createElement('td');
                total.innerText = data.total
                tr.appendChild(nomor)
                tr.appendChild(pilihanJawaban)
                tr.appendChild(total)
                fragment.appendChild(tr);
            });
            showDataTable.appendChild(fragment)
            let daftarJawaban = responseMessage2.dataPertanyaan[0].jawaban_jenis
            google.charts.load('current', {
                'packages': ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                let jawaban = [
                    ['Task', pertanyaan.options[pertanyaan.selectedIndex].innerText]
                ]
                daftarJawaban.map(function(data) {
                    jawaban.push([data.pilihan_jawaban, data.total])
                });
                console.log(jawaban);
                var data = google.visualization.arrayToDataTable(
                    jawaban
                );
                var options = {
                    title: pertanyaan.options[pertanyaan.selectedIndex].innerText,
                    sliceVisibilityThreshold: 0,
                    pieHole: 0.4,
                };

                document.querySelector("#formRow").style.display = 'block'
                document.getElementById('showDiagram').innerHTML = ""
                document.querySelector("#terapkan").addEventListener("click", function() {
                    let diagram = document.querySelector('input[name="diagram"]:checked').value;
                    var chart
                    if (diagram == "pie")
                        chart = new google.visualization.PieChart(document.getElementById('showDiagram'));
                    if (diagram == "bar")
                        chart = new google.visualization.BarChart(document.getElementById('showDiagram'));
                    chart.innerHTML = ""
                    chart.draw(data, options);
                });
            }

        });
        // {
        // }
    });
</script>
@endsection