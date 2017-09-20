<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Colloquia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colloquia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->integer('training_id')->unsigned();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('speaker', 80);
            $table->string('location', 80);
            $table->string('description', 140);
            $table->tinyInteger('status');
            $table->string('language', 80);
            $table->foreign('training_id')->references('id')->on('training')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colloquia');
    }
}
