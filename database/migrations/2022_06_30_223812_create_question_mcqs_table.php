<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionMcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_mcqs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('setquestion_id')->unsigned();
            $table->string('option');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('question_mcqs');
    }
}
