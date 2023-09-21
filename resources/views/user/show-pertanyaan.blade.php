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
            </form>
        </div>
    </div>
</section>
<!-- Basic End -->

@endsection

@section('js')
<script>
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