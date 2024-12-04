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
        Schema::create('virtual_classes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longtext('description')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->unsignedBigInteger('duration')->nullable();
            $table->unsignedBigInteger('virtual_class_category_id')->nullable();
            $table->string('icon_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('class_type')->nullable();
            $table->string('recurrence')->nullable();
            $table->date('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('recurs_for')->default(0)->nullable();;
            $table->string('host')->nullable();
            $table->string('trainer_password')->nullable();
            $table->string('attendee_password')->nullable();
            $table->boolean('view_scope')->default(0);
            $table->boolean('active')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('virtual_classes');
    }
};
