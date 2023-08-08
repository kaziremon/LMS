<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('chapter_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('question');
            $table->integer('mark');
            $table->longText('rubric')->nullable();
            $table->string('defficult_level')->nullable();
            $table->tinyInteger('draft')->default(1)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_questions');
    }
}
