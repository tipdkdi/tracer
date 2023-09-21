@extends('template')

@section('content')

<!-- Form Row Start -->
<section class="scroll-section" id="formRow">
    <!-- <h2 class="small-title">Daftar Pertanyaan</h2> -->

    <div class="card mb-5">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Bagian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td scope="row">Pertanyaan Awal</td>
                        <td>
                            @if(count($firstOrLast)!=0)
                            @if($firstOrLast[0]->stepFirst==null)
                            <a type="button" onclick="choose(event)" href="#" data-jenis="first" data-id="{{$firstOrLast[0]->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Tentukan</a>
                            @else
                            <a type="button" onclick="choose(event)" href="#" data-jenis="first" data-id="{{$firstOrLast[0]->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$firstOrLast[0]->stepFirst->step_kode."-".$firstOrLast[0]->stepFirst->step_nama}}</a>
                            @endif
                            @else
                            <a type="button" onclick="choose(event)" href="#" data-jenis="first" data-id="{{$firstOrLast[0]->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Tentukan</a>

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">2</td>
                        <td scope="row">Pertanyaan Akhir</td>
                        <td>
                            @if(count($firstOrLast)!=0)

                            @if($firstOrLast[0]->stepLast==null)
                            <a type="button" onclick="choose(event)" href="#" data-jenis="last" data-id="{{$firstOrLast[0]->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Tentukan</a>
                            @else
                            <a type="button" onclick="choose(event)" href="#" data-jenis="last" data-id="{{$firstOrLast[0]->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$firstOrLast[0]->stepLast->step_kode."-".$firstOrLast[0]->stepLast->step_nama}}</a>
                            @endif
                            @else
                            <a type="button" onclick="choose(event)" href="#" data-jenis="last" data-id="{{$firstOrLast[0]->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Tentukan</a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Form Row End -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDefault" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="small-title"><span id="modal-title"></span></h2>
                <select class="form-select mb-3" id="bagian" required>
                    <option value="">Pilih Bagian</option>
                    @foreach($bagianList as $bagian)
                    <option value="{{$bagian->id}}">{{$bagian->step_kode}} - {{$bagian->step_nama}}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="save">Tentukan Direct</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    let element
    let save = document.querySelector("#save")

    function choose(event) {
        element = event.target
    }
    save.addEventListener('click', async function() {
        let dataSend = new FormData()
        let bagian = document.querySelector("#bagian")

        dataSend.append('id', element.dataset.id)
        dataSend.append('jenis', element.dataset.jenis)
        dataSend.append('bagian_id', bagian.options[bagian.selectedIndex].value)
        response = await fetch('{{route("admin.bagian.update.first.Last")}}', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        if (responseMessage.status == "sukses") {
            alert("berhasil ubah data")
            element.innerText = bagian.options[bagian.selectedIndex].innerText
        }
        // console.log(responseMessage);
    });
</script>
@endsection