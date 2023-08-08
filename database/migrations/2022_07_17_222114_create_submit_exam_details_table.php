<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_exam_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('submitexam_id')->unsigned();
            $table->bigInteger('setquestion_id')->unsigned();
            $table->longText('answer')->nullable();
            $table->integer('mark')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('submitexam_id')->references('id')->on('submit_exams')->onDelete('cascade');
            $table->foreign('setquestion_id')->references('id')->on('set_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submit_exam_details');
    }
}
