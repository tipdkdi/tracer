@extends('template')

@section('content')

<!-- Form Row Start -->
<section class="scroll-section" id="formRow">
    <h2 class="small-title">Form Row</h2>
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{route('admin.bagian.store')}}" method="post" enctype="multipart/form" class="row g-3">
                @csrf
                <div class="col-md-2">
                    <label for="step_kode" class="form-label">Kode Step</label>
                    <input type="text" class="form-control" id="step_kode" name="step_kode" required />
                </div>
                <div class="col-md-1">
                    <label for="step_urutan" class="form-label">Urutan</label>
                    <input type="text" class="form-control" id="step_urutan" name="step_urutan" required />
                </div>
                <div class="row">
                </div>
                <div class="col-md-9">
                    <label for="step_nama" class="form-label">Deskripsi Step</label>
                    <textarea class="form-control" placeholder="Deskripsi" name="step_nama" id="step_nama" rows="3" required></textarea>
                </div>


                <div class="col-md-4">
                    <label for="inputState" class="form-label">Pilih Parent</label>
                    <select id="inputState" class="form-select" name="step_parent">
                        <option value="">Pilih</option>
                        @foreach($step as $item)
                        <option value="{{$item->id}}">{{$item->step_kode}} - {{$item->step_nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Tambah Step</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Form Row End -->

@endsection