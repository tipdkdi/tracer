@extends('template')

@section('content')

<!-- Form Row Start -->
<!-- Text Content Start -->
<section class="scroll-section" id="textContent">
    <div class="card mb-5">
        <div class="card-body d-flex flex-column">
            <h3 class="card-title mb-4">Informasi Step</h3>
            <ul>
                <li>Kode Step : {{$stepData->step_kode}}</li>
                <li>Nama Step : {{$stepData->step_nama}}</li>
            </ul>
        </div>
    </div>
</section>
<!-- Text Content End -->
<section class="scroll-section" id="formRow">
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{route('admin.pertanyaan.store')}}" method="post" enctype="multipart/form" class="row g-3">
                @csrf
                <div class="col-md-1">
                    <label for="pertanyaan_urutan" class="form-label">Urutan</label>
                    <input type="number" class="form-control" id="pertanyaan_urutan" name="pertanyaan_urutan" placeholder="Urutan" required />
                </div>
                <div class="col-md-11">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <textarea class="form-control" placeholder="Tuliskan Pertanyaan" name="pertanyaan" id="pertanyaan" rows="3" required></textarea>
                    <input type="hidden" name="step_id" value="{{$stepData->id}}" required />
                </div>

                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="isRequired" id="isRequired" value="1">
                        <label class="form-check-label" for="isRequired">Harus diisi</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="inputState" class="form-label">Jenis Jawaban</label>
                    <select class="form-select" name="pertanyaan_jenis_jawaban" id="jenis_jawaban">
                        <option value="">Pilih Jenis Jawaban</option>
                        <option value="Text">Text</option>
                        <option value="Text Panjang">Text Panjang</option>
                        <option value="Pilihan">Pilihan</option>
                        <option value="Lebih Dari Satu Jawaban">Lebih Dari Satu Jawaban</option>
                        <option value="Select">Select</option>
                    </select>


                </div>
                <div id="jawabanButton"></div>
                <div id="jawabanContainer">
                    <div id="jawaban">

                    </div>
                    <div id="lainnya">
                    </div>


                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" style="float: right">Tambah Pertanyaan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Form Row End -->
<!-- Modal  Launch Large-->
<div class="modal fade" id="lExample" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Copy Pertanyaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <select onchange="show()" class="form-select mb-3" id="bagian">
                        <option>Pilih Bagian</option>
                        @foreach($bagian as $item)
                        <option value="{{$item->id}}">{{$item->step_kode}}. {{$item->step_nama}}</option>
                        @foreach ($item->stepChild as $child)
                        <option value="{{$child->id}}">&nbsp;&nbsp;&nbsp;- {{$child->step_kode}}. {{$child->step_nama}}</option>
                        @endforeach
                        @endforeach
                    </select>

                    <select onchange="showPilihanPertanyaan()" id="pertanyaanSelect" class="form-select">

                    </select>
                    <!-- <button></button> -->
                </div>
                <div class="col-12 mt-2" id="showPilihan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<template id="lainnyaTemplate">
    <div class="col-md-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="addLainnya" id="addLainnya" value="1">
            <label class="form-check-label" for="addLainnya">Tambahkan Pilihan Lainnya</label>
        </div>
    </div>
</template>
<template id="selectTemplate">
    <div class="col-md-12 mb-3">
        <label for="pertanyaan_urutan" class="form-label">Pilihan</label>
        <input type="text" class="form-control" name="jawaban[]" placeholder="Tuliskan Jawaban" required />
    </div>
</template>

<template id="textTemplate">
    <div class="form-check">
        <input required class="form-check-input" type="radio" name="text_jenis" id="text-biasa" value="text-biasa">
        <label class="form-check-label" for="text-biasa">Text Biasa</label>
    </div>
    <div class="form-check">
        <input required class="form-check-input" type="radio" name="text_jenis" id="text-angka" value="text-angka">
        <label class="form-check-label" for="text-angka">Angka</label>
    </div>
    <div class="form-check">
        <input required class="form-check-input" type="radio" name="text_jenis" id="text-email" value="text-email">
        <label class="form-check-label" for="text-email">Email</label>
    </div>
    <div class="form-check">
        <input required class="form-check-input" type="radio" name="text_jenis" id="text-desimal" value="text-desimal">
        <label class="form-check-label" for="text-desimal">Desimal</label>
    </div>
    <div class="form-check">
        <input required class="form-check-input" type="radio" name="text_jenis" id="text-tanggal" value="text-tanggal">
        <label class="form-check-label" for="text-tanggal">Tanggal</label>
    </div>
</template>
<template id="buttonTemplate">
    <div class="d-flex mt-3">
        <h5 style="margin-right:10px">Tentukan Pilihan Jawaban</h5>
        <button class="btn btn-danger btn-icon btn-icon-start ms-1 mx-2" data-bs-toggle="modal" data-bs-target="#lExample">
            <i data-cs-icon="plus"></i>
            <span>Copy Pilihan Jawaban</span>
        </button>
        <span>atau</span>
        <button type="button" id="addPilihan" class="ml-3 btn btn-sm btn-dark mx-2">+ tambah manual</button>
    </div>
</template>
@endsection

@section('js')
<script>
    async function showPilihanPertanyaan() {
        let pertanyaan = document.getElementById('pertanyaanSelect')
        // let pertanyaanId = pertanyaan.value
        let url = "{{route('get.pilihan.pertanyaan',':id')}}"
        url = url.replace(':id', pertanyaan.value)
        let sendRequest = await fetch(url)
        let response = await sendRequest.json()
        console.log(response);
        let contents = '<p>Tidak ada Pilihan Jawaban</p>'
        if (response.jawaban_jenis.length != 0) {
            contents = '<ul>'
            response.jawaban_jenis.map((data) => {
                contents += `<li>${data.pilihan_jawaban}</li>`
            })
            contents += '</ul>'
            contents += `<div class="mt 2">
        <button class="btn btn-danger" id="copy"> Copy Pilihan Jawaban</button>
        </div>`;
        }
        document.querySelector('#showPilihan').innerHTML = ''
        document.querySelector('#showPilihan').innerHTML = contents

        document.querySelector('#copy').addEventListener('click', function() {
            alert('tercopy, silahkan close')
            let contentsPaste = ''
            response.jawaban_jenis.map((data, index) => {
                contentsPaste += `<div class="col-md-12 mb-3" id="pil_${index+1}">
            <label for="pertanyaan_urutan" class="form-label">Pilihan Jawaban ${index+1}</label>
            <input type="text" class="form-control" name="jawaban[]" value="${data.pilihan_jawaban}" required />
        </div>`
            })
            document.querySelector('#jawaban').innerHTML = ''
            document.querySelector('#jawaban').innerHTML = contentsPaste
        })


    }
    async function copy() {
        // alert('tercopy')

    }
    async function show() {
        let bagian = document.getElementById('bagian')
        // return alert(bagian.value);
        let url = "{{route('get.pertanyaan.bagian',':id')}}"
        url = url.replace(':id', bagian.value)
        let sendRequest = await fetch(url)
        let response = await sendRequest.json()
        console.log(response);
        let contents = '<option>Pilih Pertanyaan</option>'
        response.pertanyaan.map((data) => {
            contents += `<option value="${data.id}">- ${data.pertanyaan}</option>`
        })
        document.querySelector('#pertanyaanSelect').innerHTML = ''
        document.querySelector('#pertanyaanSelect').innerHTML = contents
    }

    function addElement() {
        const template = document.querySelector("#selectTemplate")
        const element = template.content.cloneNode(true);
        const length = pilihanJawaban.getElementsByTagName('input').length;
        element.querySelector('label').innerText = `Jawaban ${length+1}`
        element.querySelector('div').id = `pil_${length+1}`
        pilihanJawaban.appendChild(element)
    }

    const jenisJawaban = document.querySelector('#jenis_jawaban')
    const pilihanJawaban = document.querySelector('#jawaban');
    const pilihanJawabanButton = document.querySelector('#jawabanButton');
    const lainnyaContainer = document.querySelector("#lainnya")

    jenisJawaban.addEventListener('change', function() {
        pilihanJawaban.innerHTML = ""
        pilihanJawabanButton.innerHTML = ""
        lainnyaContainer.innerHTML = ""
        let jawabanValue = jenisJawaban.value
        if (jawabanValue == "Text") {
            const textTemplate = document.querySelector("#textTemplate")
            const text = textTemplate.content.cloneNode(true);
            pilihanJawaban.appendChild(text)

        } else if (jawabanValue != "Text" && jawabanValue != "Text Panjang") {
            addElement()
            const templateButton = document.querySelector("#buttonTemplate")
            const button = templateButton.content.cloneNode(true);
            pilihanJawabanButton.appendChild(button)
            // if (jawabanValue != "Select") {
            // if (jawabanValue != "Select" && jawabanValue != "Lebih Dari Satu Jawaban") {

            const lainnyaTemplate = document.querySelector("#lainnyaTemplate")
            const lainnya = lainnyaTemplate.content.cloneNode(true);
            lainnyaContainer.appendChild(lainnya)
            // }
            const add = document.querySelector("#addPilihan")
            add.addEventListener('click', function() {
                addElement()
            })
        }
    })
</script>
@endsection