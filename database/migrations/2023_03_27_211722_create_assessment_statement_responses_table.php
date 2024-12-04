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
        Schema::create('assessment_statement_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_response_id')->nullable();
            $table->unsignedBigInteger('assessment_id')->nullable();
            $table->unsignedBigInteger('assessment_statement_id')->nullable();
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
        Schema::dropIfExists('assessment_statement_responses');
    }
};
