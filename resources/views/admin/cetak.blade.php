<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        table {
            border-collapse: collapse;
            table-layout: auto;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Tanggal</th>
                <th rowspan="3">NIM</th>
                <th rowspan="3">Nama</th>
                <th rowspan="3">Prodi</th>
            </tr>
            <tr>
                @foreach ($bagian as $row)
                <th colspan=" {{count($row->pertanyaan)}}" style="text-align:center;
                white-space: nowrap;">{{$row->step_kode}}. {{$row->step_nama}}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($bagian as $row)
                @foreach ($row->pertanyaan as $tanya)
                <th>{{$tanya->pertanyaan}}</th>
                @endforeach
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($sesi as $index => $jawab)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{\Carbon\Carbon::parse($jawab->sesi_tanggal)->format('d-m-Y');}}</td>
                @if($jawab->user->mahasiswa!=null)
                <td>{{$jawab->user->mahasiswa->nim}}</td>
                <td>{{$jawab->user->mahasiswa->dataDiri->nama_lengkap}}</td>
                <td>{{$jawab->user->mahasiswa->prodi->organisasi_singkatan}}</td>
                @else
                <td>-</td>
                <td>-</td>
                <td>-</td>
                @endif
                @foreach ($jawab->jawaban as $row)
                <td>{{$row}}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sesi->links() }}
</body>

</html>