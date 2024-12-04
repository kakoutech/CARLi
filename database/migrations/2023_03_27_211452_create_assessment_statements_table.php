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
        Schema::create('assessment_statements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id')->nullable();
            $table->unsignedBigInteger('assessment_group_id')->nullable();
            $table->string('statement')->nullable();
            $table->string('scale')->nullable();
            $table->string('scale_1_text')->nullable();
            $table->integer('scale_1')->default(0);
            $table->string('scale_2_text')->nullable();
            $table->integer('scale_2')->default(0);
            $table->string('scale_3_text')->nullable();
            $table->integer('scale_3')->default(0);
            $table->string('scale_4_text')->nullable();
            $table->integer('scale_4')->default(0);
            $table->string('scale_5_text')->nullable();
            $table->integer('scale_5')->default(0);
            $table->string('scale_6_text')->nullable();
            $table->integer('scale_6')->default(0);
            $table->string('scale_7_text')->nullable();
            $table->integer('scale_7')->default(0);
            $table->string('scale_8_text')->nullable();
            $table->integer('scale_8')->default(0);
            $table->string('scale_9_text')->nullable();
            $table->integer('scale_9')->default(0);
            $table->string('scale_10_text')->nullable();
            $table->integer('scale_10')->default(0);
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
        Schema::dropIfExists('assessment_statements');
    }
};
