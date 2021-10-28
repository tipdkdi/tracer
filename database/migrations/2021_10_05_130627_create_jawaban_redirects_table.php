<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_redirects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id_redirect');
            $table->unsignedBigInteger('jawaban_jenis_id');
            $table->timestamps();

            $table->foreign('step_id_redirect')->references('id')->on('steps');
            $table->foreign('jawaban_jenis_id')->references('id')->on('jawaban_jenis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_redirects');
    }
}
