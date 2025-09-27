<?php

namespace App\Http\Controllers;

use App\Models\DataDiri;
use App\Models\Mahasiswa;
use App\Models\Organisasi;
use App\Models\User;
use App\Models\UserSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveiorController extends Controller
{
    //

    public function index()
    {
        $data['title'] = "DATA TIM SURVEI";
        $data['total'] = UserSesi::where('sesi_periode', '2025')->count();
        return view('surveior.dashboard', $data);
    }

    public function show($kabupaten)
    {
        $data = UserSesi::with([
            'user.mahasiswa.prodi',
            'user.mahasiswa.dataDiri' => function ($dataDiri) use ($kabupaten) {
                $dataDiri->where('kabupaten', $kabupaten);
            }
        ])
            ->whereHas('user.mahasiswa.dataDiri', function ($dataDiri) use ($kabupaten) {
                $dataDiri->where('kabupaten', $kabupaten);
            })
            ->where('sesi_periode', '2025')->get();
        return $data;
    }
    public function importDataView()
    {
        return view('surveior.import');
    }

    public function importData()
    {
        $data = User::where('user_role_id', 2)->get('name');
        return $data;
    }

    public function storeImport(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = json_decode($request->data);
            // return $data;


            $user = User::where('name', $data->iddata)->first();
            if (!$user) {
                $user = User::create([
                    'user_role_id' => 2,
                    'name' => $data->iddata,
                    'email' => $data->iddata . "@mail.com",
                    'password' => $data->iddata,
                ]);
            }

            $prodi = Organisasi::where('organisasi_singkatan', $data->idprodi)->first();
            $dataDiri = DataDiri::create([
                'nama_lengkap' => $data->nama,
                'jenis_kelamin' => ($data->kelamin != '') ? $data->kelamin : "L",
                'lahir_tempat' => $data->tmplahir,
                'lahir_tanggal' => $data->tgllahir,
                'no_hp' => $data->hp,
                'alamat_ktp' => $data->alamat,
                'alamat_domisili' => $data->alamat,
                'kecamatan' => $data->kecamatan,
                'kabupaten' => $data->idkabupaten,
                'provinsi' => $data->idprovinsi,
                'nik' => (isset($data->nik) ? $data->nik : '0000000000000000'),
            ]);
            $mahasiswa = Mahasiswa::create([
                'nim' => $data->nim,
                'data_diri_id' => $dataDiri->id,
                'organisasi_id' => $prodi->id,
                'user_id' => $user->id,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'details' => $mahasiswa,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            // return;

            return response()->json([
                'status' => false,
                'message' => $th,
                'details' => [],
            ], 500);
        }
    }
}
