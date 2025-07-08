@extends('user.template-user')

@section('content')

<div class="card mb-5">
    <div class="card-body">
        <h2>Selamat Datang di si LANNI</h2>
        <p><b>SI-LANNI atau Sistem Informasi Pelacakan Alumni</b> merupakan metode yang digunakan oleh IAIN Kendari untuk menerima umpan balik dari para alumninya. Umpan balik yang diperoleh dari alumni tersebut digunakan oleh program studi di IAIN Kendari sebagai evaluasi untuk pengembangan kualitas dan sistem Pendidikan yang dilaksanakan di perguruan tinggi. Umpan balik ini dapat bermanfaat pula bagi program studi di IAIN Kendari untuk memetakan lapangan kerja dan usaha agar sesuai dengan tuntutan dunia kerja.</p>
    </div>
</div>
<h2 class="small-title">Daftar Kuisioner</h2>
<div class="card mb-5">
    <div class="card-body">
        <p><b>Petunjuk</b> : <br>

            Berikan jawaban pada tiap-tiap pertanyaan yang telah disediakan berikut ini sesuai dengan keadaan Anda.</p>
        <select id="periode" class="form-control mb-3">
            <option value="">Pilih Periode Tahun Pengisian</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
        </select>
        <button onclick="showsesi()" class="btn btn-primary">Isi Kuisioner</button>
    </div>
</div>
@endsection

@section('js')
<script>
    function showsesi() {
        let periode = document.querySelector('#periode')
        if (periode.value == "")
            return alert('Mohon Pilih Periode!')
        let url = "{{route('user.show.pertanyaan',[':periode',$first->step_id_first])}}"
        url = url.replace(':periode', periode.value)
        window.location.href = url
    }
</script>
@endsection