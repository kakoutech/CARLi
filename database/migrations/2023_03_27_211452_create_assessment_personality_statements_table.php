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
        Schema::create('assessment_personality_statements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_personality_id')->nullable();
            $table->string('statement')->nullable();
            $table->integer('scale_1')->default(0);
            $table->integer('scale_2')->default(0);
            $table->integer('scale_3')->default(0);
            $table->integer('scale_4')->default(0);
            $table->integer('scale_5')->default(0);
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
        Schema::dropIfExists('assessment_personality_statements');
    }
};
