<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_title');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('batch_id')->unsigned();
            $table->string('start_time');
            $table->string('end_time');
            $table->date('date');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('mark_publish')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
