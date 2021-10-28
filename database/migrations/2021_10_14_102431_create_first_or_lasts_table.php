<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstOrLastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_or_lasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id_first')->nullable();
            $table->unsignedBigInteger('step_id_last')->nullable();
            $table->timestamps();

            $table->foreign('step_id_first')->references('id')->on('steps');
            $table->foreign('step_id_last')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('first_or_lasts');
    }
}
