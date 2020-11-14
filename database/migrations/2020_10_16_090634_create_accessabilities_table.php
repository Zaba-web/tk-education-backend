<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->integer('theme_id');
            $table->string('theme_title', 512);
            $table->string('group_name');
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
        //Schema::dropIfExists('accessabilities');
    }
}
