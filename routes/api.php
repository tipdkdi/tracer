<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;
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



Route::post('simpan-jawaban-redirect', [FormController::class, 'storeJawabanRedirect'])->name('admin.store.jawaban.redirect');
Route::post('hapus-jawaban-redirect', [FormController::class, 'destroyJawabanRedirect'])->name('admin.delete.jawaban.redirect');
Route::post('/bagian/pengaturan/direct/simpan', [FormController::class, 'bagianDirectStore'])->name('admin.bagian.direct.store');


Route::get('/pertanyaan/bagian/{bagianId}', [DashboardController::class, 'getPertanyaan'])->name('admin.get.pertanyaan');
Route::get('/jawaban/pertanyaan/{pertanyaanId}', [DashboardController::class, 'getCountJawaban'])->name('admin.get.count.pertanyaan');
Route::post('/bagian/update/', [FormController::class, 'updateFirstOrLast'])->name('admin.bagian.update.first.Last');
// Route::group(['middleware' => ['api']], function () {

// Route::post('/sesi', [UserController::class, 'sesi'])->name('admin.sesi');
// });
