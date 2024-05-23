<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Jawaban;
use App\Models\User;
use App\Models\BagianDirect;
use App\Models\JawabanJenis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\FirstOrLast;
use App\Models\JawabanLainnya;
use App\Models\Mahasiswa;
use App\Models\Pertanyaan;
use App\Models\UserSesi;


class UserController extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        // return session()->get('userData')->id;
        $data['iddata'] = session('iddata');
        $data['first'] = FirstOrLast::first();
        $data['data'] = Mahasiswa::with(['dataDiri', 'prodi'])->where('user_id', session('userData')->id)->first();
        // return $data;
        return view('user.dashboard', $data);
    }
    //
    public function login()
    {
        return view('user.login');
    }

    public function sesi($iddata)
    {
        // $data = json_decode($request->input('data'), true);
        // $sesi = [
        //     'iddata' => $data['iddata'],
        //     'nim' => $data['nim'],
        //     'nama' => $data['nama'],
        //     'idprodi' => $data['idprodi']
        // ];
        // $user =
        //     [
        //         'user_role_id' => 2,
        //         'name' => $iddata,
        //         'email' => $iddata . "@mail.com",
        //         'password' => $iddata,
        //         'created_at' => \Carbon\Carbon::now(),
        //     ];
        // $checkUser = User::where('name', $iddata)->first();
        // if ($checkUser == null) {
        //     $user = DB::table('users')->insert($user);
        // } else {
        //     if ($checkUser->created_at == null) {
        //         $checkUser->created_at = \Carbon\Carbon::now();
        //         $checkUser->save();
        //     }
        // }
        // else {
        // }

        // session(['data_alumni', $sesi]);
        // $request->session(['data_alumni' => $sesi]);

        // Session::put('data_alumni', $sesi);

        // session(['data_alumni' => $sesi]);

        session()->put('iddata', $iddata);
        session()->put('userData', User::where('name', $iddata)->first());
        return redirect()->route('user.index');
        // return $request->session('data_alumni');
        // return $data['iddata'];
        // return $user;
    }

    public function logout()
    {
        session()->forget('iddata');

        return redirect()->route('user.login');
    }
    public function showPertanyaan($periode, $bagianId)
    {
        $data['title'] = "Kuisioner Alumni";
        $data['iddata'] = session('iddata');


        // $jawaban = Jawaban::all();
        // foreach ($jawaban as $item) {
        //     $sesiedit = UserSesi::where(['user_id' => $item->user_id])->first();
        //     $edit = Jawaban::where(['user_id' => $item->user_id])->update([
        //         'sesi_id' => $sesiedit->id
        //     ]);
        //     // $edit->sesi_id = $sesiedit->id;
        //     // $edit->save();
        // }

        // $ses = UserSesi::all();
        // foreach ($ses as $item) {
        //     $edit = Jawaban::where(['user_id' => $item->user_id])->update([
        //         'sesi_id' => $item->id
        //     ]);
        // }
        // return;
        $sesi = UserSesi::where(['user_id' => session()->get('userData')->id, 'sesi_periode' => $periode])->first();
        // return $sesi->id;
        if (empty($sesi))
            $sesi = UserSesi::create([
                'user_id' => session()->get('userData')->id,
                'sesi_tanggal' => \Carbon\Carbon::now(),
                'sesi_periode' => $periode,
                'sesi_status' => "0"
            ]);
        $data['sesi_id'] = $sesi->id;
        $data['bagianData'] = Step::with(['pertanyaan' => function ($pertanyaan) {
            $pertanyaan->with(['jawabanJenis', 'textProperties'])->orderBy('pertanyaan_urutan', 'ASC');;
        }, 'bagianDirect'])->where('id', $bagianId)->first();

        $type = "text";
        foreach ($data['bagianData']->pertanyaan as $row) {
            $jawaban = "";
            $required = "";
            if ($row->required == 1)
                $required = "required";
            // $dataJawaban = Jawaban::where(['user_id' => session()->get('userData')->id, 'pertanyaan_id' => $row->id])->get();
            $dataJawaban = Jawaban::where(['sesi_id' => $sesi->id, 'pertanyaan_id' => $row->id])->get();
            $gg[] = $dataJawaban;
            if (count($dataJawaban) > 0) {
                $jawaban = $dataJawaban;
            }
            if ($row->pertanyaan_jenis_jawaban == "Text") {
                if ($row->textProperties->jenis == "text-email")
                    $type = "email";
                else if ($row->textProperties->jenis == "text-angka")
                    $type = "number";
                else if ($row->textProperties->jenis == "text-desimal")
                    $type = "number";
                else if ($row->textProperties->jenis == "text-tanggal")
                    $type = "date";
                else
                    $type = "text";
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                if (count($dataJawaban) > 0)
                    $content .= "<input step='any' " . $required . " type='" . $type . "' name='input[" . $row->id . "]' class='form-control' value='" . $jawaban[0]->jawaban . "'>";
                else
                    $content .= "<input step='any' " . $required . "  type='" . $type . "' name='input[" . $row->id . "]' class='form-control' value=''>";
                $content .= '</div>';
                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Text Panjang") {
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                if (count($dataJawaban) > 0)
                    $content .= "<textarea " . $required . "  name='input[" . $row->id . "]' class='form-control'>" . $jawaban[0]->jawaban . "</textarea>";
                else
                    $content .= "<textarea " . $required . "  name='input[" . $row->id . "]' class='form-control'></textarea>";

                $content .= '</div>';
                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Lebih Dari Satu Jawaban") {
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                foreach ($row->jawabanJenis as $index => $item) {
                    // $checked = "";
                    $checked = '';
                    if ($item->pilihan_jawaban != 'lainnya') {
                        if (count($dataJawaban) > 0) {
                            foreach ($jawaban as $jawab) {
                                if ($jawab->jawaban == $item->pilihan_jawaban) {
                                    $checked = "checked";
                                    break;
                                }
                            }
                        }
                        $content .= '<div class="form-check">
                    <input class="form-check-input" type="checkbox" name="input[' . $row->id . '][]" id="input' . $index . '" value="' . $item->pilihan_jawaban . '" ' . $checked . '/>
                    <label class="form-check-label" for="input' . $index . '">' . $item->pilihan_jawaban . '</label>
                  </div>';
                    } else {
                        if (count($dataJawaban) > 0) {
                            foreach ($dataJawaban as $jawab) {
                                $checked = ($jawab->jawaban == "lainnya") ? "checked" : '';
                            }
                        }
                        $content .= '<div class="form-check">
                    <input onclick="showTextInput(event, ' . $row->id . ')" class="form-check-input" type="checkbox" name="input[' . $row->id . '][]" id="input' . $row->id . '" value="lainnya" ' . $checked . '/>
                    <label class="form-check-label" for="input' . $row->id . '">Lainnya</label>
                  </div>';
                        // $check = JawabanLainnya::where('pertanyaan_id', $row->id)->get();
                        $check = Jawaban::with(['jawabanLainnya'])->where([
                            'sesi_id' => $sesi->id,
                            'pertanyaan_id' => $row->id,
                            'jawaban' => 'lainnya',
                        ])->get();
                        if (!empty($check[0]->jawabanLainnya))
                            $content .= "<input required name='lainnya[" . $row->id . "]' id='lainnya_" . $row->id . "' type='text' class='form-control' value='" . $check[0]->jawabanLainnya[0]->jawaban . "'>";
                    }
                }
                // if ($row->lainnya == "1") {
                // }
                $content .= '</div>';
                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Select") {
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                $content .= '<select onchange="showTextInput(event, ' . $row->id . ')"  ' . $required . '  class="form-select" name="input[' . $row->id . ']" required>';
                $content .= '<option value="">Pilih</option>';
                foreach ($row->jawabanJenis as $index => $item) {
                    $checked = '';
                    if ($item->pilihan_jawaban != 'lainnya') {
                        $selected = "";
                        if (count($dataJawaban) > 0)
                            $selected = ($jawaban[0]->jawaban == $item->pilihan_jawaban) ? "selected" : '';
                        $content .= '<option value="' . $item->pilihan_jawaban . '" ' . $selected . '>' . $item->pilihan_jawaban . '</option>';
                    } else {
                        if (count($dataJawaban) > 0)
                            $checked = ($jawaban[0]->jawaban == "lainnya") ? "selected" : '';
                        $content .= '<option value="lainnya" ' . $checked . '>Lainnya</option>';
                        $content .= '</select>';
                        // $check = JawabanLainnya::where('pertanyaan_id', $row->id)->get();
                        $check = Jawaban::with(['jawabanLainnya'])->where([
                            'sesi_id' => $sesi->id,
                            'pertanyaan_id' => $row->id,
                            'jawaban' => 'lainnya',
                        ])->get();
                        if (!empty($check[0]->jawabanLainnya))
                            $content .= "<input required name='lainnya[" . $row->id . "]' id='lainnya_" . $row->id . "' type='text' class='form-control' value='" . $check[0]->jawabanLainnya[0]->jawaban . "'>";
                    }
                }
                $content .= '</select>';

                $content .= '</div>';
                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Pilihan") {
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                foreach ($row->jawabanJenis as $index => $item) {
                    $checked = '';
                    if ($item->pilihan_jawaban != 'lainnya') {
                        if (count($dataJawaban) > 0)
                            $checked = ($jawaban[0]->jawaban == $item->pilihan_jawaban) ? "checked" : '';
                        // if ($row->lainnya != 0) {
                        $content .= '<div class="form-check">
                        <input onclick="removeTextInput(event, ' . $row->id . ')" ' . $required . ' class="form-check-input" type="radio" name="input[' . $row->id . ']" id="input' . $row->id . '' . $index . '" value="' . $item->pilihan_jawaban . '" ' . $checked . '/>
                        <label class="form-check-label" for="input' . $row->id . '' . $index . '">' . $item->pilihan_jawaban . '</label>
                      </div>';
                    } else {
                        if (count($dataJawaban) > 0)
                            $checked = ($jawaban[0]->jawaban == "lainnya") ? "checked" : '';
                        $content .= '<div class="form-check">
                            <input onclick="showTextInput(event, ' . $row->id . ')" class="form-check-input" type="radio" name="input[' . $row->id . ']" id="inputlainnya' . $row->id . '" value="lainnya" ' . $checked . '/>
                            <label class="form-check-label" for="inputlainnya' . $row->id . '">Lainnya</label>
                        </div>';
                        // $check = JawabanLainnya::where('pertanyaan_id', $row->id)->get();
                        $check = Jawaban::with(['jawabanLainnya'])->where([
                            'sesi_id' => $sesi->id,
                            'pertanyaan_id' => $row->id,
                            'jawaban' => 'lainnya',
                        ])->get();
                        if (!empty($check[0]->jawabanLainnya))
                            $content .= "<input required name='lainnya[" . $row->id . "]' id='lainnya_" . $row->id . "' type='text' class='form-control' value='" . $check[0]->jawabanLainnya[0]->jawaban . "'>";
                    }
                }
                $content .= '</div>';

                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Lokasi") {
                $provinsi = "";
                $kabupaten = "";
                if (count($dataJawaban) > 0) {
                    $kerjaLokasi = $jawaban[0]->jawaban;
                    $lokasi = explode('-', $kerjaLokasi);
                    $provinsi = trim($lokasi[0]);
                    $kabupaten = trim($lokasi[1]);
                }

                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                $content .= '<div style="padding-left:10px;">';
                $content .= '<select onchange="getKabupaten()" data-provinsi="' . $provinsi . '" id="provinsi" class="form-select" required>';

                $content .= '</select>';
                $content .= '<select class="form-select mt-2" data-kabupaten="' . $kabupaten . '" id="kabupaten" name="input[' . $row->id . ']" required>';

                $content .= '</select>';
                $content .= '</div>';
                $content .= '</div>';

                $row->form = $content;
            }
        }
        // return $gg;
        $data['akhir'] = false;
        $data['awal'] = false;
        $data['periode'] = $periode;
        $data['data'] = Mahasiswa::with(['dataDiri', 'prodi'])->where('user_id', session('userData')->id)->first();

        $awal = FirstOrLast::where('step_id_first', $bagianId)->count();
        if ($awal > 0)
            $data['awal'] = true;
        $akhir = FirstOrLast::where('step_id_last', $bagianId)->count();
        if ($akhir > 0)
            $data['akhir'] = true;

        return view('user.show-pertanyaan', $data);
        return $data;
    }

    public function storeJawaban(Request $request, $bagianId)
    {
        // return $request->all();
        try {
            //code...
            if ($request->awal == 1) {
                // 'sesi_periode' => $periode,
                $userSesi = UserSesi::where([
                    'id' => $request->sesi_id,
                    'sesi_status' => "1"
                ])->count();
                if ($userSesi == 0) {
                    UserSesi::updateOrCreate(
                        [
                            'id' => $request->sesi_id
                        ],
                        [
                            'sesi_tanggal' => \Carbon\Carbon::now(),
                            'sesi_status' => "0"
                        ]
                    );
                }
            } else if ($request->akhir == 1) {
                $userSesi = UserSesi::find($request->sesi_id);
                $userSesi->sesi_status = "1";
                $userSesi->save();
            }
            foreach ($request->input as $key => $value) {
                if (gettype($value) == "array") {
                    Jawaban::where([
                        'sesi_id' => $request->sesi_id,
                        'pertanyaan_id' => $key
                    ])->delete();
                    foreach ($value as $row) {
                        Jawaban::insert(
                            [
                                'sesi_id' => $request->sesi_id,
                                'pertanyaan_id' => $key,
                                'jawaban' => $row
                            ]
                        );
                    }
                } else {
                    $jawaban = Jawaban::updateOrCreate(
                        [
                            'sesi_id' => $request->sesi_id,
                            'pertanyaan_id' => $key
                        ],
                        [
                            'jawaban' => $value
                        ]
                    );
                    $lainnya = JawabanLainnya::where([
                        'jawaban_id' => $jawaban->id,
                    ])->count();
                    // return $lainnya;
                    if ($lainnya > 0) {
                        // if ($value != "lainnya")
                        JawabanLainnya::where('jawaban_id', $jawaban->id)->delete();
                    }
                }
                // JawabanLainnya::where('jawaban_id', $key)->delete();
                if (isset($request->lainnya)) {
                    if (isset($request->lainnya[$key]) && !empty($request->lainnya[$key])) { // cek ada atau tidak yang khusus pertanyaan ini punya jawaban "lainnya"
                        $jawaban = Jawaban::where([
                            'sesi_id' => $request->sesi_id,
                            'pertanyaan_id' => $key,
                            'jawaban' => 'lainnya'
                        ])->first();
                        JawabanLainnya::create(
                            [
                                'jawaban_id' => $jawaban->id,
                                'jawaban' => $request->lainnya[$key]
                            ]
                        );
                    }
                }
            }

            $direct = BagianDirect::where('step_id', $bagianId)->first();
            $akhir = FirstOrLast::where('step_id_last', $bagianId)->count();
            if ($akhir > 0) {
                $data['title'] = "Selesai";
                $data['iddata'] = session('iddata');
                $data['data'] = Mahasiswa::with(['dataDiri', 'prodi'])->where('user_id', session('userData')->id)->first();

                return view('user.selesai', $data);
            }
            // return $direct;
            if ($direct->is_direct_by_jawaban == 0) { //jika tidak direct berdasarkan jawaban 
                return redirect()->route('user.show.pertanyaan', [$request->periode, $direct->step_id_direct]);
            } else { // jika direct
                $loop = 1;
                foreach ($request->input as $key => $value) {
                    // if ($loop == 1)
                    $jawabanJenis = JawabanJenis::with(['jawabanRedirect'])
                        ->whereHas('jawabanRedirect')
                        ->where([
                            'pertanyaan_id' => $key,
                            'pilihan_jawaban' => $value
                        ])->first();

                    if ($jawabanJenis != null) {
                        $directJawaban = $jawabanJenis;
                    }
                    // $loop++;
                }
                // return $request->input;
                // return $directJawaban;
                return redirect()->route('user.show.pertanyaan', [$request->periode, $directJawaban->jawabanRedirect->step_id_redirect]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
