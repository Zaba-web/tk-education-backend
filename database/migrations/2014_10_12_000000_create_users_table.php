<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->integer('group_id');
            $table->smallInteger('access_level')->default(1);
            $table->smallInteger('confirmed')->default(0);
            $table->smallInteger('student_number')->nullable();
            $table->smallInteger('subgroup')->nullable();
            $table->rememberToken();
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
        //Schema::dropIfExists('users');
    }
}
