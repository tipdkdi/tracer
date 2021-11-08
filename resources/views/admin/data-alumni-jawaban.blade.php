@extends('template')

@section('content')
<!-- Form Row Start -->
<section class="scroll-section">
    <div class="card mb-2">
        <div class="card-body d-flex flex-column">
            <h4>Identitas Alumni</h4>
            <span class="" style="list-style-type:none">Nim : <span id=nim></span></span>
            <span style="list-style-type:none">Nama : <span id=nama></span></span>
            <span style="list-style-type:none">Prodi : <span id=prodi></span></span>
        </div>
    </div>
</section>
<section class="scroll-section">

    <div class="card mb-5">
        <div class="card-body">
            <h2>Detail Jawaban</h2>
            <table class="table table-bordered table-hover mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bagian</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                    </tr>
                </thead>
                <tbody id="show-data-table">
                    @foreach ($bagian as $index => $item)
                    <tr>
                        <td rowspan="{{(count($item->pertanyaan)+1)}}">{{$index+1}}</td>
                        <td rowspan="{{(count($item->pertanyaan)+1)}}">{{$item->step_kode}} - {{$item->step_nama}}</td>
                    </tr>

                    @foreach ($item->pertanyaan as $index => $tanya)
                    <tr>
                        <td colspan="1">{{$tanya->pertanyaan}}</td>
                        @if(count($tanya->jawaban)!==0)
                        <td>{{$tanya->jawaban[0]->jawaban}}</td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                    @endforeach


                    @endforeach
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

        dataSend.append('iddata', JSON.stringify("{{$user->name}}"))
        response = await fetch('https://sia.iainkendari.ac.id/alumni/tracer/data-alumni', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        document.querySelector("#nim").innerText = responseMessage.data[0].nim
        document.querySelector("#nama").innerText = responseMessage.data[0].nama
        document.querySelector("#prodi").innerText = responseMessage.data[0].prodi
        console.log();

    }
</script>
@endsection