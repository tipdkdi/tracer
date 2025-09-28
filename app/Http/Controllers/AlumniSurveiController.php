<?php

namespace App\Http\Controllers;

use App\Models\AlumniSurvei;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AlumniSurveiController extends Controller
{
    public function getByKabupaten(Request $request)
    {
        $kabupaten = $request->query('kabupaten');

        $query = AlumniSurvei::query();
        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }

        return response()->json($query->get());
    }

    public function getStatus($nim, $tahun)
    {
        $status = "Belum Login";
        $periode = "2025";
        $tanggalIsi = "";

        $mhs = Mahasiswa::where('nim', $nim)
            ->whereHas('user.userSesi', function ($q) use ($tahun) {
                $q->where('sesi_periode', $tahun);
            })
            ->with(['user.userSesi' => function ($q) use ($tahun) {
                $q->where('sesi_periode', $tahun);
            }])
            ->first();


        // return $mhs;
        if ($mhs && $mhs->user && $mhs->user->userSesi) {
            $sesi = $mhs->user->userSesi;
            $periode = $sesi->sesi_periode;
            $tanggalIsi = $sesi->sesi_tanggal;
            if ($sesi->sesi_periode == $tahun) {
                if ($sesi->sesi_status == '0') {
                    $status = "Sedang Mengisi";
                } elseif ($sesi->sesi_status == '1') {
                    $status = "Selesai";
                }
            }
        }

        return response()->json(['status' => $status, 'ms' => $mhs, 'periode' => $periode, 'tanggal_isi' => $tanggalIsi]);
    }
}
