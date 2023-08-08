<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('batch_id')->unsigned();
            $table->integer('total_mark')->nullable();
            $table->integer('obtained_mark')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mark_infos');
    }
}
