<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColloquiumManagementTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colloquium_management_token', function (Blueprint $table) {
            $table->increments('id');
			$table->integer("colloquium_id")->unsigned();
			$table->string("token")->unique();
            $table->timestamps();

			$table->foreign("colloquium_id")->references("id")->on("colloquia");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colloquium_management_token');
    }
}
