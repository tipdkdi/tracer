<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\SurveiorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('user.login');
    // return "SEDANG MAINTENANCE";
});
//TIM SURVEI
Route::get('/tim-survei/dashboard', [SurveiorController::class, 'index'])->name('surveior.dashboard');
Route::get('/import', [SurveiorController::class, 'importDataView']);

Route::get('data/dashboard', [DashboardController::class, 'index'])->name('data.dashboard');
Route::get('data/statistik/bagian', [DashboardController::class, 'statistik_bagian'])->name('data.statistik.bagian');
Route::get('data/statistik/data-alumni', [DashboardController::class, 'statistik_data_alumni'])->name('data.statistik.data.alumni');
Route::get('data/data-alumni', [DashboardController::class, 'dataAlumni'])->name('data.alumni');
Route::get('data/data-alumni/{userId}/data-jawaban', [DashboardController::class, 'detailJawaban'])->name('data.get.detail.jawaban');
Route::get('data/cetak/periode/{periode}', [DashboardController::class, 'cetak'])->name('data.cetak');
Route::get('data/data-alumni/{userId}/data-jawaban', [DashboardController::class, 'detailJawaban'])->name('data.get.detail.jawaban');


Route::group(['middleware' => 'auth'], function () {


    //ADMIN
    Route::get('/cetak/periode/{periode}', [DashboardController::class, 'cetak'])->name('admin.cetak');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/statistik/bagian', [DashboardController::class, 'statistik_bagian'])->name('admin.statistik.bagian');
    Route::get('/statistik/data-alumni', [DashboardController::class, 'statistik_data_alumni'])->name('admin.statistik.data.alumni');
    //bagian 
    Route::get('/bagian', [FormController::class, 'index'])->name('admin.bagian.index');
    Route::get('/bagian/tambah', [FormController::class, 'create'])->name('admin.bagian.create');
    Route::post('/bagian/save', [FormController::class, 'store'])->name('admin.bagian.store');
    Route::get('/bagian/edit/{bagianId}', [FormController::class, 'edit'])->name('admin.bagian.edit');
    Route::post('/bagian/update/{bagianId}', [FormController::class, 'update'])->name('admin.bagian.update');
    Route::get('/bagian/hapus/{bagianId}', [FormController::class, 'delete'])->name('admin.bagian.delete');
    //bagian kelola
    Route::get('bagian/{stepId}/kelola', [FormController::class, 'show'])->name('admin.bagian.show');



    Route::get('bagian/{bagianId}/tambah-pertanyaan', [FormController::class, 'pertanyaanCreate'])->name('admin.pertanyaan.create');
    Route::post('/simpan-pertanyaan', [FormController::class, 'pertanyaanStore'])->name('admin.pertanyaan.store');
    Route::get('/bagian/{bagianId}/pertanyaan/hapus/{pertanyaanId}', [FormController::class, 'pertanyaanDelete'])->name('admin.pertanyaan.delete');
    Route::get('/bagian/{bagianId}/pertanyaan/edit/{pertanyaanId}', [FormController::class, 'pertanyaanEdit'])->name('admin.pertanyaan.edit');
    Route::post('/bagian/{bagianId}/pertanyaan/update/{pertanyaanId}', [FormController::class, 'pertanyaanUpdate'])->name('admin.pertanyaan.update');
    Route::get('/bagian/{bagianId}/pertanyaan/{pertanyaanId}/jenis-jawaban/{jenisJawabanId}/hapus', [FormController::class, 'jenisJawabanDelete'])->name('admin.jenisJawaban.delete');

    Route::get('/bagian/{bagianId}/pertanyaan/{pertanyaanId}', [FormController::class, 'setJawabanRedirect'])->name('admin.set.jawaban.redirect');
    Route::get('/bagian/pengaturan/direct', [FormController::class, 'bagianDirect'])->name('admin.bagian.set.urutan');
    Route::get('/bagian/pengaturan/', [FormController::class, 'bagianPengaturan'])->name('admin.bagian.set');
    Route::get('/data-alumni', [DashboardController::class, 'dataAlumni'])->name('admin.data.alumni');
    Route::get('/data-alumni/{userId}/data-jawaban', [DashboardController::class, 'detailJawaban'])->name('admin.get.detail.jawaban');
    // Route::get('/data-alumni/{userId}/data-jawaban', [DashboardController::class, 'detailJawaban'])->name('admin.get.detail.jawaban');
});


// Route::get('bagian/{stepId}/form', [FormController::class, 'setForm'])->name('admin.set.form');
// Route::post('step/{stepId}/simpan', [FormController::class, 'storeJawaban'])->name('admin.set.form.create');

// Route::group(['middleware' => ['web']], function () {

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    // Route::get('/login', function () {
    // return "SEDANG MAINTENANCE";
    // });
    Route::get('/sesi/{iddata}', [UserController::class, 'sesi'])->name('admin.sesi');
    Route::group(['middleware' => 'usersesi'], function () {
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.index');
        Route::get('/periode/{periode}/bagian/{bagianId}', [UserController::class, 'showPertanyaan'])->name('user.show.pertanyaan');
        Route::post('/bagian/simpan-jawaban/{bagianId}', [UserController::class, 'storeJawaban'])->name('user.store.jawaban');
    });
});


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
