<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AlumniSurveiController;
use App\Http\Controllers\SurveiorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('tim-survei/hasil/{kabupaten}', [SurveiorController::class, 'show'])->name('surveior.show');


Route::post('simpan-jawaban-redirect', [FormController::class, 'storeJawabanRedirect'])->name('admin.store.jawaban.redirect');
Route::post('hapus-jawaban-redirect', [FormController::class, 'destroyJawabanRedirect'])->name('admin.delete.jawaban.redirect');
Route::post('/bagian/pengaturan/direct/simpan', [FormController::class, 'bagianDirectStore'])->name('admin.bagian.direct.store');


Route::get('/pertanyaan/bagian/{bagianId}', [DashboardController::class, 'getPertanyaan'])->name('admin.get.pertanyaan');
Route::post('/jawaban/pertanyaan', [DashboardController::class, 'getCountJawaban'])->name('admin.get.count.pertanyaan');
Route::post('/jawaban/pertanyaan/lokasi', [DashboardController::class, 'getCountLokasi'])->name('admin.get.count.lokasi');
Route::post('/jawaban/pertanyaan/angka', [DashboardController::class, 'getAngkaResult'])->name('admin.get.angka.result');
Route::post('/bagian/update/', [FormController::class, 'updateFirstOrLast'])->name('admin.bagian.update.first.Last');
Route::post('/get-users', [DashboardController::class, 'getUsers'])->name('admin.get.users');
Route::get('/filter', [DashboardController::class, 'filterData'])->name('admin.get.filter');
Route::get('/filter/bulan-lulus', [DashboardController::class, 'filterBulanLulus'])->name('admin.get.filter.bulan.lulus');

Route::post('/get-tahun-mengisi', [DashboardController::class, 'getTahunMengisi'])->name('admin.get.tahun.mengisi');
Route::post('/get-filtered-data/periode/{periode}', [DashboardController::class, 'getfilteredData'])->name('admin.get.filterd.data');
Route::post('/get-alumni-data', [DashboardController::class, 'getAlumniData'])->name('admin.get.alumni.data');

Route::get('/user/periode/{periode}', [DashboardController::class, 'getUserPeriode'])->name('get.user.periode');

Route::get('/bagian/{periode}/pertanyaan', [FormController::class, 'getPertanyaanBagian'])->name('get.pertanyaan.bagian');

Route::get('/pertanyaan/{id}/pilihan', [FormController::class, 'getPilihanPertanyaan'])->name('get.pilihan.pertanyaan');
Route::get('/bagian/{id}/copy-pertanyaan/{idCopy}', [FormController::class, 'copyPertanyaan'])->name('copy.pertanyaan');

Route::get('/import', [SurveiorController::class, 'importData'])->name('get.user.mahasiswa');
Route::post('/import', [SurveiorController::class, 'storeImport'])->name('import.store');


Route::get('/get-sesi', [DashboardController::class, 'getSesi'])->name('get.sesi');
Route::get('/get-jawaban', [DashboardController::class, 'getJawaban'])->name('get.alumni.sesi');
Route::get('/get-pertanyaan', [DashboardController::class, 'getPertanyaanCetak']);

Route::get('/alumni', [AlumniSurveiController::class, 'getByKabupaten']);
Route::get('/status/{nim}/{tahun}', [AlumniSurveiController::class, 'getStatus']);

// Route::get('/user/periode/{periode}', [DashboardController::class, 'getUserPeriode'])->name('get.user.periode');

// Route::group(['middleware' => ['api']], function () {

// Route::post('/sesi', [UserController::class, 'sesi'])->name('admin.sesi');
// });
