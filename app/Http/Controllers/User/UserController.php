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
use App\Models\Pertanyaan;


class UserController extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        // return session()->get('userData')->id;
        $data['iddata'] = session('iddata');
        $data['first'] = FirstOrLast::first();
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
        $user =
            [
                'user_role_id' => 2,
                'name' => $iddata,
                'email' => $iddata . "@mail.com",
                'password' => $iddata,
            ];
        $checkUser = User::where('name', $iddata)->count();
        if ($checkUser == 0) {
            $user = DB::table('users')->insert($user);
        }
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
    public function showPertanyaan($bagianId)
    {
        $data['title'] = "Kuisioner Alumni";
        $data['iddata'] = session('iddata');

        $data['bagianData'] = Step::with(['pertanyaan' => function ($pertanyaan) {
            $pertanyaan->with(['jawabanJenis', 'textProperties'])->orderBy('pertanyaan_urutan', 'ASC');;
        }, 'bagianDirect'])->where('id', $bagianId)->first();
        // return $data;
        $type = "text";
        foreach ($data['bagianData']->pertanyaan as $row) {
            $jawaban = "";
            $required = "";
            if ($row->required == 1)
                $required = "required";
            $dataJawaban = Jawaban::where(['user_id' => session()->get('userData')->id, 'pertanyaan_id' => $row->id])->get();
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
                    $checked = "";
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
                }
                $content .= '</div>';
                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Select") {
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                $content .= '<select ' . $required . '  class="form-select" name="input[' . $row->id . ']" required>';
                $content .= '<option value="">Pilih</option>';
                foreach ($row->jawabanJenis as $index => $item) {
                    $selected = "";
                    if (count($dataJawaban) > 0)
                        $selected = ($jawaban[0]->jawaban == $item->pilihan_jawaban) ? "selected" : '';
                    $content .= '<option value="' . $item->pilihan_jawaban . '" ' . $selected . '>' . $item->pilihan_jawaban . '</option>';
                }
                $content .= '</select>';
                $content .= '</div>';
                $row->form = $content;
            } else if ($row->pertanyaan_jenis_jawaban == "Pilihan") {
                $content = '<div class="mb-3 position-relative form-group">';
                $content .= '<label class="form-label">' . $row->pertanyaan_urutan . '. ' . $row->pertanyaan . '</label>';
                foreach ($row->jawabanJenis as $index => $item) {
                    $checked = '';
                    if (count($dataJawaban) > 0)
                        $checked = ($jawaban[0]->jawaban == $item->pilihan_jawaban) ? "checked" : '';
                    $content .= '<div class="form-check">
                    <input onclick="removeTextInput(event, ' . $row->id . ')" ' . $required . ' class="form-check-input" type="radio" name="input[' . $row->id . ']" id="input' . $row->id . '' . $index . '" value="' . $item->pilihan_jawaban . '" ' . $checked . '/>
                    <label class="form-check-label" for="input' . $row->id . '' . $index . '">' . $item->pilihan_jawaban . '</label>
                  </div>';
                }
                if ($row->lainnya == "1") {
                    if (count($dataJawaban) > 0)
                        $checked = ($jawaban[0]->jawaban == "lainnya") ? "checked" : '';
                    $content .= '<div class="form-check">
                        <input onclick="showTextInput(event, ' . $row->id . ')" class="form-check-input" type="radio" name="input[' . $row->id . ']" id="inputlainnya' . $row->id . '" value="lainnya" ' . $checked . '/>
                        <label class="form-check-label" for="inputlainnya' . $row->id . '">Lainnya</label>
                    </div>';
                    $check = JawabanLainnya::where('pertanyaan_id', $row->id)->get();
                    if (count($check) > 0)
                        $content .= "<input name='lainnya[" . $row->id . "]' id='lainnya_" . $row->id . "' type='text' class='form-control' value='" . $check[0]->jawaban . "'>";
                }
                $content .= '</div>';

                $row->form = $content;
            }
        }
        $data['akhir'] = false;
        $data['awal'] = false;
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
            foreach ($request->input as $key => $value) {
                if (gettype($value) == "array") {
                    Jawaban::where([
                        'user_id' => session()->get('userData')->id,
                        'pertanyaan_id' => $key
                    ])->delete();
                    foreach ($value as $row) {
                        Jawaban::insert(
                            [
                                'user_id' => session()->get('userData')->id,
                                'pertanyaan_id' => $key,
                                'jawaban' => $row
                            ]
                        );
                    }
                } else {
                    Jawaban::updateOrCreate(
                        [
                            'user_id' => session()->get('userData')->id,
                            'pertanyaan_id' => $key
                        ],
                        [
                            'jawaban' => $value
                        ]
                    );
                }
                JawabanLainnya::where('pertanyaan_id', $key)->delete();
            }
            if (isset($request->lainnya)) {
                foreach ($request->lainnya as $key => $value) {
                    $lainnya = Pertanyaan::where(['id' => $key, 'lainnya' => "1"])->get();

                    if (count($lainnya) > 0) {
                        JawabanLainnya::where('pertanyaan_id', $key)->delete();
                        JawabanLainnya::insert(
                            [
                                'pertanyaan_id' => $key,
                                'jawaban' => $value
                            ]
                        );
                    } else {
                        JawabanLainnya::where('pertanyaan_id', $key)->delete();
                    }
                }
            } else {
                JawabanLainnya::where('pertanyaan_id', $key)->delete();
            }

            $direct = BagianDirect::where('step_id', $bagianId)->first();
            $akhir = FirstOrLast::where('step_id_last', $bagianId)->count();
            if ($akhir > 0) {
                $data['title'] = "Selesai";
                $data['iddata'] = session('iddata');

                return view('user.selesai', $data);
            }
            // return $direct;
            if ($direct->is_direct_by_jawaban == 0) { //jika tidak direct berdasarkan jawaban 
                return redirect()->route('user.show.pertanyaan', $direct->step_id_direct);
            } else { // jika direct
                foreach ($request->input as $key => $value) {
                    $jawabanJenis = JawabanJenis::with('jawabanRedirect')->where([
                        'pertanyaan_id' => $key,
                        'pilihan_jawaban' => $value
                    ])->first();
                }
                // return $jawabanJenis;
                return redirect()->route('user.show.pertanyaan', $jawabanJenis->jawabanRedirect->step_id_redirect);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
