<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_multiple_choice_question_set_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_course_multiple_choice_question_set_id')->nullable();
            $table->unsignedBigInteger('multiple_choice_question_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('answer')->nullable();
            $table->integer('score')->nullable();
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
        Schema::dropIfExists('user_course_multiple_choice_question_set_responses');
    }
};
