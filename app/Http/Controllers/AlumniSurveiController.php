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

        $mhs = Mahasiswa::with('user.userSesi')
            ->where('nim', $nim)
            ->first();

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

        return response()->json(['status' => $status]);
    }
}
