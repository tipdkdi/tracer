<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes":{"layout": "boxed"}}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SI LANNI</title>
    <meta name="description" content="Aplikasi Tracer Study IAIN Kendari" />
    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="font/CS-Interface/style.css" />
    <!-- Font Tags End -->

    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{asset('/')}}css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}css/vendor/OverlayScrollbars.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}css/vendor/baguetteBox.min.css" />
    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{asset('/')}}css/styles.css" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{asset('/')}}css/main.css" />
    <script src="{{asset('/')}}js/base/loader.js"></script>
</head>

<body>
    <!-- Form Row Start -->
    <!-- Text Content Start -->

    <main>
        <div class="container">
            <section class="scroll-section" id="textContent">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title mb-4">Data Tracer</h3>
                        <ul>
                            <li>Periode : Tahun 2024</li>
                        </ul>
                    </div>
                </div>

            </section>
            <!-- Text Content End -->
            <section class="scroll-section" id="formRow">
                <!-- <h2 class="small-title">Daftar Pertanyaan</h2> -->
                <div class="col-auto d-flex mb-2">
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
                <button onclick="show()" class="btn btn-primary btn-sm">Lihat Progres</button>
                <div class="card mb-5">
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">KABUPATEN</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="hasil-show">

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>
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