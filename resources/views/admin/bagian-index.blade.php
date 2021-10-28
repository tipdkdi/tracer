@extends('template')

@section('content')

<!-- Form Row Start -->
<section class="scroll-section" id="formRow">
    <div class="col-auto d-flex mb-2">
        <a href="{{route('admin.bagian.create')}}" class="btn btn-primary btn-icon btn-icon-start ms-1">
            <i data-cs-icon="plus"></i>
            <span>Tambah Bagian</span>
        </a>
        <a href="{{route('admin.bagian.set')}}" class="btn btn-secondary btn-icon btn-icon-start ms-1">
            <i data-cs-icon="gear"></i>
            <span>Pengaturan Bagian</span>
        </a>
        <a href="{{route('admin.bagian.set.urutan')}}" class="btn btn-secondary btn-icon btn-icon-start ms-1">
            <i data-cs-icon="gear"></i>
            <span>Pengaturan Direct</span>
        </a>

    </div>
    <div class="card mb-5">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Deskripsi</th>
                        <!-- <th scope="col">Urutan</th> -->
                        <th scope="col">Pertanyaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stepData as $index => $step)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$step->step_kode}}</td>
                        <td>{{$step->step_nama}}</td>
                        <!-- <td>{{$step->step_urutan}}</td> -->
                        <td>
                            <a href="{{route('admin.bagian.show',$step->id)}}" class="btn btn-light btn-sm">Kelola</a>
                            <a href="{{route('admin.bagian.edit',$step->id)}}" class="btn btn-warning btn-sm">Ubah</a>
                            <a href="{{route('admin.bagian.delete',$step->id)}}" onclick="return confirm('Yakin Hapus')" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    @foreach ($step->stepChild as $child)
                    <tr>
                        <th></th>
                        <td>{{$child->step_kode}}</td>
                        <td>{{$child->step_nama}}</td>
                        <!-- <td>{{$child->step_urutan}}</td> -->
                        <td>
                            <a href="{{route('admin.bagian.show',$child->id)}}" class="btn btn-light btn-sm">Kelola</a>
                            <a href="{{route('admin.bagian.edit',$child->id)}}" class="btn btn-warning btn-sm">Ubah</a>
                            <a href="{{route('admin.bagian.delete',$child->id)}}" onclick="return confirm('Yakin Hapus')" class="btn btn-danger btn-sm">Hapus</a>

                        </td>
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