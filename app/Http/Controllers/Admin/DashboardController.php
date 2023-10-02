<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Models\JawabanJenis;
use App\Models\User;
use App\Models\UserSesi;
use Illuminate\Support\Facades\DB;

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

    public function getUserPeriode($periode)
    {
        $data = UserSesi::with('user')->where(['sesi_periode' => $periode])->get();
        return $data;
    }

    public function statistik_bagian()
    {


        // return Jawaban::where(['pertanyaan_id' => 6])->get();
        // return $data[0]->jawabanJenis;

        // foreach ($data as $row) {
        // }
        $data['bagian'] = Step::all();
        // return $data;
        $data['title'] = "Statistik Bagian";
        $data['dataUser'] = User::where('user_role_id', 2)->get();

        // $data['stepData'] = Step::with('stepChild')->whereNull('step_parent')->orderBy('step_urutan', 'ASC')->get();
        // return $data;
        return view('admin.statistik-bagian', $data);
    }

    public function filterData()
    {
        return JawabanJenis::where('pertanyaan_id', 155)->get();
    }

    public function getfilteredData(Request $request, $periode)
    {
        $users = [];
        if ($request->filter == "-")
            $userTahunAjar = Jawaban::where(['pertanyaan_id' => 155])->get();
        else
            $userTahunAjar = Jawaban::where(['pertanyaan_id' => 155, 'jawaban' => $request->filter])->get();
        foreach ($userTahunAjar as $item) {
            $users[] = $item->sesi_id;
        }
        // return $users;
        // $user = User::whereIn('id', $users)->get();
        $userSesi = UserSesi::with(['user'])->where('sesi_periode', $periode)->whereIn('id', $users)->get();
        // return $userSesi;
        $users = [];

        foreach ($userSesi as $item) {
            $users[] = $item->user->name;
        }
        return $users;
    }
    public function statistik_data_alumni()
    {

        $data['bagian'] = Step::all();
        // return $data;
        $data['title'] = "Statistik Data Alumni";
        $data['dataUser'] = User::where('user_role_id', 2)->get();
        return view('admin.statistik-data-alumni', $data);
    }

    public function getPertanyaan($bagianId)
    {
        return Pertanyaan::with(['textProperties'])->where(['step_id' => $bagianId])->get();
    }

    public function getAlumniData(Request $request)
    {
        $data = collect(json_decode($request->data));
        $data->map(function ($data) use ($request) {
            $user = User::where('name', $data->iddata)->first();
            if ($user->created_at != null)
                $data->tanggal_login = \Carbon\Carbon::parse($user->created_at)->format('d M Y');
            else
                $data->tanggal_login = "";
            $sesi = UserSesi::where([
                'user_id' => $user->id,
                'sesi_periode' => $request->periode
            ])->first();
            $data->sesi_id = $sesi->id;
        });
        return $data;
    }
    public function getCountJawaban(Request $request)
    {
        // return $request->all();
        $pertanyaanId = $request->pertanyaanId;
        $sesiId = json_decode($request->sesiId);
        $tahunId = json_decode($request->filter);
        $users = [];
        if ($request->filter == "-") {
            $users = $sesiId;
        } else {
            $userTahunAjar = Jawaban::where(['pertanyaan_id' => 155])->whereIn('jawaban', $tahunId)->whereIn('sesi_id', $sesiId)->get();

            // $userTahunAjar = Jawaban::where(['pertanyaan_id' => 2, 'jawaban' => $request->filter])->whereIn('user_id', $usersId)->get();
            foreach ($userTahunAjar as $item) {
                $users[] = $item->sesi_id;
            }
        }
        // $userTahunAjar->map(function ($user) use ($users) {
        // });
        // $users["aa"] = "mantap";
        // return $users;
        // if ($usersId == null)
        //     $usersId = [];
        $data['dataPertanyaan'] = Pertanyaan::with([
            'jawabanJenis'
        ])->where('id', $pertanyaanId)->get();
        $data['dataPertanyaan'][0]->jawabanJenis->map(function ($data) use ($pertanyaanId, $users) {
            if ($users == null)
                $total = 0;
            // $total = Jawaban::where(['pertanyaan_id' => $pertanyaanId, 'jawaban' => $data->pilihan_jawaban])->count();
            else
                $total = Jawaban::where(['pertanyaan_id' => $pertanyaanId, 'jawaban' => $data->pilihan_jawaban])
                    ->whereIn('sesi_id', $users)->count();
            $data->total = $total;
        });
        $data['asdfa'] = $request->all();
        $data['user'] = $users;
        return $data;
    }

    public function getTahunMengisi(Request $request)
    {
        $usersId = json_decode($request->usersId);
        $userSesi = UserSesi::select(DB::raw('year(sesi_tanggal) as tahun, count(*) as total'))
            ->groupBy(DB::raw('year(sesi_tanggal)'))
            ->whereIn('id', $usersId)
            ->get();
        return $userSesi;
    }

    public function dataAlumni()
    {
        $data['title'] = "Data Alumni";
        $data['dataUser'] = User::where('user_role_id', 2)->get();
        // $data['bagian'] = Step::all();

        return view('admin.data-alumni', $data);
    }

    public function getUsers(Request $request)
    {
        // return $request->all();
        $users = User::where('user_role_id', 2)->whereIn('name', json_decode($request->iddata))->get();
        $id = [];
        foreach ($users as $user) {
            $id[] = $user->id;
        }
        $dataUser = UserSesi::where('sesi_periode', $request->periode)->whereIn('user_id', $id)->get();
        return $dataUser;
    }

    public function getAngkaResult(Request $request)
    {
        $pertanyaanId = $request->pertanyaanId;
        $usersId = json_decode($request->sesiId);
        if ($usersId == null) {
            $data['dataPertanyaan'] = Pertanyaan::with('jawaban')->where('id', $pertanyaanId)->get();
        } else {
            $data['dataPertanyaan'] = Pertanyaan::with(['jawaban' => function ($jawaban) use ($usersId) {
                $jawaban->whereIn('sesi_id', $usersId);
            }])->where('id', $pertanyaanId)->get();
        }
        $data['dataPertanyaan']->map(function ($data) use ($usersId) {
            if ($usersId == null) {
                $data->total = 0;
                $data->rata = 0;
                $data->max = 0;
                $data->min = 0;
                return;
            }
            $total = $data->jawaban->reduce(function ($tot, $data) {
                return $tot + $data->jawaban;
            }, 0);
            $angka = [];
            // $data->jawaban->foreach(function ($data) {
            //     $angka[] = $data->jawaban;
            // });
            foreach ($data->jawaban as $jawaban) {
                $angka[] = (float)$jawaban->jawaban;
            }
            $data->total = number_format($total, 0, ',', '.');
            $data->rata = round($total / count($data->jawaban), 2);
            // $data->rata = number_format(round($total / count($data->jawaban), 2), 0, ',', '.');
            $data->max = number_format(max($angka), 0, ',', '.');
            $data->min = number_format(min($angka), 0, ',', '.');
        });
        return $data;
    }

    public function detailJawaban($sesiId)
    {
        $data['title'] = "Detail Jawaban";

        // $user = User::where('name', $userId)->first();
        $sesi = UserSesi::where('id', $sesiId)->with('user')->first();
        $data['user'] = $sesi->user;
        $data['bagian'] = Step::with(['pertanyaan' => function ($pertanyaan) use ($sesi) {
            $pertanyaan->with(['jawaban' => function ($jawaban) use ($sesi) {
                $jawaban->where(['sesi_id' => $sesi->id]);
            }]);
        }])->get();
        // return $data;
        return view('admin.data-alumni-jawaban', $data);
    }

    public function cetak($periode)
    {
        $bagian = Step::with(['pertanyaan'])->get();
        $jawaban = UserSesi::with('user')->where('sesi_periode', $periode)->paginate(50);
        $data = [];
        foreach ($jawaban as $sesinya) {
            foreach ($bagian as $part) {
                foreach ($part->pertanyaan as $tanya) {
                    $jawab = Jawaban::where(['pertanyaan_id' => $tanya->id, 'sesi_id' => $sesinya->id])->select('jawaban')->get();
                    if (count($jawab) == 0) {
                        $data[] = "-";
                    } else {
                        $word = "";
                        if (count($jawab) == 1) {
                            $data[] = $jawab[0]->jawaban;
                        } else {
                            foreach ($jawab as $index => $item) {
                                $word .= $item->jawaban;
                                if (count($jawab) != $index + 1)
                                    $word .= ", ";
                            }
                            $data[] = $word;
                        }
                    }
                }
            }
            $sesinya->jawaban = $data;
            $data = [];
        }
        // return $jawaban;
        return view('admin.cetak', compact(['bagian', 'jawaban']));

        // return $bagian;
    }
}
