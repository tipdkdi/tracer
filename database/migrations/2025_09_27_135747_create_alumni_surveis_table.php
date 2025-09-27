<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniSurveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_surveis', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_lulus', 10);
            $table->string('nama', 150);
            $table->string('nim', 30)->unique();
            $table->string('prodi', 100)->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('desa_kel', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 120)->nullable();
            $table->string('provinsi', 120)->nullable();
            $table->string('nama_ortu', 150)->nullable();
            $table->text('alamat_ortu_lengkap')->nullable();
            $table->string('ortu_desa_kel', 100)->nullable();
            $table->string('ortu_kecamatan', 100)->nullable();
            $table->string('ortu_kabupaten', 120)->nullable();
            $table->string('ortu_provinsi', 120)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni_surveis');
    }
}
