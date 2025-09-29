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
        $periode = "-";
        $tanggalIsi = "";


        $mhs = Mahasiswa::with('dataDiri')->where('nim', $nim)
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
            if ($sesi->sesi_periode == $tahun) {
                if ($sesi->sesi_status == '0') {
                    $status = "Sedang Mengisi";
                } elseif ($sesi->sesi_status == '1') {
                    $status = "Selesai";
                }
            }
        }

        $mhs2 = Mahasiswa::with('user.userSesi')->where('nim', $nim)->latest()->first();
        $periode = $mhs2?->user?->userSesi?->sesi_periode ?? '-';
        $tanggalIsi = $mhs2?->user?->userSesi?->sesi_tanggal ?? null;

        return response()->json(['status' => $status, 'mhs' => $mhs2, 'periode' => $periode, 'tanggal_isi' => $tanggalIsi]);
    }
}
