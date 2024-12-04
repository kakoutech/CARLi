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
        Schema::create('assessment_wellbeing_statements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_wellbeing_id')->nullable();
            $table->string('statement')->nullable();
            $table->string('type')->nullable();
            $table->string('low_label')->nullable();
            $table->string('high_label')->nullable();
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
        Schema::dropIfExists('assessment_wellbeing_statements');
    }
};
