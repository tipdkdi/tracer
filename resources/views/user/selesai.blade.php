@extends('user.template-user')

@section('content')

<div class="card mb-5">
    <div class="card-body">
        <h2>Kuisioner Selesai</h2>
        <p>Terima Kasih atas partisipasi.</p>
        <a href="{{route('user.index')}}" class="btn btn-primary">Kembali Ke Beranda</a>
    </div>
</div>
@endsection