<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {

        // $data['dataPertanyaan'] = Pertanyaan::with([
        //     'jawabanJenis'
        // ])->where('id', 6)->get();
        // // return Jawaban::where(['pertanyaan_id' => 6])->get();
        // // return $data[0]->jawabanJenis;
        // $data['dataPertanyaan'][0]->jawabanJenis->map(function ($data) {
        //     $total = Jawaban::where(['pertanyaan_id' => 6, 'jawaban' => $data->pilihan_jawaban])->count();
        //     $data->total = $total;
        // });
        // // foreach ($data as $row) {
        // // }
        // // return $data;
        $data['title'] = "Dashboard";
        $data['totalMasukSistem'] = User::where(['user_role_id' => 2])->count();
        // $data['stepData'] = Step::with('stepChild')->whereNull('step_parent')->orderBy('step_urutan', 'ASC')->get();
        // return $data;
        return view('admin.dashboard', $data);
    }
    public function statistik()
    {


        // return Jawaban::where(['pertanyaan_id' => 6])->get();
        // return $data[0]->jawabanJenis;

        // foreach ($data as $row) {
        // }
        $data['bagian'] = Step::all();
        // return $data;
        $data['title'] = "Statistik";
        // $data['stepData'] = Step::with('stepChild')->whereNull('step_parent')->orderBy('step_urutan', 'ASC')->get();
        // return $data;
        return view('admin.statistik', $data);
    }

    public function getPertanyaan($bagianId)
    {
        return Pertanyaan::where(['step_id' => $bagianId])->get();
    }

    public function getCountJawaban($pertanyaanId)
    {
        $data['dataPertanyaan'] = Pertanyaan::with([
            'jawabanJenis'
        ])->where('id', $pertanyaanId)->get();
        $data['dataPertanyaan'][0]->jawabanJenis->map(function ($data) use ($pertanyaanId) {
            $total = Jawaban::where(['pertanyaan_id' => $pertanyaanId, 'jawaban' => $data->pilihan_jawaban])->count();
            $data->total = $total;
        });
        return $data;
    }

    public function dataAlumni()
    {
        $data['title'] = "Data Alumni";
        $data['dataUser'] = User::where('user_role_id', 2)->get();

        return view('admin.data-alumni', $data);
    }
}
