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

        $mhs = Mahasiswa::with(['user.userSesi' => function ($q) use ($tahun) {
            $q->where('sesi_periode', $tahun);
        }])
            ->where('nim', $nim)
            ->first();

        // return $mhs;
        if ($mhs && $mhs->user && $mhs->user->userSesi->isNotEmpty()) {
            $sesi = $mhs->user->userSesi->first(); // atau foreach kalau mau semua
            if ($sesi->sesi_status == '0') {
                $status = "Sedang Mengisi";
            } elseif ($sesi->sesi_status == '1') {
                $status = "Selesai";
            }
        }


        return response()->json(['status' => $status, 'ms' => $mhs]);
    }
}
