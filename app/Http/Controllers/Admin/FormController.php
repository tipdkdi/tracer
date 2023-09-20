<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Pertanyaan;
use App\Models\JawabanJenis;
use App\Models\JawabanRedirect;
use App\Models\Jawaban;
use App\Models\BagianDirect;
use App\Models\FirstOrLast;
use App\Models\TextProperties;
use App\Models\UserSesi;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    //
    public function index()
    {

        $data['title'] = "Data Bagian";
        $data['stepData'] = Step::with('stepChild')->whereNull('step_parent')->orderBy('step_urutan', 'ASC')->get();
        // return $data;
        return view('admin.bagian-index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Bagian";
        $data['step'] = Step::whereNull('step_parent')->get();
        return view('admin.bagian-create', $data);
    }
    public function store(Request $request)
    {
        Step::create($request->all());
        return redirect()->route('admin.bagian.index');
    }

    public function edit($bagianId)
    {
        $data['title'] = "Edit Bagian";
        $data['dataBagian'] = Step::find($bagianId);
        $data['bagianParent'] = Step::whereNull('step_parent')->get();
        return view('admin.bagian-edit', $data);
    }

    public function update(Request $request, $bagianId)
    {
        $bagian = Step::find($bagianId);
        $bagian->step_kode = $request->step_kode;
        $bagian->step_urutan = $request->step_urutan;
        $bagian->step_nama = $request->step_nama;
        $bagian->step_parent = $request->step_parent;
        $bagian->save();
        return redirect()->route('admin.bagian.index');
    }
    public function delete($bagianId)
    {
        $bagian = Step::find($bagianId);
        $bagian->delete();
        return redirect()->route('admin.bagian.index');
    }

    public function show($bagianId)
    {
        $data['title'] = "Daftar Pertanyaan";
        $data['stepData'] = Step::with(['pertanyaan' => function ($pertanyaan) {
            $pertanyaan->orderBy('pertanyaan_urutan', 'ASC');
        }])->find($bagianId);
        // return $data;
        return view('admin.pertanyaan', $data);
    }

    public function pertanyaanCreate($bagianId)
    {
        $data['title'] = "Tambah Pertanyaan";
        $data['stepData'] = Step::find($bagianId);
        // return $data;
        return view('admin.pertanyaan-form', $data);
    }
    public function pertanyaanStore(Request $request)
    {
        // return $request->all();
        $jenisJawaban = $request->pertanyaan_jenis_jawaban;

        $dataPertanyaan = [
            "step_id" => $request->step_id,
            "pertanyaan" => $request->pertanyaan,
            "pertanyaan_urutan" => $request->pertanyaan_urutan,
            "pertanyaan_jenis_jawaban" => $request->pertanyaan_jenis_jawaban
        ];
        if (isset($request->addLainnya))
            $dataPertanyaan['lainnya'] = "1";
        if (!isset($request->isRequired))
            $dataPertanyaan['required'] = "0";
        // return $dataPertanyaan;
        $dataJawaban = [];
        $pertanyaan = Pertanyaan::create($dataPertanyaan);
        // return $pertanyaan;
        if ($jenisJawaban == "Text") {
            $dataTextProperties = [
                "pertanyaan_id" => $pertanyaan->id,
                "jenis" => $request->text_jenis
            ];
            $pertanyaan = TextProperties::create($dataTextProperties);
        } else if ($jenisJawaban != "Text" && $jenisJawaban != "Text Panjang") {
            $i = 1;
            foreach ($request->jawaban as $index => $jawaban) {
                $data =
                    [
                        'pertanyaan_id' => $pertanyaan->id,
                        'pilihan_jawaban' => $jawaban,
                        'urutan' => $index,

                    ];
                $dataJawaban[] = $data;
                $i++;
            }
            if (isset($request->addLainnya)) {
                $lainnya =
                    [
                        'pertanyaan_id' => $pertanyaan->id,
                        'pilihan_jawaban' => "lainnya",
                        'urutan' => $i,

                    ];
                $dataJawaban[] = $lainnya;
            }
            // return $dataJawaban;
            JawabanJenis::insert($dataJawaban);
        }

        return redirect()->route('admin.bagian.show', ['stepId' => $request->step_id]);
    }
    public function pertanyaanUpdate(Request $request, $bagianId, $pertanyaanId)
    {
        // return $request->all();
        $pertanyaan = JawabanJenis::where('pertanyaan_id', $pertanyaanId);
        $pertanyaan->delete();

        $jenisJawaban = $request->pertanyaan_jenis_jawaban;

        $dataJawaban = [];

        $pertanyaan = Pertanyaan::find($pertanyaanId);
        // $pertanyaan = Pertanyaan::where(["step_id" => $request->step_id])->first();

        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->pertanyaan_urutan = $request->pertanyaan_urutan;
        $pertanyaan->pertanyaan_jenis_jawaban = $request->pertanyaan_jenis_jawaban;
        if (!isset($request->isRequired))
            $pertanyaan->required = "0";
        else
            $pertanyaan->required = $request->isRequired;
        if (!isset($request->addLainnya))
            $pertanyaan->lainnya = "0";
        else
            $pertanyaan->lainnya = $request->addLainnya;

        $pertanyaan->save();
        // return $pertanyaan;
        if ($jenisJawaban == "Text") {
            $textProperties = TextProperties::where('pertanyaan_id', $pertanyaanId);
            $textProperties->delete();
            $dataTextProperties = [
                "pertanyaan_id" => $pertanyaanId,
                "jenis" => $request->text_jenis
            ];
            $pertanyaan = TextProperties::create($dataTextProperties);
        } else if ($jenisJawaban != "Text" && $jenisJawaban != "Text Panjang") {
            $i = 1;
            foreach ($request->jawaban as $index => $jawaban) {
                $data =
                    [
                        'pertanyaan_id' => $pertanyaanId,
                        'pilihan_jawaban' => $jawaban,
                        'urutan' => $index,

                    ];
                $dataJawaban[] = $data;
                $i++;
            }
            if (isset($request->addLainnya)) {
                $lainnya =
                    [
                        'pertanyaan_id' => $pertanyaan->id,
                        'pilihan_jawaban' => "lainnya",
                        'urutan' => $i,

                    ];
                $dataJawaban[] = $lainnya;
            }
            //return $dataJawaban;
            JawabanJenis::insert($dataJawaban);
        }

        return redirect()->route('admin.bagian.show', ['stepId' => $request->step_id]);
    }


    public function pertanyaanEdit($bagianId, $pertanyaanId)
    {
        $data['title'] = "Edit Pertanyaan";

        $data['stepData'] = Step::with(['pertanyaan' => function ($pertanyaan) use ($pertanyaanId) {
            $pertanyaan->with(['jawabanJenis', 'textProperties'])->where('id', $pertanyaanId);
        }])->find($bagianId);
        // return $data;
        return view('admin.pertanyaan-edit', $data);
    }

    public function jenisJawabanDelete($bagianId, $pertanyaanId, $jenisJawabanId)
    {
        $pertanyaan = JawabanJenis::find($jenisJawabanId);
        $pertanyaan->delete();
        return redirect()->route('admin.set.jawaban.redirect', [$bagianId, $pertanyaanId]);
    }
    public function pertanyaanDelete($bagianId, $pertanyaanId)
    {
        $pertanyaan = Pertanyaan::find($pertanyaanId);
        $pertanyaan->delete();
        return redirect()->route('admin.bagian.show', $bagianId);
    }


    public function bagianDirect()
    {
        $data['title'] = "Pengaturan Direct Bagian";
        $data['bagianData'] = Step::with(['bagianDirect' => function ($bagianDirect) {
            $bagianDirect->with(['stepDirect', 'stepDirectBack']);
        }])->get();
        $data['bagianList'] = Step::all();

        return view('admin.pengaturan-bagian-urutan', $data);
        return $data;
    }
    public function bagianPengaturan()
    {
        $data['title'] = "Pengaturan Bagian";
        $data['firstOrLast'] = FirstOrLast::with(['stepFirst', 'stepLast'])->get();
        $data['bagianList'] = Step::all();

        return view('admin.bagian-pengaturan', $data);
        return $data;
    }
    public function updateFirstOrLast(Request $request)
    {
        try {
            $bagian = FirstOrLast::find($request->id);
            if ($request->jenis == "first")
                $bagian->step_id_first = $request->bagian_id;
            else if ($request->jenis == "last")
                $bagian->step_id_last = $request->bagian_id;
            $bagian->save();
            return array("status" => "sukses");
        } catch (\Throwable $e) {
            return array("status" => "gagal");
        }
    }
    public function bagianDirectStore(Request $request)
    {
        // return $request->all();
        if ($request->jenis == "selanjutnya") {
            BagianDirect::updateOrCreate(
                ['step_id' => $request->step_id],
                [
                    'step_id_direct' => $request->step_id_direct,
                    'is_direct_by_jawaban' => $request->is_direct_by_jawaban,
                ]
            );
        } else if ($request->jenis == "kembali") {
            BagianDirect::updateOrCreate(
                ['step_id' => $request->step_id],
                [
                    'step_id_direct_back' => $request->step_id_direct
                ]
            );
        }
        return array("status" => "sukses");
    }

    public function setJawabanRedirect($stepId, $pertanyaanId)
    {
        $data['title'] = "Pengaturan Pilihan Jawaban";
        $data['bagianData'] = Step::whereHas('pertanyaan', function ($pertanyaan) use ($pertanyaanId) {
            $pertanyaan->where('id', $pertanyaanId);
        })->with('pertanyaan', function ($pertanyaan) use ($pertanyaanId) {
            $pertanyaan->with('jawabanJenis', function ($jawabanJenis) {
                $jawabanJenis->with('jawabanRedirect', function ($jawabanRedirect) {
                    $jawabanRedirect->with('step');
                });
            })->where('id', $pertanyaanId);
        })->find($stepId);
        $data['bagianList'] = Step::all();
        return view('admin.kelola-redirect-jawaban', $data);
        return $data;
    }

    public function storeJawabanRedirect(Request $request)
    {
        // return $request->all();
        // JawabanRedirect::create($request->all());
        JawabanRedirect::updateOrCreate(
            ['jawaban_jenis_id' => $request->jawaban_jenis_id],
            ['step_id_redirect' => $request->step_id_redirect]
        );
        return array("status" => "sukses");
    }
    public function destroyJawabanRedirect(Request $request)
    {
        try {
            JawabanRedirect::where('jawaban_jenis_id', $request->jawaban_jenis_id)->delete();
            return array("status" => "sukses");
        } catch (\Throwable $e) {
            return array("status" => "gagal");
        }
    }
}
