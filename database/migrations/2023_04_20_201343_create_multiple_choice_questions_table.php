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
        Schema::create('multiple_choice_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multiple_choice_question_set_id')->nullable();
            $table->string('type')->nullable();
            $table->integer('marks')->nullable();
            $table->string('image_path')->nullable();
            $table->text('question')->nullable();
            $table->text('explanation')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('multiple_choice_questions');
    }
};
