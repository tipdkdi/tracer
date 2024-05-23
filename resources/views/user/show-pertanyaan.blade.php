@extends('user.template-user')

@section('content')

<section class="scroll-section" id="basic">
    <!-- Basic Start -->
    <div class="card mb-5">
        <div class="card-body">
            <h3 class="mb-4">{{$bagianData->step_kode}}. {{$bagianData->step_nama}}</h3>
            <form action="{{route('user.store.jawaban',$bagianData->id)}}" method="post" enctype="multipart/form">
                @csrf
                <input type="hidden" name="step_id" value="{{$bagianData->id}}">
                <input type="hidden" name="awal" value="{{$awal}}">
                <input type="hidden" name="akhir" value="{{$akhir}}">
                <input type="hidden" name="periode" value="{{$periode}}">
                <input type="hidden" name="sesi_id" value="{{$sesi_id}}">
                @foreach ($bagianData->pertanyaan as $tanya)
                {!!$tanya->form!!}
                @endforeach



                @if($akhir==true)
                <button type="button" class="btn btn-dark" onclick="kembali('{{$periode}}','{{$bagianData->bagianDirect->step_id_direct_back}}')">Kembali</button>
                <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin Selesai?')">Selesai</button>
                @else
                @if($awal==false)
                <button type="button" class="btn btn-dark" onclick="kembali('{{$periode}}','{{$bagianData->bagianDirect->step_id_direct_back}}')">Kembali</button>
                @endif
                <button type="submit" class="btn btn-primary">Simpan dan Lanjut</button>
                @endif
                <!-- <div class="mb-3 position-relative form-group">
                    <label class="form-label">Lokasi Kerja</label>
                    <select class="form-select" id="provinsi" onchange="getKabupaten()">

                    </select>
                </div> -->
            </form>
        </div>
    </div>
</section>
<!-- Basic End -->

@endsection

@section('js')
<script>
    getProvinsi();
    async function getProvinsi() {
        let url = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'
        const provinsiSelect = document.querySelector('#provinsi')
        let provinsi = provinsiSelect.dataset.provinsi
        let sendRequest = await fetch(url)
        let response = await sendRequest.json()
        console.log(response);
        let contents = '<option>Pilih Provinsi</option>'
        response.map((data) => {
            if (provinsi == data.name) {
                getKabupaten(data.id)
            }
            contents += `<option data-value="${data.name}" value="${data.id}" ${(provinsi==data.name)?"selected":""}>- ${data.name}</option>`
        })
        provinsiSelect.innerHTML = ''
        provinsiSelect.innerHTML = contents
    }

    async function getKabupaten(provinsiId = null) {
        // let provinsiId
        const provinsiSelect = document.querySelector('#provinsi')

        if (provinsiId == null)
            provinsiId = document.querySelector('#provinsi').value
        // else
        //     provinsiId = select
        console.log(provinsiId);
        // let url = `https://emsifa.github.io/api-wilayah-indonesia/api/regencies/${provinsiId}.json`
        let url = `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`
        const kabupatenSelect = document.querySelector('#kabupaten')
        let kabupaten = kabupatenSelect.dataset.kabupaten
        let sendRequest = await fetch(url)
        let response = await sendRequest.json()
        console.log(response);
        let contents = ''
        contents += '<div class="mb-3 position-relative form-group">';
        contents += '<label class="form-label">Pilih Kabupaten</label>';
        response.map((data) => {
            contents += `<option value="${provinsiSelect.options[provinsiSelect.selectedIndex].dataset.value} - ${data.name}" ${(kabupaten==data.name)?"selected":""}>- ${data.name}</option>`
        })
        document.querySelector('#kabupaten').innerHTML = ''
        document.querySelector('#kabupaten').innerHTML = contents
    }
    async function kembali(periode, bagianId) {
        let urlBack = "{{route('user.show.pertanyaan',[':periode',':bagianId'])}}"
        urlBack = urlBack.replace(':bagianId', bagianId)
        urlBack = urlBack.replace(':periode', periode)
        window.location.replace(urlBack);

        // alert(bagianId)
    }

    function removeTextInput(event, pertanyaanId) {
        if (event.target.parentNode.parentNode.contains(document.querySelector("#lainnya_" + pertanyaanId))) {
            document.querySelector("#lainnya_" + pertanyaanId).remove();
        }
    }

    function showTextInput(event, pertanyaanId) {
        console.log(`${event.target.type} - ${event.target.checked}`);
        if (event.target.type === "checkbox") {
            if (event.target.checked == false)
                return removeTextInput(event, pertanyaanId)
        }
        if (event.target.type === "select-one") {
            if (event.target.value == "lainnya") {
                if (!event.target.parentNode.parentNode.contains(document.querySelector("#lainnya_" + pertanyaanId))) {
                    let input = document.createElement('input');
                    input.className = 'form-control'
                    input.name = `lainnya[${pertanyaanId}]`
                    input.id = `lainnya_${pertanyaanId}`
                    // event.target.removeAttribute('onclick')
                    event.target.closest('div').after(input)
                    return
                }
            } else {
                return removeTextInput(event, pertanyaanId)
            }
        }
        if (!event.target.parentNode.parentNode.contains(document.querySelector("#lainnya_" + pertanyaanId))) {
            let input = document.createElement('input');
            input.className = 'form-control'
            input.name = `lainnya[${pertanyaanId}]`
            input.id = `lainnya_${pertanyaanId}`
            input.placeholder = `isikan jawaban lainnya`
            input.setAttribute('required', 'required')
            // event.target.removeAttribute('onclick')
            event.target.closest('div').after(input);
        }
    }
</script>
@endsection