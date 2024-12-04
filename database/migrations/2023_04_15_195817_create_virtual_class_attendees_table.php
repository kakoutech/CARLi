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
        Schema::create('virtual_class_attendees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('virtual_class_id')->nullable();
            $table->unsignedBigInteger('learner_id')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('next_class')->nullable();
            $table->datetime('end_date')->nullable();
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
        Schema::dropIfExists('virtual_class_attendees');
    }
};
