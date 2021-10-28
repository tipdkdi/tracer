<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagianDirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian_directs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id');
            $table->unsignedBigInteger('step_id_direct')->nullable();
            $table->unsignedBigInteger('step_id_direct_back')->nullable();
            $table->enum('is_direct_by_jawaban', ['0', '1'])->default('0');
            $table->enum('is_first', ['0', '1'])->default('0');
            $table->enum('is_last', ['0', '1'])->default('0');
            $table->timestamps();

            $table->foreign('step_id')->references('id')->on('steps');
            $table->foreign('step_id_direct')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bagian_directs');
    }
}
