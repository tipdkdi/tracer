<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes":{"layout": "boxed"}}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SI LANNI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
</head>

<body>
    <div class="container mt-5">
        <div class="card-body">
            <h3 class="card-title mb-4">Data Tracer Periode Tahun 2024</h3>
        </div>
        <div class="col-3 d-flex mb-2">
            <select class="form-select mb-3" id="kabupaten">
                <option>Pilih Kabupaten</option>
                <option value="KAB. BUTON">KAB. BUTON</option>
                <option value="KAB. BUTON SELATAN">KAB. BUTON SELATAN</option>
                <option value="KAB. BUTON TENGAH">KAB. BUTON TENGAH</option>
                <option value="KAB. BUTON UTARA">KAB. BUTON UTARA</option>
                <option value="KAB. KOLAKA">KAB. KOLAKA</option>
                <option value="KAB. KOLAKA TIMUR">KAB. KOLAKA TIMUR</option>
                <option value="KAB. KOLAKA UTARA">KAB. KOLAKA UTARA</option>
                <option value="KAB. KONAWE">KAB. KONAWE</option>
                <option value="KAB. KONAWE KEPULAUAN">KAB. KONAWE KEPULAUAN</option>
                <option value="KAB. KONAWE SELATAN">KAB. KONAWE SELATAN</option>
                <option value="KAB. KONAWE UTARA">KAB. KONAWE UTARA</option>
                <option value="KAB. MUNA">KAB. MUNA</option>
                <option value="KAB. MUNA BARAT">KAB. MUNA BARAT</option>
                <option value="KAB. WAKATOBI">KAB. WAKATOBI</option>
                <option value="KOTA BAU-BAU">KOTA BAU-BAU</option>
                <option value="KOTA KENDARI">KOTA KENDARI</option>
            </select>

        </div>
        <button onclick="show()" class="btn btn-primary btn-sm mb-3">Lihat Progres</button>
        <div class="card mb-5">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">KABUPATEN</th>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">PRODI</th>
                            <th scope="col">NO. HP</th>
                            <th scope="col">STATUS PENGISIAN</th>
                        </tr>
                    </thead>
                    <tbody id="hasil-show">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Form Row End -->
    <div class="modal fade" id="lExample" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Copy Pertanyaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">


                    </div>
                    <div class="col-12 mt-2" id="showPertanyaan">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        async function show() {
            let kabupaten = document.querySelector('#kabupaten')
            // return alert(kabupaten);
            let url = "{{route('surveior.show',':kabupaten')}}"
            url = url.replace(':kabupaten', kabupaten.value)
            let sendRequest = await fetch(url)
            let response = await sendRequest.json()
            console.log(response);
            let contents = ''
            response.map((data, index) => {
                contents += '<tr>'
                contents += `<td>${index + 1}</td>`
                contents += `<td>${data.user.mahasiswa.data_diri.kabupaten}</td>`
                contents += `<td>${data.user.mahasiswa.nim}</td>`
                contents += `<td>${data.user.mahasiswa.data_diri.nama_lengkap}</td>`
                contents += `<td>${data.user.mahasiswa.prodi.organisasi_singkatan}</td>`
                contents += `<td>${data.user.mahasiswa.data_diri.no_hp}</td>`
                contents += `<td>${(data.sesi_status==0)?"Selesai":"Proses"}</td>`
                contents += '</tr>'
            })

            document.querySelector('#hasil-show').innerHTML = ''
            document.querySelector('#hasil-show').innerHTML = contents

            // document.querySelector('#copy').addEventListener('click', async function() {

            //     let url = "{{route('copy.pertanyaan',[':id',':idCopy'])}}"
            //     url = url.replace(':id', bagian.value)
            //     let sendRequest = await fetch(url)
            //     let response = await sendRequest.json()
            //     console.log(response);
            //     if (response.status == true) {
            //         alert('pertanyaan tercopy')
            //         window.location.reload();
            //     }

            // })
        }
    </script>
</body>

</html>