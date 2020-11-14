<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('task_id');
            $table->integer('course_id');
            $table->integer('group_id');
            $table->integer('mark')->nullable();
            $table->string('comment',512)->nullable();
            $table->integer('checked')->default(0);
            $table->integer('is_thematic')->default(0);
            $table->string("link",768);
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
        Schema::dropIfExists('task_results');
    }
}
