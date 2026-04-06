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

        $mhs2 = Mahasiswa::with(['user.userSesi' => function ($q) {
            $q->orderBy('sesi_periode', 'desc')->latest()->limit(1);
        }])->where('nim', $nim)->latest()->first();
        $periode = $mhs2?->user?->userSesi?->sesi_periode ?? '-';
        $tanggalIsi = $mhs2?->user?->userSesi?->sesi_tanggal ?? null;

        return response()->json(['status' => $status, 'mhs' => $mhs2, 'periode' => $periode, 'tanggal_isi' => $tanggalIsi]);
    }

    public function getData()
    {
        $alumni = AlumniSurvei::select('nim', 'nama', 'prodi', 'kabupaten')
            ->get();

        $hasil = [];

        foreach ($alumni as $a) {

            // Ambil data sesi berdasarkan NIM
            $mhs = \App\Models\Mahasiswa::where('nim', $a->nim)
                ->whereHas('user.userSesi')
                ->with(['user.userSesi' => function ($q) {
                    $q->orderBy('sesi_periode', 'desc')->limit(1);
                }])
                ->first();

            // Skip kalau tidak pernah login
            if (!$mhs || !$mhs->user || !$mhs->user->userSesi) {
                continue;
            }

            $sesi = $mhs->user->userSesi;

            // Tentukan status
            $status = $sesi->sesi_status == '1' ? 'Selesai' : 'Sedang Mengisi';

            $hasil[] = [
                'nim'         => $a->nim,
                'nama'        => $a->nama,
                'prodi'       => $a->prodi,
                'kabupaten'   => $a->kabupaten,
                'status'      => $status,
                'tanggal_isi' => $sesi->sesi_tanggal
            ];
        }

        // Urutkan berdasarkan kabupaten
        $hasil = collect($hasil)
            ->sortBy('kabupaten')
            ->values();

        return response()->json($hasil);
    }
}
