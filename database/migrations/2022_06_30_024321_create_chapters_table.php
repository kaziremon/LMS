<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->longText('learning_outcome');
            $table->softDeletes();
            $table->timestamps();
            //foreign key 1.users table to user_id 2.exam_types to examtype_id 3.question_banks to questionbank_id
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::dropIfExists('chapters');
    }
}
