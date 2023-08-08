<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('setquestion_id')->unsigned();
            $table->bigInteger('answer')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('setquestion_id')->references('id')->on('set_questions')->onDelete('cascade');
            $table->foreign('answer')->references('id')->on('question_mcqs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_answers');
    }
}
