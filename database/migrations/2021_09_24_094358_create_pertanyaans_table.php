<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id');
            $table->string('pertanyaan');
            $table->integer('pertanyaan_urutan');
            $table->enum('pertanyaan_jenis_jawaban', ["Text", "Text Panjang", "Pilihan", "Lebih Dari Satu Jawaban", "Select"]);
            $table->enum('required', ["0", "1"])->default('1');
            $table->enum('lainnya', ["0", "1"])->default('0');
            // $table->boolean('is_lokasi_kerja')->default(false);
            $table->timestamps();

            $table->foreign('step_id')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanyaans');
    }
}
